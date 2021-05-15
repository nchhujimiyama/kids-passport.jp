<?php

add_action('rest_api_init', 'add_rest_taxonomy_endpoint');
function add_rest_taxonomy_endpoint(){

    register_rest_route( 'custom/v0', '/taxonomies', array(
        'methods' => 'GET',
        'callback' => 'get_offer_taxonomies_api',
    ));
}

function get_offer_taxonomies_api($data) {
    $contents = array();

    $taxonomies = ['place', 'division', 'occupation', 'feature'];
    foreach( $taxonomies as $tax ) {
        $terms = get_terms( $tax, array( 'hide_empty' => false ) );
        if( $terms ) {
            foreach( $terms as $term ) {
                $contents[] = array(
                    'id' => $term->term_id,
                    'name' => $term->name,
                );
            }
        }
    }


    $response = new WP_REST_Response($contents);
    $response->set_status(200);
    $domain = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"];
    $response->header( 'Location', $domain );
    return $response;
}