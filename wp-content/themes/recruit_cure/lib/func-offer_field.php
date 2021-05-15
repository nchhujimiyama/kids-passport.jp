<?php
// ============================
// validation
//
// add_action( 'admin_enqueue_scripts', 'offer_validation_scripts' );
// function offer_validation_scripts() {
//     wp_enqueue_script('my_validate', get_stylesheet_directory__uri() . 'js/jquery.validate.min.js', array('jquery'));
//     wp_enqueue_script('reccruit_validation', get_stylesheet_directory__uri() . 'js/offer_validation.js');
// }
// ============================
// add meta box
//
add_action('admin_menu', 'add_offer_field');
function add_offer_field() {
    add_meta_box('management_option', '採用情報', 'insert_management_item', 'offer', 'normal');
    add_meta_box('offer_option', '採用情報', 'insert_offer_item', 'offer', 'normal');
    add_meta_box('treatment_option', '待遇', 'insert_treatment_item', 'offer', 'normal');
    add_meta_box('salary_option', '給与', 'insert_salary_item', 'offer', 'normal');
    add_meta_box('place_option', '勤務地', 'insert_place_item', 'offer', 'normal');

    ?>
    <style>
    .require:before {
        content: '必須';
        display: inline-block;
        margin-right: 5px;
        padding: 5px;
        background: #f00;
        border-radius: 3px;
        color: #fff;
        font-size: 10px;
        line-height: 1;
    }

    #slugdiv .inside {
        margin: 0 !important;
        padding: 0;
    }
    #slugdiv input {
        width: 100%;
        margin: 0;
        padding: 10px;
        border: none;
        border-radius: 0;
    }
    </style>
    <?php
}


// ============================
// include field
//

/* settings */
function insert_management_item() {
    global $post;

    include( STYLESHEETPATH . '/lib/page/offer_management.php' );
}

/* offer */
function insert_offer_item() {
    global $post;

    include( STYLESHEETPATH . '/lib/page/offer.php' );
}

/* treatment */
function insert_treatment_item() {
    global $post;

    include( STYLESHEETPATH . '/lib/page/offer_treatment.php' );
}

/* salary */
function insert_salary_item() {
    global $post;

    include( STYLESHEETPATH . '/lib/page/offer_salary.php' );
}

/* place */
function insert_place_item() {
    global $post;

    include( STYLESHEETPATH . '/lib/page/offer_place.php' );
}


// ============================
// save item
//
function save_offer_item( $post_id ) {
    $fields = array(
        'management_code',
        'update_num',
        'pickup',
        'offer_comment',
        'offer_pr',
        'offer_detail',
        'offer_competence',
        'treatment_status',
        'treatment_status_remarks',
        'treatment_hours',
        'treatment_hours_remarks',
        'treatment_trial',
        'treatment_holiday',
        'treatment_other',
        'salary_flag',
        'salary_width_flag',
        'salary_unit',
        'salary_value',
        'salary_value_min',
        'salary_value_max',
        'salary_remarks',
        'salary_bonus',
        'salary_increase',
        'salary_allowance',
        'place_name',
        'place_code',
        'place_prefectures',
        'place_city',
        'place_city_child',
        'place_other',
        'place_access',
    );
    foreach( $fields as $field ) {
        if( empty( $_POST[$field] ) && !( $_POST[$field] === 0 || $_POST[$field] === '0' ) ) {
            delete_post_meta( $post_id, $field );
        } else {
            if( $field === 'update_num' ) {
                update_post_meta( $post_id, $field, $_POST[$field] + 1 );
            } else {
                update_post_meta( $post_id, $field, $_POST[$field] );
            }
        }
    }
}
add_action( 'save_post', 'save_offer_item' );


/* validation */
// function validation_script() {
//     if ( get_post_type() === 'offer' ) {
//         wp_enqueue_script( 'jquery-form', get_stylesheet_directory_uri() . '/assets/js/jquery.form.js' );
//         wp_enqueue_script( 'jquery-validation', get_stylesheet_directory_uri() . '/assets/js/jquery.validate.js' );
//         wp_enqueue_script( 'offer-validation', get_stylesheet_directory_uri() . '/assets/js/offer-validation.js' );
//     }
// }
// add_action("admin_print_scripts-post.php", 'validation_script');