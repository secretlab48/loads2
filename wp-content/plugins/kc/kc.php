<?php

/*
Plugin Name: KC Addons

Version: 1.0
*/


add_action('init', 'kc_addons_init', 99 );

function kc_addons_init()
{

    if (function_exists('kc_add_map')) {

        kc_add_map(
            array(

                'lab_partners' => array(
                    'name' => 'Partners Images',
                    'description' => __('Display a Partners Images', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(
                                array(
                                    'name' => 'image',
                                    'label' => 'Upload Image',
                                    'type' => 'attach_image',
                                    'admin_label' => true,
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('lab_partners', 'lab_partners');

        function lab_partners( $atts = null )
        {
            if ( $atts ) {
                $imgs = $atts['options'];
            }
            else {
                $i1 = new StdClass();
                $i1->image = 37;
                $i2 = new StdClass();
                $i2->image = 38;
                $i3 = new StdClass();
                $i3->image = 39;
                $imgs = array( $i1, $i2, $i3 );
            }

            $out =
                '<div class="partner-imgs">';

            foreach ($imgs as $i => $img) {
                $out .= '<div class="partner-img-box">' . wp_get_attachment_image($img->image, 'partner-archive', false, array('class' => 'partner-image')) . '</div>';
            }

            $out .= '</div>';

            return $out;

        }


        kc_add_map(
            array(

                'lab_year_lines' => array(
                    'name' => 'Year Lines',
                    'description' => __('Display a Partners Images', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'year',
                                    'label' => 'Year',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter Year.', 'kc_addons')
                                ),

                                array(
                                    'name' => 'description',
                                    'label' => 'Description',
                                    'type' => 'textarea',
                                    'admin_label' => true,
                                    'description' => __('Enter Description.', 'kc_addons')
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('lab_year_lines', 'lab_year_lines');

        function lab_year_lines($atts)
        {

            $lines = $atts['options'];

            $out =
                '<div class="year-lines">';

            foreach ($lines as $i => $line) {
                $out .=
                    '<div class="year-line-box">
                         <div class="year">' . $line->year . '</div>
                         <div class="description">' . $line->description . '</div>
                     </div>';
            }

            $out .= '</div>';

            return $out;

        }



        kc_add_map(
            array(

                'loads_get_posts' => array(
                    'name' => 'Posts',
                    'description' => __('Display Posts', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'name' => 'posts_numbe',
                            'label' => 'Number Of Posts',
                            'type' => 'text',
                            'admin_label' => true,
                            'description' => __('Enter Year.', 'kc_addons')
                        ),

                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('loads_get_posts', 'loads_get_posts');

        function loads_get_posts( $atts )
        {

            $query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3 ) );

            $out =
                '<div class="news-content">';

            foreach ( $query->posts as $i => $p ) {
                $out .= loads_get_single_new( $p, true );

            }

            $out .= '</div>';

            return $out;

        }




        kc_add_map(

            array(

                'lab_testimonials_carousel' => array(
                    'name' => 'Testimonials Carousel',
                    'description' => __('Display a Testimonials Carousel', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'name',
                                    'label' => 'Name',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter Tab Name.', 'kc_addons')
                                ),

                                array(
                                    'name' => 'image',
                                    'label' => 'Upload Image',
                                    'type' => 'attach_image',
                                    'admin_label' => true,
                                ),

                                array(
                                    'name' => 'description',
                                    'label' => 'Description',
                                    'type' => 'textarea',
                                    'admin_label' => true,
                                    'description' => __('Enter Testimonial Content.', 'kc_addons')
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )

        ); // End add map


        add_shortcode('lab_testimonials_carousel', 'lab_testimonials_carousel');

        function lab_testimonials_carousel($atts)
        {

            $options = $atts['options'];

            $out = '<div class="testimonials-carousel-box"><div class="testimonials-carousel">';

            foreach ($options as $i => $option) {
                $out .=
                    '<div class="tc-item-box">
                         <div class="tc-item">' .
                    wp_get_attachment_image($option->image, 'thumbnail', false, array('class' => 'tc-item-image')) .
                    '<div class="tc-item-name">' . $option->name . '</div>
                              <div class="tc-item-description">' . $option->description . '</div>
                         </div> 
                     </div>';
            }

            $out .= '</div><div class="tc-description"></div></div>';

            /*$out .=
                '<script type="text/javascript">jQuery(document).ready( function( e ) {
                    jQuery(".testimonials-carousel").slick();
                } );</script>';*/


            return $out;

        }


    }

}







