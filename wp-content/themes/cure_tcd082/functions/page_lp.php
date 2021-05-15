<?php
function page_lp_meta_box() {
  add_meta_box(
    'page_lp_meta_box',//ID of meta box
    __('LP page setting', 'tcd-w'),//label
    'show_page_lp_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_lp_meta_box');

function show_page_lp_meta_box() {

  global $post, $font_type_options, $animation_type_options;

  $lp_page_catch = get_post_meta($post->ID, 'lp_page_catch', true);
  $lp_page_catch_font_size = get_post_meta($post->ID, 'lp_page_catch_font_size', true) ?  get_post_meta($post->ID, 'lp_page_catch_font_size', true) : '38';
  $lp_page_catch_font_size_mobile = get_post_meta($post->ID, 'lp_page_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'lp_page_catch_font_size_mobile', true) : '24';
  $lp_page_catch_font_color = get_post_meta($post->ID, 'lp_page_catch_font_color', true) ?  get_post_meta($post->ID, 'lp_page_catch_font_color', true) : '#ffffff';
  $lp_page_catch_font_type = get_post_meta($post->ID, 'lp_page_catch_font_type', true) ?  get_post_meta($post->ID, 'lp_page_catch_font_type', true) : 'type3';

  $lp_page_desc = get_post_meta($post->ID, 'lp_page_desc', true);
  $lp_page_desc_mobile = get_post_meta($post->ID, 'lp_page_desc_mobile', true);
  $lp_page_desc_font_size = get_post_meta($post->ID, 'lp_page_desc_font_size', true) ?  get_post_meta($post->ID, 'lp_page_desc_font_size', true) : '16';
  $lp_page_desc_font_size_mobile = get_post_meta($post->ID, 'lp_page_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'lp_page_desc_font_size_mobile', true) : '14';
  $lp_page_desc_font_color = get_post_meta($post->ID, 'lp_page_desc_font_color', true) ?  get_post_meta($post->ID, 'lp_page_desc_font_color', true) : '#ffffff';

  $lp_page_use_overlay = get_post_meta($post->ID, 'lp_page_use_overlay', true);
  $lp_page_overlay_color = get_post_meta($post->ID, 'lp_page_overlay_color', true) ?  get_post_meta($post->ID, 'lp_page_overlay_color', true) : '#000000';
  $lp_page_overlay_opacity = get_post_meta($post->ID, 'lp_page_overlay_opacity', true) ?  get_post_meta($post->ID, 'lp_page_overlay_opacity', true) : '0.3';

  $lp_page_display_only_logo = get_post_meta($post->ID, 'lp_page_display_only_logo', true);
  $lp_page_logo_position = get_post_meta($post->ID, 'lp_page_logo_position', true);
  $lp_page_hide_footer = get_post_meta($post->ID, 'lp_page_hide_footer', true);
  $lp_page_hide_line = get_post_meta($post->ID, 'lp_page_hide_line', true);
  $lp_page_content_font_size = get_post_meta($post->ID, 'lp_page_content_font_size', true) ?  get_post_meta($post->ID, 'lp_page_content_font_size', true) : '16';
  $lp_page_content_font_size_mobile = get_post_meta($post->ID, 'lp_page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'lp_page_content_font_size_mobile', true) : '14';

  echo '<input type="hidden" name="page_lp_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってABOUT入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="default">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">
    <ul class="option_list">
     <li class="cf lp_page_logo_position_button"><span class="label"><?php _e('Display only logo', 'tcd-w'); ?></span><input name="lp_page_display_only_logo" type="checkbox" value="1" <?php checked( $lp_page_display_only_logo, 1 ); ?>></li>
     <li class="cf lp_page_logo_position" style="display:<?php if($lp_page_display_only_logo) { echo 'block'; } else { echo 'none'; }; ?>"><span class="label"><?php _e('Position of logo', 'tcd-w');  ?></span>
      <select name="lp_page_logo_position">
       <option style="padding-right: 10px;" value="type1" <?php selected( $lp_page_logo_position, 'type1' ); ?>><?php _e('Display on left', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $lp_page_logo_position, 'type2' ); ?>><?php _e('Display on center', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type3" <?php selected( $lp_page_logo_position, 'type3' ); ?>><?php _e('Display on right', 'tcd-w');  ?></option>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Hide footer', 'tcd-w'); ?></span><input name="lp_page_hide_footer" type="checkbox" value="1" <?php checked( $lp_page_hide_footer, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide background line', 'tcd-w'); ?></span><input name="lp_page_hide_line" type="checkbox" value="1" <?php checked( $lp_page_hide_line, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="lp_page_content_font_size" value="<?php echo esc_attr($lp_page_content_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size of content (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="lp_page_content_font_size_mobile" value="<?php echo esc_attr($lp_page_content_font_size_mobile); ?>" /><span>px</span></li>
    </ul>
    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Header setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="3" name="lp_page_catch"><?php echo esc_textarea(  $lp_page_catch ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
      <select name="lp_page_catch_font_type">
       <?php foreach ( $font_type_options as $option ) { ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $lp_page_catch_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
       <?php } ?>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="lp_page_catch_font_size" value="<?php echo esc_attr($lp_page_catch_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="lp_page_catch_font_size_mobile" value="<?php echo esc_attr($lp_page_catch_font_size_mobile); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_page_catch_font_color" value="<?php echo esc_attr($lp_page_catch_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="3" name="lp_page_desc"><?php echo esc_textarea(  $lp_page_desc ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="lp_page_desc_font_size" value="<?php echo esc_attr($lp_page_desc_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_page_desc_font_color" value="<?php echo esc_attr($lp_page_desc_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w'); ?></h3>
    <div class="theme_option_message2">
     <p><?php echo __('Please use this option if you want to change description in mobile device.', 'tcd-w'); ?></p>
    </div>
    <textarea class="full_width" cols="50" rows="3" name="lp_page_desc_mobile"><?php echo esc_textarea(  $lp_page_desc_mobile ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="lp_page_desc_font_size_mobile" value="<?php echo esc_attr($lp_page_desc_font_size_mobile); ?>" /><span>px</span></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h3>
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '1100'); ?></p>
    <?php mlcf_media_form('lp_page_bg_image', __('Background image', 'tcd-w')); ?>

    <h3 class="theme_option_headline2"><?php _e( 'Background image (mobile)', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
     <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
    </div>
    <?php mlcf_media_form('lp_page_bg_image_mobile', __('Background image', 'tcd-w')); ?>

    <h3 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php _e('By using overlay color, you can adjust the brightness of the image or create a mysterious impression.', 'tcd-w'); ?></p>
    </div>
    <p class="displayment_checkbox"><label for="lp_page_use_overlay"><input id="lp_page_use_overlay" type="checkbox" name="lp_page_use_overlay" value="1" <?php if( $lp_page_use_overlay == '1' ) { echo 'checked="checked"'; }; ?> /><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div class="blog_show_overlay" style="<?php if($lp_page_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="lp_page_overlay_color" value="<?php echo esc_attr($lp_page_overlay_color); ?>" data-default-color="#000000" class="c-color-picker" /></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="lp_page_overlay_opacity" value="<?php echo esc_attr($lp_page_overlay_opacity); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_lp_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_lp_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_lp_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'lp_page_display_only_logo','lp_page_hide_footer','lp_page_logo_position','lp_page_hide_line','lp_page_content_font_size','lp_page_content_font_size_mobile',
    'lp_page_bg_image','lp_page_bg_image_mobile','lp_page_use_overlay','lp_page_overlay_color','lp_page_overlay_opacity',
    'lp_page_catch','lp_page_catch_font_size','lp_page_catch_font_size_mobile','lp_page_catch_font_color','lp_page_catch_font_type',
    'lp_page_desc','lp_page_desc_mobile','lp_page_desc_font_size','lp_page_desc_font_size_mobile','lp_page_desc_font_color',
  );
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
add_action('save_post', 'save_page_lp_meta_box');



?>