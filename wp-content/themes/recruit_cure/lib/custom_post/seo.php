<?php
function child_seo_meta_box() {
  $post_types = array ( 'menu', 'diary' );
  add_meta_box(
    'show_seo_meta_box',//ID of meta box
    __('SEO setting', 'tcd-w'),//label
    'show_child_seo_meta_box',//callback function
    $post_types,// post type
    'normal',// context
    'low'// priority
  );
}
add_action('add_meta_boxes', 'child_seo_meta_box', 998);

function show_child_seo_meta_box() {
  global $post;
  $options =  get_design_plus_option();

  $seo_title = get_post_meta($post->ID, 'tcd-w_meta_title', true);
  $seo_desc = get_post_meta($post->ID, 'tcd-w_meta_description', true);

  echo '<input type="hidden" name="seo_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

 <div class="tcd_cf_content">
  <h3 class="tcd_cf_headline"><?php _e( 'Title tag', 'tcd-w' ); ?></h3>
  <input type="text" name="tcd-w_meta_title" value="<?php if(!empty($seo_title)){ echo esc_attr($seo_title); }; ?>" style="width:100%" />
 </div><!-- END .content -->

 <div class="tcd_cf_content">
  <h3 class="tcd_cf_headline"><?php _e( 'Meta description tag', 'tcd-w' ); ?></h3>
  <p><?php printf(__('Recommended number of characters is %s.', 'tcd-w'), '180'); ?></p>
  <textarea class="large-text word_count" cols="50" rows="2" name="tcd-w_meta_description"><?php if(!empty($seo_desc)){ echo esc_textarea($seo_desc); }; ?></textarea>
  <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-w' ); ?></p>
 </div><!-- END .content -->

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_child_seo_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['seo_meta_box_nonce']) || !wp_verify_nonce($_POST['seo_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('tcd-w_meta_title','tcd-w_meta_description');
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_child_seo_meta_box');