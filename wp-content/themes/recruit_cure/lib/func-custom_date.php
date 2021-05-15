<?php
// jQuery UI Script / Style
add_action( 'admin_print_scripts', 'custom_enqueue_script', 1000 );
add_action( 'admin_print_styles', 'custom_enqueue_style', 1000 );
function custom_enqueue_script() {
    wp_enqueue_script('jquery-ui-datepicker');
}
function custom_enqueue_style() {
    wp_register_style('jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_enqueue_style( 'jquery-ui' );
}

// Meta Box
add_action('admin_menu', 'add_modified_date');
function add_modified_date() {
    add_meta_box('custom_modified_date', '更新日時', 'custom_modified_date', 'offer', 'side', 'high');
}

function custom_modified_date() {
    global $post;

    //現在の更新日時
    echo '<div>更新日時：<strong>' . get_the_modified_time( 'Y年n月j日 H:i' ) . '</strong></div>';

    //日付と時間に分離
    $modified = explode( ' ', get_the_modified_time( 'Y-m-d H:i' ) );

    //時間と分に分離
    $modified_time = explode( ':', $modified[1] );

    //時間のSELECT
    $hour = '<select name="modified_hour">';
    for( $i = 0; $i < 24; ++$i ) {
        $selected = ( $i == $modified_time[0] ) ? ' selected' : null;
        $hour .= '<option value="'.sprintf( '%02d', $i ).'"' . $selected . '>'.sprintf( '%02d', $i ).'</option>';
    }
    $hour .= '</select>';

    //分のSELECT
    $minute = '<select name="modified_minute">';
    for( $i = 0; $i < 60; ++$i ) {
        $selected = ( $i == $modified_time[1] ) ? ' selected' : null;
        $minute .= '<option value="'.sprintf( '%02d', $i ).'"' . $selected . '>'.sprintf( '%02d', $i ).'</option>';
    }
    $minute .= '</select>';

    // Meta Box のHTML
echo <<<EOF
<ul>
    <li><label><input type="radio" name="modified_type" value="1" checked>更新時の日時（wordpress標準）</label></li>
    <li><label><input type="radio" name="modified_type" value="2">変更しない</label></li>
    <li><label><input type="radio" name="modified_type" value="3">指定</label><li>
    <li class="modified_select"><input type="text" name="modified_date" class="datepicker">{$hour}時{$minute}分</li>
</ul>
<script>
jQuery(document).ready(function($){
    $('.datepicker').datepicker();
    $('.datepicker').datepicker('option', 'dateFormat', 'yy-mm-dd');
    $('.datepicker').datepicker('setDate', '{$modified[0]}');
});
</script>
<style>
.modified_select input,
.modified_select select {
    max-width:7em;
    line-height:100%;
    height:auto;
    vertical-align:middle;
}
.modified_select select {
    margin:0 5px;
}
</style>
EOF;
}

// Set Save Post
add_filter( 'wp_insert_post_data', 'set_modified_date' , '99', 2 );

// set_modified_date
function set_modified_date( $data, $postarr ) {
    // Radioのチェックなし or [更新時の日時（wordpress標準）]
    if( !isset( $_POST['modified_type'] ) || $_POST['modified_type'] == 1 ) return $data;

    //　Radioのチェックが[3]かつ日付がセットされてる場合は変更　それ以外は変更しない
    if( $_POST['modified_type'] == 3 && isset( $_POST['modified_date'] ) && $_POST['modified_date'] ) {
        $modified = $_POST['modified_date'] . ' ' . $_POST['modified_hour'] . ':' . $_POST['modified_minute'] . ':00';
        $modified_gmt = get_gmt_from_date( $modified );
    } else {
        $modified = get_the_modified_time( 'Y-m-d H:i:s' );
        $modified_gmt = get_post_modified_time( 'Y-m-d H:i:s', true);
    }

    update_offer_permalink( $data['ID'], $permalink_date );

    // Postデータの書き換え
    $data['post_modified'] = $modified;
    $data['post_modified_gmt'] = $modified_gmt;

    return $data;
}


function update_offer_permalink( $post_id, $post ) {
    if( get_post_type( $post_id ) != 'offer' ) return;

    global $wpdb;

    remove_action( 'save_post', 'update_offer_permalink', 99, 2 );

    $code = get_post_meta( $post_id, 'management_code', true );
    $num = str_pad( get_post_meta( $post_id, 'update_num', true ), 3, 0, STR_PAD_LEFT );

    $type = $_POST['modified_type'];
    if( !isset( $type ) || $type == 1 ) $date = date('Ymd');
    if( $type == 3 && isset( $type ) && $type ) {
        $date = str_replace( '-', '', $_POST['modified_date'] );
    } else {
        $day = new DateTime($post->post_modified);
        $date = $day->format('Ymd');
    }
    $permalink = $code . '-' . $num . '-' . $date;

    update_post_meta( $post_id, 'uuid', $date );
    update_post_meta( $post_id, 'custom_permalink', $permalink );

    $wpdb->update(
        'wp_posts',
        array(
            'post_name' => $permalink
        ),
        array( 'ID' => $post_id )
    );

    add_action( 'save_post', 'update_offer_permalink', 99, 2 );
}
add_action( 'save_post', 'update_offer_permalink', 99, 2 );