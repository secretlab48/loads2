jQuery(document).ready( function( $ ) {
   
    
    $('form#login').on('submit', function(e){
        e.preventDefault();
        $('form#login p.status').show().text(ajaxdata.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxdata.url,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'remember_user': $('form#login #remember_user').val(),
                'security': $('form#login #security').val() },
            success: function(data){
                console.log(data);
                $('form#login p.status').text(data.message);
                if (data.loggedin == true){
                    document.location.href = data.redirecturl;
                }
            }
        });
    });

    /*$(document).on( 'click', 'button.site-button', function( e ) {
        console.log(e.target);
    });*/

    // Perform AJAX login/register on form submit
    $('form#register').on('submit', function (e) {
        $('form#register p.status').show().text(ajaxdata.loadingmessage);
        if ($(this).attr('id') == 'register') {
            action = 'ajaxregister';
            username = $('#signonname').val();
            password = $('#signonpassword').val();
            email = $('#email').val();
            //role = $('#role').val();
            security = $('#registersecurity').val();
        }
        ctrl = $(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxdata.url,
            data: {
                'action': action,
                'username': username,
                'password': password,
                'email': email,
                //'role': role,
                'security': security
            },
            success: function (data) {
                $('p.status', ctrl).text(data.message);
                if (data.loggedin == true) {
                    document.location.href = data.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

    // Perform AJAX forget password on form submit
    $('form#forgot_password').on('submit', function(e){
        $('p.status', this).show().text(ajaxdata.loadingmessage);
        ctrl = $(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxdata.url,
            data: {
                'action': 'ajaxforgotpassword',
                'user_login': $('#user_login').val(),
                'security': $('#passforgotsecurity').val(),
            },
            success: function(data){
                $('p.status',ctrl).text(data.message);
            }
        });
        e.preventDefault();
        return false;
    });


    $('.sign-in-link.not-logged-in').on( 'click', function( e ) {
        e.preventDefault();
        $('.login-form-box form').toggleClass('active');
    });
    
    
    
        $(document).on( 'click', 'a.log-in-here', function( e ) {
        e.preventDefault();

        $('a.sign-in-link.not-logged-in').trigger('click');
        $('html, body').animate( { 'scrollTop' : 0 }, 700 );

    });


    $('.login-form-box form .reg').on('click', function(e){
        e.preventDefault();
        $('.modal-login').show();
        $('.modal-login > div').hide();
        $('.modal-login_reg').fadeIn();
    });

    $('.login-form-box form > a').on('click', function(e){
        if($('#login').length){
            e.preventDefault();
        }
    });
    $('.login-form-box form .lost').on('click', function(e){
        e.preventDefault();
        $('.modal-login').show();
        $('.modal-login > div').hide();
        $('.modal-login_res').fadeIn();
    });

    $('.modal-login_reg .lrm-login_exit, .modal-login_res .lrm-login_exit').on('click',function(e){
        e.preventDefault();
        $('.modal-login').fadeOut();
    });

    $('.modal-login_reg_login').on('click',function(e){
        e.preventDefault();
        $('.modal-login').fadeOut();
        $('.lrm-login').mouseover();
    });


    $('.login-form-box form .lrm-login_exit').on('click', function(e){
        e.preventDefault();
        $('.sign-in-link').trigger('click');
    });
    
});