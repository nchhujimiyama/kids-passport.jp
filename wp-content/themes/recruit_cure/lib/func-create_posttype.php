<?php
function create_post_type() {
    $support = [
        'title',
        'thumbnail'
    ];
    $post_type = array(
        'offer' => '求人',
    );

    register_post_type(
        'offer',
        array(
            'labels' => array(
                'name' => '求人',
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'supports' => $support,
            'show_in_rest'  => true,
        )
    );

    $taxonomies = array(
        'place' => '勤務地',
        'division' => '事業部',
        'feature' => '特徴',
        'occupation' => '職種'
    );

    foreach( $taxonomies as $key => $name ) {
        register_taxonomy(
            $key,
            'offer',
            array(
                'label' => $name,
                'labels' => array(
                    'all_items' => $name . '一覧',
                    'add_new_item' => '新規' . $name . '追加',
                ),
                'hierarchical' => true,
                'show_in_rest'  => true,
            )
        );
    }
}
add_action( 'init', 'create_post_type' );

