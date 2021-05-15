<?php

function service_cf_meta_box() {
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );
  add_meta_box(
    'service_cf_meta_box',//ID of meta box
    sprintf(__('%s data setting', 'tcd-w'), $service_label),
    'show_service_cf_meta_box',//callback function
    'service',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'service_cf_meta_box');

function show_service_cf_meta_box() {

  global $post;

  $desc1 = get_post_meta($post->ID, 'desc1', true);
  $desc2 = get_post_meta($post->ID, 'desc2', true);

  // コンテンツビルダー
  $service_cf = get_post_meta( $post->ID, 'service_cf', true );

  echo '<input type="hidden" name="service_cf_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap contents_builder_wrap">

 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <h4 class="theme_option_headline2"><?php _e('Description for single page', 'tcd-w'); ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="desc2"><?php echo esc_textarea($desc2); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Image for front page', 'tcd-w');  ?></h4>
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '240', '100'); ?></p>
   <?php mlcf_media_form('index_image', __('Image for front page', 'tcd-w')); ?>

   <h4 class="theme_option_headline2"><?php _e('Description for front page and archive page', 'tcd-w'); ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="desc1"><?php echo esc_textarea($desc1); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Image for mega menu', 'tcd-w');  ?></h4>
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '100', '100'); ?></p>
   <?php mlcf_media_form('mega_image', __('Image for mega menu', 'tcd-w')); ?>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown service.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
 </div>


 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $service_cf && is_array( $service_cf ) ) :
         foreach( $service_cf as $key => $content ) :
           $cb_index = 'cb_' . $key . '_' . mt_rand( 0, 999999 );
  ?>
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>">
     <?php
          the_page_cb_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            service_cf_content_setting( $cb_index, $content['cb_content_select'], $content );
          endif;
     ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
         endforeach;
       endif;
  ?>
 </div><!-- END .contents_builder -->
 <ul class="button_list cf cb_add_row_buttton_area">
  <li><input type="button" value="<?php _e( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
 </ul>

 <?php // コンテンツビルダー追加用 非表示 ?>
 <div class="contents_builder-clone hidden">
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="cb_cloneindex">
       <?php the_page_cb_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( page_cb_get_contents() as $key => $value ) :
         service_cf_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_service_cf_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['service_cf_meta_box_nonce']) || !wp_verify_nonce($_POST['service_cf_meta_box_nonce'], basename(__FILE__))) {
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
    'desc1','desc2','index_image','mega_image'
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

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['service_cf'] ) && is_array( $_POST['service_cf'] ) ) {
		$cb_contents = page_cb_get_contents();
		$cb_data = array();

		foreach ( $_POST['service_cf'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// コンテンツ
			if ( 'content1' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

			// コンテンツ２
			} elseif ( 'content2' === $value['cb_content_select'] ) {

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

        $value['list_bg_color'] = wp_filter_nohtml_kses( $value['list_bg_color'] );

			// コンテンツ３
			} elseif ( 'content3' === $value['cb_content_select'] ) {

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

        $value['list_headline'] = wp_filter_nohtml_kses( $value['list_headline'] );
        $value['list_headline_font_color'] = wp_filter_nohtml_kses( $value['list_headline_font_color'] );
        $value['list_headline_bg_color'] = wp_filter_nohtml_kses( $value['list_headline_bg_color'] );

			// フリースペース
			} elseif ( 'free_space' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );
				$value['padding_top'] = absint( $value['padding_top'] );
				$value['padding_bottom'] = absint( $value['padding_bottom'] );
				$value['padding_top_mobile'] = absint( $value['padding_top_mobile'] );
				$value['padding_bottom_mobile'] = absint( $value['padding_bottom_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'service_cf', $cb_data );
		} else {
			delete_post_meta( $post_id, 'service_cf' );
		}
	}
}
add_action('save_post', 'save_service_cf_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function page_cb_get_contents() {
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Menu', 'tcd-w' );
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __('Content list', 'tcd-w') . '1',
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 20,
				'headline_font_type' => 'type2',
				'item_list' => array(),
				'item_catch_font_size' => 22,
				'item_catch_font_size_mobile' => 18,
				'item_desc_font_size' => 16,
				'item_desc_font_size_mobile' => 14,
			),
			'item_list_default' => array(
				'layout' => 'type1',
				'image' => '',
				'catch' => '',
				'catch_font_color' => '#00a7ce',
				'desc' => '',
			),
		),
    // コンテンツ２
		'content2' => array(
			'name' => 'content2',
			'label' => __('Content list', 'tcd-w') . '2',
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 20,
				'headline_font_type' => 'type2',
				'item_list' => array(),
				'list_bg_color' => '#f7f7f7',
				'item_desc_font_size' => 16,
				'item_desc_font_size_mobile' => 14,
			),
			'item_list_default' => array(
				'image' => '',
				'desc' => '',
			),
		),
    // コンテンツ３
		'content3' => array(
			'name' => 'content3',
			'label' => __('Price list', 'tcd-w'),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 20,
				'headline_font_type' => 'type2',
				'list_headline' => '',
				'list_headline_font_color' => '#ffffff',
				'list_headline_bg_color' => '#00a6d0',
				'item_list' => array(),
				'item_font_size' => 16,
				'item_font_size_mobile' => 14,
			),
			'item_list_default' => array(
				'name' => '',
				'price' => '',
			),
		),
    // フリースペース
		'free_space' => array(
			'name' => 'free_space',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'content_width' => 'type1',
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
				'padding_top' => 50,
				'padding_bottom' => 50,
				'padding_top_mobile' => 30,
				'padding_bottom_mobile' => 30,
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function the_page_cb_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = page_cb_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="service_cf[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="">' . __( 'Choose the content', 'tcd-w' ) . '</option>';

	foreach ( $cb_contents as $key => $value ) {
		$out .= '<option value="' . esc_attr( $key ) . '"' . selected( $key, $selected, false ) . '>' . esc_html( $value['label'] ) . '</option>';
	}

	$out .= '</select>';

	echo $out;
}

