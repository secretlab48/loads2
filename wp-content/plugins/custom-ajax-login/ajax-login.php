<?php

/**
 * Plugin Name: Custom Ajax Login Form
*/

add_action( 'init', function() {

    wp_enqueue_style('ajax_login_css', plugin_dir_url(__FILE__) . '/css/ajax-login.css');
    wp_register_script('ajax_login_js', plugin_dir_url(__FILE__) . '/js/ajax-login.js', array('jquery'), false, true);
    wp_enqueue_script('ajax_login_js');

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
    add_action( 'wp_ajax_ajaxlogin', 'ajax_login' );
    add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
    add_action( 'wp_ajax_ajaxregister', 'ajax_register' );
    add_action( 'wp_ajax_nopriv_ajaxforgotpassword', 'ajax_forgotPassword' );
    add_action( 'wp_ajax_ajaxforgotpassword', 'ajax_forgotPassword' );

} );


function recruit_update_user_info( $user, $resume_id = null, $mode = 'add_resume' ) {

    if ( !is_object( $user ) ) {
        $user = get_user_by( 'ID', $user );
    }

    $meta = get_user_meta( $user->ID, 'user_info', true );
    if ( $meta == '' ) {
        $meta = array( 'last_seen' => time(), 'linked_resumes' => array() );
    }

    if ( !$resume_id ) {
        $meta['last_seen'] = time();
    }
    else {
        $meta['last_seen'] = time();
        if ( $mode == 'add_resume' ) {
            if (!in_array($resume_id, $meta['linked_resumes']))
                $meta['linked_resumes'][] = $resume_id;
        }
        else {
            if ( ( $key = array_search( $resume_id, $meta['linked_resumes'] ) ) !== false) {
                unset( $meta['linked_resumes'][$key] );
            }
        }
    }

    update_user_meta( $user->ID, 'user_info', $meta );

}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = $_POST['remember_user'];

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message' => _x( 'Not valid credentials, please check it and try again', 'recruit', 'reg-form' ) ) );
    } else {
        recruit_update_user_info( $user_signon );
        echo json_encode( array( 'loggedin'=>true, 'message'=>_x( 'You have hogged in, please wait...', 'recruit', 'reg-form' ), 'redirecturl' => site_url() ) );
    }

    die();
}

function auth_user_login( $user_login, $password, $login )
{
    $info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;

    $user_signon = wp_signon( $info, '' ); // From false to '' since v4.9
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Неправильный логин или пароль.')));
    } else {
        wp_set_current_user($user_signon->ID);
        echo json_encode(array('loggedin'=>true, 'message'=>__('Вы успешно зарегистрировались, ожидайте...')));
    }

    die();
}

function ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'registersecurity', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass'] = sanitize_text_field($_POST['password']);
    $info['user_email'] = sanitize_email( $_POST['email']);
    $info['role'] = 'applicant'; //sanitize_text_field( $_POST['role']);

    $email_validate = filter_var($info['user_email'], FILTER_VALIDATE_EMAIL);
    if(!$email_validate){
        echo json_encode( array( 'loggedin'=>false, 'message'=>_x( 'Некорректно введен email', 'recruit', 'reg-form' ) ) );
        die();
    }
    // Register the user
    if(strlen($info['user_pass']) < 6){
        echo json_encode( array('loggedin'=>false, 'message'=>_x( 'Password con not be less 6 symbols', 'recruit', 'reg-form' ) ) );
        die();
    }
    if( $info['role'] != 'applicant' && $info['role'] != 'employer' ){
        echo json_encode( array( 'loggedin'=>false, 'message'=>_x( 'You must choose your role', 'recruit', 'reg-form' ) ) );
        die();
    }
    $user_register = wp_insert_user( $info );
    if ( is_wp_error($user_register) ){
        $error  = $user_register->get_error_codes()	;

        if(in_array('empty_user_login', $error))
            echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
        elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message'=> _x( 'This E-mail already exists', 'recruit', 'reg-form' ) ) );
        elseif(in_array('existing_user_login',$error))
            echo json_encode(array('loggedin'=>false, 'message'=> _x( 'This LOGIN already exists', 'recruit', 'reg-form' ) ) );
    } else {
        $user_signon = wp_signon( array( 'user_login' => $info['user_login'], 'user_password' => $info['user_pass'], 'remember' => true ), '' );
        echo json_encode( array( 'loggedin'=>true, 'message'=>_x( 'You are logged in', 'recruit', 'reg-form' ) ) );
        //auth_user_login( $info['user_login'], $info['user_pass'], 'Registration' );
    }

    die();
}


