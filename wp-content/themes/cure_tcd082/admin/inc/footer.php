<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['footer_bg_type'] = 'type1';
	$dp_default_options['footer_bg_image'] = false;
	$dp_default_options['footer_bg_image_mobile'] = false;
	$dp_default_options['footer_bg_video'] = false;
	$dp_default_options['footer_bg_video_image'] = false;
	$dp_default_options['footer_bg_use_overlay'] = 1;
	$dp_default_options['footer_bg_overlay_color'] = '#000000';
	$dp_default_options['footer_bg_overlay_opacity'] = '0.3';
	$dp_default_options['show_footer_logo'] = '';
	$dp_default_options['footer_menu_bg_color'] = '#f5f5f5';

  // 診療科目一覧
	$dp_default_options['show_footer_service_list'] = '';
	$dp_default_options['footer_service_list_font_color'] = '#ffffff';

  // 位置
	$dp_default_options['footer_button_position'] = 'type1';
	$dp_default_options['footer_schedule_position'] = 'type1';

  // ボタン
	$dp_default_options['show_footer_button'] = 1;

  // 電話番号
	$dp_default_options['show_footer_tel'] = 1;

  // スケジュール
	$dp_default_options['show_footer_schedule'] = 1;
	$dp_default_options['footer_sd_border_color'] = '#05aac9';
	$dp_default_options['footer_sd_font_color'] = '#00a8c8';
	$dp_default_options['footer_sd_font_size'] = '14';
	$dp_default_options['footer_sd_font_size_mobile'] = '12';
	$dp_default_options['footer_sd_row1_col1'] = __( 'Time', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col2'] = __( 'MON', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col3'] = __( 'TUE', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col4'] = __( 'WED', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col5'] = __( 'THU', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col6'] = __( 'FRI', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col7'] = __( 'SAT', 'tcd-w' );
	$dp_default_options['footer_sd_row1_col8'] = __( 'SUN', 'tcd-w' );
	$dp_default_options['footer_sd_row2_col1'] = '9:00 ~ 13:00';
	$dp_default_options['footer_sd_row2_col2'] = '';
	$dp_default_options['footer_sd_row2_col3'] = '';
	$dp_default_options['footer_sd_row2_col4'] = '';
	$dp_default_options['footer_sd_row2_col5'] = '';
	$dp_default_options['footer_sd_row2_col6'] = '';
	$dp_default_options['footer_sd_row2_col7'] = '';
	$dp_default_options['footer_sd_row2_col8'] = '';
	$dp_default_options['footer_sd_row3_col1'] = '14:00 ~ 18:30';
	$dp_default_options['footer_sd_row3_col2'] = '';
	$dp_default_options['footer_sd_row3_col3'] = '';
	$dp_default_options['footer_sd_row3_col4'] = '';
	$dp_default_options['footer_sd_row3_col5'] = '';
	$dp_default_options['footer_sd_row3_col6'] = '';
	$dp_default_options['footer_sd_row3_col7'] = '';
	$dp_default_options['footer_sd_row3_col8'] = '';

  //バナーの設定
	$dp_default_options['footer_banner_font_size'] = '14';
	$dp_default_options['footer_banner_font_size_mobile'] = '12';
	for ( $i = 1; $i <= 4; $i++ ) {
		$dp_default_options['show_footer_banner'.$i] = 1;
		$dp_default_options['footer_banner_image'.$i] = false;
		$dp_default_options['footer_banner_url'.$i] = '#';
		$dp_default_options['footer_banner_title'.$i] = __( 'Title', 'tcd-w' );
		$dp_default_options['footer_banner_font_color'.$i] = '#ffffff';
		$dp_default_options['footer_banner_overlay_color'.$i] = '#000000';
	}

  //住所
	$dp_default_options['show_footer_info'] = 1;
	$dp_default_options['footer_info_font_size'] = '16';
	$dp_default_options['footer_info_font_size_mobile'] = '14';

  //SNS
	$dp_default_options['show_footer_sns'] = '1';
	$dp_default_options['footer_facebook_url'] = '';
	$dp_default_options['footer_twitter_url'] = '';
	$dp_default_options['footer_instagram_url'] = '';
	$dp_default_options['footer_pinterest_url'] = '';
	$dp_default_options['footer_youtube_url'] = '';
	$dp_default_options['footer_contact_url'] = '';
	$dp_default_options['footer_show_rss'] = 1;

  //コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; 2020';
	$dp_default_options['copyright_font_color'] = '#ffffff';
	$dp_default_options['copyright_bg_color'] = '#00a8c8';

  //ページ上部へ戻るリンク
	$dp_default_options['return_top_font_color'] = '#ffffff';
	$dp_default_options['return_top_bg_color'] = '#007a94';
	$dp_default_options['return_top_bg_color_hover'] = '#006277';

	// フッターの固定メニュー
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_font_color'] = '#ffffff';
	$dp_default_options['footer_bar_bg_color'] = '#000000';
	$dp_default_options['footer_bar_bg_color_hover'] = '#333333';
	$dp_default_options['footer_bar_border_color'] = '#ffffff';
	$dp_default_options['footer_bar_border_color_opacity'] = 0.2;
	$dp_default_options['footer_bar_btns'] = array();

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $font_type_options;
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

