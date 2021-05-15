<?php

add_action('rest_api_init', 'add_rest_original_endpoint');
function add_rest_original_endpoint(){

    register_rest_route( 'custom/v0', '/offer', array(
        'methods' => 'GET',
        'callback' => 'get_offers_api',
    ));
}

function get_offers_api($data) {
    $params = $data->get_params();
    $contents = array();
    $args = array(
        'post_type' => 'offer',
        'posts_per_page' => 12,
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


    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ):
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $id = get_the_ID();

            $place = [];
            $terms = get_the_terms( $id, 'place' );
            if( $terms ) foreach( (array)$terms as $term ) array_push( $place, $term->term_id );

            $division = '';
            $division_name = '';
            $terms = get_the_terms( $id, 'division' );
            if( $terms ) :
                foreach( (array)$terms as $term ) :
                    if( $term->parent == 0 ) :
                        $division = $term->term_id;
                        $division_name = $term->name;
                    endif;
                endforeach;
            endif;

            $feature = [];
            $terms = get_the_terms( $id, 'feature' );
            if( $terms ) foreach( (array)$terms as $term ) array_push( $feature, $term->term_id );

            $occupation = [];
            $terms = get_the_terms( $id, 'occupation' );
            if( $terms ) foreach( (array)$terms as $term ) array_push( $occupation, $term->term_id );

            array_push($contents, array(
                'id' => $id, // ID
                'title' => get_the_title(), // タイトル
                'thumb' => get_the_post_thumbnail_url(), // サムネイル
                'link' => get_the_permalink(), // URL
                'modified_date' => get_the_modified_date('c'), // 最終更新日時
                'offer_comment' => get_post_meta( $id, 'offer_comment', true ), // 一言
                'post_views_count' => get_post_meta( $id, 'post_views_count', true ), // 閲覧数
                'place' => $place, // タクソノミー：勤務地
                'division' => $division, // タクソノミー：事業部
                'division_name' => $division_name, // タクソノミー：事業部
                'feature' => $feature, // 特徴
                'occupation' => $occupation, // 職種
                'params' => $params
            ));
        endwhile;
    endif;

    $response = new WP_REST_Response($contents);
    $response->set_status(200);
    $domain = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"];
    $response->header( 'Location', $domain );
    return $response;
}