/**
 * コンテンツビルダー用 コンテンツ設定
 */
function service_cf_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $font_type_options, $free_space_options, $content_width_options;

	$cb_contents = page_cb_get_contents();

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // コンテンツ１ -------------------------------------------------------------------------
      if ( 'content1' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="service_cf[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging content header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Layout setting', 'tcd-w');  ?></h4>
       <ul class="design_radio_button">
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type1" <?php checked( $repeater_value['layout'], 'type1' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1"><?php _e('Display image on left side', 'tcd-w');  ?></label>
        </li>
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type2" <?php checked( $repeater_value['layout'], 'type2' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2"><?php _e('Display image on right side', 'tcd-w');  ?></label>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '470', '300'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"><?php echo esc_textarea(  $repeater_value['catch'] ); ?></textarea>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_color]" value="<?php echo esc_attr( $repeater_value['catch_font_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
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
          $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Layout setting', 'tcd-w');  ?></h4>
       <ul class="design_radio_button">
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type1" <?php checked( $repeater_value['layout'], 'type1' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1"><?php _e('Display image on left side', 'tcd-w');  ?></label>
        </li>
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type2" <?php checked( $repeater_value['layout'], 'type2' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2"><?php _e('Display image on right side', 'tcd-w');  ?></label>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '470', '300'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"></textarea>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_color]" value="<?php echo esc_attr( $repeater_value['catch_font_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
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
    <li class="cf"><span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_catch_font_size]" value="<?php esc_attr_e( $value['item_catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of catchphrase (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_catch_font_size_mobile]" value="<?php esc_attr_e( $value['item_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_desc_font_size]" value="<?php esc_attr_e( $value['item_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of desctiption (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_desc_font_size_mobile]" value="<?php esc_attr_e( $value['item_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // コンテンツ２ -------------------------------------------------------------------------
      elseif ( 'content2' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="service_cf[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging content header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '330', '210'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
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
          $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '330', '210'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
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
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="service_cf[<?php echo $cb_index; ?>][list_bg_color]" value="<?php echo esc_attr( $value['list_bg_color'] ); ?>" data-default-color="#f7f7f7" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_desc_font_size]" value="<?php esc_attr_e( $value['item_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of desctiption (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_desc_font_size_mobile]" value="<?php esc_attr_e( $value['item_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // コンテンツ３ -------------------------------------------------------------------------
      elseif ( 'content3' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="service_cf[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Price list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new item button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Price', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
       <input class="repeater-label full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][name]" value="<?php esc_attr_e( $repeater_value['name'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
       <input class="full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php esc_attr_e( $repeater_value['price'] ); ?>" />
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
       <input class="repeater-label full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][name]" value="" />
       <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
       <input class="full_width" type="text" name="service_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][price]" value="" />
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w'); ?></span><input type="text" class="full_width" name="service_cf[<?php echo $cb_index; ?>][list_headline]" value="<?php echo esc_attr( $value['list_headline'] ); ?>"></li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="service_cf[<?php echo $cb_index; ?>][list_headline_font_color]" value="<?php echo esc_attr( $value['list_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="service_cf[<?php echo $cb_index; ?>][list_headline_bg_color]" value="<?php echo esc_attr( $value['list_headline_bg_color'] ); ?>" data-default-color="#00a6d0" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font size of price list', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_font_size]" value="<?php esc_attr_e( $value['item_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of price list (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][item_font_size_mobile]" value="<?php esc_attr_e( $value['item_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
       // フリースペース -------------------------------------------------------------------------
       elseif ( 'free_space' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="service_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
   <ul class="design_radio_button">
    <?php foreach ( $content_width_options as $option ) { ?>
    <li>
     <input type="radio" id="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="service_cf[<?php echo $cb_index; ?>][content_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['content_width'], $option['value'] ); ?> />
     <label for="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
    </li>
    <?php } ?>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'service_cf[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php esc_attr_e( $value['desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][padding_top]" value="<?php esc_attr_e( $value['padding_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][padding_bottom]" value="<?php esc_attr_e( $value['padding_bottom'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin top (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][padding_top_mobile]" value="<?php esc_attr_e( $value['padding_top_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="service_cf[<?php echo $cb_index; ?>][padding_bottom_mobile]" value="<?php esc_attr_e( $value['padding_bottom_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
       // ボタンを表示 ----------------------------------------------------------------------------
       else :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?></h3>
  <div class="cb_content">
   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div>
  <?php endif; ?>

  </div><!-- END .cb_content_wrap -->
<?php
}

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function service_cb_tiny_mce_before_init( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'service_cb_tiny_mce_before_init', 10, 2 );






