<?php
/*
 * トップページの設定（モバイル用）
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_mobile_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_mobile_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_mobile_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_mobile_theme_options_validate' );


// タブの名前
function add_front_page_mobile_tab_label( $tab_labels ) {
	$tab_labels['front_page_mobile'] = __( 'Front page (smartphone)', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_front_page_mobile_dp_default_options( $dp_default_options ) {

	// ヘッダースライダー
	$dp_default_options['mobile_show_index_slider'] = '';
	$dp_default_options['mobile_index_slider_time'] = '7000';
	$dp_default_options['mobile_index_slider'] = array();

  // コンテンツビルダー
	$dp_default_options['mobile_show_contents_builder'] = '';
	$dp_default_options['mobile_contents_builder'] = array();

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_tab_panel( $options ) {

  global $dp_default_options, $slider_type_options, $time_options, $font_type_options, $slider_animation_options, $content_direction_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

?>

<div id="tab-content-front-page-mobile" class="tab-content">

   <?php // ヘッダーコンテンツの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p><label><input name="dp_options[mobile_show_index_slider]" type="checkbox" value="1" <?php checked( '1', $options['mobile_show_index_slider'] ); ?> /> <?php _e('Use slider for smartphone', 'tcd-w');  ?></label></p>
     <div class="theme_option_message">
      <p><strong><?php _e('If you want to display different slider in smartphone please check the checkbox below.', 'tcd-w');  ?></strong></p>
      <br>
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
     </div>
     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[mobile_index_slider]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['mobile_index_slider'] ) :
              foreach ( $options['mobile_index_slider'] as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php if($value['catch']) { echo esc_html( $value['catch'] ); } else { _e( 'Item', 'tcd-w' ); }; ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e('Slider type', 'tcd-w');  ?></h4>
         <ul class="design_radio_button">
          <?php foreach ( $slider_type_options as $option ) { ?>
          <li class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>">
           <input type="radio" id="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> />
           <label for="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>"><?php echo $option['label']; ?></label>
          </li>
          <?php } ?>
         </ul>
         <?php // 画像 ----------------------- ?>
         <div class="index_slider_image_area" style="<?php if($value['slider_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_image">
            <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </div><!-- END .index_slider_image_area -->
         <?php // video ----------------------- ?>
         <div class="index_slider_video_area" style="<?php if($value['slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
           <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
          </div>
          <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video">
           <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
           <div class="preview_field preview_field_video">
            <?php if($value['video']){ ?>
            <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
            <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
            <?php }; ?>
           </div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
            <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
           </div>
          </div>
          <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          </div>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video_image">
            <input type="hidden" value="<?php if($value['video_image']) { echo esc_attr( $value['video_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video_image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['video_image']){ echo wp_get_attachment_image($value['video_image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['video_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </div><!-- END .index_slider_video_area -->
         <?php // youtube ----------------------- ?>
         <div class="index_slider_youtube_area" style="<?php if($value['slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
           <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
          </div>
          <input class="regular-text" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
          <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          </div>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_youtube_image">
            <input type="hidden" value="<?php if($value['youtube_image']) { echo esc_attr( $value['youtube_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_youtube_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube_image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['youtube_image']){ echo wp_get_attachment_image($value['youtube_image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['youtube_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </div><!-- END .index_slider_youtube_area -->
         <?php // キャッチフレーズ ----------------------- ?>
         <div class="index_slider_other_setting" style="<?php if($value['slider_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Catchphrase setting', 'tcd-w' ); ?></h4>
          <textarea class="repeater-label large-text" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
             <?php foreach ( $font_type_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
           <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_direction]" type="checkbox" value="1" <?php checked( $value['catch_direction'], 1 ); ?>><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
          </ul>
          <h4 class="theme_option_headline2"><?php _e('Dropshadow setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_catch_shadow]" type="checkbox" value="1" <?php checked( $value['use_catch_shadow'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_catch_shadow'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_a]" value="<?php echo esc_attr( $value['catch_shadow_a'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_b]" value="<?php echo esc_attr( $value['catch_shadow_b'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_c]" value="<?php echo esc_attr( $value['catch_shadow_c'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_color]" value="<?php echo esc_attr( $value['catch_shadow_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
           </ul>
          </div>
          <?php // オーバーレイ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000"></li>
            <li class="cf"><span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" /><p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p></li>
           </ul>
          </div>
          <?php // アニメーション ----------------------- ?>
          <div class="index_slider_image_area" style="<?php if($value['slider_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <h4 class="theme_option_headline2"><?php _e('Animation type', 'tcd-w');  ?></h4>
           <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][animation_type]">
            <?php foreach ( $slider_animation_options as $option ) { ?>
            <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['animation_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
            <?php } ?>
           </select>
          </div><!-- END .index_slider_image_area -->
         </div><!-- END .index_slider_other_setting -->
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'slider_type' => 'type1',
             'image' => false,
             'video' => '',
             'video_image' => false,
             'youtube' => '',
             'youtube_image' => false,
             'catch' => '',
             'catch_font_type' => 'type3',
             'catch_font_size' => '20',
             'catch_font_color' => '#ffffff',
             'catch_direction' => '',
             'use_catch_shadow' => '',
             'catch_shadow_a' => '0',
             'catch_shadow_b' => '0',
             'catch_shadow_c' => '4',
             'catch_shadow_color' => '#000000',
             'use_overlay' => '',
             'overlay_color' => '#000000',
             'overlay_opacity' => '0.3',
             'animation_type' => 'type1',
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e('Slider type', 'tcd-w');  ?></h4>
         <ul class="design_radio_button">
          <?php foreach ( $slider_type_options as $option ) { ?>
          <li class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>">
           <input type="radio" id="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> />
           <label for="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>"><?php echo $option['label']; ?></label>
          </li>
          <?php } ?>
         </ul>
         <?php // 画像 ----------------------- ?>
         <div class="index_slider_image_area" style="<?php if($value['slider_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_image">
            <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </div><!-- END .index_slider_image_area -->
         <?php // video ----------------------- ?>
         <div class="index_slider_video_area" style="<?php if($value['slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
           <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
          </div>
          <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video">
           <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
           <div class="preview_field preview_field_video">
            <?php if($value['video']){ ?>
            <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
            <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
            <?php }; ?>
           </div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
            <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
           </div>
          </div>
          <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          </div>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video_image">
            <input type="hidden" value="<?php if($value['video_image']) { echo esc_attr( $value['video_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video_image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['video_image']){ echo wp_get_attachment_image($value['video_image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['video_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </div><!-- END .index_slider_video_area -->
         <?php // youtube ----------------------- ?>
         <div class="index_slider_youtube_area" style="<?php if($value['slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
           <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
          </div>
          <input class="regular-text" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
          <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
          <div class="theme_option_message2">
           <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
           <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          </div>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_youtube_image">
            <input type="hidden" value="<?php if($value['youtube_image']) { echo esc_attr( $value['youtube_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_youtube_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube_image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['youtube_image']){ echo wp_get_attachment_image($value['youtube_image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['youtube_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </div><!-- END .index_slider_youtube_area -->
         <?php // キャッチフレーズ ----------------------- ?>
         <div class="index_slider_image_area" style="<?php if($value['slider_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Catchphrase setting', 'tcd-w' ); ?></h4>
          <textarea class="repeater-label large-text" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
             <?php foreach ( $font_type_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
           <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_direction]" type="checkbox" value="1" <?php checked( $value['catch_direction'], 1 ); ?>><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
          </ul>
          <h4 class="theme_option_headline2"><?php _e('Dropshadow setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_catch_shadow]" type="checkbox" value="1" <?php checked( $value['use_catch_shadow'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_catch_shadow'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_a]" value="<?php echo esc_attr( $value['catch_shadow_a'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_b]" value="<?php echo esc_attr( $value['catch_shadow_b'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_c]" value="<?php echo esc_attr( $value['catch_shadow_c'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_color]" value="<?php echo esc_attr( $value['catch_shadow_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
           </ul>
          </div>
          <?php // オーバーレイ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000"></li>
            <li class="cf"><span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" /><p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p></li>
           </ul>
          </div>
          <?php // アニメーション ----------------------- ?>
          <div class="index_slider_animation_area" style="<?php if($value['slider_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <h4 class="theme_option_headline2"><?php _e('Animation type', 'tcd-w');  ?></h4>
           <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][animation_type]">
            <?php foreach ( $slider_animation_options as $option ) { ?>
            <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['animation_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
            <?php } ?>
           </select>
          </div><!-- END .index_slider_image_area -->
         </div><!-- END .index_slider_other_setting -->
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>
     <?php // スピードの設定 ---------- ?>
     <h4 class="theme_option_headline2"><?php _e('Slider speed setting', 'tcd-w');  ?></h4>
     <select name="dp_options[mobile_index_slider_time]">
      <?php
           $i = 1;
           foreach ( $time_options as $option ):
             if( $i >= 2 && $i <= 10 ){
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['mobile_index_slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php
             }
             $i++;
          endforeach;
      ?>
     </select>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active show_arrow">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message no_arrow">
      <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
     </div>
     <p><label><input name="dp_options[mobile_show_contents_builder]" type="checkbox" value="1" <?php checked( '1', $options['mobile_show_contents_builder'] ); ?> /> <?php _e('Use content builder for smartphone', 'tcd-w');  ?></label></p>
     <h4 class="theme_option_headline2"><?php _e( 'Content image', 'tcd-w' ); ?></h4>
     <ul class="design_button_list cf rebox_group">
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_content_slider.jpg" title="<?php _e( 'Content carousel', 'tcd-w' ); ?>"><?php _e( 'Content carousel', 'tcd-w' ); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_service_list.jpg" title="<?php printf(__('%s list', 'tcd-w'),$service_label); ?>"><?php printf(__('%s list', 'tcd-w'),$service_label); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_message.jpg" title="<?php echo __('Message', 'tcd-w'); ?>"><?php echo __('Message', 'tcd-w'); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_post_slider.jpg" title="<?php echo __('Post carousel', 'tcd-w'); ?>"><?php echo __('Post carousel', 'tcd-w'); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_access.jpg" title="<?php echo __('Access information', 'tcd-w'); ?>"><?php echo __('Access information', 'tcd-w'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <div class="contents_builder_wrap">

    <div class="contents_builder">
     <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
     <?php
          if (!empty($options['mobile_contents_builder'])) {
            foreach($options['mobile_contents_builder'] as $key => $content) :
              $cb_index = 'cb_'.$key.'_'.mt_rand(0,999999);
     ?>
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>" />
        <?php mobile_the_cb_content_select($cb_index, $content['cb_content_select']); ?>
        <?php if (!empty($content['cb_content_select'])) mobile_the_cb_content_setting($cb_index, $content['cb_content_select'], $content); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          endforeach;
         };
     ?>
    </div><!-- END .contents_builder -->
    <ul class="button_list cf cb_add_row_buttton_area">
     <li><input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
     <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    </ul>

    <?php // コンテンツビルダー追加用 非表示 ?>
    <div class="contents_builder-clone hidden">
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="cb_cloneindex" />
        <?php mobile_the_cb_content_select('cb_cloneindex'); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          mobile_the_cb_content_setting('cb_cloneindex', 'content_slider');
          mobile_the_cb_content_setting('cb_cloneindex', 'service_list');
          mobile_the_cb_content_setting('cb_cloneindex', 'message');
          mobile_the_cb_content_setting('cb_cloneindex', 'post_slider');
          mobile_the_cb_content_setting('cb_cloneindex', 'access');
          mobile_the_cb_content_setting('cb_cloneindex', 'free_space');
     ?>
    </div><!-- END .contents_builder-clone -->

   </div><!-- END .contents_builder_wrap -->
   <?php // コンテンツビルダーここまで ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>


</div><!-- END .tab-content -->

<?php
} // END add_front_page_mobile_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_theme_options_validate( $input ) {

  global $dp_default_options, $time_options, $font_type_options, $slider_animation_options, $content_direction_options, $index_content_type_options, $slider_type_options;

  // ヘッダーコンテンツ
  $input['mobile_show_index_slider'] = ! empty( $input['mobile_show_index_slider'] ) ? 1 : 0;
  if ( ! isset( $value['mobile_index_slider_time'] ) )
    $value['mobile_index_slider_time'] = null;
  if ( ! array_key_exists( $value['mobile_index_slider_time'], $time_options ) )
    $value['mobile_index_slider_time'] = null;

  //スライダーの設定
  $mobile_index_slider = array();
  if ( isset( $input['mobile_index_slider'] ) && is_array( $input['mobile_index_slider'] ) ) {
    foreach ( $input['mobile_index_slider'] as $key => $value ) {
      $mobile_index_slider[] = array(
        'slider_type' => ( isset( $input['mobile_index_slider'][$key]['slider_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['slider_type'], $slider_type_options ) ) ? $input['mobile_index_slider'][$key]['slider_type'] : 'type1',
        'image' => isset( $input['mobile_index_slider'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['image'] ) : '',
        'video' => isset( $input['mobile_index_slider'][$key]['video'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['video'] ) : '',
        'video_image' => isset( $input['mobile_index_slider'][$key]['video_image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['video_image'] ) : '',
        'youtube' => isset( $input['mobile_index_slider'][$key]['youtube'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['youtube'] ) : '',
        'youtube_image' => isset( $input['mobile_index_slider'][$key]['youtube_image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['youtube_image'] ) : '',
        'catch' => isset( $input['mobile_index_slider'][$key]['catch'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch'] ) : '',
        'catch_font_type' => ( isset( $input['mobile_index_slider'][$key]['catch_font_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['catch_font_type'], $font_type_options ) ) ? $input['mobile_index_slider'][$key]['catch_font_type'] : 'type1',
        'catch_font_size' => isset( $input['mobile_index_slider'][$key]['catch_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_font_size'] ) : '30',
        'catch_font_color' => isset( $input['mobile_index_slider'][$key]['catch_font_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_font_color'] ) : '#FFFFFF',
        'catch_direction' => ! empty( $input['mobile_index_slider'][$key]['catch_direction'] ) ? 1 : 0,
        'use_catch_shadow' => ! empty( $input['mobile_index_slider'][$key]['use_catch_shadow'] ) ? 1 : 0,
        'catch_shadow_a' => isset( $input['mobile_index_slider'][$key]['catch_shadow_a'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_a'] ) : '0',
        'catch_shadow_b' => isset( $input['mobile_index_slider'][$key]['catch_shadow_b'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_b'] ) : '0',
        'catch_shadow_c' => isset( $input['mobile_index_slider'][$key]['catch_shadow_c'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_c'] ) : '4',
        'catch_shadow_color' => isset( $input['mobile_index_slider'][$key]['catch_shadow_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_color'] ) : '#000000',
        'use_overlay' => ! empty( $input['mobile_index_slider'][$key]['use_overlay'] ) ? 1 : 0,
        'overlay_color' => isset( $input['mobile_index_slider'][$key]['overlay_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_color'] ) : '#000000',
        'overlay_opacity' => isset( $input['mobile_index_slider'][$key]['overlay_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_opacity'] ) : '0.3',
        'animation_type' => ( isset( $input['mobile_index_slider'][$key]['animation_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['animation_type'], $slider_animation_options ) ) ? $input['mobile_index_slider'][$key]['animation_type'] : 'type1',
      );
    }
  };
  $input['mobile_index_slider'] = $mobile_index_slider;

  // コンテンツビルダー -----------------------------------------------------------------------------
  $input['mobile_show_contents_builder'] = ! empty( $input['mobile_show_contents_builder'] ) ? 1 : 0;
  if (!empty($input['mobile_contents_builder'])) {

    $input_cb = $input['mobile_contents_builder'];
    $input['mobile_contents_builder'] = array();

    foreach($input_cb as $key => $value) {

      // クローン用はスルー
      //if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'))) continue;
      if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'), true)) continue;

      // コンテンツカルーセル -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'content_slider') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_color'] = wp_filter_nohtml_kses( $value['headline_font_color'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_url'] = wp_filter_nohtml_kses( $value['button_url'] );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );

        $value['item_list'] = $value['item_list'];

        $value['slider_time'] = wp_filter_nohtml_kses( $value['slider_time'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

      // サービス一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'service_list') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_color'] = wp_filter_nohtml_kses( $value['headline_font_color'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['title_font_type'] = wp_filter_nohtml_kses( $value['title_font_type'] );

        $value['excerpt_font_size'] = wp_filter_nohtml_kses( $value['excerpt_font_size'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );

        $value['bg_image'] = wp_filter_nohtml_kses( $value['bg_image'] );
        $value['bg_use_overlay'] = ! empty( $value['bg_use_overlay'] ) ? 1 : 0;
        $value['bg_overlay_color'] = wp_filter_nohtml_kses( $value['bg_overlay_color'] );
        $value['bg_overlay_opacity'] = wp_filter_nohtml_kses( $value['bg_overlay_opacity'] );

        if ( ! isset( $value['use_animation_image'] ) )
          $value['use_animation_image'] = null;
          $value['use_animation_image'] = ( $value['use_animation_image'] == 1 ? 1 : 0 );

      // メッセージ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'message') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_color'] = wp_filter_nohtml_kses( $value['headline_font_color'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['image'] = wp_filter_nohtml_kses( $value['image'] );

        $value['message_catch'] = wp_filter_nohtml_kses( $value['message_catch'] );
        $value['message_catch_font_size'] = wp_filter_nohtml_kses( $value['message_catch_font_size'] );
        $value['message_catch_font_type'] = wp_filter_nohtml_kses( $value['message_catch_font_type'] );
        $value['message_catch_font_color'] = wp_filter_nohtml_kses( $value['message_catch_font_color'] );

        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

        $value['title'] = wp_filter_nohtml_kses( $value['title'] );
        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['title_font_type'] = wp_filter_nohtml_kses( $value['title_font_type'] );

        $value['sub_title'] = wp_filter_nohtml_kses( $value['sub_title'] );
        $value['sub_title_font_size'] = wp_filter_nohtml_kses( $value['sub_title_font_size'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_url'] = wp_filter_nohtml_kses( $value['button_url'] );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );

      // 記事カルーセル -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'post_slider') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['background_color'] = wp_filter_nohtml_kses( $value['background_color'] );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_color'] = wp_filter_nohtml_kses( $value['headline_font_color'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['post_type'] = wp_filter_nohtml_kses( $value['post_type'] );
        $value['post_num'] = wp_filter_nohtml_kses( $value['post_num'] );
        $value['post_order'] = wp_filter_nohtml_kses( $value['post_order'] );
        $value['slider_time'] = wp_filter_nohtml_kses( $value['slider_time'] );

        if ( ! isset( $value['show_date'] ) )
          $value['show_date'] = null;
          $value['show_date'] = ( $value['show_date'] == 1 ? 1 : 0 );
        if ( ! isset( $value['show_category'] ) )
          $value['show_category'] = null;
          $value['show_category'] = ( $value['show_category'] == 1 ? 1 : 0 );
        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );

      // アクセス -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'access') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_color'] = wp_filter_nohtml_kses( $value['headline_font_color'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['desc'] = $value['desc'];
        $value['desc_bg_color'] = wp_filter_nohtml_kses( $value['desc_bg_color'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_url'] = wp_filter_nohtml_kses( $value['button_url'] );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );

      //自由入力欄 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        if ( ! isset( $value['free_space'] )) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

        $value['padding_top'] = wp_filter_nohtml_kses( $value['padding_top'] );
        $value['padding_bottom'] = wp_filter_nohtml_kses( $value['padding_bottom'] );

        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

      }

      $input['mobile_contents_builder'][] = $value;

    }

  } //コンテンツビルダーここまで -----------------------------------------------------------------------

  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ選択プルダウン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_select($cb_index = 'cb_cloneindex', $selected = null) {

  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

	$cb_content_select = array(
		'content_slider' => __('Content carousel', 'tcd-w'),
		'service_list' =>  sprintf(__('%s list', 'tcd-w'),$service_label),
		'message' => __('Message', 'tcd-w'),
		'post_slider' => __('Post carousel', 'tcd-w'),
		'access' => __('Access information', 'tcd-w'),
		'free_space' => __('Free space', 'tcd-w')
	);

	if ($selected && isset($cb_content_select[$selected])) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="dp_options[mobile_contents_builder]['.esc_attr($cb_index).'][cb_content_select]" class="cb_content_select'.$add_class.'">';
	$out .= '<option value="" style="padding-right: 10px;">'.__("Choose the content", "tcd-w").'</option>';

	foreach($cb_content_select as $key => $value) {
		$attr = '';
		if ($key == $selected) {
			$attr = ' selected="selected"';
		}
		$out .= '<option value="'.esc_attr($key).'"'.$attr.' style="padding-right: 10px;">'.esc_html($value).'</option>';
	}

	$out .= '</select>';

	echo $out; 
}

/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_setting($cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array()) {

  global $content_direction_options, $font_type_options, $content_width_options, $time_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;
  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

?>

<div class="cb_content_wrap cf <?php echo esc_attr($cb_content_select); ?>">

<?php
     // コンテンツカルーセル　-------------------------------------------------------------
     if ($cb_content_select == 'content_slider') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['headline_font_size'])) { $value['headline_font_size'] = '12'; }
       if (!isset($value['headline_font_color'])) { $value['headline_font_color'] = '#00a6cc'; }
       if (!isset($value['headline_font_type'])) { $value['headline_font_type'] = 'type2'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_url'])) { $value['button_url'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#00a8ca'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#007a96'; }

       if (!isset($value['item_list'])) { $value['item_list'] = array(); }

       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }
       if (!isset($value['slider_time'])) { $value['slider_time'] = 5000; }
?>

  <h3 class="cb_content_headline"><?php _e('Content carousel', 'tcd-w'); ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display content carousel', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '300'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="mobile_item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
       <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" value="<?php esc_attr_e( $repeater_value['url'] ); ?>" />
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = array(
            'image' => false,
            'desc' => '',
            'url' => '',
          );
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '300'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="mobile_item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
       <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" value="" />
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Slider speed', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][slider_time]">
      <?php
           $time = 1;
           foreach ( $time_options as $option ):
             if( $time >= 2 && $time <= 10 ){
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php
             }
             $time++;
          endforeach;
      ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00a8ca" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#007a96" class="c-color-picker"></li>
    </ul>
   </div>

<?php
     // サービス一覧　-------------------------------------------------------------
     } elseif ($cb_content_select == 'service_list') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['headline_font_size'])) { $value['headline_font_size'] = '12'; }
       if (!isset($value['headline_font_color'])) { $value['headline_font_color'] = '#00a6cc'; }
       if (!isset($value['headline_font_type'])) { $value['headline_font_type'] = 'type2'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '18'; }
       if (!isset($value['title_font_type'])) { $value['title_font_type'] = 'type2'; }

       if (!isset($value['excerpt_font_size'])) { $value['excerpt_font_size'] = '12'; }

       if (!isset($value['bg_image'])) { $value['bg_image'] = 'false'; }
       if (!isset($value['bg_use_overlay'])) { $value['bg_use_overlay'] = ''; }
       if (!isset($value['bg_overlay_color'])) { $value['bg_overlay_color'] = '#000000'; }
       if (!isset($value['bg_overlay_opacity'])) { $value['bg_overlay_opacity'] = '0.3'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#00a8ca'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#007a96'; }

       if (!isset($value['use_animation_image'])) { $value['use_animation_image'] = ''; }

?>
  <h3 class="cb_content_headline"><?php printf(__('%s list', 'tcd-w'), $service_label); ?></h3>
  <div class="cb_content">

   <div class="theme_option_message2" style="margin-top:20px;">
    <p><?php printf(__('The image and description created in custom post type "%s" will be displayed.', 'tcd-w'), $service_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php printf(__('Display %s list', 'tcd-w'), $service_label); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php printf(__('%s list setting', 'tcd-w'), $service_label); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of excerpt', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][excerpt_font_size]" value="<?php esc_attr_e( $value['excerpt_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Use animation on image', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][use_animation_image]" type="checkbox" value="1" <?php checked( $value['use_animation_image'], 1 ); ?>></li>
   </ul>


   <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
   </div>
   <div class="image_box cf">
    <div class="cf cf_media_field hide-if-no-js">
     <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_image]" id="mobile_bg_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['bg_image'] ); ?>">
     <div class="preview_field"><?php if ( $value['bg_image'] ) echo wp_get_attachment_image( $value['bg_image'], 'medium' ); ?></div>
     <div class="buttton_area">
      <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
      <input type="button" class="cfmf-delete-img button<?php if ( ! $value['bg_image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Overlay setting for background image', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_use_overlay]" type="checkbox" value="1" <?php checked( $value['bg_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['bg_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_overlay_color]" value="<?php echo esc_attr( $value['bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_overlay_opacity]" value="<?php echo esc_attr( $value['bg_overlay_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button for archive page', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00a8ca" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#007a96" class="c-color-picker"></li>
    </ul>
   </div>


<?php
     // メッセージ　-------------------------------------------------------------
     } elseif ($cb_content_select == 'message') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['headline_font_size'])) { $value['headline_font_size'] = '12'; }
       if (!isset($value['headline_font_color'])) { $value['headline_font_color'] = '#00a6cc'; }
       if (!isset($value['headline_font_type'])) { $value['headline_font_type'] = 'type2'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['image'])) { $value['image'] = 'false'; }

       if (!isset($value['message_catch'])) { $value['message_catch'] = ''; }
       if (!isset($value['message_catch_font_size'])) { $value['message_catch_font_size'] = '18'; }
       if (!isset($value['message_catch_font_type'])) { $value['message_catch_font_type'] = 'type2'; }
       if (!isset($value['message_catch_font_color'])) { $value['message_catch_font_color'] = '#00a8cc'; }

       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }

       if (!isset($value['title'])) { $value['title'] = ''; }
       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '14'; }
       if (!isset($value['title_font_type'])) { $value['title_font_type'] = 'type2'; }

       if (!isset($value['sub_title'])) { $value['sub_title'] = ''; }
       if (!isset($value['sub_title_font_size'])) { $value['sub_title_font_size'] = '12'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_url'])) { $value['button_url'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#00a8ca'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#007a96'; }

?>
  <h3 class="cb_content_headline"><?php _e('Message', 'tcd-w'); ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display message', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '640'); ?></p>
   </div>
   <div class="image_box cf">
    <div class="cf cf_media_field hide-if-no-js">
     <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][image]" id="mobile_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image'] ); ?>">
     <div class="preview_field"><?php if ( $value['image'] ) echo wp_get_attachment_image( $value['image'], 'medium' ); ?></div>
     <div class="buttton_area">
      <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
      <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase (message area)', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][message_catch]"><?php echo esc_textarea(  $value['message_catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][message_catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['message_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][message_catch_font_size]" value="<?php esc_attr_e( $value['message_catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description (message area)', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Title (message area)', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title]" value="<?php esc_attr_e( $value['title'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Subtitle (message area)', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][sub_title]" value="<?php esc_attr_e( $value['sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][sub_title_font_size]" value="<?php esc_attr_e( $value['sub_title_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00a8ca" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#007a96" class="c-color-picker"></li>
    </ul>
   </div>


<?php
     // 記事カルーセル　-------------------------------------------------------------
     } elseif ($cb_content_select == 'post_slider') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['background_color'])) { $value['background_color'] = '#f5f5f5'; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['headline_font_size'])) { $value['headline_font_size'] = '12'; }
       if (!isset($value['headline_font_color'])) { $value['headline_font_color'] = '#00a6cc'; }
       if (!isset($value['headline_font_type'])) { $value['headline_font_type'] = 'type2'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['post_type'])) { $value['post_type'] = 'post'; }
       if (!isset($value['post_num'])) { $value['post_num'] = '6'; }
       if (!isset($value['post_order'])) { $value['post_order'] = 'date'; }
       if (!isset($value['slider_time'])) { $value['slider_time'] = 5000; }

       if (!isset($value['show_date'])) { $value['show_date'] = 1; }
       if (!isset($value['show_category'])) { $value['show_category'] = 1; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '14'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#00a8ca'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#007a96'; }

?>

  <h3 class="cb_content_headline"><?php _e('Post carousel', 'tcd-w'); ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display post carousel', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-w'); ?></h4>
   <input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][background_color]" value="<?php echo esc_attr($value['background_color']); ?>" data-default-color="#f5f5f5" class="c-color-picker" />

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Carousel setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w'); ?></span>
     <select class="post_type" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type]">
      <option style="padding-right: 10px;" value="post" <?php selected( $value['post_type'], 'post' ); ?>><?php _e('Blog', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="news" <?php selected( $value['post_type'], 'news' ); ?>><?php echo esc_html($news_label); ?></option>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w'); ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order]">
      <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'], 'date' ); ?>><?php _e('Date', 'tcd-w');  ?></option>
      <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num]">
      <?php for($post_num=3; $post_num<= 10; $post_num++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($post_num); ?>" <?php selected( $value['post_num'], $post_num ); ?>><?php echo esc_html($post_num); ?></option>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Carousel speed', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][slider_time]">
      <?php
           $time = 1;
           foreach ( $time_options as $option ):
             if( $time >= 2 && $time <= 10 ){
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php
             }
             $time++;
          endforeach;
      ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button for archive page', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00a8ca" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#007a96" class="c-color-picker"></li>
    </ul>
   </div>


<?php
     // アクセス　-------------------------------------------------------------
     } elseif ($cb_content_select == 'access') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['headline_font_size'])) { $value['headline_font_size'] = '12'; }
       if (!isset($value['headline_font_color'])) { $value['headline_font_color'] = '#00a6cc'; }
       if (!isset($value['headline_font_type'])) { $value['headline_font_type'] = 'type2'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['desc_bg_color'])) { $value['desc_bg_color'] = '#f5f5f5'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_url'])) { $value['button_url'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#00a8ca'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#007a96'; }

?>

  <h3 class="cb_content_headline"><?php _e('Access information', 'tcd-w'); ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display access information', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <div class="theme_option_message2">
    <p><?php _e('Please register Google map data and access information from <strong>Basic setting area</strong> in site basic setting theme option.', 'tcd-w'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Access information', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_bg_color]" value="<?php echo esc_attr( $value['desc_bg_color'] ); ?>" data-default-color="#f5f5f5" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00a8ca" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#007a96" class="c-color-picker"></li>
    </ul>
   </div>

<?php
     // 自由入力欄　-------------------------------------------------------------
     } elseif ($cb_content_select == 'free_space') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['free_space'])) {
         $value['free_space'] = '';
       }

       if (!isset($value['padding_top'])) { $value['padding_top'] = '30'; }
       if (!isset($value['padding_bottom'])) { $value['padding_bottom'] = '30'; }

       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }

?>
  <h3 class="cb_content_headline"><?php _e('Free space', 'tcd-w');  ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display free space', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php
        wp_editor(
          $value['free_space'],
          'cb_wysiwyg_editor-' . $cb_index,
          array (
            'textarea_name' => 'dp_options[mobile_contents_builder][' . $cb_index . '][free_space]'
          )
       );
   ?>

   <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][padding_top]" value="<?php esc_attr_e( $value['padding_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][padding_bottom]" value="<?php esc_attr_e( $value['padding_bottom'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Font size setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

<?php
     // ボタンの表示　-------------------------------------------------------------
     } else {
?>
  <h3 class="cb_content_headline"><?php echo esc_html($cb_content_select); ?></h3>
  <div class="cb_content">

<?php
     }
?>

   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>

  </div><!-- END .cb_content -->

</div><!-- END .cb_content_wrap -->

<?php

} // END mobile_the_cb_content_setting()

?>