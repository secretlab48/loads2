<?php
/*
 *  Author: CA
 *  Custom functions, support, custom post types and more.
 */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*------------------------------------*\
	Functions
\*------------------------------------*/

global $udft;

require_once ( 'inc/functions.php' );
require_once ( 'inc/emailes/subscribtion-request.php' );
require_once ( 'inc/newsletter2go-api.php' );



add_action( 'init', 'udft::init' );

class UDFT
{

    static function init()
    {

        global $udft;

        $user = wp_get_current_user();
        $udft['user'] = array( 'id' => $user->ID, 'data' => $user->data, 'role' => isset( $user->roles[0] ) ?  $user->roles[0] : false );

        if (function_exists('add_theme_support')) {

            add_theme_support('menus');
            add_theme_support('widgets');

            add_theme_support('post-thumbnails');
            add_image_size('post-large', 740, 420, true);
            add_image_size('post-small', 370, 290, true);

            load_theme_textdomain('tpl', get_template_directory() . '/languages');
        }

        add_filter('widget_text', 'do_shortcode');

        wp_enqueue_style('bootstrap-template_css', get_template_directory_uri() . '/css/grid.css');
        if ( !is_admin() ) {
            wp_enqueue_style('main_custom_css', get_template_directory_uri() . '/css/custom.css');
        }
        wp_register_script('preloader_js', get_template_directory_uri() . '/js/preloader.js', array('jquery'), false, true);
        wp_enqueue_script('preloader_js');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style('jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, null );
        //wp_enqueue_style('air-datepicker_css', get_template_directory_uri() . '/js/air-datepicker/datepicker.css');
        wp_enqueue_style('fontawesome_css', get_template_directory_uri() . '/css/font-awesome.css');
        wp_enqueue_style('slick_css', get_template_directory_uri() . '/inc/slick/slick.css');
        wp_enqueue_style('slick__theme_css', get_template_directory_uri() . '/inc/slick/slick-theme.css');

        wp_register_script('jquery_de_js', get_template_directory_uri() . '/js/de-datepicker.js', array('jquery'), false, true);
        wp_enqueue_script('jquery_de_js');
        wp_register_script('gsap_js', get_template_directory_uri() . '/js/gsap/minified/gsap.min.js', array('jquery'), false, true);
        wp_enqueue_script('gsap_js');
        wp_register_script('scrollMagic_js', get_template_directory_uri() . '/js/scrollMagic/ScrollMagic.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_js');
        wp_register_script('scrollMagic_jquery_js', get_template_directory_uri() . '/js/scrollMagic/plugins/jquery.ScrollMagic.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_jquery_js');
        wp_register_script('scrollMagic_gsap_js', get_template_directory_uri() . '/js/scrollMagic/plugins/animation.gsap.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_gsap_js');
        wp_register_script('scrollMagic_dev_js', get_template_directory_uri() . '/js/scrollMagic/plugins/debug.addIndicators.js', array('jquery'), false, true);
        wp_enqueue_script('scrollMagic_dev_js');
        /*wp_register_script('air-datepicker_js', get_template_directory_uri() . '/js/air-datepicker/datepicker.js', array('jquery'), false, true);
        wp_enqueue_script('air-datepicker_js');*/
        wp_register_script('slick_js', get_template_directory_uri() . '/inc/slick/slick.js', array('jquery'), false, true);
        wp_enqueue_script('slick_js');
        wp_register_script('mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array('jquery'), false, true);
        wp_enqueue_script('mousewheel_js');
        wp_register_script('custom_js', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true);
        wp_enqueue_script('custom_js');


        add_action( 'wp_ajax_get_subscibtion_mail_answer', 'get_subscibtion_mail_answer' );
        add_action( 'wp_ajax_nopriv_get_subscibtion_mail_answer', 'get_subscibtion_mail_answer' );


        register_nav_menus(array(
            'header-location' => 'Top Memu',
            'footer-location' => 'Footer Menu'
        ));

        add_action('wp_enqueue_scripts', array('UDFT', 'add_ajax_data'), 99);

    }


    static function add_ajax_data()
    {

        wp_localize_script('jquery', 'ajaxdata',
            array(
                'url' => admin_url('admin-ajax.php'),
            )
        );
    }


    static function get_template_part($template, $part_name = null, $mode = 'return')
    {

        if ($mode == 'return') {
            ob_start();
            get_template_part($template, $part_name);
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        } else {
            get_template_part($template);
        }

    }

}


/* CUSTOM */


add_filter('upload_mimes', 'kmwp_mime_types');

function kmwp_mime_types( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';
    return $mimes;

}


function block_wpadmin() {
    $file = basename($_SERVER['PHP_SELF']);
    if ( is_admin() && ( $file == 'plugins.php' || $file == 'themes.php' || $file == 'plugin-install.php' || $file == 'plugin-editor.php' || $file == 'theme-editor.php')){
        wp_redirect( admin_url() );
        exit();
    }
}

//add_action('init', 'block_wpadmin');



add_filter( 'wp_revisions_to_keep', 'filter_function_name', 10, 2 );

function filter_function_name( $num, $post ) {

    return 0;

}



add_action( 'wp_footer', 'loads_wp_footer' );

function loads_wp_footer() {

    $out =
        '<div class="modal-box">
            <div class="modal-content-box">
                <div class="modal-content">
                    <div class="form-messages">
                        <div class="modal-close"></div>
                        <div class="fm-content">
                            <div class="fm-title"></div>
                            <div class="fm-text"></div>
                            <div class="fm-dialog"></div>
                            <a class="fm-btn site-button">ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    $out .=
        '<div class="map-info-box">
             <div class="map-addr"> 
                 <div class="bold">Bachweg 25</div>
                 <div class="mib-addres">Bachweg Str. 25, Oestrich-Winkel, Deutschland</div>
             </div>
             <div class="link-box">
                 <div class="link-img"></div>
                 <a href="https://www.google.com/maps/dir/?api=1&destination=Bachweg+Str.+25,+Oestrich-Winkel,+Germany&travelmode=driving">Routenplaner</a>
             </div>
         </div>';

    echo $out;

}



add_action ( 'wp_head', function( ) {

   global $post;

   $out = '';

   if ( $post && $post->ID && $post->ID == 14 ) {
       $out = '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJH_df0u-I98JmaAWGZMqWsLMu8EvQL6Q&language=de"></script>';
   }

   echo $out;

});





function custom_sidebars() {
    register_sidebar(
        array (
            'name' => __( 'Test', 'your-theme-domain' ),
            'id' => 'test-side-bar',
            'description' => __( 'Test Sidebar', 'tpl' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'custom_sidebars' );



function dpdm_term_access_filter( $term, $role_curr_user ) {

    global $wpdb;

    $out = false;

    $str = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "termmeta` WHERE `term_id` = '".$term->term_id."' and `meta_key` = '__wpdm_access' ");
    $meta_id = "";
    if( $str ) {
        $meta_value = $str[0]->meta_value;
        $mass = unserialize($meta_value);
        if( $role_curr_user == "" ){
            $role_curr_user = "guest";
        }
        $elem_roles = array();
        foreach($mass as $key=>$roles){
            if($roles != "__wpdm__"){
                $elem_roles[] = $roles;
            }
        }
        if ( $role_curr_user == 'administrator' && !in_array('administrator', $elem_roles ) ) {
            $elem_roles[] = 'administrator';
        }
        if( in_array( $role_curr_user, $elem_roles ) || ( count( $elem_roles ) == 1 && $elem_roles[0] == 'guest' )/* || count( $elem_roles ) == 0*/ ){
            $out = $term;
        }
        else {
            $out = false;
        }
    }
    else {
        $out = $term;
    }

    return $out;

}



function smyles_get_taxonomy_hierarchy( $taxonomy, $parent = 0, $args = array( 'hide_empty' => false ), $out = '' ) {

    $defaults = array(
        'parent' => $parent,
        'hide_empty' => false
    );

    $r = wp_parse_args( $args, $defaults );

    $terms = get_terms( $taxonomy, $r );

    $children = array();
    foreach ( $terms as $term ) {
        $data = smyles_get_taxonomy_hierarchy( $taxonomy, $term->term_id, array( 'hide_empty' => false, ), $out );
        $term->children = $data['children'];
        $children[ $term->term_id ] = $term;
    }

    return array( 'children' => $children );
}




add_shortcode( 'loads_wpdm_categories', 'loads_wpdm_categories' );

function loads_wpdm_categories( $args ) {

    $out = '<div class="dpbmpro-sidebar"><div class="dpbmpro-cats">' . get_wpdm_cat_menu() . '</div></div>';

    return $out;

}




function dpbm_downloads_archive_args_filter( $params ) {

    $taxonomy_name = get_query_var('wpdmcategory');

    $tax_query = array();
    if ( $taxonomy_name != '' ) {
        $tax_query =
            array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'wpdmcategory',
                    'field' => 'slug',
                    'terms' => $taxonomy_name
                )
            );

    }

    $user = wp_get_current_user();
    if ($user->ID == 0) {
        $role = "guest";
    } else {
        $user_data = get_userdata($user->ID);
        $role = $user_data->roles[0];
    }

    if($role == 'administrator') {
        $args = array(
            'post_type' => 'wpdmpro',
            //'is_paged' => 1,
            'paged' => $params['paged'],
            'posts_per_page' => $params['ppp'],
            'tax_query' => $tax_query
        );
    }
    else {
        $args = array(
            'post_type' => 'wpdmpro',
            'is_paged' => 1,
            'paged' => $params['paged'],
            'posts_per_page' => $params['ppp'],
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '__wpdm_access',
                    'value' => $role,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => '__wpdm_access',
                    'value' => '',
                    'compare' => '=',
                ),
                array(
                    'key' => '__wpdm_access',
                    'value' => 'guest',
                    'compare' => 'LIKE',
                ),
            ),
            'tax_query' => $tax_query
        );
    }

