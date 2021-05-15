<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-w'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-w'); ?>" />
    </div>
  </div>
 </div>
<?php
}




/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'page_header_meta_box',//ID of meta box
    __('Header setting', 'tcd-w'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $font_type_options, $animation_type_options;

  $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';

  $page_header_title_font_size = get_post_meta($post->ID, 'page_header_title_font_size', true) ?  get_post_meta($post->ID, 'page_header_title_font_size', true) : '28';
  $page_header_title_font_size_mobile = get_post_meta($post->ID, 'page_header_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_title_font_size_mobile', true) : '18';
  $page_header_title_font_color = get_post_meta($post->ID, 'page_header_title_font_color', true) ?  get_post_meta($post->ID, 'page_header_title_font_color', true) : '#ffffff';
  $page_header_title_font_type = get_post_meta($post->ID, 'page_header_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_title_font_type', true) : 'type3';
  $page_header_title_direction = get_post_meta($post->ID, 'page_header_title_direction', true);

  $page_header_sub_title = get_post_meta($post->ID, 'page_header_sub_title', true);
  $page_header_sub_title_font_size = get_post_meta($post->ID, 'page_header_sub_title_font_size', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size', true) : '16';
  $page_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) : '14';
  $page_header_sub_title_font_type = get_post_meta($post->ID, 'page_header_sub_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_type', true) : 'type2';
  $page_header_sub_title_font_color = get_post_meta($post->ID, 'page_header_sub_title_font_color', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_color', true) : '#ffffff';
  $page_header_sub_title_bg_color = get_post_meta($post->ID, 'page_header_sub_title_bg_color', true) ?  get_post_meta($post->ID, 'page_header_sub_title_bg_color', true) : '#00a7ce';

  $page_header_use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
  $page_header_overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
  $page_header_overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';

  $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
  $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';

  $page_hide_logo = get_post_meta($post->ID, 'page_hide_logo', true);
  $page_hide_global_menu = get_post_meta($post->ID, 'page_hide_global_menu', true);
  $page_hide_header_image = get_post_meta($post->ID, 'page_hide_header_image', true);
  $page_hide_bread = get_post_meta($post->ID, 'page_hide_bread', true);
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
  $page_hide_side_bar = get_post_meta($post->ID, 'page_hide_side_bar', true);

  $page_sub_title_type = get_post_meta($post->ID, 'page_sub_title_type', true) ?  get_post_meta($post->ID, 'page_sub_title_type', true) : 'type1';

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';
  $page_header_width = get_post_meta($post->ID, 'page_header_width', true) ?  get_post_meta($post->ID, 'page_header_width', true) : 'type1';

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

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
    <h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Please use the option below if you want to make this page like Landing page.', 'tcd-w'); ?></p>
    </div>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Hide logo', 'tcd-w'); ?></span><input name="page_hide_logo" type="checkbox" value="1" <?php checked( $page_hide_logo, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide global menu', 'tcd-w'); ?></span><input name="page_hide_global_menu" type="checkbox" value="1" <?php checked( $page_hide_global_menu, 1 ); ?>></li>
     <li class="cf hide_page_header"><span class="label"><?php _e('Hide page header', 'tcd-w'); ?></span><input name="page_hide_header_image" type="checkbox" value="1" <?php checked( $page_hide_header_image, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide breadcrumb link', 'tcd-w'); ?></span><input name="page_hide_bread" type="checkbox" value="1" <?php checked( $page_hide_bread, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide side bar', 'tcd-w'); ?></span><input name="page_hide_side_bar" type="checkbox" value="1" <?php checked( $page_hide_side_bar, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide footer', 'tcd-w'); ?></span><input name="page_hide_footer" type="checkbox" value="1" <?php checked( $page_hide_footer, 1 ); ?>></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Content width', 'tcd-w' ); ?></h4>
    <p><input class="hankaku page_content_width_input" style="width:100px;" type="number" max="1200" name="page_content_width" value="<?php echo esc_attr($page_content_width); ?>" /><span>px</span></p>
    <div id="page_option_content_font_size_setting" style="display:none;">
     <h4 class="theme_option_headline2"><?php _e( 'Other setting', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_content_font_size" value="<?php echo esc_attr($page_content_font_size); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of content (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_content_font_size_mobile" value="<?php echo esc_attr($page_content_font_size_mobile); ?>" /><span>px</span></li>
     </ul>
    </div>
    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area" style="<?php if($page_hide_header_image){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
   <h3 class="theme_option_headline"><?php _e( 'Header setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h4 class="theme_option_headline2"><?php _e('Header width', 'tcd-w');  ?></h4>
    <ul class="design_radio_button">
     <li id="page_header_width_type1_button">
      <input type="radio" id="page_header_width_type1" name="page_header_width" value="type1" <?php checked( $page_header_width, 'type1' ); ?> />
      <label for="page_header_width_type1">1200px</label>
     </li>
     <li id="page_header_width_type2_button">
      <input type="radio" id="page_header_width_type2" name="page_header_width" value="type2" <?php checked( $page_header_width, 'type2' ); ?> />
      <label for="page_header_width_type2"><?php _e('Fit to the width of the content', 'tcd-w');  ?></label>
     </li>
     <li id="page_header_width_type3_button">
      <input type="radio" id="page_header_width_type3" name="page_header_width" value="type3" <?php checked( $page_header_width, 'type3' ); ?> />
      <label for="page_header_width_type3"><?php _e('Full screen width', 'tcd-w');  ?></label>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Title', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
      <select name="page_header_title_font_type">
       <?php foreach ( $font_type_options as $option ) { ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $page_header_title_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
       <?php } ?>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_title_font_size" value="<?php echo esc_attr($page_header_title_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_title_font_size_mobile" value="<?php echo esc_attr($page_header_title_font_size_mobile); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="page_header_title_font_color" value="<?php echo esc_attr($page_header_title_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
     <li class="cf page_title_direction"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input type="checkbox" name="page_header_title_direction" value="1" <?php if( $page_header_title_direction == '1' ) { echo 'checked="checked"'; }; ?> /><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="2" name="page_header_sub_title"><?php echo esc_textarea(  $page_header_sub_title ); ?></textarea>
    <ul class="option_list">
     <li class="cf page_subtitle_type" style="<?php if($page_header_title_direction){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>"><span class="label"><?php _e('Display position', 'tcd-w');  ?></span>
      <select id="page_sub_title_type" name="page_sub_title_type">
       <option style="padding-right: 10px;" value="type1" <?php selected( $page_sub_title_type, 'type1' ); ?>><?php _e('Display on left top by square shape', 'tcd-w'); ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $page_sub_title_type, 'type2' ); ?>><?php _e('Display under title', 'tcd-w'); ?></option>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
      <select name="page_header_sub_title_font_type">
       <?php foreach ( $font_type_options as $option ) { ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $page_header_sub_title_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
       <?php } ?>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_sub_title_font_size" value="<?php echo esc_attr($page_header_sub_title_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_sub_title_font_size_mobile" value="<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="page_header_sub_title_font_color" value="<?php echo esc_attr($page_header_sub_title_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
     <li class="cf page_subtitle_bg_color" style="<?php if($page_sub_title_type == 'type2'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="page_header_sub_title_bg_color" value="<?php echo esc_attr($page_header_sub_title_bg_color); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p id="page_header_width_type1_image" style="<?php if($page_header_width == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1200', '400'); ?></p>
     <p id="page_header_width_type2_image" style="<?php if($page_header_width == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><?php printf(__('Recommend image size. Width:<span class="page_change_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), $page_content_width, '400' ); ?></p>
     <p id="page_header_width_type3_image" style="<?php if($page_header_width == 'type3'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '400'); ?></p>
    </div>
    <?php mlcf_media_form('page_header_bg_image', __('Background image', 'tcd-w')); ?>

    <h3 class="theme_option_headline2"><?php _e( 'Background image (mobile)', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
     <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '400'); ?></p>
    </div>
    <?php mlcf_media_form('page_header_bg_image_mobile', __('Background image', 'tcd-w')); ?>

    <h3 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php _e('By using overlay color, you can adjust the brightness of the image or create a mysterious impression.', 'tcd-w'); ?></p>
    </div>
    <p class="displayment_checkbox"><label for="page_header_use_overlay"><input id="page_header_use_overlay" type="checkbox" name="page_header_use_overlay" value="1" <?php if( $page_header_use_overlay == '1' ) { echo 'checked="checked"'; }; ?> /><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div class="blog_show_overlay" style="<?php if($page_header_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="page_header_overlay_color" value="<?php echo esc_attr($page_header_overlay_color); ?>" data-default-color="#000000" class="c-color-picker" /></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="page_header_overlay_opacity" value="<?php echo esc_attr($page_header_overlay_opacity); ?>" />
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

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
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
    'page_header_bg_image','page_header_bg_image_mobile','page_header_use_overlay','page_header_overlay_color','page_header_overlay_opacity',
    'page_header_title_font_size','page_header_title_font_size_mobile','page_header_title_font_color','page_header_title_font_type','page_header_title_bg_color','page_header_title_bg_opacity',
    'page_header_sub_title','page_header_sub_title_font_size','page_header_sub_title_font_size_mobile','page_header_sub_title_font_type','page_header_sub_title_font_color','page_header_sub_title_bg_color',
    'page_content_font_size','page_content_font_size_mobile','page_header_title_direction',
    'page_hide_logo','page_hide_global_menu','page_hide_header_image','page_hide_bread','page_hide_footer','page_hide_side_bar','page_sub_title_type','page_content_width','page_header_width'
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
add_action('save_post', 'save_page_header_meta_box');



?>