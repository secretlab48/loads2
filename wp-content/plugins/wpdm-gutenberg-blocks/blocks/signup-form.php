<?php
/**
 * User: shahnuralam
 * Date: 9/17/19
 * Time: 12:38 PM
 */

namespace WPDM\Block;

if (!defined('ABSPATH')) die();

class SigupForm{

    function __construct(){
        add_action( 'init', array($this, 'block'), 9 );
        add_action( 'admin_head', array($this, 'customJS'), 9 );

    }

    function customJS(){
        global $wp_roles;
        $roles = array_reverse($wp_roles->role_names);
        $options = array();
        $role_ids = get_option("__wpdm_signup_roles", array());
        foreach ($role_ids as $role){
            $options[] = array("label" => $roles[$role], "value" => $role);
        }
        ?>
        <script>
            var __wpdm_roles = <?php echo json_encode($options); ?>;
        </script>
        <?php
    }

    function block(){

        wp_register_script(
            'wpdm-signup-form-block',
            plugins_url('js/signup-form.js', __WPDM_GB__),
            array( 'wp-blocks', 'wp-editor', 'wp-components', 'wp-element','wpdm-admin-bootstrap', 'wpdm-icons' )
        );

        register_block_type( 'download-manager/signup-form', array(
            'attributes'      => array(
                'role' => array(
                    'type' => 'string',
                    'default' => 'subscriber',
                ),
                'logo' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'verifyemail' => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'autologin' => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'note_before' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'note_after' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'social_only' => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'className'      => array(
                    'type'      => 'string',
                    'default'   => ''
                )
            ),
            'editor_script' => 'wpdm-signup-form-block',
            'editor_style' => 'wpdm-block-style',
            'render_callback' => array($this, 'output'),
        ) );
    }

    function output( $attributes, $content){
        return "<section class='__wpdm_gb_section __wpdm_gb_signup_form'>".do_shortcode("[wpdm_reg_form logo='{$attributes['logo']}' social_only='{$attributes['social_only']}' note_before='{$attributes['note_before']}' note_after='{$attributes['note_after']}' role='{$attributes['role']}' verifyemail='{$attributes['verifyemail']}' autologin='{$attributes['autologin']}' ]")."</section>";
    }

}

new SigupForm();