function ajax_forgotPassword(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'passforgotsecurity', 'security' );
    global $wpdb;

    $account = $_POST['user_login'];

    if( empty( $account ) ) {
        $error = _x( 'Input user login or user Email.', 'recruit', 'reg-form' );
    } else {
        if(is_email( $account )) {
            if( email_exists($account) )
                $get_by = 'email';
            else
                $error = _x( 'No such Email in our DB', 'recruit', 'reg-form' );
        }
        else if (validate_username( $account )) {
            if( username_exists($account) )
                $get_by = 'login';
            else
                $error = _x( 'We have not user with this login', 'recruit', 'reg-form' );
        }
        else
            $error = _x( 'Invalid login or Email', 'recruit', 'reg-form' );
    }

    if(empty ($error)) {
        // lets generate our new password
        //$random_password = wp_generate_password( 12, false );
        $random_password = wp_generate_password();
        // Get user data by field and data, fields are id, slug, email and login
        $user = get_user_by( $get_by, $account );
        $update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
        // if  update user return true then lets send user an email containing the new password
        if( $update_user ) {

            $from = 'WRITE SENDER EMAIL ADDRESS HERE'; // Set whatever you want like mail@yourdomain.com

            if(!(isset($from) && is_email($from))) {
                $sitename = strtolower( $_SERVER['SERVER_NAME'] );
                if ( substr( $sitename, 0, 4 ) == 'www.' ) {
                    $sitename = substr( $sitename, 4 );
                }
                $from = 'admin@'.$sitename;
            }

            $to = $user->user_email;
            $subject = _x( 'your new password', 'recruit', 'reg-form' );
            $sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";

            $message = _x( 'your new password', 'recruit', 'reg-form' ) . ': '.$random_password;

            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = $sender;

            $mail = wp_mail( $to, $subject, $message, $headers );
            if( $mail )
                $success = _x( 'Check your Emai for your new password', 'recruit', 'reg-form' );
            else
                $error = _x( 'Technical error, try again later', 'recruit', 'reg-form' );
        }
        else {
            $error = _x( 'Technical error, try again later', 'recruit', 'reg-form' );
        }
    }

    if( ! empty( $error ) )
        echo json_encode(array('loggedin'=>false, 'message'=>__($error)));

    if( ! empty( $success ) )
        echo json_encode(array('loggedin'=>false, 'message'=>__($success)));

    die();
}




function get_ajax_login_form() {


    $out = '';
    if ( !is_user_logged_in() ) {
        $out = '<div class="login-form-box">
                    <form id="login" action="login" class="lrm-login-form" method="post">
                        <p class="status"></p>
                        <input id="username" class="lrm-input" type="text" name="username" placeholder="' . _x( 'E-mail', 'recruit', 'login-forms' ) . '">
                        <input id="password" class="lrm-input" type="password" name="password" placeholder="' . _x( 'Password', 'recruit', 'login-forms' ) . '">
                        <div class="lrm-h">
                            <div class="checkbox-box">
                                <div class="v-checkbox">
                                    <input id="remember_user" name="remember_user" type="checkbox">
                                    <span class="marker"></span><span class="name">' . _x( 'Remember me', 'recruit', 'login-forms' ) . '</span>
                                </div>
                            </div>
                            <!--<a class="lost" href="' . wp_lostpassword_url() . '">' . _x( 'Forgot password', 'recruit', 'login-forms' ) . '</a>-->
                        </div>
                        <div class="lrm-h">
                            <p>' . _x( 'Do not have an account yet?', 'recruit', 'login-forms' ) . '</p>
                            <!--<a class="reg" href="' . wp_lostpassword_url() . '">' . _x( 'Create Account', 'recruit', 'login-forms' ) . '</a>-->
                            <a class="userpro-register-page" href="' . site_url() . '/profile/register">' . _x( 'Create Account', 'recruit', 'login-forms' ) . '</a>
                        </div>
                        <button class="submit_button site-button" type="submit" name="submit">' . _x( 'Log in', 'recruit', 'login-forms' ) . '</button>
                        '. wp_nonce_field( 'ajax-login-nonce', 'security', true, false ) . '
                    </form>
                </div>';
    }
    else {
        $out = '<div class="login-form-box"><a class="btn-link" type="submit" href="' . wp_logout_url( home_url() ) . '">' . _x( 'Log Out', 'recruit', 'login-forms' ) . '</a></div>';
    }

    return $out;

}



