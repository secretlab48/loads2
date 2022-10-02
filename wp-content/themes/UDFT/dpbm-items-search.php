<?php
/* Template Name: Custom Search */
get_header( 'extended' );


?>


<main role="main">
    <!-- section -->
    <section>

        <div class="container flex-box dpbmpro-taxonomy-archive p0">
            <?php

            echo '<div class="ds-archive-column sidebar-col">' . get_downloads_search_form() . loads_wpdm_categories( array( 'parent' => 0 ) ) . '</div>';

            echo '<div class="ds-archive-column content-col">' . get_downloads_search_form_results() . '</div>';

            ?>
        </div>

    </section>
    <!-- /section -->
</main>


<?php

get_footer();

?>