    return $args;

}



function loads_wpdm_category_items( $params = array() ) {

    global $wp_query, $post;
    $paged = (get_query_var('paged'))? get_query_var('paged') : 1;
    $ppp = isset( $params['ppp'] ) ? $params['ppp'] : -1;
    $out = '';


        $args = dpbm_downloads_archive_args_filter( array( 'paged' => $paged, 'ppp' => $ppp ) );
        //var_dump($args);
        $sort_title_class = $sort_date_class = 'asc';

        if(!isset($_GET['sortname']) || $_GET['sortname'] == 'desc')
            $sortname = 'asc';
        else
            $sortname = 'desc';

        if(isset($_GET['sortby'])){
            $args['orderby'] = $_GET['sortby'];
            $args['order'] = $_GET['sortname'];
            if ( $_GET['sortby'] == 'title' ) {
                $sort_title_class = $sortname;
            }
            else if ( $_GET['sortby'] == 'modified' ) {
                $sort_date_class = $sortname;
            }
        }
        $query = new WP_Query( $args );
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

        $out .= loads_get_pagination( array( 'page' => $paged, 'q' => $query->found_posts, 'ppp' => $ppp, 'base' => site_url() . '/' . preg_replace( '/\/$/', '', preg_replace( '/page\/[0-9]+\//', '', $_SERVER['REQUEST_URI'] ) ), 'qs' => preg_replace( '/page\/[0-9]+\//', '', $_SERVER['QUERY_STRING'] ) ) );

        $out .=
            '<div class="dpbmpro-content-table">
                 <table class="dpbmpro-downloads-archive">
                     <thead>
                         <th class="dpbmpro-name"><a class="dpbm-sort-link sort-by-name ' . $sort_title_class . '" href="' . get_site_url() . $uri_parts[0] . '?sortby=title&sortname=' . $sortname . '">Name</a></th>
                         <th class="dpbmpro-date"><a class="dpbm-sort-link sort-by-date ' . $sort_date_class . '"href="' . get_site_url() . $uri_parts[0] . '?sortby=modified&sortname=' . $sortname . '">Date</a></th>
                         <th class="dpbmpro-action"></th>
                     </thead>
                     <tbody>';
        while( $query->have_posts() ){
            $query->the_post();

            $pack = (array)$post;
            $out .= wpdm_download_archive_item( $post );
        }
        $out.=
            '</tbody></table></div>';


        return $out;


}


