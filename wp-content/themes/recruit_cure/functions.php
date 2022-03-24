<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// style ans script --------------------------------------------------------------------------------
function add_my_styles() {
    $options = get_design_plus_option();
    $interview_slug = $options['interview_slug'] ? sanitize_title( $options['interview_slug'] ) : 'interview';
    $review_slug = $options['review_slug'] ? sanitize_title( $options['review_slug'] ) : 'review';
    if( is_post_type_archive($interview_slug) || is_post_type_archive($review_slug) ) {
        wp_enqueue_style('archive-custom', get_stylesheet_directory_uri() . '/assets/css/custom-archive.css');
    }
}
add_action('wp_enqueue_scripts', 'add_my_styles');

function add_my_scripts() {
    if( is_post_type_archive('interview') ) {
        wp_enqueue_script('interview-filter', get_stylesheet_directory_uri() . '/assets/js/custom-archive.js', array(), false, true);
    }
}
add_action('wp_footer', 'add_my_scripts');


// company settings page --------------------------------------------------------------------------------
get_template_part( 'lib/func', 'company_fields' );


// hook wp_head --------------------------------------------------------------------------------
require get_stylesheet_directory() . '/functions/head.php';


// custom_script --------------------------------------------------------------------------------
require get_stylesheet_directory() . '/functions/custom_script.php';


// custom access field --------------------------------------------------------------------------------
require get_stylesheet_directory() . '/functions/page_access.php';


// count views --------------------------------------------------------------------------------
function setPostViews($post_id) {
    $custom_key = 'post_views_count';
    $view_count = get_post_meta($post_id, $custom_key, true);
    if ($view_count === '') {
        delete_post_meta($post_id, $custom_key);
        add_post_meta($post_id, $custom_key, '0');
    } else {
        $view_count++;
        update_post_meta($post_id, $custom_key, $view_count);
    }
}


// format wp editor --------------------------------------------------------------------------------
function format_wpeditor( $content ) {
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    return $content;
}

// custom css in media library --------------------------------------------------------------------------------
function my_admin_style() {
	echo '<style>
	.media-toolbar-secondary,
	.media-toolbar-primary {
		height: auto !important;
	}
	</style>'.PHP_EOL;
}
add_action('admin_print_styles', 'my_admin_style');


add_action('init','remove_parent_custom_script');
function remove_parent_custom_script() {
    remove_action('admin_print_scripts', 'my_admin_scripts');
}
function custom_admin_scripts() {
    wp_enqueue_script( 'wp-color-picker');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('jquery-ui-resizable');//トップページのロゴで使用
    wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.0', true);
    wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
    wp_enqueue_script('my_script', get_stylesheet_directory_uri().'/admin/js/my_script.js', '', '1.0.7', true);
    wp_enqueue_script('ml-rebox-js', get_template_directory_uri().'/admin/js/rebox/jquery-rebox.js', '', '1.0.0', true);
    wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
      'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-w' ),
      'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-w' ),
      'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-w' ),
      'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-w' ),
      'imageContentWidthMessage' => __( '<span>You can display image by content width when you displaying border around the content on LP page.</span>', 'tcd-w' ),
    ) );
    wp_enqueue_media();//画像アップロード用
    wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
    wp_localize_script( 'cf-media-field', 'cfmf_text', array(
      'image_title' => __( 'Please select image', 'tcd-w' ),
      'image_button' => __( 'Use this image', 'tcd-w' ),
      'video_title' => __( 'Please select MP4 file', 'tcd-w' ),
      'video_button' => __( 'Use this MP4 file', 'tcd-w' )
    ) );
}
add_action('admin_print_scripts', 'custom_admin_scripts');

function add_cta_script() {
    wp_enqueue_script('footer-cta', get_stylesheet_directory_uri() . '/assets/js/footer-cta.js', array(), false, true );
}
add_action('wp_enqueue_scripts', 'add_cta_script');



require get_stylesheet_directory() . '/lib/custom_post/create-posttype.php';
require get_stylesheet_directory() . '/lib/custom_post/blog_cf.php';
require get_stylesheet_directory() . '/lib/custom_post/seo.php';
require get_stylesheet_directory() . '/lib/custom_post/custom_css.php';
require get_stylesheet_directory() . '/lib/custom_post/menu.php';
require get_stylesheet_directory() . '/lib/custom_post/diary.php';
require get_stylesheet_directory() . '/lib/custom_post/category_cf.php';
require get_stylesheet_directory() . '/lib/custom_post/shortcode-top_diary_menu.php';

require get_stylesheet_directory() . '/lib/custom_post/interview.php';
require get_stylesheet_directory() . '/lib/custom_post/review.php';

require get_stylesheet_directory() . '/lib/custom_post/marketing.php';

require get_stylesheet_directory() . '/lib/recruit/create-division_fields.php';

require get_stylesheet_directory() . '/lib/top/shortcode-interview.php';
require get_stylesheet_directory() . '/lib/top/shortcode-review.php';



function tcd_body_classes_custom($classes) {
    global $wp_query, $post;
    $options = get_design_plus_option();

    /* menu */
    if( is_singular('menu') && $options['single_menu_layout'] ) {
      $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
      if($side_content_layout == 'type0'){
        $classes[] = 'layout_' . esc_attr($options['single_menu_layout']);
      } else {
        $classes[] = 'layout_' . esc_attr($side_content_layout);
      }
    };
    if( is_post_type_archive('menu') && $options['archive_menu_layout'] ) { $classes[] = 'layout_' . esc_attr($options['archive_menu_layout']); };

    /* diary */
    if( is_singular('diary') && $options['single_diary_layout'] ) {
        $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
        if($side_content_layout == 'type0'){
          $classes[] = 'layout_' . esc_attr($options['single_diary_layout']);
        } else {
          $classes[] = 'layout_' . esc_attr($side_content_layout);
        }
    };
    if( is_post_type_archive('diary') && $options['archive_diary_layout'] ) { $classes[] = 'layout_' . esc_attr($options['archive_diary_layout']); };

    /* interview */
    if( is_singular('interview') && $options['single_interview_layout'] ) {
        $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
        if($side_content_layout == 'type0'){
          $classes[] = 'layout_' . esc_attr($options['single_interview_layout']);
        } else {
          $classes[] = 'layout_' . esc_attr($side_content_layout);
        }
    };
    if( is_post_type_archive('interview') && $options['archive_interview_layout'] ) { $classes[] = 'layout_' . esc_attr($options['archive_interview_layout']); };

    /* review */
    if( is_singular('review') && $options['single_review_layout'] ) {
        $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
        if($side_content_layout == 'type0'){
          $classes[] = 'layout_' . esc_attr($options['single_review_layout']);
        } else {
          $classes[] = 'layout_' . esc_attr($side_content_layout);
        }
    };
    if( is_post_type_archive('review') && $options['archive_review_layout'] ) { $classes[] = 'layout_' . esc_attr($options['archive_review_layout']); };


    if (wp_is_mobile()) { $classes[] = 'mobile_device'; };
    if ($options['header_fix'] != 'type1') { $classes[] = 'use_header_fix'; };
    if ($options['mobile_header_fix'] == 'type2') { $classes[] = 'use_mobile_header_fix'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type1') ) { $classes[] = 'show_footer_bar dp-footer-bar-type1'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type2') ) { $classes[] = 'show_footer_bar dp-footer-bar-type2'; };

    return array_unique($classes);
};
add_filter('body_class','tcd_body_classes_custom');