<?php

/**
 * Template Name: Confirmation Email Page Template
 * The template for display Confirmation Email Page
 *
 */

global $post;

require_once ( 'inc/subscriptions.php' );

$email = isset( $_GET['email'] ) ? $_GET['email'] : '';
$emails = get_option( 'collected_emails' );
if ( !$emails ) $emails = array();
$period = 600;

if ( array_key_exists( $email, $emails ) ) {
    $data = $emails[$email];
    $time = $data['request_time'];
    if ( ( time() - $time ) < $period ) {
        $create_recipient_result = $api->updateRecipientList(
            $news_list_id, $email, '', '', '', '', false, false, null
        );
        if ( $create_recipient_result->status == 200 || $create_recipient_result->status == 201 ) {
            $a = $create_recipient_result->value;
            $emails[$email]['service_href'] = $create_recipient_result->value[0]->_href;
            $emails[$email]['service_id'] = $create_recipient_result->value[0]->id;
            $emails[$email]['confirmed'] = 1;
            update_option('collected_emails', $emails);
            $result = array('result' => 1, 'content' => 'You have confirmed subscription!');
        }
        else {
            $result = array('result' => 0, 'content' => 'Service did not recieve your data, check it!');
        }
    }
    else {
        $result = array( 'result' => 0, 'content' => 'You have missed ypur chance!' );
    }
}
else {
    $result = array( 'result' => 0, 'content' => 'Hacking? You are wasting time)' );
}

//$c = join( ' ', get_post_class( array( $result_class, 'custom-container' ), $post->ID ) );
$result_class = $result['result'] == 1 ? 'confirmed' : 'not-confirmed';

get_header();


echo
    '<main role="main">
		<section>
		    <article id="post-' . $post->ID . '" class="' . join( ' ', get_post_class( array( $result_class, 'custom-container' ), $post->ID ) ) . '">
		        <div class="subsription-result">' . $result['content'] . '</div>
		    </article>
		</section>
	</main>';


get_footer();