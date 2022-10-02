<?php

class True_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0  ) {

        global $wp_query;

        if ( $item->title == 'media' ) {
            if ( !is_user_logged_in() ) {
                return;
            }
        }
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        if ( in_array( 'sign-in-link', $classes ) ) {
            $item_output .= get_ajax_login_form();
        }


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}




function loads_get_single_new( $p = null, $home = false ) {

    global $post;
    $p = $p ? $p : $post;

    if ( $home ) $el = 'h3'; else $el = 'h2';

    $out =
        '<div class="news-item-box">
            <article id="' . $p->ID . '" ' . join( ' ', get_post_class( join( ' ', array( 'single-new' ) ), $p->ID ) ) . '>
                <div class="news-item-content-box">
                    <' . $el . '>' . get_the_title( $p ) . '</' . $el . '>
                    <div class="news-item-date">' . get_the_date( 'd. m. Y', $p ) . '</div>
                    <div class="news-item-content">' . get_the_excerpt( $p ) . '</div>
                </div>
                <a class="btn-link" href="' . get_permalink($p->ID) . '">Mehr lesen</a>
            </article>
        </div>';

    return $out;

}


function loads_get_pagination( $args = array( 'page' => null, 'q' => null, 'ppp' => 1, 'base' => null, 'qs' => '' ) )
{

    global $wp_query;

    $data = array(
        'page' => 1,
        'q'    => null,
        'ppp'  => 1,
        'base' => site_url(),
        'qs'   => ''
    );

    $data = shortcode_atts( $data, $args );
    $data['qs'] = strlen( $data['qs'] ) > 0 ? '?' . $data['qs'] : $data['qs'];

    $pages = ceil( $data['q'] / $data['ppp'] );
    $out =
        '<div class="pagination_wrapper ajax-pagination">
             <div class="pagination">';
    $prev = '';
    if ( $pages > 1 ) {
        for ( $i = 1; $i <= $pages; $i++ ) {
            if ( $i == 1 ) {
                if ( $data['page'] != 1 ) {
                    $out .= '<a class="prev page-numbers" href="' . $data['base'] . '__prev__' . '"></a>';
                }

            }
            if ( $data['page'] == $i ) {
                $out .= '<span aria-current="page" class="page-numbers current">' . $i . '</span>';
                $prev = ( ( $i - 1 )  > 1 ) ? '/page/' . ( $i - 1 ) : '/page/1/' . $data['qs'];
                $next = ( ( $i + 1 ) < $data['q'] ) ? ( $i + 1 ) : $data['q'];
            }
            else {
                $out .= '<a class="page-numbers" href="' . $data['base'] . '/page/' . $i . '/' . $data['qs'] . '">' . $i . '</a>';
            }
            if ( $i == $pages ) {
                if ( $data['page'] < $pages ) {
                    $out .= '<a class="next page-numbers" href="' . $data['base'] . '/page/' . $next . '/' . $data['qs'] . '">' . '' . '</a>';
                }
            }
        }
    }

    $out .=
        '</div>
    </div>';

    $out = str_replace( '__prev__', $prev, $out );

    $a = 1;
    return $out;

}


add_filter( 'bcn_template_tags', 'custom_bcn_template_tags', 100, 3 );

function custom_bcn_template_tags( $replacements, $type, $id ) {

    global $post;

    if ( $replacements['%type%'] == 'home' ) {
        $replacements['%title%'] = '';
        $replacements['%htitle%'] = '';
        $replacements['%ftitle%'] = '';
        $replacements['%fhtitle%'] = '';
    }

    if ( isset( $replacements['%title%'] ) && $replacements['%title%'] == 'Uncategorized' ) {
        $type = $replacements['%type%'];
        $current_item = preg_match( '/current-item/', $replacements['%type%'] ) ? ' current-item' : '';

        $replacements['%title%'] = 'news';
        $replacements['%link%'] = get_permalink( 8 );
        $replacements['%htitle%'] = 'news';
        $replacements['%type%'] = 'page' . $current_item;
        $replacements['%ftitle%'] = 'news';
        $replacements['%fhtitle%'] = 'news';

    }



    return $replacements;

}




add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
    $phpmailer->SMTPDebug = 0;
    $phpmailer->isSMTP();
    $phpmailer->Host = "smtp.gmail.com";
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = "465";
    $phpmailer->Username = "zhekas361@gmail.com";
    $phpmailer->Password = "ab124578";
    $phpmailer->SMTPSecure = "ssl";
    $phpmailer->CharSet = 'UTF-8';

    $phpmailer->isHTML( true );

    $phpmailer->smtpConnect(
        array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        )
    );

    $phpmailer->setFrom('zhekas361@gmail.com', 'Booking Mailer');
    $phpmailer->addReplyTo('zhekas361@gmail.com', 'Information');

    $phpmailer->Subject = 'New Lead';


}




function get_subscibtion_mail_answer() {

    $email = $_POST['email'];
    $emails = get_option( 'collected_emails' );
    if ( !$emails ) $emails = array();

    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $result = array( 'result' => 0, 'content' => 'Invalid Email' );
    }
    else if ( array_key_exists( $email, $emails ) ) {
        $result = array( 'result' => 0, 'content' => 'Yo have requested confirmation already!' );
    }
    else {

        $emails[$email] = array( 'confirmed' > 0, 'request_time' => time() );
        update_option( 'collected_emails', $emails );
        $message = subscription_request_email();
        //'To confirm subscription go to ' . site_url() . '/confirm-subscription?action=confirm&email=' . $email
        $r = wp_mail( $email, 'Confirmation Email', $message );
        $result = array( 'result' => 1, 'content' => 'Confirmation was sent to your email, check it' );

    }

    echo json_encode( $result );
    wp_die();

}



