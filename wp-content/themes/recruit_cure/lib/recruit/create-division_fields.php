<?php
class CT_DIVISION_META {
    public function __construct() {}

    public function init() {
        add_action( 'division_add_form_fields', array ( $this, '_add_category_field' ), 10, 2 );
        add_action( 'create_term', array ( $this, '_save_category_field' ), 10, 2 );
        add_action( 'division_edit_form_fields', array ( $this, '_update_category_field' ), 10, 2 );
        add_action( 'edit_terms', array ( $this, '_updated_category_field' ), 10, 2 );
    }

    public function _add_category_field( $tag ) {
        ?>
        <div class="form-field term_group">
            <label for="bg_color">タグ用背景色</label>
            <input type="text" name="bg_color" placeholder="#000000" value="">
        </div>
        <div class="form-field term_group">
            <label for="text_color">タグ用文字色</label>
            <input type="text" name="text_color" placeholder="#ffffff" value="">
        </div>
        <?php
    }

    public function _save_category_field( $term_id, $tt_id ) {
        $keys = ['bg_color', 'text_color'];

        foreach($keys as $key) {
            if( isset( $_POST[$key] ) && '' !== $_POST[$key] ) {
                add_term_meta( $term_id, '', $_POST[$key], true );
            }
        }
    }

    public function _update_category_field( $term, $taxonomy ) {
        ?>
        <tr class="form-field term_group_wrap">
            <th scope="row"><label for="bg_color">タグ用背景色</label></th>
            <td><input type="text" name="bg_color" value="<?= get_term_meta( $term->term_id, 'bg_color', true ); ?>"></td>
        </tr>
        <tr class="form-field term_group_wrap">
            <th scope="row"><label for="text_color">タグ用文字色</label></th>
            <td><input type="text" name="text_color" value="<?= get_term_meta( $term->term_id, 'text_color', true ); ?>"></td>
        </tr>
        <?php
    }

    public function _updated_category_field( $term_id, $tt_id ) {
        $keys = ['bg_color', 'text_color'];

        foreach( $keys as $key ) {
            if( isset( $_POST[$key] ) && '' !== $_POST[$key] ) {
                update_term_meta( $term_id, $key, $_POST[$key] );
            } else {
                update_term_meta( $term_id, $key, '' );
            }
        }
    }
}

$CT_DIVISION_META = new CT_DIVISION_META();
$CT_DIVISION_META->init();