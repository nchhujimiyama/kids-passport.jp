<h3 class="require">一言</h3>
<input class="require" type="text" name="offer_comment" value="<?= get_post_meta( $post->ID, 'offer_comment', true ); ?>" required>

<h3 class="require">PR情報</h3>
<?php wp_editor( get_post_meta( $post->ID, 'offer_pr', true ), 'offer_pr', array('textarea_name' => 'offer_pr', 'textarea_rows' => 6, 'editor_class' => 'my-required-field') ); ?>

<h3>仕事内容</h3>
<?php wp_editor( get_post_meta( $post->ID, 'offer_detail', true ), 'offer_detail', array('textarea_rows' => 6) ); ?>

<h3>応募資格</h3>
<?php wp_editor( get_post_meta( $post->ID, 'offer_competence', true ), 'offer_competence', array('textarea_rows' => 6) ); ?>

<style>
    #offer_option h3 {
        padding: 10px;
        font-size: 14px;
        background: #efefef;
        border: 1px solid #ccd0d4
    }
    #offer_option div + h3 {
        margin-top: 30px;
    }
    #offer_option input[type="text"] {
        display: block;
        width: 100%;
        padding: 10px;
    }
</style>