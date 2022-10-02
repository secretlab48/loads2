<?php

namespace NL2GO;

$authKey  =  "rcpmopub_CO6xgA0Fpz_cyG3neGzWO_vZdsOAa_xCf7e3eMkO:4e09dm87";
$userEmail  =  "sysadmin@telenorma.ag";
$userPassword  =  "2134964165dsmsdfbkljeb49bfrkljbvklbsrAds";

$api  =  new  Newsletter2Go_REST_Api($authKey,  $userEmail,  $userPassword);

$api->setSSLVerification(true);

$lists  =  $api->getLists();
$news_list = false;
$list_name = 'contact';
$news_list_id = null;
if ( isset( $lists->value ) ) {
    foreach ($lists->value as $list) {

        if ( preg_match( '/' . $list_name . '/i', $list->name ) ) {
            $news_list = $list;
            $news_list_id = $list->id;
        }

    }
}

if ( !$news_list ) {
    $result = $api->createList(
        'News Subscription List',
        true,
        false,
        true,
        true,
        true,
        'https://telenorma.ag/',
        'info@hltv.quarantine.tn-rechenzentrum1.de',
        'Telenorma AG',
        'info@hltv.quarantine.tn-rechenzentrum1.de',
        'Telenorma AG',
        null,
        site_url() . '/unsubscribe-news',
        false
    );

    if ( $result->status == 201 ) {

        $list_data = $result->value[0];
        $news_list_id = $list_data->id;

    }
}

