<?php
/**
 * User: shahnuralam
 * Date: 8/4/18
 * Time: 4:05 PM
 */

namespace WPDM\Block;

if (!defined('ABSPATH')) die();


class Category{

    function __construct(){
        add_action( 'init', array($this, 'block'), 9 );
    }

    function block(){
        wp_register_script(
            'wpdm-category-block',
            plugins_url('js/category.js', __WPDM_GB__),
            array( 'wp-blocks', 'wp-element','wpdm-admin-bootstrap', 'wpdm-icons', 'wpdm-link-templates', 'wpdm-category-selector' )
        );

        register_block_type( 'download-manager/category', array(
            'attributes'      => array(
                'cats' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'title' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'desc' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'toolbar' => array(
                    'type'    => 'string',
                    'default' => "1"
                ),
                'items_per_page' => array(
                    'type'    => 'number',
                    'default' => 10
                ),
                'paging' => array(
                    'type'    => 'number',
                    'default' => 1
                ),
                'cols' => array(
                    'type'    => 'number',
                    'default' => 1
                ),
                'order_by' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'order' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'template'      => array(
                    'type'      => 'string',
                    'default'   => 'link-template-panel'
                ),
                'className'      => array(
                    'type'      => 'string',
                    'default'   => ''
                )
            ),
            'editor_script' => 'wpdm-category-block',
            'editor_style' => 'wpdm-block-style',
            'render_callback' => array($this, 'output'),
        ) );
    }

    function output( $attributes, $content){
        if($attributes['cats'] == "") return "<div class='w3eden'><div class='well text-center'>".__('Select categories!', 'wpdmpro')."</div></div>";
        $attributes['id'] = $attributes['cats'];
        unset($attributes['cats']);
        $attributes['css_class'] = isset($attributes['className'])?$attributes['className']:'';
        return "<section class='__wpdm_gb_section __wpdm_gb_category'>".wpdm_embed_category($attributes)."</section>";
        //return do_shortcode("[wpdm_category id='{$attributes['cats']}' template='{$attributes['template']}' ]");
    }

}

new Category();

