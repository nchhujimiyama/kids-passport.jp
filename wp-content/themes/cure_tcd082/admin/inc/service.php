<?php
/*
 * サービスの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_service_dp_default_options' );


//  Add label of service tab
add_action( 'tcd_tab_labels', 'add_service_tab_label' );


// Add HTML of service tab
add_action( 'tcd_tab_panel', 'add_service_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_service_theme_options_validate' );


// タブの名前
function add_service_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );
  $tab_labels['service'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_service_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['service_label'] = __( 'Service', 'tcd-w' );
	$dp_default_options['service_slug'] = 'service';
	$dp_default_options['show_service_archive_sidebar'] = 1;
	$dp_default_options['show_service_single_sidebar'] = 1;

	// ヘッダー
	$dp_default_options['service_title_font_type'] = 'type3';
	$dp_default_options['service_title_font_size'] = '28';
	$dp_default_options['service_title_font_size_mobile'] = '24';
	$dp_default_options['service_title_font_color'] = '#FFFFFF';
	$dp_default_options['service_title_direction'] = '';
	$dp_default_options['service_sub_title'] = 'SERVICE';
	$dp_default_options['service_sub_title_font_type'] = 'type2';
	$dp_default_options['service_sub_title_font_size'] = '16';
	$dp_default_options['service_sub_title_font_size_mobile'] = '14';
	$dp_default_options['service_sub_title_font_color'] = '#FFFFFF';
	$dp_default_options['service_sub_title_bg_color'] = '#00a7ce';
	$dp_default_options['service_bg_image'] = false;
	$dp_default_options['service_bg_image_mobile'] = false;
	$dp_default_options['service_use_overlay'] = 1;
	$dp_default_options['service_overlay_color'] = '#000000';
	$dp_default_options['service_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_service_headline'] = '';
	$dp_default_options['archive_service_headline_font_size'] = '14';
	$dp_default_options['archive_service_headline_font_size_mobile'] = '12';
	$dp_default_options['archive_service_headline_font_color'] = '#00a6cc';
	$dp_default_options['archive_service_headline_font_type'] = 'type2';
	$dp_default_options['archive_service_catch'] = '';
	$dp_default_options['archive_service_catch_font_type'] = 'type3';
	$dp_default_options['archive_service_catch_font_size'] = '38';
	$dp_default_options['archive_service_catch_font_size_mobile'] = '20';
	$dp_default_options['archive_service_desc'] = '';
	$dp_default_options['archive_service_desc_font_size'] = '16';
	$dp_default_options['archive_service_desc_font_size_mobile'] = '14';

	$dp_default_options['archive_service_title_font_size'] = '22';
	$dp_default_options['archive_service_title_font_size_mobile'] = '18';
	$dp_default_options['archive_service_title_font_color'] = '#00a8cc';

	$dp_default_options['archive_service_excerpt_font_size'] = '16';
	$dp_default_options['archive_service_excerpt_font_size_mobile'] = '14';

	// 記事ページ
	$dp_default_options['single_service_desc_font_size'] = '16';
	$dp_default_options['single_service_desc_font_size_mobile'] = '14';
	$dp_default_options['show_single_service_list'] = 1;
	$dp_default_options['single_service_list_headline'] = __( 'Service', 'tcd-w' );
	$dp_default_options['single_service_list_headline_font_size'] = '24';
	$dp_default_options['single_service_list_headline_font_size_mobile'] = '20';
	$dp_default_options['single_service_list_headline_font_type'] = 'type2';
	$dp_default_options['single_service_list_num'] = '8';
	$dp_default_options['single_service_list_item_font_color_hover'] = '#000000';
	$dp_default_options['single_service_list_item_bg_color_hover'] = '#f1fafc';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_tab_panel( $options ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options, $animation_type_options;
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

?>

<div id="tab-content-service" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <input class="regular-text" type="text" name="dp_options[service_label]" value="<?php echo esc_attr( $options['service_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku regular-text" type="text" name="dp_options[service_slug]" value="<?php echo sanitize_title( $options['service_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Sidebar setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display on archive page', 'tcd-w');  ?></span><input name="dp_options[show_service_archive_sidebar]" type="checkbox" value="1" <?php checked( '1', $options['show_service_archive_sidebar'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display on single page', 'tcd-w');  ?></span><input name="dp_options[show_service_single_sidebar]" type="checkbox" value="1" <?php checked( '1', $options['show_service_single_sidebar'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // ヘッダーの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[service_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['service_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[service_title_font_size]" value="<?php esc_attr_e( $options['service_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[service_title_font_size_mobile]" value="<?php esc_attr_e( $options['service_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[service_title_font_color]" value="<?php echo esc_attr( $options['service_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input name="dp_options[service_title_direction]" type="checkbox" value="1" <?php checked( $options['service_title_direction'], 1 ); ?>><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Subtitle will be displayed on left top of the header image by square shape.', 'tcd-w'); ?></p>
     </div>
     <textarea class="full_width" cols="50" rows="2" name="dp_options[service_sub_title]"><?php echo esc_textarea(  $options['service_sub_title'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[service_sub_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['service_sub_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[service_sub_title_font_size]" value="<?php esc_attr_e( $options['service_sub_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[service_sub_title_font_size_mobile]" value="<?php esc_attr_e( $options['service_sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[service_sub_title_font_color]" value="<?php echo esc_attr( $options['service_sub_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[service_sub_title_bg_color]" value="<?php echo esc_attr( $options['service_sub_title_bg_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1200', '400'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js service_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['service_bg_image'] ); ?>" id="service_bg_image" name="dp_options[service_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['service_bg_image']){ echo wp_get_attachment_image($options['service_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['service_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
      <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js service_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['service_bg_image_mobile'] ); ?>" id="service_bg_image_mobile" name="dp_options[service_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['service_bg_image_mobile']){ echo wp_get_attachment_image($options['service_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['service_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[service_use_overlay]" type="checkbox" value="1" <?php checked( $options['service_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['service_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[service_overlay_color]" value="<?php echo esc_attr( $options['service_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[service_overlay_opacity]" value="<?php echo esc_attr( $options['service_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[archive_service_headline]" value="<?php echo esc_attr( $options['archive_service_headline'] ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_service_headline_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_service_headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_headline_font_size]" value="<?php esc_attr_e( $options['archive_service_headline_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_headline_font_size_mobile]" value="<?php esc_attr_e( $options['archive_service_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_service_headline_font_color]" value="<?php echo esc_attr( $options['archive_service_headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_service_catch]"><?php echo esc_textarea(  $options['archive_service_catch'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_service_catch_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_service_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_catch_font_size]" value="<?php esc_attr_e( $options['archive_service_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_catch_font_size_mobile]" value="<?php esc_attr_e( $options['archive_service_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_service_desc]"><?php echo esc_textarea(  $options['archive_service_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_desc_font_size]" value="<?php esc_attr_e( $options['archive_service_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_desc_font_size_mobile]" value="<?php esc_attr_e( $options['archive_service_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'),$service_label);  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_title_font_size]" value="<?php esc_attr_e( $options['archive_service_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_service_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_service_title_font_color]" value="<?php echo esc_attr( $options['archive_service_title_font_color'] ); ?>" data-default-color="#00a8cc" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_excerpt_font_size]" value="<?php esc_attr_e( $options['archive_service_excerpt_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_service_excerpt_font_size_mobile]" value="<?php esc_attr_e( $options['archive_service_excerpt_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Single page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Description setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_service_desc_font_size]" value="<?php esc_attr_e( $options['single_service_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_service_desc_font_size_mobile]" value="<?php esc_attr_e( $options['single_service_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'),$service_label); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_single_service_list]" type="checkbox" value="1" <?php checked( $options['show_single_service_list'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-w'),$service_label); ?></label></p>
     <div style="<?php if($options['show_single_service_list'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[single_service_list_headline]" value="<?php echo esc_attr($options['single_service_list_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font type of headline', 'tcd-w');  ?></span>
        <select name="dp_options[single_service_list_headline_font_type]">
         <?php foreach ( $font_type_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_service_list_headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_service_list_headline_font_size]" value="<?php esc_attr_e( $options['single_service_list_headline_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_service_list_headline_font_size_mobile]" value="<?php esc_attr_e( $options['single_service_list_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[single_service_list_num]">
         <option style="padding-right: 10px;" value="-1" <?php selected( $options['single_service_list_num'], '-1' ); ?>><?php _e('Display all', 'tcd-w');  ?></option>
         <?php for($i=4; $i<= 24; $i++): if(($i % 4) == 0) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['single_service_list_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php }; endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[single_service_list_item_font_color_hover]" value="<?php echo esc_attr( $options['single_service_list_item_font_color_hover'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[single_service_list_item_bg_color_hover]" value="<?php echo esc_attr( $options['single_service_list_item_bg_color_hover'] ); ?>" data-default-color="#f1fafc" class="c-color-picker"></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_service_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_theme_options_validate( $input ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options, $animation_type_options;

  // 基本設定
  $input['service_label'] = wp_filter_nohtml_kses( $input['service_label'] );
  $input['service_slug'] = sanitize_title( $input['service_slug'] );
  $input['show_service_archive_sidebar'] = ! empty( $input['show_service_archive_sidebar'] ) ? 1 : 0;
  $input['show_service_single_sidebar'] = ! empty( $input['show_service_single_sidebar'] ) ? 1 : 0;

  //ヘッダーの設定
  $input['service_title_direction'] = ! empty( $input['service_title_direction'] ) ? 1 : 0;
  if ( ! isset( $value['service_title_font_type'] ) )
    $value['service_title_font_type'] = null;
  if ( ! array_key_exists( $value['service_title_font_type'], $font_type_options ) )
    $value['service_title_font_type'] = null;
  $input['service_title_font_size'] = wp_filter_nohtml_kses( $input['service_title_font_size'] );
  $input['service_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['service_title_font_size_mobile'] );
  $input['service_title_font_color'] = wp_filter_nohtml_kses( $input['service_title_font_color'] );
  $input['service_sub_title'] = wp_filter_nohtml_kses( $input['service_sub_title'] );
  if ( ! isset( $value['service_sub_title_font_type'] ) )
    $value['service_sub_title_font_type'] = null;
  if ( ! array_key_exists( $value['service_sub_title_font_type'], $font_type_options ) )
    $value['service_sub_title_font_type'] = null;
  $input['service_sub_title_font_size'] = wp_filter_nohtml_kses( $input['service_sub_title_font_size'] );
  $input['service_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['service_sub_title_font_size_mobile'] );
  $input['service_sub_title_font_color'] = wp_filter_nohtml_kses( $input['service_sub_title_font_color'] );
  $input['service_sub_title_bg_color'] = wp_filter_nohtml_kses( $input['service_sub_title_bg_color'] );
  $input['service_bg_image'] = wp_filter_nohtml_kses( $input['service_bg_image'] );
  $input['service_bg_image_mobile'] = wp_filter_nohtml_kses( $input['service_bg_image_mobile'] );
  $input['service_use_overlay'] = ! empty( $input['service_use_overlay'] ) ? 1 : 0;
  $input['service_overlay_color'] = wp_filter_nohtml_kses( $input['service_overlay_color'] );
  $input['service_overlay_opacity'] = wp_filter_nohtml_kses( $input['service_overlay_opacity'] );

  // アーカイブ
  $input['archive_service_headline'] = wp_filter_nohtml_kses( $input['archive_service_headline'] );
  if ( ! isset( $value['archive_service_headline_font_type'] ) )
    $value['archive_service_headline_font_type'] = null;
  if ( ! array_key_exists( $value['archive_service_headline_font_type'], $font_type_options ) )
    $value['archive_service_headline_font_type'] = null;
  $input['archive_service_headline_font_size'] = wp_filter_nohtml_kses( $input['archive_service_headline_font_size'] );
  $input['archive_service_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_service_headline_font_size_mobile'] );
  $input['archive_service_catch'] = wp_filter_nohtml_kses( $input['archive_service_catch'] );
  if ( ! isset( $value['archive_service_catch_font_type'] ) )
    $value['archive_service_catch_font_type'] = null;
  if ( ! array_key_exists( $value['archive_service_catch_font_type'], $font_type_options ) )
    $value['archive_service_catch_font_type'] = null;
  $input['archive_service_catch_font_size'] = wp_filter_nohtml_kses( $input['archive_service_catch_font_size'] );
  $input['archive_service_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_service_catch_font_size_mobile'] );
  $input['archive_service_desc'] = wp_filter_nohtml_kses( $input['archive_service_desc'] );
  $input['archive_service_desc_font_size'] = wp_filter_nohtml_kses( $input['archive_service_desc_font_size'] );
  $input['archive_service_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_service_desc_font_size_mobile'] );
  $input['archive_service_title_font_size'] = wp_filter_nohtml_kses( $input['archive_service_title_font_size'] );
  $input['archive_service_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_service_title_font_size_mobile'] );
  $input['archive_service_title_font_color'] = wp_filter_nohtml_kses( $input['archive_service_title_font_color'] );
  $input['archive_service_excerpt_font_size'] = wp_filter_nohtml_kses( $input['archive_service_excerpt_font_size'] );
  $input['archive_service_excerpt_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_service_excerpt_font_size_mobile'] );

  // 記事ページ
  $input['single_service_desc_font_size'] = wp_filter_nohtml_kses( $input['single_service_desc_font_size'] );
  $input['single_service_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_service_desc_font_size_mobile'] );

  $input['show_single_service_list'] = ! empty( $input['show_single_service_list'] ) ? 1 : 0;
  $input['single_service_list_headline'] = wp_filter_nohtml_kses( $input['single_service_list_headline'] );
  $input['single_service_list_headline_font_size'] = wp_filter_nohtml_kses( $input['single_service_list_headline_font_size'] );
  $input['single_service_list_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_service_list_headline_font_size_mobile'] );
  $input['single_service_list_num'] = wp_filter_nohtml_kses( $input['single_service_list_num'] );
  $input['single_service_list_headline_font_type'] = wp_filter_nohtml_kses( $input['single_service_list_headline_font_type'] );
  $input['single_service_list_item_font_color_hover'] = wp_filter_nohtml_kses( $input['single_service_list_item_font_color_hover'] );
  $input['single_service_list_item_bg_color_hover'] = wp_filter_nohtml_kses( $input['single_service_list_item_bg_color_hover'] );


	return $input;

};


?>