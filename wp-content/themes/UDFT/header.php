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
            wp_head();

        ?>

	</head>
	<body <?php body_class(); ?>>

        <div id="preloader"></div>
        <div class="site-container">

            <div class="site-wrapper">


                <header class="header" role="banner">

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
                            <h1 class="top-text">
                                <?php
                                if ( is_front_page() ) {
                                    echo
                                    '<span class="black" > Die Interessensvertretung </span >
                                                 <span class="red"> der Lottoverkaufsstellen in Hessen </span >';
                                }
                                else if ( is_404() ) {
                                    echo '<span class="red">404</span>';
                                }
                                else {
                                    echo '<span class="red">' . get_the_title( $post ) . '</span>';
                                }
                                ?>
                            </h1>
                        </div>
                    </div>

                    <?php
                        if ( !is_front_page() ) {
                            echo '<div class="bc-container"><div class="bc-box custom-container p0">';
                            bcn_display();
                            echo '</div></div>';
                        }
                    ?>


                </header>