?>

<div id="tab-content-footer" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Background setting', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <li>
       <input type="radio" id="footer_bg_type1" name="dp_options[footer_bg_type]" value="type1" <?php checked( $options['footer_bg_type'], 'type1' ); ?> />
       <label for="footer_bg_type1"><?php _e('Image', 'tcd-w'); ?></label>
      </li>
      <li>
       <input type="radio" id="footer_bg_type2" name="dp_options[footer_bg_type]" value="type2" <?php checked( $options['footer_bg_type'], 'type2' ); ?> />
       <label for="footer_bg_type2"><?php _e('Video', 'tcd-w'); ?></label>
      </li>
     </ul>
     <div id="footer_bg_type1_area" style="<?php if($options['footer_bg_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '400'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js footer_bg_image">
        <input type="hidden" value="<?php echo esc_attr( $options['footer_bg_image'] ); ?>" id="footer_bg_image" name="dp_options[footer_bg_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['footer_bg_image']){ echo wp_get_attachment_image($options['footer_bg_image'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_bg_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
       <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js footer_bg_image_mobile">
        <input type="hidden" value="<?php echo esc_attr( $options['footer_bg_image_mobile'] ); ?>" id="footer_bg_image_mobile" name="dp_options[footer_bg_image_mobile]" class="cf_media_id">
        <div class="preview_field"><?php if($options['footer_bg_image_mobile']){ echo wp_get_attachment_image($options['footer_bg_image_mobile'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_bg_image_mobile']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div id="footer_bg_type2_area" style="<?php if($options['footer_bg_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js footer_bg_video">
        <input type="hidden" value="<?php echo esc_attr( $options['footer_bg_video'] ); ?>" id="footer_bg_video" name="dp_options[footer_bg_video]" class="cf_media_id">
        <div class="preview_field preview_field_video">
         <?php if($options['footer_bg_video']){ ?>
         <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
         <p><?php echo esc_url(wp_get_attachment_url($options['footer_bg_video'])); ?></p>
         <?php }; ?>
        </div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
         <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$options['footer_bg_video']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js footer_bg_video_image">
        <input type="hidden" value="<?php echo esc_attr( $options['footer_bg_video_image'] ); ?>" id="footer_bg_video_image" name="dp_options[footer_bg_video_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['footer_bg_video_image']){ echo wp_get_attachment_image($options['footer_bg_video_image'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_bg_video_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting for background', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[footer_bg_use_overlay]" type="checkbox" value="1" <?php checked( $options['footer_bg_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['footer_bg_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bg_overlay_color]" value="<?php echo esc_attr( $options['footer_bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_bg_overlay_opacity]" value="<?php echo esc_attr( $options['footer_bg_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Logo setting', 'tcd-w');  ?></h4>
     <p><label><input id="dp_options[show_footer_logo]" name="dp_options[show_footer_logo]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_logo'] ); ?> /> <?php _e('Display logo', 'tcd-w');  ?></label></p>
     <div class="theme_option_message2">
      <p><?php _e('Please register logo image from Logo option section.', 'tcd-w'); ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Address', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_info]" type="checkbox" value="1" <?php checked( $options['show_footer_info'], 1 ); ?>> <?php _e('Display address under logo', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_footer_info'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('Please register address data from <strong>Basic setting area</strong> in site basic setting theme option.', 'tcd-w'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_info_font_size]" value="<?php echo esc_attr( $options['footer_info_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_info_font_size_mobile]" value="<?php echo esc_attr( $options['footer_info_font_size_mobile'] ); ?>" /><span>px</span></li>
      </ul>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Footer menu background color', 'tcd-w');  ?></h4>
     <input type="text" name="dp_options[footer_menu_bg_color]" value="<?php echo esc_attr( $options['footer_menu_bg_color'] ); ?>" data-default-color="#f5f5f5" class="c-color-picker">
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 診療科目一覧の設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s list setting', 'tcd-w'),$service_label); ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_service_list]" type="checkbox" value="1" <?php checked( $options['show_footer_service_list'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-w'),$service_label); ?></label></p>
     <div style="<?php if($options['show_footer_service_list'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('Headline and number of post can be set from site basic setting option area.', 'tcd-w'); ?></p>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Font color', 'tcd-w');  ?></h4>
      <input class="c-color-picker" type="text" name="dp_options[footer_service_list_font_color]" value="<?php echo esc_attr( $options['footer_service_list_font_color'] ); ?>" data-default-color="#ffffff">
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ボタン等の設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Contact button, Telephone number, and Schedule setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('Please register Contact button data and Telephone number data from <strong>Basic setting area</strong> in site basic setting theme option.', 'tcd-w'); ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Contact button setting', 'tcd-w');  ?></h4>
     <p><label><input id="dp_options[show_footer_button]" name="dp_options[show_footer_button]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_button'] ); ?> /> <?php _e('Display contact button', 'tcd-w');  ?></label></p>
     <h4 class="theme_option_headline2"><?php _e('Telephone number setting', 'tcd-w');  ?></h4>
     <p><label><input id="dp_options[show_footer_tel]" name="dp_options[show_footer_tel]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_tel'] ); ?> /> <?php _e('Display telephone number', 'tcd-w');  ?></label></p>
     <h4 class="theme_option_headline2"><?php _e('Schedule setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_schedule]" type="checkbox" value="1" <?php checked( $options['show_footer_schedule'], 1 ); ?>> <?php _e('Display schedule', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_footer_schedule'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="footer_schedule_table">
       <table>
        <tr>
         <?php for ( $i = 1; $i <= 8; $i++ ) { ?>
         <td class="col<?php echo $i; ?>"><textarea class="full_width" cols="50" rows="2" name="dp_options[footer_sd_row1_col<?php echo $i; ?>]"><?php echo esc_textarea(  $options['footer_sd_row1_col'.$i] ); ?></textarea></td>
         <?php }; ?>
        </tr>
        <tr>
         <?php for ( $i = 1; $i <= 8; $i++ ) { ?>
         <td class="col<?php echo $i; ?>"><textarea class="full_width" cols="50" rows="2" name="dp_options[footer_sd_row2_col<?php echo $i; ?>]"><?php echo esc_textarea(  $options['footer_sd_row2_col'.$i] ); ?></textarea></td>
         <?php }; ?>
        </tr>
        <tr>
         <?php for ( $i = 1; $i <= 8; $i++ ) { ?>
         <td class="col<?php echo $i; ?>"><textarea class="full_width" cols="50" rows="2" name="dp_options[footer_sd_row3_col<?php echo $i; ?>]"><?php echo esc_textarea(  $options['footer_sd_row3_col'.$i] ); ?></textarea></td>
         <?php }; ?>
        </tr>
       </table>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_sd_font_color]" value="<?php echo esc_attr( $options['footer_sd_font_color'] ); ?>" data-default-color="#00a8c8"></li>
       <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_sd_border_color]" value="<?php echo esc_attr( $options['footer_sd_border_color'] ); ?>" data-default-color="#05aac9"></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_sd_font_size]" value="<?php echo esc_attr( $options['footer_sd_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_sd_font_size_mobile]" value="<?php echo esc_attr( $options['footer_sd_font_size_mobile'] ); ?>" /><span>px</span></li>
      </ul>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Position of contact button and telephone number', 'tcd-w');  ?></h4>
     <ul class="design_radio_button">
      <li>
       <input type="radio" id="footer_button_position_type1" name="dp_options[footer_button_position]" value="type1" <?php checked( $options['footer_button_position'], 'type1' ); ?> />
       <label for="footer_button_position_type1"><?php _e('Display contact button above telephone number', 'tcd-w');  ?></label>
      </li>
      <li>
       <input type="radio" id="footer_button_position_type2" name="dp_options[footer_button_position]" value="type2" <?php checked( $options['footer_button_position'], 'type2' ); ?> />
       <label for="footer_button_position_type2"><?php _e('Display contact button under telephone number', 'tcd-w');  ?></label>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Position of schedule', 'tcd-w');  ?></h4>
     <ul class="design_radio_button" style="margin-bottom:40px;">
      <li>
       <input type="radio" id="footer_schedule_position_type1" name="dp_options[footer_schedule_position]" value="type1" <?php checked( $options['footer_schedule_position'], 'type1' ); ?> />
       <label for="footer_schedule_position_type1"><?php _e('Display schedule on right side', 'tcd-w');  ?></label>
      </li>
      <li>
       <input type="radio" id="footer_schedule_position_type2" name="dp_options[footer_schedule_position]" value="type2" <?php checked( $options['footer_schedule_position'], 'type2' ); ?> />
       <label for="footer_schedule_position_type2"><?php _e('Display schedule on left side', 'tcd-w');  ?></label>
      </li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // バナーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner contents setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_banner_font_size]" value="<?php esc_attr_e( $options['footer_banner_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_banner_font_size_mobile]" value="<?php esc_attr_e( $options['footer_banner_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <?php for($i = 1; $i <= 4; $i++) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('Content%s setting', 'tcd-w'), $i); ?></h3>
      <div class="sub_box_content">
       <p><label><input id="dp_options[show_footer_banner<?php echo $i; ?>]" name="dp_options[show_footer_banner<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_banner'.$i] ); ?> /> <?php _e('Display banner content', 'tcd-w');  ?></label></p>
       <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
       <textarea class="repeater-label full_width" cols="50" rows="2" name="dp_options[footer_banner_title<?php echo $i; ?>]"><?php echo esc_textarea( $options['footer_banner_title'.$i] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w'); ?></h4>
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '360', '150'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js footer_banner_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['footer_banner_image'.$i] ); ?>" id="footer_banner_image<?php echo $i; ?>" name="dp_options[footer_banner_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['footer_banner_image'.$i]){ echo wp_get_attachment_image($options['footer_banner_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_banner_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('URL', 'tcd-w');  ?></h4>
       <input class="regular-text" type="text" name="dp_options[footer_banner_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_banner_url'.$i] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_banner_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_banner_font_color'.$i] ); ?>" data-default-color="#ffffff"></li>
        <li class="cf"><span class="label"><?php _e('Overlay color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_banner_overlay_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_banner_overlay_color'.$i] ); ?>" data-default-color="#000000"></li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php endfor; ?>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタンの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('SNS button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_sns]" type="checkbox" value="1" <?php checked( $options['show_footer_sns'], 1 ); ?>><?php _e( 'Display SNS button', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_footer_sns'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('Enter url of your Twitter, Facebook, Instagram, Pinterest, Flickr, Tumblr, and contact page. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-w');  ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_instagram_url]" value="<?php echo esc_attr( $options['footer_instagram_url'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Twitter URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_twitter_url]" value="<?php echo esc_attr( $options['footer_twitter_url'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_facebook_url]" value="<?php echo esc_attr( $options['footer_facebook_url'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Pinterest URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_pinterest_url]" value="<?php echo esc_attr( $options['footer_pinterest_url'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Youtube URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_youtube_url]" value="<?php echo esc_attr( $options['footer_youtube_url'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Contact page URL (You can use mailto:)', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_contact_url]" value="<?php echo esc_attr( $options['footer_contact_url'] ); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Display RSS button', 'tcd-w'); ?></span><input name="dp_options[footer_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['footer_show_rss'] ); ?> /></li>
      </ul>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ページ上部へ戻るリンクの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Return top link button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[return_top_font_color]" value="<?php echo esc_attr( $options['return_top_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[return_top_bg_color]" value="<?php echo esc_attr( $options['return_top_bg_color'] ); ?>" data-default-color="#007a94" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[return_top_bg_color_hover]" value="<?php echo esc_attr( $options['return_top_bg_color_hover'] ); ?>" data-default-color="#006277" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コピーライトの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Copyright setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <input class="regular-text" type="text" name="dp_options[copyright]" value="<?php echo esc_attr($options['copyright']); ?>" />
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_font_color]" value="<?php echo esc_attr( $options['copyright_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_bg_color]" value="<?php echo esc_attr( $options['copyright_bg_color'] ); ?>" data-default-color="#00a8c8" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar setting (mobile device only)', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-w' ); ?>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Display type of the footer bar', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $footer_bar_display_options as $option ) { ?>
      <li>
       <input type="radio" id="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_bar_display]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_bar_display'], $option['value'] ); ?> />
       <label for="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Settings for the appearance of the footer bar', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_font_color]" value="<?php echo esc_attr( $options['footer_bar_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg_color]" value="<?php echo esc_attr( $options['footer_bar_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg_color_hover]" value="<?php echo esc_attr( $options['footer_bar_bg_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_border_color]" value="<?php echo esc_attr( $options['footer_bar_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Opacity of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_bar_border_color_opacity]" value="<?php echo esc_attr( $options['footer_bar_border_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br><?php _e('Please enter 0 if you don\'t want to display border.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
     </div>
     <table class="table-border">
      <tr>
       <th><?php _e( 'Default', 'tcd-w' ); ?></th>
       <td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
      </tr>
      <tr>
       <th><?php _e( 'Share', 'tcd-w' ); ?></th>
       <td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
      </tr>
      <tr>
       <th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
       <td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
      </tr>
     </table>
     <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[footer_bar_btns]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['footer_bar_btns'] ) :
              foreach ( $options['footer_bar_btns'] as $key => $value ) :  
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
          <li class="cf footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></li>
          <li class="cf footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
         </ul>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div>
       </div>
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
              'type' => 'type1',
              'label' => '',
              'url' => '',
              'number' => '',
              'target' => 0,
              'icon' => 'twitter'
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
          <li class="cf footer-bar-url"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></li>
          <li class="cf footer-bar-target"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf footer-bar-number" style="display:none;"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
         </ul>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div>
       </div>
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $font_type_options;

  // 基本設定
  $input['footer_bg_type'] = wp_filter_nohtml_kses( $input['footer_bg_type'] );
  $input['footer_bg_video'] = wp_filter_nohtml_kses( $input['footer_bg_video'] );
  $input['footer_bg_video_image'] = wp_filter_nohtml_kses( $input['footer_bg_video_image'] );
  $input['footer_bg_image'] = wp_filter_nohtml_kses( $input['footer_bg_image'] );
  $input['footer_bg_image_mobile'] = wp_filter_nohtml_kses( $input['footer_bg_image_mobile'] );
  $input['footer_bg_use_overlay'] = ! empty( $input['footer_bg_use_overlay'] ) ? 1 : 0;
  $input['footer_bg_overlay_color'] = wp_filter_nohtml_kses( $input['footer_bg_overlay_color'] );
  $input['footer_bg_overlay_opacity'] = wp_filter_nohtml_kses( $input['footer_bg_overlay_opacity'] );
  $input['show_footer_logo'] = ! empty( $input['show_footer_logo'] ) ? 1 : 0;
  $input['footer_menu_bg_color'] = wp_filter_nohtml_kses( $input['footer_menu_bg_color'] );


  // 診療科目
  $input['show_footer_service_list'] = ! empty( $input['show_footer_service_list'] ) ? 1 : 0;
  $input['footer_service_list_font_color'] = wp_filter_nohtml_kses( $input['footer_service_list_font_color'] );


  // 位置
  $input['footer_button_position'] = wp_filter_nohtml_kses( $input['footer_button_position'] );
  $input['footer_schedule_position'] = wp_filter_nohtml_kses( $input['footer_schedule_position'] );


  // ボタン
  $input['show_footer_button'] = ! empty( $input['show_footer_button'] ) ? 1 : 0;


  // 電話番号
  $input['show_footer_tel'] = ! empty( $input['show_footer_tel'] ) ? 1 : 0;


  // スケジュール
  $input['show_footer_schedule'] = ! empty( $input['show_footer_schedule'] ) ? 1 : 0;
  $input['footer_sd_border_color'] = wp_filter_nohtml_kses( $input['footer_sd_border_color'] );
  $input['footer_sd_font_color'] = wp_filter_nohtml_kses( $input['footer_sd_font_color'] );
  $input['footer_sd_font_size'] = wp_filter_nohtml_kses( $input['footer_sd_font_size'] );
  $input['footer_sd_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_sd_font_size_mobile'] );
  for ( $i = 1; $i <= 8; $i++ ) {
    $input['footer_sd_row1_col'.$i] = wp_filter_nohtml_kses( $input['footer_sd_row1_col'.$i] );
    $input['footer_sd_row2_col'.$i] = wp_filter_nohtml_kses( $input['footer_sd_row2_col'.$i] );
    $input['footer_sd_row3_col'.$i] = wp_filter_nohtml_kses( $input['footer_sd_row3_col'.$i] );
  }


  // バナーの設定
  $input['footer_banner_font_size'] = wp_filter_nohtml_kses( $input['footer_banner_font_size'] );
  $input['footer_banner_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_banner_font_size_mobile'] );
  for ( $i = 1; $i <= 4; $i++ ) {
    if ( ! isset( $input['show_footer_banner'.$i] ) )
      $input['show_footer_banner'.$i] = null;
      $input['show_footer_banner'.$i] = ( $input['show_footer_banner'.$i] == 1 ? 1 : 0 );
    $input['footer_banner_title'.$i] = $input['footer_banner_title'.$i];
    $input['footer_banner_image'.$i] = wp_filter_nohtml_kses( $input['footer_banner_image'.$i] );
    $input['footer_banner_url'.$i] = wp_filter_nohtml_kses( $input['footer_banner_url'.$i] );
    $input['footer_banner_font_color'.$i] = wp_filter_nohtml_kses( $input['footer_banner_font_color'.$i] );
    $input['footer_banner_overlay_color'.$i] = wp_filter_nohtml_kses( $input['footer_banner_overlay_color'.$i] );
  }


  // 住所
  $input['show_footer_info'] = ! empty( $input['show_footer_info'] ) ? 1 : 0;
  $input['footer_info_font_size'] = wp_filter_nohtml_kses( $input['footer_info_font_size'] );
  $input['footer_info_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_info_font_size_mobile'] );


  //フッターのSNSボタンの設定
  $input['show_footer_sns'] = ! empty( $input['show_footer_sns'] ) ? 1 : 0;
  $input['footer_facebook_url'] = wp_filter_nohtml_kses( $input['footer_facebook_url'] );
  $input['footer_twitter_url'] = wp_filter_nohtml_kses( $input['footer_twitter_url'] );
  $input['footer_instagram_url'] = wp_filter_nohtml_kses( $input['footer_instagram_url'] );
  $input['footer_pinterest_url'] = wp_filter_nohtml_kses( $input['footer_pinterest_url'] );
  $input['footer_youtube_url'] = wp_filter_nohtml_kses( $input['footer_youtube_url'] );
  $input['footer_contact_url'] = wp_filter_nohtml_kses( $input['footer_contact_url'] );
  $input['footer_show_rss'] = ! empty( $input['footer_show_rss'] ) ? 1 : 0;


  // ページ上部へ戻るリンク
  $input['return_top_font_color'] = wp_kses_post($input['return_top_font_color']);
  $input['return_top_bg_color'] = wp_kses_post($input['return_top_bg_color']);
  $input['return_top_bg_color_hover'] = wp_kses_post($input['return_top_bg_color_hover']);


  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);


  // スマホ用固定フッターバーの設定
  $input['footer_bar_display'] = wp_kses_post($input['footer_bar_display']);
  $input['footer_bar_font_color'] = wp_kses_post($input['footer_bar_font_color']);
  $input['footer_bar_bg_color'] = wp_kses_post($input['footer_bar_bg_color']);
  $input['footer_bar_bg_color_hover'] = wp_kses_post($input['footer_bar_bg_color_hover']);
  $input['footer_bar_border_color'] = wp_kses_post($input['footer_bar_border_color']);
  $input['footer_bar_border_color_opacity'] = wp_kses_post($input['footer_bar_border_color_opacity']);
  $footer_bar_btns = array();
  if ( isset( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
      $footer_bar_btns[] = array(
        'type' => ( isset( $input['footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['footer_bar_btns'][$key]['type'] : 'type1',
        'label' => isset( $input['footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['label'] ) : '',
        'url' => isset( $input['footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['url'] ) : '',
        'number' => isset( $input['footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['number'] ) : '',
        'target' => ! empty( $input['footer_bar_btns'][$key]['target'] ) ? 1 : 0,
        'icon' => ( isset( $input['footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['footer_bar_btns'][$key]['icon'] : 'twitter',
      );
    };
  };
  $input['footer_bar_btns'] = $footer_bar_btns;

	return $input;

};


?>