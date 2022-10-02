<?php

/**
 * Template Name: Media Page Template
 * The template for display Media Page
 *
 */


    get_header('extended' );
    $cat_slug = get_query_var( 'wpdmcategory' );
    if ( $cat_slug != '' ) {
        $cat = get_term_by('slug', $cat_slug, 'wpdmcategory');
        $cat = $cat->parent != 0 ? $cat->parent : $cat->term_id;
    }
    else { $cat = 0; }

?>

    <main role="main">
        <!-- section -->
        <section>

            <div class="container flex-box dpbmpro-taxonomy-archive p0">
                <?php

                    echo '<div class="ds-archive-column sidebar-col">' . get_downloads_search_form() . loads_wpdm_categories( array( 'parent' => 0 ) ) . '</div>';

                    echo '<div class="ds-archive-column content-col">' . loads_wpdm_category_items( array( 'ppp' => 10 ) ) . '</div>';

                ?>
            </div>

        </section>
        <!-- /section -->
    </main>

<?php get_footer(); ?>
