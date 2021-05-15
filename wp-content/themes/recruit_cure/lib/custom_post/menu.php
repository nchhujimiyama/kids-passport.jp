<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_menu_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_menu_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_menu_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_menu_theme_options_validate' );


// タブの名前
function add_menu_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['menu_label'] ? esc_html( $options['menu_label'] ) : __( 'Menu', 'tcd-w' );
  $tab_labels['menu'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_menu_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['menu_label'] = __( 'menu', 'tcd-w' );
	$dp_default_options['menu_slug'] = 'menu';
	$dp_default_options['show_menu_archive_sidebar'] = 1;
	$dp_default_options['show_menu_single_sidebar'] = 1;

	// ヘッダー
	$dp_default_options['menu_title_font_type'] = 'type3';
	$dp_default_options['menu_title_font_size'] = '28';
	$dp_default_options['menu_title_font_size_mobile'] = '24';
	$dp_default_options['menu_title_font_color'] = '#FFFFFF';
	$dp_default_options['menu_title_direction'] = '';
	$dp_default_options['menu_sub_title'] = 'menu';
	$dp_default_options['menu_sub_title_font_type'] = 'type2';
	$dp_default_options['menu_sub_title_font_size'] = '16';
	$dp_default_options['menu_sub_title_font_size_mobile'] = '14';
	$dp_default_options['menu_sub_title_font_color'] = '#FFFFFF';
	$dp_default_options['menu_sub_title_bg_color'] = '#00a7ce';
	$dp_default_options['menu_bg_image'] = false;
	$dp_default_options['menu_bg_image_mobile'] = false;
	$dp_default_options['menu_use_overlay'] = 1;
	$dp_default_options['menu_overlay_color'] = '#000000';
	$dp_default_options['menu_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_menu_headline'] = '';
	$dp_default_options['archive_menu_headline_font_size'] = '14';
	$dp_default_options['archive_menu_headline_font_size_mobile'] = '12';
	$dp_default_options['archive_menu_headline_font_color'] = '#00a6cc';
	$dp_default_options['archive_menu_headline_font_type'] = 'type2';
	$dp_default_options['archive_menu_catch'] = '';
	$dp_default_options['archive_menu_catch_font_type'] = 'type3';
	$dp_default_options['archive_menu_catch_font_size'] = '38';
	$dp_default_options['archive_menu_catch_font_size_mobile'] = '20';
	$dp_default_options['archive_menu_desc'] = '';
	$dp_default_options['archive_menu_desc_font_size'] = '16';
	$dp_default_options['archive_menu_desc_font_size_mobile'] = '14';

	$dp_default_options['archive_menu_title_font_size'] = '18';
	$dp_default_options['archive_menu_title_font_size_mobile'] = '15';
	$dp_default_options['archive_menu_show_date'] = 1;
	$dp_default_options['archive_menu_num'] = '10';
	$dp_default_options['archive_menu_layout'] = 'type1';

	// 詳細ページ
	$dp_default_options['single_menu_title_font_size'] = '24';
	$dp_default_options['single_menu_title_font_size_mobile'] = '18';
	$dp_default_options['single_menu_title_font_type'] = 'type2';
	$dp_default_options['single_menu_content_font_size'] = '16';
	$dp_default_options['single_menu_content_font_size_mobile'] = '14';
	$dp_default_options['single_menu_show_image'] = 1;
	$dp_default_options['single_menu_show_date'] = 1;
	$dp_default_options['single_menu_show_category'] = 1;
	$dp_default_options['single_menu_show_sns_top'] = 1;
	$dp_default_options['single_menu_show_sns_btm'] = 1;
	$dp_default_options['single_menu_show_copy_top'] = 1;
	$dp_default_options['single_menu_show_copy_btm'] = 1;
	$dp_default_options['single_menu_show_nav'] = 1;
	$dp_default_options['single_menu_layout'] = 'type1';

	// 最新のお知らせ一覧
	$dp_default_options['show_recent_menu'] = 1;
	$dp_default_options['recent_menu_headline'] = __( 'Latest menu', 'tcd-w' );
	$dp_default_options['recent_menu_headline_font_size'] = '18';
	$dp_default_options['recent_menu_headline_font_size_mobile'] = '15';
	$dp_default_options['recent_menu_num'] = '3';
	$dp_default_options['recent_menu_num_mobile'] = '3';
	$dp_default_options['show_recent_menu_button'] = 1;
	$dp_default_options['recent_menu_button_label'] = __( 'Menu list', 'tcd-w' );
	$dp_default_options['recent_menu_button_font_color'] = '#ffffff';
	$dp_default_options['recent_menu_button_bg_color'] = '#02a8c6';
	$dp_default_options['recent_menu_button_font_color_hover'] = '#ffffff';
	$dp_default_options['recent_menu_button_bg_color_hover'] = '#007a96';
	$dp_default_options['recent_menu_title_font_size'] = '18';
	$dp_default_options['recent_menu_title_font_size_mobile'] = '15';

	// 広告
	$dp_default_options['menu_single_top_ad_code'] = '';
	$dp_default_options['menu_single_top_ad_image'] = false;
	$dp_default_options['menu_single_top_ad_url'] = '';

	$dp_default_options['menu_single_bottom_ad_code'] = '';
	$dp_default_options['menu_single_bottom_ad_image'] = false;
	$dp_default_options['menu_single_bottom_ad_url'] = '';

	$dp_default_options['menu_single_shortcode_ad_code'] = '';
	$dp_default_options['menu_single_shortcode_ad_image'] = false;
	$dp_default_options['menu_single_shortcode_ad_url'] = '';

	$dp_default_options['menu_single_mobile_ad_code'] = '';
	$dp_default_options['menu_single_mobile_ad_image'] = false;
	$dp_default_options['menu_single_mobile_ad_url'] = '';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_menu_tab_panel( $options ) {

  global $dp_default_options, $no_image_options, $font_type_options, $layout_options;
  $menu_label = $options['menu_label'] ? esc_html( $options['menu_label'] ) : __( 'Menu', 'tcd-w' );

?>

<div id="tab-content-menu" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input id="dp_options[menu_label]" class="regular-text" type="text" name="dp_options[menu_label]" value="<?php echo esc_attr( $options['menu_label'] ); ?>" />
     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input id="dp_options[menu_slug]" class="hankaku regular-text" type="text" name="dp_options[menu_slug]" value="<?php echo sanitize_title( $options['menu_slug'] ); ?>" /></p>
     <h4 class="theme_option_headline2"><?php _e('Sidebar setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display on archive page', 'tcd-w');  ?></span><input name="dp_options[show_menu_archive_sidebar]" type="checkbox" value="1" <?php checked( '1', $options['show_menu_archive_sidebar'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display on single page', 'tcd-w');  ?></span><input name="dp_options[show_menu_single_sidebar]" type="checkbox" value="1" <?php checked( '1', $options['show_menu_single_sidebar'] ); ?> /></li>
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
       <select name="dp_options[menu_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['menu_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[menu_title_font_size]" value="<?php esc_attr_e( $options['menu_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[menu_title_font_size_mobile]" value="<?php esc_attr_e( $options['menu_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[menu_title_font_color]" value="<?php echo esc_attr( $options['menu_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input name="dp_options[menu_title_direction]" type="checkbox" value="1" <?php checked( $options['menu_title_direction'], 1 ); ?>><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Subtitle will be displayed on left top of the header image by square shape.', 'tcd-w'); ?></p>
     </div>
     <textarea class="full_width" cols="50" rows="2" name="dp_options[menu_sub_title]"><?php echo esc_textarea(  $options['menu_sub_title'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[menu_sub_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['menu_sub_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[menu_sub_title_font_size]" value="<?php esc_attr_e( $options['menu_sub_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[menu_sub_title_font_size_mobile]" value="<?php esc_attr_e( $options['menu_sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[menu_sub_title_font_color]" value="<?php echo esc_attr( $options['menu_sub_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[menu_sub_title_bg_color]" value="<?php echo esc_attr( $options['menu_sub_title_bg_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1200', '400'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js menu_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['menu_bg_image'] ); ?>" id="menu_bg_image" name="dp_options[menu_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['menu_bg_image']){ echo wp_get_attachment_image($options['menu_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['menu_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
      <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js menu_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['menu_bg_image_mobile'] ); ?>" id="menu_bg_image_mobile" name="dp_options[menu_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['menu_bg_image_mobile']){ echo wp_get_attachment_image($options['menu_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['menu_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[menu_use_overlay]" type="checkbox" value="1" <?php checked( $options['menu_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['menu_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[menu_overlay_color]" value="<?php echo esc_attr( $options['menu_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[menu_overlay_opacity]" value="<?php echo esc_attr( $options['menu_overlay_opacity'] ); ?>" />
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
     <input class="full_width" type="text" name="dp_options[archive_menu_headline]" value="<?php echo esc_attr( $options['archive_menu_headline'] ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_menu_headline_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_menu_headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_headline_font_size]" value="<?php esc_attr_e( $options['archive_menu_headline_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_headline_font_size_mobile]" value="<?php esc_attr_e( $options['archive_menu_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_menu_headline_font_color]" value="<?php echo esc_attr( $options['archive_menu_headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_menu_catch]"><?php echo esc_textarea(  $options['archive_menu_catch'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_menu_catch_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_menu_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_catch_font_size]" value="<?php esc_attr_e( $options['archive_menu_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_catch_font_size_mobile]" value="<?php esc_attr_e( $options['archive_menu_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_menu_desc]"><?php echo esc_textarea(  $options['archive_menu_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_desc_font_size]" value="<?php esc_attr_e( $options['archive_menu_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_desc_font_size_mobile]" value="<?php esc_attr_e( $options['archive_menu_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php printf(__('%s list setting', 'tcd-w'), $menu_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select name="dp_options[archive_menu_layout]">
        <?php
             $i = 1;
             foreach ( $layout_options as $option ) {
               if($i != 1){
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_menu_layout'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php
                };
             $i++;
             };
        ?>
       </select>
       <div class="theme_option_message2" style="clear:both; margin:12px 0 7px 0;">
        <p><?php _e('Content width will be 1000px if you don\'t display side content.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_title_font_size]" value="<?php esc_attr_e( $options['archive_menu_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_menu_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_menu_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w'); ?></span>
       <select name="dp_options[archive_menu_num]">
        <?php for($i=5; $i<= 10; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_menu_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[archive_menu_show_date]" type="checkbox" value="1" <?php checked( '1', $options['archive_menu_show_date'] ); ?> /></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Single page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Post title setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
       <select name="dp_options[single_menu_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_menu_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_menu_title_font_size]" value="<?php esc_attr_e( $options['single_menu_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_menu_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_menu_title_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Post content setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_menu_content_font_size]" value="<?php esc_attr_e( $options['single_menu_content_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of content (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_menu_content_font_size_mobile]" value="<?php esc_attr_e( $options['single_menu_content_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select name="dp_options[single_menu_layout]">
        <?php
             $i = 1;
             foreach ( $layout_options as $option ) {
               if($i != 1){
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_menu_layout'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php
                };
             $i++;
             };
        ?>
       </select>
       <div class="theme_option_message2" style="clear:both; margin:12px 0 7px 0;">
        <p><?php _e('Content width will be 1000px if you don\'t display side content.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Display featured image', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_image]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_image'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display date under post title', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display next previous link', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_nav]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_nav'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_copy_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under post content', 'tcd-w');  ?></span><input name="dp_options[single_menu_show_copy_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_menu_show_copy_btm'] ); ?> /></li>
     </ul>
     <h4 class="theme_option_headline2"><?php printf(__('%s list setting', 'tcd-w'), $menu_label); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_recent_menu]" type="checkbox" value="1" <?php checked( $options['show_recent_menu'], 1 ); ?>><?php printf(__('Display recent %s', 'tcd-w'), $menu_label); ?></label></p>
     <div style="<?php if($options['show_recent_menu'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[recent_menu_headline]" value="<?php esc_attr_e( $options['recent_menu_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_menu_headline_font_size]" value="<?php esc_attr_e( $options['recent_menu_headline_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_menu_headline_font_size_mobile]" value="<?php esc_attr_e( $options['recent_menu_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_menu_title_font_size]" value="<?php esc_attr_e( $options['recent_menu_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_menu_title_font_size_mobile]" value="<?php esc_attr_e( $options['recent_menu_title_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[recent_menu_num]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['recent_menu_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[recent_menu_num_mobile]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['recent_menu_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
      </ul>
      <ul class="option_list displayment_checkbox" style="border-top:1px dotted #ccc; padding-top:8px; margin:-12px 0;">
       <li class="cf"><span class="label"><?php _e('Display button for archive page', 'tcd-w');  ?></span><input name="dp_options[show_recent_menu_button]" type="checkbox" value="1" <?php checked( '1', $options['show_recent_menu_button'] ); ?> /></li>
      </ul>
      <div style="<?php if($options['show_recent_menu_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('Label of button', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[recent_menu_button_label]" value="<?php esc_attr_e( $options['recent_menu_button_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Font color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_menu_button_font_color]" value="<?php echo esc_attr( $options['recent_menu_button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_menu_button_bg_color]" value="<?php echo esc_attr( $options['recent_menu_button_bg_color'] ); ?>" data-default-color="#02a8c6" class="c-color-picker"></li>
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_menu_button_font_color_hover]" value="<?php echo esc_attr( $options['recent_menu_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_menu_button_bg_color_hover]" value="<?php echo esc_attr( $options['recent_menu_button_bg_color_hover'] ); ?>" data-default-color="#007a96" class="c-color-picker"></li>
       </ul>
      </div>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // アイキャッチ画像の下 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Under featured image', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed after featured image.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[menu_single_top_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[menu_single_top_ad_code]"><?php echo esc_textarea( $options['menu_single_top_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
        <p><?php printf(__('Maximum image width is %1$spx.', 'tcd-w'), '730'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js menu_single_top_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['menu_single_top_ad_image'] ); ?>" id="menu_single_top_ad_image" name="dp_options[menu_single_top_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['menu_single_top_ad_image']){ echo wp_get_attachment_image($options['menu_single_top_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['menu_single_top_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[menu_single_top_ad_url]" class="regular-text" type="text" name="dp_options[menu_single_top_ad_url]" value="<?php esc_attr_e( $options['menu_single_top_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // 最新のお知らせの上 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('Above %s list', 'tcd-w'), $menu_label); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php printf(__('This banner will be displayed before %s list', 'tcd-w'), $menu_label); ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[menu_single_bottom_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[menu_single_bottom_ad_code]"><?php echo esc_textarea( $options['menu_single_bottom_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
        <p><?php printf(__('Maximum image width is %1$spx.', 'tcd-w'), '730'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js menu_single_bottom_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['menu_single_bottom_ad_image'] ); ?>" id="menu_single_bottom_ad_image" name="dp_options[menu_single_bottom_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['menu_single_bottom_ad_image']){ echo wp_get_attachment_image($options['menu_single_bottom_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['menu_single_bottom_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[menu_single_bottom_ad_url]" class="regular-text" type="text" name="dp_options[menu_single_bottom_ad_url]" value="<?php esc_attr_e( $options['menu_single_bottom_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // ショートコード -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Short code', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('Please copy and paste the short code inside the content to show this banner.', 'tcd-w'); ?></p>
       </div>
       <p><?php _e('Short code', 'tcd-w');  ?> : <input type="text" readonly="readonly" value="[menu_s_ad]" /></p>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[menu_single_shortcode_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[menu_single_shortcode_ad_code]"><?php echo esc_textarea( $options['menu_single_shortcode_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
        <p><?php printf(__('Maximum image width is %1$spx.', 'tcd-w'), '730'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js menu_single_shortcode_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['menu_single_shortcode_ad_image'] ); ?>" id="menu_single_shortcode_ad_image" name="dp_options[menu_single_shortcode_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['menu_single_shortcode_ad_image']){ echo wp_get_attachment_image($options['menu_single_shortcode_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['menu_single_shortcode_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[menu_single_shortcode_ad_url]" class="regular-text" type="text" name="dp_options[menu_single_shortcode_ad_url]" value="<?php esc_attr_e( $options['menu_single_shortcode_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // モバイル用 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Mobile device', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed on mobile device.', 'tcd-w');  ?></p>
        <p><?php printf(__('This banner will be display above recent %s and will be repleace by banner for PC device.', 'tcd-w'), $menu_label);  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[menu_single_mobile_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[menu_single_mobile_ad_code]"><?php echo esc_textarea( $options['menu_single_mobile_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js menu_single_mobile_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['menu_single_mobile_ad_image'] ); ?>" id="menu_single_mobile_ad_image" name="dp_options[menu_single_mobile_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['menu_single_mobile_ad_image']){ echo wp_get_attachment_image($options['menu_single_mobile_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['menu_single_mobile_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[menu_single_mobile_ad_url]" class="regular-text" type="text" name="dp_options[menu_single_mobile_ad_url]" value="<?php esc_attr_e( $options['menu_single_mobile_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_menu_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_menu_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options, $layout_options;

  //基本設定
  $input['menu_slug'] = sanitize_title( $input['menu_slug'] );
  $input['menu_label'] = wp_filter_nohtml_kses( $input['menu_label'] );
  $input['show_menu_archive_sidebar'] = ! empty( $input['show_menu_archive_sidebar'] ) ? 1 : 0;
  $input['show_menu_single_sidebar'] = ! empty( $input['show_menu_single_sidebar'] ) ? 1 : 0;

  //ヘッダーの設定
  $input['menu_title_direction'] = ! empty( $input['menu_title_direction'] ) ? 1 : 0;
  if ( ! isset( $value['menu_title_font_type'] ) )
    $value['menu_title_font_type'] = null;
  if ( ! array_key_exists( $value['menu_title_font_type'], $font_type_options ) )
    $value['menu_title_font_type'] = null;
  $input['menu_title_font_size'] = wp_filter_nohtml_kses( $input['menu_title_font_size'] );
  $input['menu_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['menu_title_font_size_mobile'] );
  $input['menu_title_font_color'] = wp_filter_nohtml_kses( $input['menu_title_font_color'] );
  $input['menu_sub_title'] = wp_filter_nohtml_kses( $input['menu_sub_title'] );
  if ( ! isset( $value['menu_sub_title_font_type'] ) )
    $value['menu_sub_title_font_type'] = null;
  if ( ! array_key_exists( $value['menu_sub_title_font_type'], $font_type_options ) )
    $value['menu_sub_title_font_type'] = null;
  $input['menu_sub_title_font_size'] = wp_filter_nohtml_kses( $input['menu_sub_title_font_size'] );
  $input['menu_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['menu_sub_title_font_size_mobile'] );
  $input['menu_sub_title_font_color'] = wp_filter_nohtml_kses( $input['menu_sub_title_font_color'] );
  $input['menu_sub_title_bg_color'] = wp_filter_nohtml_kses( $input['menu_sub_title_bg_color'] );
  $input['menu_bg_image'] = wp_filter_nohtml_kses( $input['menu_bg_image'] );
  $input['menu_bg_image_mobile'] = wp_filter_nohtml_kses( $input['menu_bg_image_mobile'] );
  $input['menu_use_overlay'] = ! empty( $input['menu_use_overlay'] ) ? 1 : 0;
  $input['menu_overlay_color'] = wp_filter_nohtml_kses( $input['menu_overlay_color'] );
  $input['menu_overlay_opacity'] = wp_filter_nohtml_kses( $input['menu_overlay_opacity'] );

  // アーカイブ
  $input['archive_menu_headline'] = wp_filter_nohtml_kses( $input['archive_menu_headline'] );
  if ( ! isset( $value['archive_menu_headline_font_type'] ) )
    $value['archive_menu_headline_font_type'] = null;
  if ( ! array_key_exists( $value['archive_menu_headline_font_type'], $font_type_options ) )
    $value['archive_menu_headline_font_type'] = null;
  $input['archive_menu_headline_font_size'] = wp_filter_nohtml_kses( $input['archive_menu_headline_font_size'] );
  $input['archive_menu_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_menu_headline_font_size_mobile'] );
  $input['archive_menu_catch'] = wp_filter_nohtml_kses( $input['archive_menu_catch'] );
  if ( ! isset( $value['archive_menu_catch_font_type'] ) )
    $value['archive_menu_catch_font_type'] = null;
  if ( ! array_key_exists( $value['archive_menu_catch_font_type'], $font_type_options ) )
    $value['archive_menu_catch_font_type'] = null;
  $input['archive_menu_catch_font_size'] = wp_filter_nohtml_kses( $input['archive_menu_catch_font_size'] );
  $input['archive_menu_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_menu_catch_font_size_mobile'] );
  $input['archive_menu_desc'] = wp_filter_nohtml_kses( $input['archive_menu_desc'] );
  $input['archive_menu_desc_font_size'] = wp_filter_nohtml_kses( $input['archive_menu_desc_font_size'] );
  $input['archive_menu_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_menu_desc_font_size_mobile'] );
  $input['archive_menu_title_font_size'] = wp_filter_nohtml_kses( $input['archive_menu_title_font_size'] );
  $input['archive_menu_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_menu_title_font_size_mobile'] );
  $input['archive_menu_num'] = wp_filter_nohtml_kses( $input['archive_menu_num'] );
  $input['archive_menu_show_date'] = ! empty( $input['archive_menu_show_date'] ) ? 1 : 0;
  if ( ! isset( $value['archive_menu_layout'] ) )
    $value['archive_menu_layout'] = null;
  if ( ! array_key_exists( $value['archive_menu_layout'], $layout_options ) )
    $value['archive_menu_layout'] = null;


  //詳細ページ
  if ( ! isset( $value['single_menu_title_font_type'] ) )
    $value['single_menu_title_font_type'] = null;
  if ( ! array_key_exists( $value['single_menu_title_font_type'], $font_type_options ) )
    $value['single_menu_title_font_type'] = null;
  $input['single_menu_title_font_size'] = wp_filter_nohtml_kses( $input['single_menu_title_font_size'] );
  $input['single_menu_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_menu_title_font_size_mobile'] );
  $input['single_menu_content_font_size'] = wp_filter_nohtml_kses( $input['single_menu_content_font_size'] );
  $input['single_menu_content_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_menu_content_font_size_mobile'] );
  $input['single_menu_show_date'] = ! empty( $input['single_menu_show_date'] ) ? 1 : 0;
  $input['single_menu_show_nav'] = ! empty( $input['single_menu_show_nav'] ) ? 1 : 0;
  $input['single_menu_show_image'] = ! empty( $input['single_menu_show_image'] ) ? 1 : 0;
  $input['single_menu_show_sns_top'] = ! empty( $input['single_menu_show_sns_top'] ) ? 1 : 0;
  $input['single_menu_show_sns_btm'] = ! empty( $input['single_menu_show_sns_btm'] ) ? 1 : 0;
  $input['single_menu_show_copy_top'] = ! empty( $input['single_menu_show_copy_top'] ) ? 1 : 0;
  $input['single_menu_show_copy_btm'] = ! empty( $input['single_menu_show_copy_btm'] ) ? 1 : 0;
  if ( ! isset( $value['single_menu_layout'] ) )
    $value['single_menu_layout'] = null;
  if ( ! array_key_exists( $value['single_menu_layout'], $layout_options ) )
    $value['single_menu_layout'] = null;


  // 最新お知らせ一覧
  $input['show_recent_menu'] = ! empty( $input['show_recent_menu'] ) ? 1 : 0;
  $input['recent_menu_headline'] = wp_filter_nohtml_kses( $input['recent_menu_headline'] );
  $input['recent_menu_headline_font_size'] = wp_filter_nohtml_kses( $input['recent_menu_headline_font_size'] );
  $input['recent_menu_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['recent_menu_headline_font_size_mobile'] );
  $input['recent_menu_num'] = wp_filter_nohtml_kses( $input['recent_menu_num'] );
  $input['recent_menu_num_mobile'] = wp_filter_nohtml_kses( $input['recent_menu_num_mobile'] );
  $input['show_recent_menu_button'] = ! empty( $input['show_recent_menu_button'] ) ? 1 : 0;
  $input['recent_menu_button_label'] = wp_filter_nohtml_kses( $input['recent_menu_button_label'] );
  $input['recent_menu_button_font_color'] = wp_filter_nohtml_kses( $input['recent_menu_button_font_color'] );
  $input['recent_menu_button_bg_color'] = wp_filter_nohtml_kses( $input['recent_menu_button_bg_color'] );
  $input['recent_menu_button_font_color_hover'] = wp_filter_nohtml_kses( $input['recent_menu_button_font_color_hover'] );
  $input['recent_menu_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['recent_menu_button_bg_color_hover'] );
  $input['recent_menu_title_font_size'] = wp_filter_nohtml_kses( $input['recent_menu_title_font_size'] );
  $input['recent_menu_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['recent_menu_title_font_size_mobile'] );


  // 広告
  $input['menu_single_top_ad_code'] = $input['menu_single_top_ad_code'];
  $input['menu_single_top_ad_image'] = wp_filter_nohtml_kses( $input['menu_single_top_ad_image'] );
  $input['menu_single_top_ad_url'] = wp_filter_nohtml_kses( $input['menu_single_top_ad_url'] );

  $input['menu_single_bottom_ad_code'] = $input['menu_single_bottom_ad_code'];
  $input['menu_single_bottom_ad_image'] = wp_filter_nohtml_kses( $input['menu_single_bottom_ad_image'] );
  $input['menu_single_bottom_ad_url'] = wp_filter_nohtml_kses( $input['menu_single_bottom_ad_url'] );

  $input['menu_single_shortcode_ad_code'] = $input['menu_single_shortcode_ad_code'];
  $input['menu_single_shortcode_ad_image'] = wp_filter_nohtml_kses( $input['menu_single_shortcode_ad_image'] );
  $input['menu_single_shortcode_ad_url'] = wp_filter_nohtml_kses( $input['menu_single_shortcode_ad_url'] );

  $input['menu_single_mobile_ad_code'] = $input['menu_single_mobile_ad_code'];
  $input['menu_single_mobile_ad_image'] = wp_filter_nohtml_kses( $input['menu_single_mobile_ad_image'] );
  $input['menu_single_mobile_ad_url'] = wp_filter_nohtml_kses( $input['menu_single_mobile_ad_url'] );

	return $input;

};


?>