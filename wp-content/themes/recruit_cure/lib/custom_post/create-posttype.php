<?php
add_action( 'init', 'create_custom_post_type' );
function create_custom_post_type() {
    $options = get_design_plus_option();
    $support = [
        'title',
        'thumbnail',
        'editor'
    ];

    // Menu --------------------------------------------------------------------------------
    $menu_label = $options['menu_label'] ? esc_html( $options['menu_label'] ) : __( 'Menu', 'tcd-w' );
    $menu_slug = $options['menu_slug'] ? sanitize_title( $options['menu_slug'] ) : 'menu';
    $menu_labels = array(
        'name' => $menu_label,
        'add_new' => __( 'Add New', 'tcd-w' ),
        'add_new_item' => __( 'Add New Item', 'tcd-w' ),
        'edit_item' => __( 'Edit', 'tcd-w' ),
        'new_item' => __( 'New item', 'tcd-w' ),
        'view_item' => __( 'View Item', 'tcd-w' ),
        'search_items' => __( 'Search Items', 'tcd-w' ),
        'not_found' => __( 'Not Found', 'tcd-w' ),
        'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
        'parent_item_colon' => ''
    );

    register_post_type( 'menu', array(
        'label' => $menu_label,
        'labels' => $menu_labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_position' => 5,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $menu_slug ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => $support,
        'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
    ));

    // Diary --------------------------------------------------------------------------------
    $diary_label = $options['diary_label'] ? esc_html( $options['diary_label'] ) : __( 'Diary', 'tcd-w' );
    $diary_slug = $options['diary_slug'] ? sanitize_title( $options['diary_slug'] ) : 'diary';
    $diary_labels = array(
        'name' => $diary_label,
        'add_new' => __( 'Add New', 'tcd-w' ),
        'add_new_item' => __( 'Add New Item', 'tcd-w' ),
        'edit_item' => __( 'Edit', 'tcd-w' ),
        'new_item' => __( 'New item', 'tcd-w' ),
        'view_item' => __( 'View Item', 'tcd-w' ),
        'search_items' => __( 'Search Items', 'tcd-w' ),
        'not_found' => __( 'Not Found', 'tcd-w' ),
        'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
        'parent_item_colon' => ''
    );

    register_post_type( 'diary', array(
        'label' => $diary_label,
        'labels' => $diary_labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_position' => 5,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $diary_slug ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => $support,
        'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
    ));

    register_taxonomy(
        'diary_category',
        'diary',
        array(
            'label' => 'カテゴリー',
            'labels' => array(
                'all_items' => 'カテゴリー一覧',
                'add_new_item' => '新規カテゴリー追加',
            ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );


    // Interview --------------------------------------------------------------------------------
    $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Interview', 'tcd-w' );
    $interview_slug = $options['interview_slug'] ? sanitize_title( $options['interview_slug'] ) : 'interview';
    $interview_labels = array(
        'name' => $interview_label,
        'add_new' => __( 'Add New', 'tcd-w' ),
        'add_new_item' => __( 'Add New Item', 'tcd-w' ),
        'edit_item' => __( 'Edit', 'tcd-w' ),
        'new_item' => __( 'New item', 'tcd-w' ),
        'view_item' => __( 'View Item', 'tcd-w' ),
        'search_items' => __( 'Search Items', 'tcd-w' ),
        'not_found' => __( 'Not Found', 'tcd-w' ),
        'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
        'parent_item_colon' => ''
    );

    register_post_type( 'interview', array(
        'label' => $interview_label,
        'labels' => $interview_labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_position' => 5,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $interview_slug ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => $support,
        'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
    ));

    register_taxonomy(
        'interview_occupation',
        'interview',
        array(
            'label' => '職種',
            'labels' => array(
                'all_items' => '職種一覧',
                'add_new_item' => '新規職種追加',
            ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );
    register_taxonomy(
        'interview_division',
        'interview',
        array(
            'label' => '事業部',
            'labels' => array(
                'all_items' => '事業部一覧',
                'add_new_item' => '新規事業部追加',
            ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );


    // Review --------------------------------------------------------------------------------
    $review_label = $options['review_label'] ? esc_html( $options['review_label'] ) : __( 'Review', 'tcd-w' );
    $review_slug = $options['review_slug'] ? sanitize_title( $options['review_slug'] ) : 'review';
    $review_labels = array(
        'name' => $review_label,
        'add_new' => __( 'Add New', 'tcd-w' ),
        'add_new_item' => __( 'Add New Item', 'tcd-w' ),
        'edit_item' => __( 'Edit', 'tcd-w' ),
        'new_item' => __( 'New item', 'tcd-w' ),
        'view_item' => __( 'View Item', 'tcd-w' ),
        'search_items' => __( 'Search Items', 'tcd-w' ),
        'not_found' => __( 'Not Found', 'tcd-w' ),
        'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
        'parent_item_colon' => ''
    );

    register_post_type( 'review', array(
        'label' => $review_label,
        'labels' => $review_labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_position' => 5,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $review_slug ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => $support,
        'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
    ));

    register_taxonomy(
        'review_category',
        'review',
        array(
            'label' => 'カテゴリー',
            'labels' => array(
                'all_items' => 'カテゴリー一覧',
                'add_new_item' => '新規カテゴリー追加',
            ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );

}