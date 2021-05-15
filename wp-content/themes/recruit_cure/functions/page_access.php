<?php
add_action('admin_menu', 'add_access_field', 99);
function add_access_field() {
    add_meta_box( 'custom-access_field', 'カスタムアクセスコンテンツ', 'create_access_field', 'page', 'normal' );
}

function create_access_field() {
    global $post;

    ?>
    <h3>住所</h3>
    <input type="text" name="custom_access_address" value="<?= get_post_meta($post->ID, 'custom_access_address', true); ?>">

    <h3>アクセス情報</h3>
    <?php wp_editor( get_post_meta( $post->ID, 'custom_access_info', true ), 'custom_access_info', array('textarea_rows' => 6) ); ?>

    <h3>お問い合わせボタン：見出し</h3>
    <input type="text" name="custom_access_button_headline" value="<?= get_post_meta($post->ID, 'custom_access_button_headline', true); ?>">

    <h3>お問い合わせボタン：ラベル</h3>
    <input type="text" name="custom_access_button_label" value="<?= get_post_meta($post->ID, 'custom_access_button_label', true); ?>">

    <h3>お問い合わせボタン：URL</h3>
    <input type="text" name="custom_access_button_url" value="<?= get_post_meta($post->ID, 'custom_access_button_url', true); ?>">

    <h3>電話番号：見出し</h3>
    <input type="text" name="custom_access_tel_headline" value="<?= get_post_meta($post->ID, 'custom_access_tel_headline', true); ?>">

    <h3>電話番号：番号</h3>
    <input type="text" name="custom_access_tel" value="<?= get_post_meta($post->ID, 'custom_access_tel', true); ?>">

    <h3>電話番号：説明文</h3>
    <textarea name="custom_access_tel_desc"><?= get_post_meta($post->ID, 'custom_access_tel_desc', true); ?></textarea>

    <h3>業務案内一覧</h3>
    <?php
    $service = get_post_meta($post->ID, 'custom_access_service', true);
    ?>
    <div id="custom_access_service">
        <?php
        $services = new WP_Query(array(
            'post_type' => 'service'
        ));
        if($services->have_posts()):
            while($services->have_posts()):$services->the_post(); ?>
                <label><input type="checkbox" name="custom_access_service[]" value="<?= get_the_ID(); ?>" <?php if(in_array(get_the_ID(), $service)) echo 'checked'; ?>><?= get_the_title(); ?></label>
            <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>

    <style>
    #custom-access_field .inside {
        margin: 0;
        padding: 0 12px 12px;
    }
    #custom-access_field h3 {
        margin: 20px 0 10px;
        font-size: 14px;
    }
    #custom-access_field input[type="text"] {
        display: block;
        width: 100%;
        height: 40px;
        margin: 0;
        padding: 0 10px;
        box-sizing: border-box;
    }
    #custom-access_field textarea {
        display: block;
        width: 100%;
        min-height: 80px;
        margin: 0;
        padding: 10px;
        box-sizing: border-box;
    }
    #custom_access_service {
        display: block;
        width: 100%;
        max-height: 5em;
        padding: 5px 0;
        overflow-y: auto;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 3px;
    }
    #custom_access_service label {
        display: block;
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    </style>
    <?php
}

function save_access_field( $post_id ) {
    $fields = [
        'custom_access_address',
        'custom_access_info',
        'custom_access_button_headline', 'custom_access_button_label', 'custom_access_button_url',
        'custom_access_tel_headline', 'custom_access_tel', 'custom_access_tel_desc',
        'custom_access_service'
    ];

    foreach( $fields as $field ) {
        if( isset( $_POST[$field] ) && $_POST[$field] ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
        } else {
            delete_post_meta( $post_id, $field );
        }
    }
}
add_action('save_post', 'save_access_field');