add_action ( 'wp_footer', 'get_login_modals' );

function get_login_modals() {

    $out =
        '<div class="modal-login">
			<div class="modal-login_reg">
				<!--<div class="bg">
					<img src="https://www.protokeratin.ru/wp-content/themes/UDFT/img/pero.png" alt="pero">
					<p>' . _x( 'Have account?', 'recruit', 'login-forms' ) . '<a href="" class="modal-login_reg_login">' . _x( 'Log In', 'recruit', 'login-forms' ) . '</a></p>
				</div>-->
				<form id="register" class="ajax-auth" action="register" method="post">
				    <div class="lrm-login_exit"></div>
					<p class="title">' . _x( 'REGISTRATION', 'recruit', 'login-forms' ) . '</p>
					<p class="status"></p>' .
					wp_nonce_field( 'registersecurity', 'registersecurity', true, false ) .
					'<input id="signonname" type="text" class="lrm-input required" name="signonname" placeholder="' . _x( 'Name', 'recruit', 'login-forms' ) . '">
					<input id="email" type="text" class="lrm-input required email" name="email" placeholder="' . _x( 'E-mail', 'recruit', 'login-forms' ) . '">
					<!--<select id="role" class="required role" name="role">
					    <option value="applicant">' . _x( 'applicant', 'recruit', 'reg-form' ) . '</option>
					    <option value="employer">' . _x( 'employer', 'recruit', 'reg-form' ) . '</option>
					</select>-->
					<input id="signonpassword" type="password" class="required lrm-input" name="signonpassword" placeholder="' . _x( 'Password', 'recruit', 'login-forms' ) . '">
					<input type="password" id="password2" class="required lrm-input" name="password2" placeholder="' . _x( 'Retype password', 'recruit', 'login-forms' ) . '">
					<button class="submit_button site-button" name="submit" type="submit">' . _x( 'register', 'recruit', 'login-forms' ) . '</button>  
					<p class="policy">' . _x( 'You agree with ', 'recruit', 'login-forms' ) . '<br> с <a href="https://www.protokeratin.ru/usloviya-i-soglasheniya">' . _x( 'terms and confitions', 'recruit', 'login-forms' ) . '</a></p>
				</form>
			</div>
			<div class="modal-login_res">
			   <form id="forgot_password" class="ajax-auth" action="forgot_password" method="post">    
					<div class="lrm-login_exit"></div>
                    <div class="lrm-title">' . _x( 'restore password', 'recruit', 'login-forms' ) . '</div>
					<p class="status"></p>' .
                    wp_nonce_field( 'passforgotsecurity', 'passforgotsecurity', true, false ) .
					'<input id="user_login" class="lrm-input" type="text" class="required" name="user_login" placeholder="' . _x( 'Mame or E-mail', 'recruit', 'login-forms' ) . '">
					 <button class="submit_button site-button" type="submit">' . _x( 'send request', 'recruit', 'login-forms' ) . '</button>
				</form>  
			</div>
		</div>';

    echo $out;


}
