<?php

add_action('rest_api_init', 'add_rest_count_endpoint');
function add_rest_count_endpoint(){

    register_rest_route( 'custom/v0', '/count', array(
        'methods' => 'GET',
        'callback' => 'get_offer_count_api',
    ));
}

function get_offer_count_api($data) {
    $params = $data->get_params();
    $args = array(
        'post_type' => 'offer',
        'posts_per_page' => -1,
    );

    // params --------------------------------------------------------------------------------
    if( isset( $params['page'] ) ) {
        $args['paged'] = (int)$params['page'];
    }

    if( isset( $params['order'] ) ) {
        if( $params['order'] === 'views' ) {
            $args['meta_key'] = 'post_views_count';
            $args['orderby'] = 'meta_value';
            $args['order'] === 'DESC';
        } else {
            $args['orderby'] = 'date';
            $args['order'] = $params['order'] === 'old' ? 'ASC' : 'DESC';
        }
    }

    // tax --------------------------------------------------------------------------------
    $taxonomies = ['place', 'division', 'occupation', 'feature'];
    foreach( $taxonomies as $tax ) {
        if(isset( $params[$tax] ) ) {
            $ids = [];
            foreach( (array)$params[$tax] as $id ) $ids[] = (int)$id;
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][] = array(
                'taxonomy' => $tax,
                'field' => 'id',
                'terms' => $ids,
            );
        }
    }

    // custom field --------------------------------------------------------------------------------
    // treatment
    if( isset( $params['treatment_status'] ) ) {
        $args['meta_query'][] = array(
            'key' => 'treatment_status',
            'value' => $params['treatment_status'],
            'compare' => 'IN'
        );
    }

    // salary
    if( $params['salary_unit'] ) {
        $args['meta_query'][] = array(
            'key' => 'salary_unit',
            'value' => $params['salary_unit'],
        );
    }
    if( $params['salary'] && $params['salary_unit'] ) {
        $args['meta_query'][] = array(
            'relation' => 'OR',
            array(
                'key' => 'salary_value',
                'value' => $params['salary'],
                'compare' => '>=',
            ),
            array(
                'key' => 'salary_value_min',
                'value' => $params['salary'],
                'compare' => '>=',
            ),
            array(
                'key' => 'salary_value_max',
                'value' => $params['salary'],
                'compare' => '>=',
            ),
        );
    }

    // keyword --------------------------------------------------------------------------------
    if( $params['keyword'] ) {
        $keyword_arr = array_filter( explode( ' ', $params['keyword'] ), 'strlen' );
        $keyword_search_arr = array( 'relation' => $operator );
        if( !empty($keyword_arr) ) {
            $key = '';
            foreach( $keyword_arr as $key ) {
                $keyword_search_arr[] = array(
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => 'offer_comment',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'offer_pr',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'offer_detail',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'offer_competence',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'treatment_status_remarks',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'treatment_hours_remarks',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'treatment_trial',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'treatment_holiday',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'treatment_other',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'salary_remarks',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'salary_bonus',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'salary_increase',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'salary_allowance',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'place_name',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'place_other',
                            'value' => $key,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'place_access',
                            'value' => $key,
                            'compare' => 'LIKE'
                        )
                    )
                );
            }
            $args['meta_query'][] = array( $keyword_search_arr );
        }
    }

    $count = 0;

    $the_query = new WP_Query($args);
    if( $the_query->have_posts() ) $count = $the_query->post_count;

    $response = new WP_REST_Response($count);
    $response->set_status(200);
    $domain = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"];
    $response->header( 'Location', $domain );
    return $response;
}