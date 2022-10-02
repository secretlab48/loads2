<?php
/**
 * User: shahnuralam
 * Date: 8/21/18
 * Time: 7:15 AM
 */

namespace WPDM\Block\libs;

use WPDM\libs\Crypt;

class RestAPI
{

    function __construct()
    {

        add_action( 'rest_api_init', array($this, 'restAPIInit'));
    }

    function restAPIInit(){

        //wpdm/v1/search-package
        register_rest_route( 'wpdm/v1', '/search-package', array(
            'methods' => 'GET',
            'callback' => array($this, 'searchPackages'),
        ) );

        //wpdm/v1/link-templates
        register_rest_route( 'wpdm/v1', '/link-templates', array(
            'methods' => 'GET',
            'callback' => array($this, 'linkTemplates'),
        ) );

        //wpdm/v1/post-templates
        register_rest_route( 'wpdm/v1', '/post-templates', array(
            'methods' => 'GET',
            'callback' => array($this, 'postTemplates'),
        ) );

        //wpdm/v1/categories
        register_rest_route( 'wpdm/v1', '/categories', array(
            'methods' => 'GET',
            'callback' => array($this, 'categories'),
        ) );

        //wpdm/v1/layouts
        register_rest_route( 'wpdm/v1', '/layouts', array(
            'methods' => 'GET',
            'callback' => array($this, 'layouts'),
        ) );

        //wpdm/v1/getlayout
        register_rest_route( 'wpdm/v1', '/getlayout', array(
            'methods' => 'GET',
            'callback' => array($this, 'getlayout'),
        ) );
    }

    function linkTemplates()
    {
        $type = 'link';
        $tplstatus = maybe_unserialize(get_option("_fm_link_template_status"));
        $activetpls = array();
        if(is_array($tplstatus)) {
            foreach ($tplstatus as $tpl => $active) {
                if ($active)
                    $activetpls[] = $tpl;
            }
        }

        $ttpldir = get_stylesheet_directory() . '/download-manager/' . $type . '-templates/';
        $ttpls = array();
        if(file_exists($ttpldir)) {
            $ttpls = scandir($ttpldir);
            array_shift($ttpls);
            array_shift($ttpls);
        }

        $ltpldir = WPDM_TPL_DIR . $type . '-templates/';
        $ctpls = scandir($ltpldir);
        array_shift($ctpls);
        array_shift($ctpls);

        foreach($ctpls as $ind => $tpl){
            $ctpls[$ind] = $ltpldir.$tpl;
        }

        foreach($ttpls as $tpl){
            if(!in_array($ltpldir.$tpl, $ctpls)) {
                $ctpls[] = $ttpldir . $tpl;
            }
        }

        $custom_templates = maybe_unserialize(get_option("_fm_{$type}_templates",true));

        $name = isset($name)?$name:$type.'_template';
        $css = isset($css)?"style='$css'":'';
        $id = isset($id)?$id:uniqid();
        $default = $type == 'link'?'link-template-calltoaction3.php':'page-template-1col-flat.php';
        $xdf = str_replace(".php", "", $default);
        if(is_array($activetpls) && count($activetpls) > 0)
            $default = in_array($xdf, $activetpls)?$default:$activetpls[0];

        $data = array();
        foreach ($ctpls as $ctpl) {
            $ind = str_replace(".php", "", basename($ctpl));
            if(!isset($tplstatus[$ind]) || $tplstatus[$ind] == 1) {
                $tmpdata = file_get_contents($ctpl);
                $regx = "/WPDM.*Template[\s]*:([^\-\->]+)/";
                if (preg_match($regx, $tmpdata, $matches)) {
                    $data[] = array('value' => basename($ctpl), 'label' => $matches[1]);
                }
            }
        }

        if(is_array($custom_templates)) {
            foreach ($custom_templates as $id => $template) {
                if(!isset($tplstatus[$id]) || $tplstatus[$id] == 1) {
                    $data[] = array('value' => $id, 'label' => $template['title']);
                }
            }
        }

        wp_send_json($data);
        die();

    }

    function postTemplates(){
        $files = scandir(__WPDM_GBDIR__.'/blocks/tpls/post/');
        $templates = array();
        foreach ($files as $file){
            if(strpos($file, '.php')){
                $templates[] = array('value' => $file, 'label' => "Plugin / ".ucfirst(str_replace(".php", "", $file)));
            }
        }

        if(file_exists(get_template_directory()."/download-manager/gutenberg/post/")) {
            $path = get_template_directory() . "/download-manager/gutenberg/post/";
            $files = scandir($path);
            foreach ($files as $file) {
                if(strpos($file, '.php')){
                    $templates[] = array('value' => $file, 'label' => "Plugin / ".ucfirst(str_replace(".php", "", $file)));
                }
            }
        }

        if(file_exists(get_stylesheet_directory()."/gutenberg/layouts/")) {
            $path = get_stylesheet_directory() . "/gutenberg/layouts/";
            $files = scandir($path);
            foreach ($files as $file) {
                if(strpos($file, '.php')){
                    $templates[] = array('value' => $file, 'label' => "Plugin / ".ucfirst(str_replace(".php", "", $file)));
                }
            }
        }

        wp_send_json($templates);
    }

    function searchPackages(){

        $packs = get_posts(array('post_type' => 'wpdmpro','s' => wpdm_query_var('s', 'txt'), 'posts_per_page' => 10));
        foreach ($packs as $pack){
            $data[] = array('id' => $pack->ID, 'title' => $pack->post_title);
        }
        wp_send_json($data);
        die();

    }

    function categories(){
        $tax = wpdm_query_var('tax');
        $tax = $tax ? $tax : 'wpdmcategory';
        $cats = get_terms(array('taxonomy' => $tax,
            'hide_empty' => false));
        foreach ($cats as $cat){
            $data[] = array('value' => $cat->slug, 'id' => $cat->term_id, 'label' => $cat->name);
        }
        wp_send_json($data);
        die();

    }

    function layouts(){
        $layouts = array();
        if(file_exists(get_template_directory()."/gutenberg/layouts/")) {
            $path = get_template_directory() . "/gutenberg/layouts/";
            $files = scandir($path);
            foreach ($files as $file) {
                if (strstr($file, '.json')) {
                    $template = file_get_contents($path.$file);
                    $template = json_decode($template);
                    $layouts[md5($path.$file)] = array('id' => md5($path.$file), 'path' => Crypt::encrypt($path.$file), 'title' => $template->title, 'preview' => $template->preview);
                }
            }
        }

        if(file_exists(get_stylesheet_directory()."/gutenberg/layouts/")) {
            $path = get_stylesheet_directory() . "/gutenberg/layouts/";
            $files = scandir($path);
            foreach ($files as $file) {
                if (strstr($file, '.json')) {
                    $template = file_get_contents($path.$file);
                    $template = json_decode($template);
                    $layouts[md5($path.$file)] = array('id' => md5($path.$file), 'path' => Crypt::encrypt($path.$file), 'title' => $template->title, 'preview' => $template->preview);
                }
            }
        }

        wp_send_json(array_values($layouts));

    }

    function getlayout(){
        $layout = Crypt::decrypt(wpdm_query_var('layout'));
        $template = file_get_contents($layout);
        $template = json_decode($template);
        //echo stripslashes_deep(htmlspecialchars_decode(str_replace(array("\n", "\r"), "", $template->content)));
        wp_send_json($template);
        die();
    }





}

new RestAPI();