add_shortcode( 'loads_wpdm_category_items', 'loads_wpdm_category_items' );



function wpdm_download_archive_item( $p ) {

    $file = get_post_meta( $p->ID, '__wpdm_files', true );
    $icon = get_post_meta( $p->ID, '__wpdm_icon', true );
    $style = '';
    if ( strlen( $icon ) > 0 ) {
        $style = ' style="background-image:url(' . $icon . ');"';
    }

    $out =
        '<tr class="download-item-line">
             <td><span class="dpbmpro-icon"' . $style . '></span>' . get_the_title( $p->ID ) . '</td>
             <td>' . get_the_modified_date('d.m.Y', $p ) . '</td>
             <td><a class="dpbmpro-download-link" href="' . preg_replace( '/&refresh.+/', '', wpdm_download_url( $p->ID ) ) . '" download>download</a></td>
         </tr>';

    return $out;

}



function get_downloads_search_form() {

    $s = isset( $_GET['s'] ) ? $_GET['s'] : '';

    $out =
        '<form class="dpbm-search-form">
            <div class="dpbm-word-box">
                <input class="dpbm-word" name="s" value="' . $s . '">
                <input type="hidden" name="posttype" value="downloads">
                <button class="dpbm-form-submit" type="submit"></button>
            </div>
         </form>';

    return $out;

}




