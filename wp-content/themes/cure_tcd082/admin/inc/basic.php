<?php
/*
 * 基本設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );


// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );


// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );


// タブの名前
function add_basic_tab_label( $tab_labels ) {
	$tab_labels['basic'] = __( 'Site basic setting', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_basic_dp_default_options( $dp_default_options ) {

  // 住所の情報
	$dp_default_options['basic_access_info'] = '';
	$dp_default_options['basic_access_info_font_size'] = '16';
	$dp_default_options['basic_access_info_font_size_mobile'] = '14';
	$dp_default_options['basic_address'] = '';

  // 地図の情報
	$dp_default_options['basic_gmap_api_key'] = '';
	$dp_default_options['basic_gmap_marker_type'] = 'type1';
	$dp_default_options['basic_gmap_custom_marker_type'] = 'type1';
	$dp_default_options['basic_gmap_marker_text'] = '';
	$dp_default_options['basic_gmap_marker_color'] = '#ffffff';
	$dp_default_options['basic_gmap_marker_img'] = '';
	$dp_default_options['basic_gmap_marker_bg'] = '#000000';
	$dp_default_options['basic_access_address'] = '';
	$dp_default_options['basic_access_saturation'] = '-100';

  // サービス一覧
	$dp_default_options['basic_service_list_headline'] = __( 'Service', 'tcd-w' );
	$dp_default_options['basic_service_list_num'] = '-1';

  // お問い合わせボタン
	$dp_default_options['basic_contact_button_headline'] = __( 'Headline', 'tcd-w' );
	$dp_default_options['basic_contact_button_label'] = __( 'Button', 'tcd-w' );
	$dp_default_options['basic_contact_button_url'] = '';
	$dp_default_options['basic_contact_button_font_color'] = '#ffffff';
	$dp_default_options['basic_contact_button_bg_color'] = '#02a8c6';
	$dp_default_options['basic_contact_button_font_color_hover'] = '#ffffff';
	$dp_default_options['basic_contact_button_bg_color_hover'] = '#007a96';

  // 電話番号
	$dp_default_options['basic_tel_headline'] = __( 'Headline', 'tcd-w' );
	$dp_default_options['basic_tel_num'] = '000-0000-0000';
	$dp_default_options['basic_tel_desc'] = __( 'Description', 'tcd-w' );
	$dp_default_options['show_basic_tel_icon'] = 1;
	$dp_default_options['basic_tel_icon_color'] = '#00a8c8';

	// 色の設定
	$dp_default_options['main_color'] = '#00a7ce';
	$dp_default_options['content_link_color'] = '#000000';
	$dp_default_options['content_link_hover_color'] = '#00a7ce';

	// フォントの種類
	$dp_default_options['font_type'] = 'type2';
	$dp_default_options['content_font_type'] = 'typ2';
	$dp_default_options['headline_font_type'] = 'type2';
	$dp_default_options['widget_headline_font_type'] = 'type2';

	// アニメーションの設定
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = '1.2';
	$dp_default_options['hover2_direct'] = 'type1';
	$dp_default_options['hover2_opacity'] = '0.5';
	$dp_default_options['hover2_bgcolor'] = '#FFFFFF';
	$dp_default_options['hover3_opacity'] = '0.5';
	$dp_default_options['hover3_bgcolor'] = '#FFFFFF';

	// オリジナルスタイルの設定
	$dp_default_options['css_code'] = '';

	// オリジナルスクリプトの設定
	$dp_default_options['script_code'] = '';

	// Facebook OGPの設定
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_app_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// Twitter Cardsの設定
	$dp_default_options['use_twitter_card'] = 0;
	$dp_default_options['twitter_account_name'] = '';

	// ファビコン
	$dp_default_options['favicon'] = '';

	// ロードアイコンの設定
	$dp_default_options['show_load_screen'] = 'type1';
	$dp_default_options['load_icon'] = 'type1';
	$dp_default_options['load_time'] = 5000;
	$dp_default_options['load_color1'] = '#000000';
	$dp_default_options['load_color2'] = '#999999';
	$dp_default_options['load_bgcolor'] = '#ffffff';
	$dp_default_options['load_type4_image'] = 0;
	$dp_default_options['load_type4_image_retina'] = 0;
	$dp_default_options['load_type4_image_mobile'] = 0;
	$dp_default_options['load_type4_image_retina_mobile'] = 0;
	$dp_default_options['load_type4_catch'] = '';
	$dp_default_options['load_type4_catch_font_size'] = 16;
	$dp_default_options['load_type4_catch_font_size_sp'] = 14;
	$dp_default_options['load_type4_catch_font_type'] = 'type3';
	$dp_default_options['load_type4_catch_color'] = '#000000';
	$dp_default_options['load_type4_catch_position'] = 'type2';
	$dp_default_options['load_type4_no_dot'] = 0;
	$dp_default_options['load_screen_animation_type'] = 'type1';

	// Google Map
	$dp_default_options['gmap_api_key'] = '';
	$dp_default_options['gmap_marker_type'] = 'type1';
	$dp_default_options['gmap_custom_marker_type'] = 'type1';
	$dp_default_options['gmap_marker_text'] = '';
	$dp_default_options['gmap_marker_color'] = '#ffffff';
	$dp_default_options['gmap_marker_img'] = '';
	$dp_default_options['gmap_marker_bg'] = '#000000';

	// NO IMAGE
	$dp_default_options['no_image1'] = false;

	// SNSボタン
	$dp_default_options['sns_type_top'] = 'type1';
	$dp_default_options['sns_type_btm'] = 'type1';

	$dp_default_options['show_twitter_top'] = 1;
	$dp_default_options['show_fblike_top'] = 1;
	$dp_default_options['show_fbshare_top'] = 1;
	$dp_default_options['show_hatena_top'] = 1;
	$dp_default_options['show_pocket_top'] = 1;
	$dp_default_options['show_feedly_top'] = 1;
	$dp_default_options['show_rss_top'] = 1;
	$dp_default_options['show_pinterest_top'] = 1;

	$dp_default_options['show_twitter_btm'] = 1;
	$dp_default_options['show_fblike_btm'] = 1;
	$dp_default_options['show_fbshare_btm'] = 1;
	$dp_default_options['show_hatena_btm'] = 1;
	$dp_default_options['show_pocket_btm'] = 1;
	$dp_default_options['show_feedly_btm'] = 1;
	$dp_default_options['show_rss_btm'] = 1;
	$dp_default_options['show_pinterest_btm'] = 1;

	$dp_default_options['twitter_info'] = '';

  // サイドバー
	$dp_default_options['show_side_bar'] = 1;
	$dp_default_options['side_bar_position'] = 'right';
	$dp_default_options['side_bar_bg_color'] = '#529eaa';
	$dp_default_options['side_bar_bg_color_hover'] = '#37828e';
	$dp_default_options['side_bar'] = array();

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_tab_panel( $options ) {

  global $dp_default_options, $time_options, $load_screen_options, $load_icon_type, $font_type_options, $post_type_options, $gmap_marker_type_options, $gmap_custom_marker_type_options, $hover_type_options, $hover2_direct_options, $sns_type_options, $content_direction_options, $footer_bar_icon_options;

  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

?>

<div id="tab-content-basic" class="tab-content">

   <?php // 基本設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <?php // 住所 ----------------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Address information', 'tcd-w');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Address', 'tcd-w');  ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="dp_options[basic_address]"><?php echo esc_textarea(  $options['basic_address'] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e('Access information', 'tcd-w'); ?></h4>
       <?php wp_editor( $options['basic_access_info'], 'basic_access_info', array ( 'textarea_name' => 'dp_options[basic_access_info]' ) ); ?>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[basic_access_info_font_size]" value="<?php esc_attr_e( $options['basic_access_info_font_size'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[basic_access_info_font_size_mobile]" value="<?php esc_attr_e( $options['basic_access_info_font_size_mobile'] ); ?>" /><span>px</span></li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php // 地図の情報 ----------------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Google map information', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'API key', 'tcd-w' ); ?></h4>
       <input type="text" class="regular-text" name="dp_options[basic_gmap_api_key]" value="<?php echo esc_attr( $options['basic_gmap_api_key'] ); ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $gmap_marker_type_options as $option ) : ?>
        <li class="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
         <input type="radio" id="basic_gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[basic_gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['basic_gmap_marker_type'] ); ?>>
         <label for="basic_gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
          <span><?php echo esc_html( $option['label'] ); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
         </label>
        </li>
        <?php endforeach; ?>
       </ul>
       <div class="gmap_marker_type2_area" style="<?php if($options['basic_gmap_marker_type'] == 'type1'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
        <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
        <ul class="design_radio_button">
         <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
         <li class="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
          <input type="radio" id="basic_gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[basic_gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['basic_gmap_custom_marker_type'] ); ?>>
          <label for="basic_gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><?php echo esc_html_e( $option['label'] ); ?></label>
         </li>
         <?php endforeach; ?>
        </ul>
        <div class="gmap_custom_marker_type1_area" style="<?php if ( $options['basic_gmap_custom_marker_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
         <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Text', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[basic_gmap_marker_text]" value="<?php echo esc_attr( $options['basic_gmap_marker_text'] ); ?>"></li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[basic_gmap_marker_color]" value="<?php echo esc_attr( $options['basic_gmap_marker_color'] ); ?>" data-default-color="#ffffff"></li>
         </ul>
        </div>
        <div class="gmap_custom_marker_type2_area" style="<?php if ( $options['basic_gmap_custom_marker_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
         <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
         <p><?php _e( 'Recommended size: width:60px, height:20px', 'tcd-w' ); ?></p>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js basic_gmap_marker_img">
           <input type="hidden" value="<?php echo esc_attr( $options['basic_gmap_marker_img'] ); ?>" id="basic_gmap_marker_img" name="dp_options[basic_gmap_marker_img]" class="cf_media_id">
           <div class="preview_field"><?php if ( $options['basic_gmap_marker_img'] ) { echo wp_get_attachment_image($options['basic_gmap_marker_img'], 'medium' ); } ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['basic_gmap_marker_img'] ) { echo 'hidden'; } ?>">
           </div>
          </div>
         </div>
        </div>
        <h4 class="theme_option_headline2"><?php _e( 'Background color of marker', 'tcd-w' ); ?></h4>
        <p><input type="text" class="c-color-picker" name="dp_options[basic_gmap_marker_bg]" data-default-color="#000000" value="<?php echo esc_attr( $options['basic_gmap_marker_bg'] ); ?>"></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Address of location', 'tcd-w'); ?></h4>
       <input class="full_width" type="text" name="dp_options[basic_access_address]" value="<?php echo esc_attr($options['basic_access_address']); ?>" />

       <h4 class="theme_option_headline2"><?php _e('Saturation of map', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e( 'Please set the saturation of the map. If you set it to -100 the output map is monochrome.', 'tcd-w' ); ?></p>
       </div>
       <p class="range-output"><?php _e( 'Current value: ', 'tcd-w' ); ?><span><?php echo esc_html( $options['basic_access_saturation'] ); ?></span></p>
       <input class="range" type="range" name="dp_options[basic_access_saturation]" value="<?php echo esc_attr($options['basic_access_saturation']); ?>" min="-100" max="100" step="10" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php // 診療科目情報 ----------------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s list setting', 'tcd-w'),$service_label);  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[basic_service_list_headline]" value="<?php echo esc_attr( $options['basic_service_list_headline'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e('Number of post to display', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('The post title created in %s will be displayed.', 'tcd-w'),$service_label); ?></p>
        <p><?php _e('Please leave this field blank if you want to display all post.', 'tcd-w');  ?></p>
       </div>
       <input class="hankaku" style="width:70px;" type="number" name="dp_options[basic_service_list_num]" value="<?php echo esc_attr( $options['basic_service_list_num'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php // お問い合わせボタン ----------------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Contact button setting', 'tcd-w');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[basic_contact_button_headline]" value="<?php echo esc_attr( $options['basic_contact_button_headline'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[basic_contact_button_label]" value="<?php echo esc_attr( $options['basic_contact_button_label'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[basic_contact_button_url]" value="<?php echo esc_attr( $options['basic_contact_button_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[basic_contact_button_font_color]" value="<?php echo esc_attr( $options['basic_contact_button_font_color'] ); ?>" data-default-color="#ffffff"></li>
        <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[basic_contact_button_bg_color]" value="<?php echo esc_attr( $options['basic_contact_button_bg_color'] ); ?>" data-default-color="#02a8c6"></li>
        <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[basic_contact_button_font_color_hover]" value="<?php echo esc_attr( $options['basic_contact_button_font_color_hover'] ); ?>" data-default-color="#ffffff"></li>
        <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[basic_contact_button_bg_color_hover]" value="<?php echo esc_attr( $options['basic_contact_button_bg_color_hover'] ); ?>" data-default-color="#007a96"></li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php // 電話番号 ----------------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Telephone number setting', 'tcd-w');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[basic_tel_headline]" value="<?php echo esc_attr( $options['basic_tel_headline'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e('Telephone', 'tcd-w');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Telephone number', 'tcd-w'); ?></span><input class="full_width hankaku" type="text" name="dp_options[basic_tel_num]" value="<?php echo esc_attr( $options['basic_tel_num'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Description', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[basic_tel_desc]"><?php echo esc_textarea(  $options['basic_tel_desc'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php _e('Display icon', 'tcd-w'); ?></span><input name="dp_options[show_basic_tel_icon]" type="checkbox" value="1" <?php checked( '1', $options['show_basic_tel_icon'] ); ?> /></li>
        <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[basic_tel_icon_color]" value="<?php echo esc_attr( $options['basic_tel_icon_color'] ); ?>" data-default-color="#00a8c8"></li>
       </ul>
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


   <?php // 色の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Color setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Main color', 'tcd-w'); ?></span><input type="text" name="dp_options[main_color]" value="<?php echo esc_attr( $options['main_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Single page text link color', 'tcd-w'); ?></span><input type="text" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Text link color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[content_link_hover_color]" value="<?php echo esc_attr( $options['content_link_hover_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ファビコン ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
  	<h3 class="theme_option_headline"><?php _e( 'Favicon setting', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'Setting for the favicon displayed at browser address bar or tab.', 'tcd-w' ); ?></p>
      <p><?php _e( 'You can use .ico, .png or .gif file, and we recommed you to use .ico file.', 'tcd-w' ); ?></p>
      <p><?php _e( 'Favicon file', 'tcd-w' ); ?> (<?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '16', '16'); ?>)</p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js favicon">
       <input type="hidden" value="<?php echo esc_attr( $options['favicon'] ); ?>" id="favicon" name="dp_options[favicon]" class="cf_media_id">
       <div class="preview_field"><?php if($options['favicon']){ echo wp_get_attachment_image($options['favicon'], 'full'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['favicon']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フォントの種類 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Font type setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Basic font type', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This font type will be the basic font type of this website.', 'tcd-w'); ?></p>
     </div>
     <ul class="design_radio_button">
      <?php
           foreach ( $font_type_options as $option ) {
           if(strtoupper(get_locale()) == 'JA'){
             $label = $option['label'];
           } else {
             $label = $option['label_en'];
           }
      ?>
      <li>
       <input type="radio" id="font_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[font_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['font_type'], $option['value'] ); ?> />
       <label for="font_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $label; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Font type of headline', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This font type will be apply to headline and catchphrase.', 'tcd-w'); ?></p>
     </div>
     <ul class="design_radio_button">
      <?php
           foreach ( $font_type_options as $option ) {
           if(strtoupper(get_locale()) == 'JA'){
             $label = $option['label'];
           } else {
             $label = $option['label_en'];
           }
      ?>
      <li>
       <input type="radio" id="headline_font_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[headline_font_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['headline_font_type'], $option['value'] ); ?> />
       <label for="headline_font_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $label; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Font type of widget headline', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php
           foreach ( $font_type_options as $option ) {
           if(strtoupper(get_locale()) == 'JA'){
             $label = $option['label'];
           } else {
             $label = $option['label_en'];
           }
      ?>
      <li>
       <input type="radio" id="widget_headline_font_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[widget_headline_font_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['widget_headline_font_type'], $option['value'] ); ?> />
       <label for="widget_headline_font_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $label; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Font type of content area', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This font type will be apply to single page content area.', 'tcd-w'); ?></p>
     </div>
     <ul class="design_radio_button">
      <?php
           foreach ( $font_type_options as $option ) {
           if(strtoupper(get_locale()) == 'JA'){
             $label = $option['label'];
           } else {
             $label = $option['label_en'];
           }
      ?>
      <li>
       <input type="radio" id="content_font_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[content_font_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['content_font_type'], $option['value'] ); ?> />
       <label for="content_font_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $label; ?></label>
      </li>
      <?php } ?>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // サイドバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Sidebar setting', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[show_side_bar]" type="checkbox" value="1" <?php checked( '1', $options['show_side_bar'] ); ?> /> <?php _e('Display side bar', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_side_bar'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <h4 class="theme_option_headline2"><?php _e('Display position', 'tcd-w');  ?></h4>
     <ul class="design_radio_button">
      <li>
       <input type="radio" id="side_bar_position_right" name="dp_options[side_bar_position]" value="right" <?php checked( $options['side_bar_position'], 'right' ); ?> />
       <label for="side_bar_position_right"><?php _e('Display on right side', 'tcd-w');  ?></label>
      </li>
      <li>
       <input type="radio" id="side_bar_position_left" name="dp_options[side_bar_position]" value="left" <?php checked( $options['side_bar_position'], 'left' ); ?> />
       <label for="side_bar_position_left"><?php _e('Display on left side', 'tcd-w');  ?></label>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[side_bar_bg_color]" value="<?php echo esc_attr( $options['side_bar_bg_color'] ); ?>" data-default-color="#529eaa" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[side_bar_bg_color_hover]" value="<?php echo esc_attr( $options['side_bar_bg_color_hover'] ); ?>" data-default-color="#37828e" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Click Add item button to add input field. You can change the order by dragging header of each item.', 'tcd-w' ); ?></p>
     </div>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[side_bar]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['side_bar'] ) :
              foreach ( $options['side_bar'] as $key => $value ) :  
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list">
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
          <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-w'); ?></span><input type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
          <li class="cf side_bar_url" style="<?php if ( $value['icon'] == 'tel' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></li>
          <li class="cf side_bar_url" style="<?php if ( $value['icon'] == 'tel' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf side_bar_tel" style="<?php if ( $value['icon'] != 'tel' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][tel]" value="<?php echo esc_attr( $value['tel'] ); ?>"></li>
         </ul>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div>
       </div>
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
              'label' => '',
              'color' => '#ffffff',
              'url' => '',
              'tel' => '',
              'target' => 0,
              'icon' => 'twitter'
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list">
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
          <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-w'); ?></span><input type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
          <li class="cf side_bar_url"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][url]" value=""></li>
          <li class="cf side_bar_url"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1"></li>
          <li class="cf side_bar_tel" style="display: none;"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_bar][<?php echo esc_attr( $key ); ?>][tel]" value=""></li>
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
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // hover エフェクト ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Hover effect', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Hover effect type', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please set the hover effect for thumbnail images.', 'tcd-w'); ?></p>
     </div>
     <ul class="design_radio_button">
      <?php foreach ( $hover_type_options as $option ) { ?>
      <li>
       <input type="radio" id="hover_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[hover_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['hover_type'], $option['value'] ); ?> />
       <label for="hover_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php } ?>
     </ul>
     <div id="hover_type1_area" style="<?php if($options['hover_type'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Settings for Zoom effect', 'tcd-w'); ?></h4>
      <p><?php _e('Please set the rate of magnification.', 'tcd-w'); ?></p>
      <input id="dp_options[hover1_zoom]" class="hankaku" style="width:45px;" type="text" name="dp_options[hover1_zoom]" value="<?php esc_attr_e( $options['hover1_zoom'] ); ?>" />
     </div>
     <div id="hover_type2_area" style="<?php if($options['hover_type'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Settings for Slide effect', 'tcd-w'); ?></h4>
      <p><?php _e('Please set the direction of slide.', 'tcd-w'); ?></p>
      <fieldset class="cf select_type2">
       <?php foreach ( $hover2_direct_options as $option ) { ?>
       <label class="description" style="display:inline-block;margin-right:15px;">
        <input type="radio" name="dp_options[hover2_direct]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['hover2_direct'], $option['value'] ); ?> />
        <?php echo $option['label']; ?>
       </label>
       <?php } ?>
      </fieldset>
      <p><?php _e('Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w'); ?></p>
      <input id="dp_options[hover2_opacity]" class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover2_opacity]" value="<?php esc_attr_e( $options['hover2_opacity'] ); ?>" />
      <p><?php _e('Please set the background color.', 'tcd-w'); ?></p>
      <input type="text" name="dp_options[hover2_bgcolor]" value="<?php echo esc_attr( $options['hover2_bgcolor'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker">
     </div>
     <div id="hover_type3_area" style="<?php if($options['hover_type'] == 'type3'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Settings for Fade effect', 'tcd-w'); ?></h4>
      <p><?php _e('Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w'); ?></p>
      <input id="dp_options[hover3_opacity]" class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover3_opacity]" value="<?php esc_attr_e( $options['hover3_opacity'] ); ?>" />
      <p><?php _e('Please set the background color.', 'tcd-w'); ?></p>
      <input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker">
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタン  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Social button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('You can set share buttons at single page.', 'tcd-w'); ?></p>
      <p><?php _e('Facebook like button is displayed only when you select Button type 5 (Default button).', 'tcd-w'); ?></p>
      <p><?php _e('RSS button is not displayed if you select Button type 5 (Default button).', 'tcd-w'); ?></p>
      <p><?php _e('If you use Button type 5 (Default button) and Button types 1 to 4 together, button design will collapses.', 'tcd-w'); ?></p>
     </div>
     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Top social button', 'tcd-w');  ?></h3>
      <div class="sub_box_content">
       <p><?php _e('This button will be displayed under post title area.', 'tcd-w');  ?></p>
       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $sns_type_options as $option ) { ?>
        <li>
         <input type="radio" id="sns_type_top_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_type_top]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_type_top'], $option['value'] ); ?> />
         <label for="sns_type_top_<?php esc_attr_e( $option['value'] ); ?>">
          <span><?php echo esc_html($option['label']); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
         </label>
        </li>
        <?php } ?>
       </ul>
       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_twitter_top]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_top'] ); ?> /> <?php _e('Display twitter button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fblike_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_top'] ); ?> /> <?php _e('Display facebook like button -Button type 5 (Default button) only', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fbshare_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_top'] ); ?> /> <?php _e('Display facebook share button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_hatena_top]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_top'] ); ?> /> <?php _e('Display hatena button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pocket_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_top'] ); ?> /> <?php _e('Display pocket button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_feedly_top]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_top'] ); ?> /> <?php _e('Display feedly button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_rss_top]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_top'] ); ?> /> <?php _e('Display rss button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pinterest_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_top'] ); ?> /> <?php _e('Display pinterest button', 'tcd-w');  ?></label></li>
       </ul>
       <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Bottom social button', 'tcd-w');  ?></h3>
      <div class="sub_box_content">
       <p><?php _e('This button will be displayed under post content.', 'tcd-w');  ?></p>
       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $sns_type_options as $option ) { ?>
        <li>
         <input type="radio" id="sns_type_btm_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_type_btm]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_type_btm'], $option['value'] ); ?> />
         <label for="sns_type_btm_<?php esc_attr_e( $option['value'] ); ?>">
          <span><?php echo esc_html($option['label']); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
         </label>
        </li>
        <?php } ?>
       </ul>
       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_twitter_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_btm'] ); ?> /> <?php _e('Display twitter button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fblike_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_btm'] ); ?> /> <?php _e('Display facebook like button-Button type 5 (Default button) only', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fbshare_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_btm'] ); ?> /> <?php _e('Display facebook share button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_hatena_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_btm'] ); ?> /> <?php _e('Display hatena button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pocket_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_btm'] ); ?> /> <?php _e('Display pocket button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_feedly_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_btm'] ); ?> /> <?php _e('Display feedly button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_rss_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_btm'] ); ?> /> <?php _e('Display rss button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pinterest_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_btm'] ); ?> /> <?php _e('Display pinterest button', 'tcd-w');  ?></label></li>
       </ul>
       <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <h4 class="theme_option_headline2"><?php _e('Setting for the twitter button', 'tcd-w');  ?></h4>
     <label style="margin-top:20px;"><?php _e('Set of twitter account. (ex.designplus)', 'tcd-w');  ?></label>
     <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>" />
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // Use OGP tag ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Facebook OGP setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('OGP is a mechanism for correctly conveying page information.', 'tcd-w'); ?></p>
     </div>    
     <p><label><input id="dp_options[use_ogp]" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( '1', $options['use_ogp'] ); ?> /> <?php _e('Use OGP', 'tcd-w');  ?></label></p>
     <p><?php _e( 'Your app ID', 'tcd-w' );  ?> <input class="regular-text" type="text" name="dp_options[fb_app_id]" value="<?php esc_attr_e( $options['fb_app_id'] ); ?>"></p>
     <p><?php _e( 'In order to use Facebook Insights please set your app ID.', 'tcd-w' ); ?></p>
     <h4 class="theme_option_headline2"><?php _e( 'OGP image', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-w' ); ?></p>
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1200', '630'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
       <div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
       </div>
      </div>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // Twitter card ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Twitter Cards setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('This theme requires Facebook OGP settings to use Twitter cards.', 'tcd-w'); ?></p>
     </div>    
     <p><label><input id="dp_options[use_twitter_card]" name="dp_options[use_twitter_card]" type="checkbox" value="1" <?php checked( '1', $options['use_twitter_card'] ); ?>> <?php _e( 'Use Twitter Cards', 'tcd-w' );  ?></label></p>
     <p><?php _e( 'Your Twitter account name (exclude @ mark)', 'tcd-w' ); ?><input id="dp_options[twitter_account_name]" class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php esc_attr_e( $options['twitter_account_name'] ); ?>"></p>
     <p><a href="http://design-plus1.com/tcd-w/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about Twitter Cards.', 'tcd-w' ); ?></a></p>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // No Imageの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Original alternate image for featured image', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('You can register original alternate image for featured image.', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '500'); ?></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js no_image1">
       <input type="hidden" value="<?php echo esc_attr( $options['no_image1'] ); ?>" id="no_image1" name="dp_options[no_image1]" class="cf_media_id">
       <div class="preview_field"><?php if($options['no_image1']){ echo wp_get_attachment_image($options['no_image1'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['no_image1']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // ローディング画面の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Loading screen setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('You can set the load screen displayed during page transition.', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $load_screen_options as $option ) { ?>
      <li>
       <input type="radio" id="show_load_screen_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[show_load_screen]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['show_load_screen'], $option['value'] ); ?> />
       <label for="show_load_screen_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Screen animation after loading content', 'tcd-w'); ?></h4>
     <select name="dp_options[load_screen_animation_type]">
      <option style="padding-right: 10px;" value="type1" <?php selected( $options['load_screen_animation_type'], 'type1' ); ?>><?php _e('Fade out', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="type2" <?php selected( $options['load_screen_animation_type'], 'type2' ); ?>><?php _e('Slide up', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="type3" <?php selected( $options['load_screen_animation_type'], 'type3' ); ?>><?php _e('Slide down', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="type4" <?php selected( $options['load_screen_animation_type'], 'type4' ); ?>><?php _e('Slide left', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="type5" <?php selected( $options['load_screen_animation_type'], 'type5' ); ?>><?php _e('Slide right', 'tcd-w'); ?></option>
     </select>
     <h4 class="theme_option_headline2"><?php _e('Type of loader', 'tcd-w');  ?></h4>
     <select id="load_icon_type" name="dp_options[load_icon]">
      <?php foreach ( $load_icon_type as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['load_icon'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php } ?>
     </select>
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul id="load_icon_color" class="option_list">
      <li class="cf color1" style="<?php if($options['load_icon'] != 'type4') { echo 'display:block'; } else { echo 'display:none;'; }; ?>"><span class="label"><?php _e('Primary color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_color1]" value="<?php echo esc_attr( $options['load_color1'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf color1" style="<?php if($options['load_icon'] != 'type4') { echo 'display:block'; } else { echo 'display:none;'; }; ?>"><span class="label"><?php _e('Secondary color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_color2]" value="<?php echo esc_attr( $options['load_color2'] ); ?>" data-default-color="#999999" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_bgcolor]" value="<?php echo esc_attr( $options['load_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Maximum display time', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please set the maximum display time of the loading screen.<br />Even if all the content is not loaded, loading screen will disappear automatically after a lapse of time you have set at follwing.', 'tcd-w'); ?></p>
     </div>
     <select name="dp_options[load_time]">
      <?php
           $i = 1;
           foreach ( $time_options as $option ):
             if( $i >= 3 && $i <= 10 ){
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['load_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php
             }
             $i++;
          endforeach;
      ?>
     </select>
     <div id="load_icon_type4">
      <h4 class="theme_option_headline2"><?php _e( 'Logo', 'tcd-w' ); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js load_type4_image">
        <input type="hidden" value="<?php echo esc_attr( $options['load_type4_image'] ); ?>" id="load_type4_image" name="dp_options[load_type4_image]" class="cf_media_id">
        <div class="preview_field"><?php if ( $options['load_type4_image'] ) { echo wp_get_attachment_image( $options['load_type4_image'], 'full' ); } ?></div>
        <div class="button_area">
         <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['load_type4_image'] ) { echo 'hidden'; } ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[load_type4_image_retina]" type="checkbox" value="1" <?php checked( 1, $options['load_type4_image_retina'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>
      <h4 class="theme_option_headline2"><?php _e( 'Logo (mobile)', 'tcd-w' ); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js load_type4_image_mobile">
        <input type="hidden" value="<?php echo esc_attr( $options['load_type4_image_mobile'] ); ?>" id="load_type4_image_mobile" name="dp_options[load_type4_image_mobile]" class="cf_media_id">
        <div class="preview_field"><?php if ( $options['load_type4_image_mobile'] ) { echo wp_get_attachment_image( $options['load_type4_image_mobile'], 'full' ); } ?></div>
        <div class="button_area">
         <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['load_type4_image_mobile'] ) { echo 'hidden'; } ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[load_type4_image_retina_mobile]" type="checkbox" value="1" <?php checked( 1, $options['load_type4_image_retina_mobile'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>
      <h4 class="theme_option_headline2"><?php _e( 'Loading message', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('You can display loading message below logo image.', 'tcd-w');  ?></p>
      </div>
      <textarea class="large-text" id="load_type4_catch" name="dp_options[load_type4_catch]" rows="3"><?php echo esc_attr( $options['load_type4_catch'] ); ?></textarea>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
        <select name="dp_options[load_type4_catch_font_type]">
         <?php foreach ( $font_type_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['load_type4_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Text position', 'tcd-w');  ?></span>
        <select name="dp_options[load_type4_catch_position]">
         <?php foreach ( $content_direction_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['load_type4_catch_position'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[load_type4_catch_font_size]" value="<?php esc_attr_e( $options['load_type4_catch_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[load_type4_catch_font_size_sp]" value="<?php esc_attr_e( $options['load_type4_catch_font_size_sp'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_type4_catch_color]" value="<?php echo esc_attr( $options['load_type4_catch_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      </ul>
      <h4 class="theme_option_headline2"><?php _e( 'Dot animation setting', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Animated dot will be display behind loading message.', 'tcd-w');  ?></p>
      </div>
      <p><label><input name="dp_options[load_type4_no_dot]" type="checkbox" value="1" <?php checked( 1, $options['load_type4_no_dot'] ); ?>><?php _e( 'Don\'t display dot animation', 'tcd-w' ); ?></label></p>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // Google Map ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Google Maps settings', 'tcd-w' );  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('You can set styles of marker in Google maps, and select default marker or custom marker.', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'API key', 'tcd-w' ); ?></h4>
     <input type="text" class="regular-text" name="dp_options[gmap_api_key]" value="<?php echo esc_attr( $options['gmap_api_key'] ); ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
     <ul class="design_radio_button image_radio_button cf">
      <?php foreach ( $gmap_marker_type_options as $option ) : ?>
      <li class="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
       <input type="radio" id="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_marker_type'] ); ?>>
       <label for="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
        <span><?php echo esc_html( $option['label'] ); ?></span>
        <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
       </label>
      </li>
      <?php endforeach; ?>
     </ul>
     <div class="gmap_marker_type2_area" style="<?php if($options['gmap_marker_type'] == 'type1'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
      <ul class="design_radio_button">
       <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
       <li class="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
        <input type="radio" id="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_custom_marker_type'] ); ?>>
        <label for="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><?php echo esc_html_e( $option['label'] ); ?></label>
       </li>
       <?php endforeach; ?>
      </ul>
      <div class="gmap_custom_marker_type1_area" style="<?php if ( $options['gmap_custom_marker_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Text', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[gmap_marker_text]" value="<?php echo esc_attr( $options['gmap_marker_text'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[gmap_marker_color]" value="<?php echo esc_attr( $options['gmap_marker_color'] ); ?>" data-default-color="#ffffff"></li>
       </ul>
      </div>
      <div class="gmap_custom_marker_type2_area" style="<?php if ( $options['gmap_custom_marker_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
       <p><?php _e( 'Recommended size: width:60px, height:20px', 'tcd-w' ); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js gmap_marker_img">
         <input type="hidden" value="<?php echo esc_attr( $options['gmap_marker_img'] ); ?>" id="gmap_marker_img" name="dp_options[gmap_marker_img]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['gmap_marker_img'] ) { echo wp_get_attachment_image($options['gmap_marker_img'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['gmap_marker_img'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Background color of marker', 'tcd-w' ); ?></h4>
      <p><input type="text" class="c-color-picker" name="dp_options[gmap_marker_bg]" data-default-color="#000000" value="<?php echo esc_attr( $options['gmap_marker_bg'] ); ?>"></p>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ユーザーCSS用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom css displayed inside &lt;head&gt; tag', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'This css will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;style&gt; tag in this field.', 'tcd-w' ); ?></p>
      <p><?php _e('Example:<br><strong>.custom_css { font-size:12px; }</strong>', 'tcd-w');  ?></p>
     </div>
     <textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ユーザースクリプト用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom script displayed inside &lt;head&gt; tag', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'This script will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;script&gt; tag in this field.', 'tcd-w' ); ?></p>
      <p><?php _e( 'If you want to use tracking code of Google Analytics please paste your code to this area.', 'tcd-w' ); ?></p>
     </div>
     <textarea id="dp_options[script_code]" class="large-text" cols="50" rows="10" name="dp_options[script_code]"><?php echo esc_textarea( $options['script_code'] ); ?></textarea>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_basic_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_theme_options_validate( $input ) {

  global $dp_default_options, $sns_type_options, $time_options, $load_screen_options, $load_icon_type, $font_type_options, $post_type_options, $gmap_marker_type_options, $gmap_custom_marker_type_options, $hover_type_options, $hover2_direct_options, $content_direction_options, $footer_bar_icon_options;


  // 住所の情報
  $input['basic_address'] = wp_filter_nohtml_kses( $input['basic_address'] );
  $input['basic_access_info'] = wp_kses_post($input['basic_access_info']);
  $input['basic_access_info_font_size'] = wp_kses_post($input['basic_access_info_font_size']);
  $input['basic_access_info_font_size_mobile'] = wp_kses_post($input['basic_access_info_font_size_mobile']);


  // 地図の情報
  $input['basic_gmap_api_key'] = wp_filter_nohtml_kses( $input['basic_gmap_api_key'] );
  if ( ! isset( $input['basic_gmap_marker_type'] ) ) $input['basic_gmap_marker_type'] = null;
  if ( ! array_key_exists( $input['basic_gmap_marker_type'], $gmap_marker_type_options ) ) $input['basic_gmap_marker_type'] = null;
  if ( ! isset( $input['basic_gmap_custom_marker_type'] ) ) $input['basic_gmap_custom_marker_type'] = null;
  if ( ! array_key_exists( $input['basic_gmap_custom_marker_type'], $gmap_custom_marker_type_options ) ) $input['basic_gmap_custom_marker_type'] = null;
  $input['basic_gmap_marker_text'] = wp_filter_nohtml_kses( $input['basic_gmap_marker_text'] );
  $input['basic_gmap_marker_color'] = wp_filter_nohtml_kses( $input['basic_gmap_marker_color'] );
  $input['basic_gmap_marker_img'] = wp_filter_nohtml_kses( $input['basic_gmap_marker_img'] );
  $input['basic_access_address'] = wp_filter_nohtml_kses( $input['basic_access_address'] );
  $input['basic_access_saturation'] = wp_filter_nohtml_kses( $input['basic_access_saturation'] );


  // お問い合わせボタン
  $input['basic_contact_button_headline'] = wp_filter_nohtml_kses( $input['basic_contact_button_headline'] );
  $input['basic_contact_button_label'] = wp_filter_nohtml_kses( $input['basic_contact_button_label'] );
  $input['basic_contact_button_url'] = wp_filter_nohtml_kses( $input['basic_contact_button_url'] );
  $input['basic_contact_button_font_color'] = wp_filter_nohtml_kses( $input['basic_contact_button_font_color'] );
  $input['basic_contact_button_bg_color'] = wp_filter_nohtml_kses( $input['basic_contact_button_bg_color'] );
  $input['basic_contact_button_font_color_hover'] = wp_filter_nohtml_kses( $input['basic_contact_button_font_color_hover'] );
  $input['basic_contact_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['basic_contact_button_bg_color_hover'] );


  // 電話番号
  $input['basic_tel_headline'] = wp_filter_nohtml_kses( $input['basic_tel_headline'] );
  $input['basic_tel_num'] = wp_filter_nohtml_kses( $input['basic_tel_num'] );
  $input['basic_tel_desc'] = wp_filter_nohtml_kses( $input['basic_tel_desc'] );
  $input['show_basic_tel_icon'] = ! empty( $input['show_basic_tel_icon'] ) ? 1 : 0;
  $input['basic_tel_icon_color'] = wp_filter_nohtml_kses( $input['basic_tel_icon_color'] );


  // 色の設定
  $input['main_color'] = sanitize_hex_color( $input['main_color'] );
  $input['content_link_color'] = sanitize_hex_color( $input['content_link_color'] );
  $input['content_link_hover_color'] = sanitize_hex_color( $input['content_link_hover_color'] );


  // フォントの種類
  if ( ! isset( $input['font_type'] ) )
    $input['font_type'] = null;
  if ( ! array_key_exists( $input['font_type'], $font_type_options ) )
    $input['font_type'] = null;
  if ( ! isset( $input['headline_font_type'] ) )
    $input['headline_font_type'] = null;
  if ( ! array_key_exists( $input['headline_font_type'], $font_type_options ) )
    $input['headline_font_type'] = null;
  if ( ! isset( $input['widget_headline_font_type'] ) )
    $input['widget_headline_font_type'] = null;
  if ( ! array_key_exists( $input['widget_headline_font_type'], $font_type_options ) )
    $input['widget_headline_font_type'] = null;
  if ( ! isset( $input['content_font_type'] ) )
    $input['content_font_type'] = null;
  if ( ! array_key_exists( $input['content_font_type'], $font_type_options ) )
    $input['content_font_type'] = null;


  // アニメーションの設定
  if ( ! isset( $input['hover_type'] ) )
    $input['hover_type'] = null;
  if ( ! array_key_exists( $input['hover_type'], $hover_type_options ) )
    $input['hover_type'] = null;
  $input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
  if ( ! isset( $input['hover2_direct'] ) )
    $input['hover2_direct'] = null;
  if ( ! array_key_exists( $input['hover2_direct'], $hover2_direct_options ) )
    $input['hover2_direct'] = null;
  $input['hover2_opacity'] = wp_filter_nohtml_kses( $input['hover2_opacity'] );
  $input['hover2_bgcolor'] = sanitize_hex_color( $input['hover2_bgcolor'] );
  $input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
  $input['hover3_bgcolor'] = sanitize_hex_color( $input['hover3_bgcolor'] );


  // ファビコン
  $input['favicon'] = wp_filter_nohtml_kses( $input['favicon'] );


  // Facebook OGPの設定
  $input['use_ogp'] = ! empty( $input['use_ogp'] ) ? 1 : 0;
  $input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );
  $input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );


  // Twitter Cardsの設定
  $input['use_twitter_card'] = ! empty( $input['use_twitter_card'] ) ? 1 : 0;
  $input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );


  // オリジナルスタイルの設定
  $input['css_code'] = $input['css_code'];


  // オリジナルスクリプトの設定
  $input['script_code'] = $input['script_code'];


  // ロードアイコンの設定
  if ( ! isset( $input['show_load_screen'] ) )
    $input['show_load_screen'] = null;
  if ( ! array_key_exists( $input['show_load_screen'], $load_screen_options ) )
    $input['show_load_screen'] = null;
  if ( ! isset( $input['load_icon'] ) || ! array_key_exists( $input['load_icon'], $load_icon_type ) )
    $input['load_icon'] = $dp_default_options['load_icon'];
  if ( ! isset( $input['load_time'] ) || ! array_key_exists( $input['load_time'], $time_options ) )
    $input['load_time'] = $dp_default_options['load_time'];
  $input['load_color1'] = sanitize_hex_color( $input['load_color1'] );
  $input['load_color2'] = sanitize_hex_color( $input['load_color2'] );
  $input['load_type4_image'] = absint( $input['load_type4_image'] );
  $input['load_type4_image_retina'] = ! empty( $input['load_type4_image_retina'] ) ? 1 : 0;
  $input['load_type4_image_mobile'] = absint( $input['load_type4_image_mobile'] );
  $input['load_type4_image_retina_mobile'] = ! empty( $input['load_type4_image_retina_mobile'] ) ? 1 : 0;
  $input['load_type4_catch'] = sanitize_textarea_field( $input['load_type4_catch'] );
  $input['load_type4_catch_font_size'] = absint( $input['load_type4_catch_font_size'] );
  $input['load_type4_catch_font_size_sp'] = absint( $input['load_type4_catch_font_size_sp'] );
  if ( ! isset( $input['load_type4_catch_font_type'] ) || ! array_key_exists( $input['load_type4_catch_font_type'], $font_type_options ) )
    $input['load_type4_catch_font_type'] = $dp_default_options['load_type4_catch_font_type'];
  if ( ! isset( $input['load_type4_catch_position'] ) || ! array_key_exists( $input['load_type4_catch_position'], $content_direction_options ) )
    $input['load_type4_catch_position'] = $dp_default_options['load_type4_catch_position'];
  $input['load_type4_catch_color'] = sanitize_hex_color( $input['load_type4_catch_color'] );
  $input['load_type4_no_dot'] = ! empty( $input['load_type4_no_dot'] ) ? 1 : 0;
  $input['load_screen_animation_type'] = sanitize_text_field( $input['load_screen_animation_type'] );


  // NO IMAGE
  $input['no_image1'] = wp_filter_nohtml_kses( $input['no_image1'] );


  // Google Maps 
  $input['gmap_api_key'] = wp_filter_nohtml_kses( $input['gmap_api_key'] );
  if ( ! isset( $input['gmap_marker_type'] ) ) $input['gmap_marker_type'] = null;
  if ( ! array_key_exists( $input['gmap_marker_type'], $gmap_marker_type_options ) ) $input['gmap_marker_type'] = null;
  if ( ! isset( $input['gmap_custom_marker_type'] ) ) $input['gmap_custom_marker_type'] = null;
  if ( ! array_key_exists( $input['gmap_custom_marker_type'], $gmap_custom_marker_type_options ) ) $input['gmap_custom_marker_type'] = null;
  $input['gmap_marker_text'] = wp_filter_nohtml_kses( $input['gmap_marker_text'] );
  $input['gmap_marker_color'] = wp_filter_nohtml_kses( $input['gmap_marker_color'] );
  $input['gmap_marker_img'] = wp_filter_nohtml_kses( $input['gmap_marker_img'] );


  // SNSルボタン　上部
  if ( ! isset( $input['sns_type_top'] ) )
    $input['sns_type_top'] = null;
  if ( ! array_key_exists( $input['sns_type_top'], $sns_type_options ) )
    $input['sns_type_top'] = null;
  $input['show_twitter_top'] = ! empty( $input['show_twitter_top'] ) ? 1 : 0;
  $input['show_fblike_top'] = ! empty( $input['show_fblike_top'] ) ? 1 : 0;
  $input['show_fbshare_top'] = ! empty( $input['show_fbshare_top'] ) ? 1 : 0;
  $input['show_hatena_top'] = ! empty( $input['show_hatena_top'] ) ? 1 : 0;
  $input['show_pocket_top'] = ! empty( $input['show_pocket_top'] ) ? 1 : 0;
  $input['show_feedly_top'] = ! empty( $input['show_feedly_top'] ) ? 1 : 0;
  $input['show_rss_top'] = ! empty( $input['show_rss_top'] ) ? 1 : 0;
  $input['show_pinterest_top'] = ! empty( $input['show_pinterest_top'] ) ? 1 : 0;


  // SNSボタン　下部
  if ( ! isset( $input['sns_type_btm'] ) )
    $input['sns_type_btm'] = null;
  if ( ! array_key_exists( $input['sns_type_btm'], $sns_type_options ) )
    $input['sns_type_btm'] = null;
  $input['show_twitter_btm'] = ! empty( $input['show_twitter_btm'] ) ? 1 : 0;
  $input['show_fblike_btm'] = ! empty( $input['show_fblike_btm'] ) ? 1 : 0;
  $input['show_fbshare_btm'] = ! empty( $input['show_fbshare_btm'] ) ? 1 : 0;
  $input['show_hatena_btm'] = ! empty( $input['show_hatena_btm'] ) ? 1 : 0;
  $input['show_pocket_btm'] = ! empty( $input['show_pocket_btm'] ) ? 1 : 0;
  $input['show_feedly_btm'] = ! empty( $input['show_feedly_btm'] ) ? 1 : 0;
  $input['show_rss_btm'] = ! empty( $input['show_rss_btm'] ) ? 1 : 0;
  $input['show_pinterest_btm'] = ! empty( $input['show_pinterest_btm'] ) ? 1 : 0;


  // SNSボタン　Twitterボタン
  $input['twitter_info'] = wp_filter_nohtml_kses( $input['twitter_info'] );


  // サイドバーの設定
  $input['display_side_bar'] = ! empty( $input['display_side_bar'] ) ? 1 : 0;
  $input['side_bar_position'] = wp_filter_nohtml_kses( $input['side_bar_position'] );
  $input['side_bar_bg_color'] = wp_filter_nohtml_kses( $input['side_bar_bg_color'] );
  $input['side_bar_bg_color_hover'] = wp_filter_nohtml_kses( $input['side_bar_bg_color_hover'] );
  $side_bar = array();
  if ( isset( $input['side_bar'] ) && is_array( $input['side_bar'] ) ) {
    foreach ( $input['side_bar'] as $key => $value ) {
      $side_bar[] = array(
        'label' => isset( $input['side_bar'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['side_bar'][$key]['label'] ) : '',
        'color' => isset( $input['side_bar'][$key]['color'] ) ? wp_filter_nohtml_kses( $input['side_bar'][$key]['color'] ) : '#ffffff',
        'url' => isset( $input['side_bar'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['side_bar'][$key]['url'] ) : '',
        'tel' => isset( $input['side_bar'][$key]['tel'] ) ? wp_filter_nohtml_kses( $input['side_bar'][$key]['tel'] ) : '',
        'target' => ! empty( $input['side_bar'][$key]['target'] ) ? 1 : 0,
        'icon' => ( isset( $input['side_bar'][$key]['icon'] ) && array_key_exists( $input['side_bar'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['side_bar'][$key]['icon'] : 'twitter',
      );
    };
  };
  $input['side_bar'] = $side_bar;


  return $input;

};


?>