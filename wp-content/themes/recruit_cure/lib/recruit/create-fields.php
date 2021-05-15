<?php
add_action('admin_menu', 'add_relation_field');
function add_relation_field() {
    $options = get_design_plus_option();

    $slugs[] = 'post';
    $slugs[] = 'page';
    $slugs[] = $options['review_slug'] ? sanitize_title( $options['review_slug'] ) : 'review';
    $slugs[] = $options['interview_slug'] ? sanitize_title( $options['interview_slug'] ) : 'interview';
    $slugs[] = $options['diary_slug'] ? sanitize_title( $options['diary_slug'] ) : 'diary';
    $slugs[] = $options['menu_slug'] ? sanitize_title( $options['menu_slug'] ) : 'menu';
    $slugs[] = $options['service_slug'] ? sanitize_title( $options['service_slug'] ) : 'service';
    $slugs[] = $options['faq_slug'] ? sanitize_title( $options['faq_slug'] ) : 'faq';
    $slugs[] = $options['news_slug'] ? sanitize_title( $options['news_slug'] ) : 'news';

    foreach( $slugs as $slug ):
        add_meta_box('relation_option', '関連求人', 'insert_relation_item', $slug, 'normal');
    endforeach;
}

function insert_relation_item() {
    global $post;

    $occupation = get_post_meta($post->ID, 'relation_occupation', true);
    $division = get_post_meta($post->ID, 'relation_division', true);
    $place = get_post_meta($post->ID, 'relation_place', true);
    ?>
    <div class="check">
        <input type="checkbox" id="relation_display" name="relation_display" value="1" <?= get_post_meta($post->ID, 'relation_display', true) ? 'checked' : ''; ?>>
        <label for="relation_display">関連求人を表示する</label>
    </div>
    <dl>
        <dt>職種</dt>
        <dd>
            <select name="relation_occupation">
                <option value="">指定しない</option>
                <?php
                $terms = get_terms('occupation');
                if( $terms && !is_wp_error($terms) ):
                    foreach( $terms as $term ): ?>
                        <option value="<?= $term->term_id; ?>" <?= $occupation == $term->term_id ? 'selected' : ''; ?>><?= $term->name; ?></option>
                    <?php endforeach;
                endif;
                ?>
            </select>
        </dd>
    </dl>
    <dl>
        <dt>事業部</dt>
        <dd>
            <select name="relation_division">
                <option value="">指定しない</option>
                <?php
                $terms = get_terms('division');
                if( $terms && !is_wp_error($terms) ):
                    foreach( $terms as $term ): ?>
                        <option value="<?= $term->term_id; ?>" <?= $division == $term->term_id ? 'selected' : ''; ?>><?= $term->name; ?></option>
                    <?php endforeach;
                endif;
                ?>
            </select>
        </dd>
    </dl>
    <dl>
        <dt>勤務地</dt>
        <dd>
            <select name="relation_place">
                <option value="">指定しない</option>
                <?php
                $terms = get_terms('place');
                if( $terms && !is_wp_error($terms) ):
                    foreach( $terms as $term ): ?>
                        <option value="<?= $term->term_id; ?>" <?= $place == $term->term_id ? 'selected' : ''; ?>><?= $term->name; ?></option>
                    <?php endforeach;
                endif;
                ?>
            </select>
        </dd>
    </dl>

    <style>
    #relation_option .inside {
        margin: 0;
        padding: 0;
    }
    #relation_option dl {
        display: flex;
        align-items: center;
        margin: 0;
        box-sizing: border-box;
        border-top: 1px solid rgba(0,0,0,0.1);
    }
    #relation_option dt {
        width: 100px;
        padding: 0 10px;
    }
    #relation_option dd {
        flex: 1;
        margin: 0;
        border-left: 1px solid rgba(0,0,0,0.1);
        box-sizing: border-box;
    }
    #relation_option select {
        display: block;
        width: 100%;
        height: auto;
        margin: 0;
        padding: 15px;
        border: none;
        border-radius: 0;
        box-shadow: none;
        font-size: 16px;
    }
    #relation_option .check {
        padding: 10px;
    }
    #relation_option .check input {
        display: none;
    }
    #relation_option .check label {
        padding-left: 50px;
        position: relative;
    }
    #relation_option .check label:before,
    #relation_option .check label:after {
        content: '';
        display: block;
        margin: auto;
        border-radius: 10px;
        position: absolute;
        top: 0;
        bottom: 0;
        transition: all .3s;
    }
    #relation_option .check label:before {
        width: 40px;
        height: 20px;
        background: #ccc;
        left: 0;
    }
    #relation_option .check label:after {
        width: 16px;
        width: 16px;
        background: #fff;
        left: 2px;
    }
    #relation_option .check input:checked ~ label:before {
        background: #e2001b;
    }
    #relation_option .check input:checked ~ label:after {
        transform: translateX(20px);
    }
    </style>
    <?php
}


function save_relation_item( $post_id ) {
    $fields = [
        'relation_display',
        'relation_occupation',
        'relation_division',
        'relation_place'
    ];
    foreach( $fields as $field ) {
        if( isset($_POST[$field]) && $_POST[$field] ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
        } else {
            delete_post_meta( $post_id, $field );
        }
    }
}
add_action( 'save_post', 'save_relation_item' );