function get_downloads_search_form_results( $args = array() ) {

    global $wp_query, $post;
    $paged = (get_query_var('paged'))? get_query_var('paged') : 1;
    $ppp = isset( $args['ppp'] ) ? $args['ppp'] : -1;
    $out = '';

    $args = dpbm_downloads_archive_args_filter( array( 'paged' => 1, 'ppp' => -1 ) );

    $sort_title_class = $sort_date_class = 'asc';

    if(!isset($_GET['sortname']) || $_GET['sortname'] == 'desc')
        $sortname = 'asc';
    else
        $sortname = 'desc';

    if(isset($_GET['sortby'])){
        $args['orderby'] = $_GET['sortby'];
        $args['order'] = $_GET['sortname'];
        if ( $_GET['sortby'] == 'title' ) {
            $sort_title_class = $sortname;
        }
        else if ( $_GET['sortby'] == 'modified' ) {
            $sort_date_class = $sortname;
        }
    }

    $query = $wp_query;
    $args['s'] = $_GET['s'];
    $query = new WP_Query( $args );

    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

    $out .=
        '<div class="dpbmpro-content-table">
                 <table class="dpbmpro-downloads-archive">
                     <thead>
                         <!--<th class="dpbmpro-name"><a class="dpbm-sort-link sort-by-name ' . $sort_title_class . '" href="' . get_site_url() . $uri_parts[0] . '?s=&posttype=downloads' . '&sortby=title&sortname=' . $sortname . '">Name</a></th>
                         <th class="dpbmpro-date"><a class="dpbm-sort-link sort-by-date ' . $sort_date_class . '"href="' . get_site_url() . $uri_parts[0] . '?sortby=modified&sortname=' . $sortname . '">Date</a></th>
                         <th class="dpbmpro-action"></th>-->
                     </thead>
                     <tbody>';
    while( $query->have_posts() ){
        $query->the_post();

        $pack = (array)$post;
        $out .= wpdm_download_archive_item( $post );
    }
    $out.=
        '</tbody></table></div>';

    $out .= loads_get_pagination( array( 'page' => $paged, 'q' => $query->found_posts, 'ppp' => $ppp, 'base' => site_url() . '/' . preg_replace( '/\/$/', '', preg_replace( '/page\/[0-9]+\//', '', $_SERVER['REQUEST_URI'] ) ), 'qs' => preg_replace( '/page\/[0-9]+\//', '', $_SERVER['QUERY_STRING'] ) ) );

    return $out;


}


add_filter( 'pre_get_posts', function( $query ) {

    if ( !is_admin() && $query->is_main_query() ) {
        if ( is_tax( 'wpdmcategory' ) ) {
            $query->set( 'posts_per_page', 2 );
        }
        if ( is_search() && isset( $_GET['posttype'] ) && $_GET['posttype'] != '' ) {
            $query->set( 'post_type', 'wpdmpro' );
            $query->set( 'posts_per_page', -1 );
        }
    }

    return $query;

} );



add_filter( 'posts_where' , function( $where ) {

    global $wp_query;

    if ( !is_admin() && $wp_query->is_main_query() ) {
        if ( is_search() && isset( $_GET['posttype'] ) && $_GET['posttype'] == 'downloads' ) {
            $where = preg_replace( '/AND.?\(.+wp_term[^)]+\).?\)/s', '', $where );
        }
    }

    return $where;

} );





function template_chooser($template)
{
    global $wp_query;
    $post_type = ( isset( $_GET['posttype'] ) && $_GET['posttype'] != '' ) ? $_GET['posttype'] : '';
    if( isset( $_GET['s'] ) && $post_type == 'downloads' )
    {
        return locate_template('dpbm-items-search.php');
    }
    return $template;
}
add_filter('template_include', 'template_chooser');


?>
