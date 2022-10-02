<?php
/**
 * User: shahnuralam
 * Date: 12/05/18
 * Time: 4:05 AM
 */

namespace WPDM\Block;

use WPDM\libs\CategoryHandler;

if (!defined('ABSPATH')) die();

class TheCategory{

    function __construct(){
        add_action( 'init', array($this, 'block'), 9 );
    }

    function block(){
        wp_register_script(
            'wpdm-thecategory-block',
            plugins_url('js/the-category.js', __WPDM_GB__),
            array( 'wp-blocks', 'wp-element','wpdm-admin-bootstrap', 'wpdm-icons', 'wpdm-link-templates', 'wpdm-category-selector', 'wpdm-category-dropdown' )
        );

        register_block_type( 'download-manager/thecategory', array(
            'attributes'      => array(
                'category' => array(
                    'type'    => 'number',
                    'default' => 0
                ),
                'template'      => array(
                    'type'      => 'string',
                    'default'   => 'the-category'
                )
            ),
            'editor_script' => 'wpdm-thecategory-block',
            'editor_style' => 'wpdm-block-style',
            'render_callback' => array($this, 'output'),
        ) );
    }

    function output( $attributes, $content){
        if(!(int)$attributes['category']) return "<div class='w3eden'><div class='well text-center'>".__('Select category!', 'wpdmpro')."</div></div>";

        $term = get_term((int)$attributes['category']);
        ob_start();
        ?>
        <div class="w3eden">
            <div class="panel panel-default card">
                <div class="panel-body card-body text-center">
                    <img style="width: 128px;border-radius: 500px;margin: 20px auto" src="<?php echo CategoryHandler::icon($term->term_id); ?>" align="<?php echo $term->name; ?>" />
                    <h3><?php echo $term->name; ?></h3>
                    <p><?php echo $term->description; ?></p>
                    <a class="btn btn-primary" href="<?php echo get_term_link($term->term_id); ?>" >View Packages</a>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();

    }

}

new TheCategory();

