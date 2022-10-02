<?php

/**
 * Template Name: UserPro Edit Profile Page Template
 * The template for display UserPro Edit Profile Page
 *
 */

global $post;

get_header( 'extended' );

?>


<main role="main">
    <section>
        <div class="container p0">

            <?php

                echo do_shortcode( '[userpro template=edit]' );

            ?>


        </div>
    </section>
</main>


<?php

get_footer();