//$ts = wp_list_categories( array( 'taxonomy' => 'wpdmcategory', 'hide_empty' => false, 'title_li' => '', 'echo' => false ) );

function get_wpdm_cat_menu() {

    global $udft, $wp_query;

    $query_cat = get_query_var( 'wpdmcategory' );
    if ( $query_cat != '' ) {
        $qc = get_term_by( 'slug', $query_cat, 'wpdmcategory' );
        $qc = $qc->term_id;
    }
    else {
        $qc = 0;
    }

    $args = array(
        'child_of'            => 0,
        'current_category'    => $qc,
        'depth'               => 0,
        'echo'                => 1,
        'exclude'             => '',
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 0,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'name',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories' ),
        'style'               => 'list',
        'taxonomy'            => 'wpdmcategory',
        'title_li'            => '',
        'use_desc_for_title'  => 1,
        'walker'              => new Custom_Walker_Category()
    );

    $categories = get_categories( $args );
    $cats = array();
    foreach( $categories as $cat ) {
        $t = dpdm_term_access_filter( $cat, $udft['user']['role'] );
        if ( $t ) $cats[] = $cat;
    }

    $out = walk_category_tree( $cats, 0, $args );
    $html = '<ul class="dpbm-cats">' . apply_filters( 'wp_list_categories', $out, $args ) . '</ul>';

    return $html;

}






class Custom_Walker_Category extends Walker {

    /**
     * What the class handles.
     *
     * @since 2.1.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = 'category';

    /**
     * Database fields to use.
     *
     * @since 2.1.0
     * @var array
     *
     * @see Walker::$db_fields
     * @todo Decouple this
     */
    public $db_fields = array(
        'parent' => 'parent',
        'id'     => 'term_id',
    );

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.1.0
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] ) {
            return;
        }

        $indent  = str_repeat( "\t", $depth );
        $output .= "$indent<ul class='children'>\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 2.1.0
     *
     * @see Walker::end_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] ) {
            return;
        }

        $indent  = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     *
     * @since 2.1.0
     *
     * @see Walker::start_el()
     *
     * @param string $output   Used to append additional content (passed by reference).
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */

        global $udft;

        $cat_name = apply_filters( 'list_cats', esc_attr( $category->name ), $category );

        // Don't generate an element if the category name is empty.
        if ( '' === $cat_name ) {
            return;
        }

        $atts         = array();
        $atts['href'] = get_term_link( $category );

        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $atts['title'] = strip_tags( apply_filters( 'category_description', $category->description, $category ) );
        }

        /**
         * Filters the HTML attributes applied to a category list item's anchor element.
         *
         * @since 5.2.0
         *
         * @param array   $atts {
         *     The HTML attributes applied to the list item's `<a>` element, empty strings are ignored.
         *
         *     @type string $href  The href attribute.
         *     @type string $title The title attribute.
         * }
         * @param WP_Term $category Term data object.
         * @param int     $depth    Depth of category, used for padding.
         * @param array   $args     An array of arguments.
         * @param int     $id       ID of the current category.
         */
        $atts = apply_filters( 'category_list_link_attributes', $atts, $category, $depth, $args, $id );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $link = sprintf(
            '<a%s>%s<div class="open-category"></div></a>',
            $attributes,
            $cat_name
        );

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';

            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

            if ( empty( $args['feed'] ) ) {
                /* translators: %s: Category name. */
                $alt = ' alt="' . sprintf( __( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
            } else {
                $alt   = ' alt="' . $args['feed'] . '"';
                $name  = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }

            $link .= '>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . esc_url( $args['feed_image'] ) . "'$alt" . ' />';
            }
            $link .= '</a>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }

        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' (' . number_format_i18n( $category->count ) . ')';
        }
        if ( 'list' == $args['style'] ) {
            $output     .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );

            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms(
                    array(
                        'taxonomy'   => $category->taxonomy,
                        'include'    => $args['current_category'],
                        'hide_empty' => false,
                    )
                );

                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                        $css_classes[] = 'opened';
                        $link          = str_replace( '<a', '<a aria-current="page"', $link );
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                        $css_classes[] = 'opened';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] = 'current-cat-ancestor';
                            $css_classes[] = 'opened';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }

            $css_classes[] = 'depth-' . $depth;
            $term_children = get_term_children( filter_var( $category->term_id, FILTER_VALIDATE_INT ), filter_var( $category->taxonomy, FILTER_SANITIZE_STRING ) );
            if ( !empty( $term_children ) && !is_wp_error( $term_children ) ) {
                $css_classes[] = 'has-sub-categories';
            }

            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
            $css_classes = $css_classes ? ' class="' . esc_attr( $css_classes ) . '"' : '';

            $output .= $css_classes;
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 2.1.0
     *
     * @see Walker::end_el()
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param object $page   Not used.
     * @param int    $depth  Optional. Depth of category. Not used.
     * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
     *                       to output. See wp_list_categories(). Default empty array.
     */
    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] ) {
            return;
        }

        $output .= "</li>\n";
    }

}


