<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php

    global $post;

    $top_caption = '';
    if ( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $userdata = get_userdata( $user->ID );
        $user_role = $user->roles[0];
        $user_name = $userdata->data->display_name;
        $redirect = wp_logout_url( home_url() );
        $top_caption = $user_name . ' als ' . $user_role . ' | <a href="' . $redirect . '">Logout</a>';
    }

    wp_head();

    ?>

</head>
<body <?php body_class(); ?>>

<div id="preloader"></div>
<div class="site-container">

    <div class="site-wrapper">


        <header class="header extended" role="banner">

            <div class="header-top-container">
                <div class="header-top-box container">

                    <div class="header-top">

                        <div class="top-logo-box">
                            <a class="top-logo-link" href="<?php echo site_url(); ?>"><img class="top-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/top-logo.svg"></a>
                        </div>

                        <nav class="nav" role="navigation">
                            <?php wp_nav_menu( array( 'menu' => 'top-menu', 'container' => false, 'menu_class' => 'top-menu', 'walker' => new True_Walker_Nav_Menu() ) ); ?>
                        </nav>

                        <div class="menu-manage"><span></span><span></span><span></span></div>

                    </div>

                </div>
            </div>

            <div class="top-media-box container">
                <div class="parallaxParent full-width">
                    <div class="top-media-img-box parallaxChild"></div>
                </div>
                <div class="top-text-box">
                    <div class="top-text">
                        <?php

                            echo '<span class="red">' . $top_caption . '</span>';

                        ?>
                    </div>
                </div>
            </div>

            <?php

            if ( is_user_logged_in() ) {
                $menu = wp_nav_menu( array( 'menu' => 'logged-media-menu', 'container' => false, 'menu_class' => 'media-menu', 'echo' => false ) );
            }
            else {
                $menu = wp_nav_menu( array( 'menu' => 'media-menu', 'container' => false, 'menu_class' => 'media-menu', 'echo' => false ) );
            }

            echo
                '<div class="media-menu-box">
                     <div class="container p0">
                           <nav class="media-nav" role="navigation">' .
                               $menu .
                           '</nav>
                     </div>
                </div>';

            ?>


        </header>