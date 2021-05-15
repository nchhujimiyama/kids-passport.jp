<?php

function design1_meta_box() {
  $options = get_design_plus_option();
  add_meta_box(
    'design1_meta_box',//ID of meta box
    __('About page setting', 'tcd-w'),//label
    'show_design1_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'design1_meta_box');

function show_design1_meta_box() {

  global $post, $font_type_options;

  $dc1_headline = get_post_meta($post->ID, 'dc1_headline', true);
  $dc1_headline_font_size = get_post_meta($post->ID, 'dc1_headline_font_size', true) ?  get_post_meta($post->ID, 'dc1_headline_font_size', true) : '14';
  $dc1_headline_font_size_mobile = get_post_meta($post->ID, 'dc1_headline_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc1_headline_font_size_mobile', true) : '12';
  $dc1_headline_font_color = get_post_meta($post->ID, 'dc1_headline_font_color', true) ?  get_post_meta($post->ID, 'dc1_headline_font_color', true) : '#00a6cc';
  $dc1_headline_font_type = get_post_meta($post->ID, 'dc1_headline_font_type', true) ?  get_post_meta($post->ID, 'dc1_headline_font_type', true) : 'type2';

  $dc1_catch = get_post_meta($post->ID, 'dc1_catch', true);
  $dc1_catch_font_size = get_post_meta($post->ID, 'dc1_catch_font_size', true) ?  get_post_meta($post->ID, 'dc1_catch_font_size', true) : '38';
  $dc1_catch_font_size_mobile = get_post_meta($post->ID, 'dc1_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc1_catch_font_size_mobile', true) : '24';
  $dc1_catch_font_type = get_post_meta($post->ID, 'dc1_catch_font_type', true) ?  get_post_meta($post->ID, 'dc1_catch_font_type', true) : 'type3';

  $dc1_desc = get_post_meta($post->ID, 'dc1_desc', true);
  $dc1_desc_font_size = get_post_meta($post->ID, 'dc1_desc_font_size', true) ?  get_post_meta($post->ID, 'dc1_desc_font_size', true) : '16';
  $dc1_desc_font_size_mobile = get_post_meta($post->ID, 'dc1_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc1_desc_font_size_mobile', true) : '14';

  // コンテンツビルダー
  $design1_content = get_post_meta( $post->ID, 'design1_content', true );

  echo '<input type="hidden" name="design1_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

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

<div class="tcd_custom_field_wrap contents_builder_wrap">

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Content header setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dc1_headline" value="<?php echo esc_attr( $dc1_headline ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dc1_headline_font_type">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $dc1_headline_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc1_headline_font_size" value="<?php esc_attr_e( $dc1_headline_font_size ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc1_headline_font_size_mobile" value="<?php esc_attr_e( $dc1_headline_font_size_mobile ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dc1_headline_font_color" value="<?php echo esc_attr( $dc1_headline_font_color ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dc1_catch"><?php echo esc_textarea(  $dc1_catch ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dc1_catch_font_type">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $dc1_catch_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc1_catch_font_size" value="<?php esc_attr_e( $dc1_catch_font_size ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc1_catch_font_size_mobile" value="<?php esc_attr_e( $dc1_catch_font_size_mobile ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dc1_desc"><?php echo esc_textarea(  $dc1_desc ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc1_desc_font_size" value="<?php esc_attr_e( $dc1_desc_font_size ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc1_desc_font_size_mobile" value="<?php esc_attr_e( $dc1_desc_font_size_mobile ); ?>" /><span>px</span></li>
     </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <?php echo __( '<p>STEP1: Click add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
  <?php echo __( '<p>Margins will be automatically adjusted and displayed where the content is not set. You do not have to enter all the content.</p>', 'tcd-w' ); ?>
  <p class="rebox_group preview_page_image"><a href="<?php bloginfo('template_url'); ?>/admin/img/clinic.jpg"><?php _e( 'Preview page image', 'tcd-w' ); ?></a></p>
 </div>

 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $design1_content && is_array( $design1_content ) ) :
         foreach( $design1_content as $key => $content ) :
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
          design1_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            design1_content_content_setting( $cb_index, $content['cb_content_select'], $content );
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
       <?php design1_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( design1_get_contents() as $key => $value ) :
         design1_content_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_design1_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['design1_meta_box_nonce']) || !wp_verify_nonce($_POST['design1_meta_box_nonce'], basename(__FILE__))) {
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
    'dc1_headline','dc1_headline_font_size','dc1_headline_font_size_mobile','dc1_headline_font_color','dc1_headline_font_type',
    'dc1_catch','dc1_catch_font_size','dc1_catch_font_size_mobile','dc1_catch_font_type',
    'dc1_desc','dc1_desc_font_size','dc1_desc_font_size_mobile',
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
	if ( ! empty( $_POST['design1_content'] ) && is_array( $_POST['design1_content'] ) ) {
		$cb_contents = design1_get_contents();
		$cb_data = array();

		foreach ( $_POST['design1_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// コンテンツ１
			if ( 'content1' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_textarea_field($value['headline']);
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_type'] = sanitize_text_field( $value['headline_font_type'] );

				$value['bg_image'] = sanitize_text_field( $value['bg_image'] );
        $value['bg_use_overlay'] = ! empty( $value['bg_use_overlay'] ) ? 1 : 0;
        $value['bg_overlay_color'] = wp_filter_nohtml_kses( $value['bg_overlay_color'] );
        $value['bg_overlay_opacity'] = wp_filter_nohtml_kses( $value['bg_overlay_opacity'] );

				$value['catch'] = sanitize_textarea_field($value['catch']);
				$value['catch_font_size'] = absint( $value['catch_font_size'] );
				$value['catch_font_size_mobile'] = absint( $value['catch_font_size_mobile'] );
				$value['catch_font_color'] = sanitize_hex_color( $value['catch_font_color'] );
				$value['catch_font_type'] = sanitize_text_field( $value['catch_font_type'] );
				$value['catch_direction'] = sanitize_text_field( $value['catch_direction'] );

  for ( $i = 1; $i <= 3; $i++ ) {
				$value['item_image'.$i] = sanitize_text_field( $value['item_image'.$i] );
				$value['item_headline'.$i] = sanitize_text_field( $value['item_headline'.$i] );
				$value['item_headline_font_color'.$i] = sanitize_text_field( $value['item_headline_font_color'.$i] );
				$value['item_desc'.$i] = sanitize_text_field( $value['item_desc'.$i] );
  };

				$value['item_headline_font_size'] = absint( $value['item_headline_font_size'] );
				$value['item_headline_font_size_mobile'] = absint( $value['item_headline_font_size_mobile'] );
				$value['item_desc_font_size'] = absint( $value['item_desc_font_size'] );
				$value['item_desc_font_size_mobile'] = absint( $value['item_desc_font_size_mobile'] );

			// コンテンツ２
			} elseif ( 'content2' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_textarea_field($value['headline']);
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_type'] = sanitize_text_field( $value['headline_font_type'] );

        $value['list_catch_font_size'] = wp_filter_nohtml_kses( $value['list_catch_font_size'] );
        $value['list_catch_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_catch_font_size_mobile'] );
        $value['list_catch_font_type'] = wp_filter_nohtml_kses( $value['list_catch_font_type'] );

        $value['list_desc_font_size'] = wp_filter_nohtml_kses( $value['list_desc_font_size'] );
        $value['list_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_desc_font_size_mobile'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

			// コンテンツ３
			} elseif ( 'content3' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_textarea_field($value['headline']);
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_type'] = sanitize_text_field( $value['headline_font_type'] );

        $value['list_desc_font_size'] = wp_filter_nohtml_kses( $value['list_desc_font_size'] );
        $value['list_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_desc_font_size_mobile'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

			// フリースペース
			} elseif ( 'free_space' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

				$value['padding_top'] = sanitize_text_field( $value['padding_top'] );
				$value['padding_bottom'] = sanitize_text_field( $value['padding_bottom'] );
				$value['padding_top_mobile'] = sanitize_text_field( $value['padding_top_mobile'] );
				$value['padding_bottom_mobile'] = sanitize_text_field( $value['padding_bottom_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'design1_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'design1_content' );
		}
	}
}
add_action('save_post', 'save_design1_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function design1_get_contents() {
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __( '3 points concept content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 18,
				'headline_font_type' => 'type2',
				'bg_image' => false,
				'bg_use_overlay' => '',
				'bg_overlay_color' => '#000000',
				'bg_overlay_opacity' => '0.3',
				'catch' => '',
				'catch_font_size' => 28,
				'catch_font_size_mobile' => 24,
				'catch_font_type' => 'type3',
				'catch_font_color' => '#ffffff',
				'catch_direction' => '',
				'item_image1' => false,
				'item_image2' => false,
				'item_image3' => false,
				'item_headline1' => '',
				'item_headline2' => '',
				'item_headline3' => '',
				'item_headline_font_color1' => '#00a8cc',
				'item_headline_font_color2' => '#00a8cc',
				'item_headline_font_color3' => '#00a8cc',
				'item_desc1' => '',
				'item_desc2' => '',
				'item_desc3' => '',
				'item_headline_font_size' => 22,
				'item_headline_font_size_mobile' => 18,
				'item_desc_font_size' => 16,
				'item_desc_font_size_mobile' => 14,
			)
		),
    // コンテンツ２
		'content2' => array(
			'name' => 'content2',
			'label' => __( 'Image + text content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 18,
				'headline_font_type' => 'type2',
				'list_catch_font_size' => 22,
				'list_catch_font_size_mobile' => 18,
				'list_catch_font_type' => 'type2',
				'list_desc_font_size' => 16,
				'list_desc_font_size_mobile' => 14,
				'item_list' => array(),
			),
			'item_list_default' => array(
				'layout' => 'type1',
				'image' => '',
				'catch' => '',
				'catch_font_color' => '#00a8cc',
				'desc' => '',
				'caption' => '',
			),
		),
    // コンテンツ３
		'content3' => array(
			'name' => 'content3',
			'label' => __( 'Round image content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 18,
				'headline_font_type' => 'type2',
				'list_desc_font_size' => 16,
				'list_desc_font_size_mobile' => 14,
				'item_list' => array(),
			),
			'item_list_default' => array(
				'image' => '',
				'desc' => '',
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
				'padding_top' => '50',
				'padding_bottom' => '50',
				'padding_top_mobile' => '30',
				'padding_bottom_mobile' => '30',
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function design1_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = design1_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="design1_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
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
function design1_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $post, $font_type_options, $content_direction_options, $content_width_options;

	$cb_contents = design1_get_contents();

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';

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
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="design1_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design1_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Main image', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), $page_content_width, '400' ); ?></p>
   </div>
   <div class="image_box cf">
    <div class="cf cf_media_field hide-if-no-js">
     <input type="hidden" class="cf_media_id" name="design1_content[<?php echo $cb_index; ?>][bg_image]" id="bg_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['bg_image'] ); ?>">
     <div class="preview_field"><?php if ( $value['bg_image'] ) echo wp_get_attachment_image( $value['bg_image'], 'medium' ); ?></div>
     <div class="buttton_area">
      <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
      <input type="button" class="cfmf-delete-img button<?php if ( ! $value['bg_image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Overlay setting for main image', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="design1_content[<?php echo $cb_index; ?>][bg_use_overlay]" type="checkbox" value="1" <?php checked( $value['bg_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['bg_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="design1_content[<?php echo $cb_index; ?>][bg_overlay_color]" value="<?php echo esc_attr( $value['bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="design1_content[<?php echo $cb_index; ?>][bg_overlay_opacity]" value="<?php echo esc_attr( $value['bg_overlay_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="2" name="design1_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea($value['catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design1_content[<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php esc_attr_e( $value['catch_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="design1_content[<?php echo $cb_index; ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input name="design1_content[<?php echo $cb_index; ?>][catch_direction]" type="checkbox" value="1" <?php checked( $value['catch_direction'], 1 ); ?>><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>

   <?php for($i = 1; $i <= 3; $i++) : ?>
   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php printf(__('Content%s setting', 'tcd-w'), $i); ?></h3>
    <div class="sub_box_content">
     <h4 class="theme_option_headline2"><?php _e('Main image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width3">%1$s</span>px, Height:%2$spx.', 'tcd-w'), floor($page_content_width/3), '150' ); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="design1_content[<?php echo $cb_index; ?>][item_image<?php echo $i; ?>]" id="item_image<?php echo $i; ?>-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['item_image'.$i] ); ?>">
       <div class="preview_field"><?php if ( $value['item_image'.$i] ) echo wp_get_attachment_image( $value['item_image'.$i], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['item_image'.$i] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
     <input class="repeater-label full_width" type="text" name="design1_content[<?php echo $cb_index; ?>][item_headline<?php echo $i; ?>]" value="<?php esc_attr_e( $value['item_headline'.$i] ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="design1_content[<?php echo $cb_index; ?>][item_headline_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $value['item_headline_font_color'.$i] ); ?>" data-default-color="#00a8cc"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_desc<?php echo $i; ?>]"><?php echo esc_textarea( $value['item_desc'.$i] ); ?></textarea>
     <ul class="button_list cf">
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <?php endfor; ?>

   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][item_headline_font_size]" value="<?php esc_attr_e( $value['item_headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][item_headline_font_size_mobile]" value="<?php esc_attr_e( $value['item_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][item_desc_font_size]" value="<?php esc_attr_e( $value['item_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][item_desc_font_size_mobile]" value="<?php esc_attr_e( $value['item_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // コンテンツ２ -------------------------------------------------------------------------
      elseif ( 'content2' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="design1_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design1_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
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
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Layout setting', 'tcd-w');  ?></h4>
       <ul class="design_radio_button">
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type1" <?php checked( $repeater_value['layout'], 'type1' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1"><?php _e('Display image on left side', 'tcd-w');  ?></label>
        </li>
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type2" <?php checked( $repeater_value['layout'], 'type2' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2"><?php _e('Display image on right side', 'tcd-w');  ?></label>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width2">%1$s</span>px, Height:%2$spx.', 'tcd-w'), floor($page_content_width/2), '400' ); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"><?php echo esc_textarea(  $repeater_value['catch'] ); ?></textarea>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_color]" value="<?php echo esc_attr( $repeater_value['catch_font_color'] ); ?>" data-default-color="#00a8cc" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Caption', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="2" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][caption]"><?php echo esc_textarea(  $repeater_value['caption'] ); ?></textarea>
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
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type1" <?php checked( $repeater_value['layout'], 'type1' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1"><?php _e('Display image on left side', 'tcd-w');  ?></label>
        </li>
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type2" <?php checked( $repeater_value['layout'], 'type2' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2"><?php _e('Display image on right side', 'tcd-w');  ?></label>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width2">%1$s</span>px, Height:%2$spx.', 'tcd-w'), floor($page_content_width/2), '400' ); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"></textarea>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_color]" value="<?php echo esc_attr( $repeater_value['catch_font_color'] ); ?>" data-default-color="#00a8cc" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Caption', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="2" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][caption]"></textarea>
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
    <li class="cf"><span class="label"><?php _e('Font type of catchphrase', 'tcd-w');  ?></span>
     <select name="design1_content[<?php echo $cb_index; ?>][list_catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['list_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][list_catch_font_size]" value="<?php esc_attr_e( $value['list_catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of catchphrase (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][list_catch_font_size_mobile]" value="<?php esc_attr_e( $value['list_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][list_desc_font_size]" value="<?php esc_attr_e( $value['list_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][list_desc_font_size_mobile]" value="<?php esc_attr_e( $value['list_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // コンテンツ３ -------------------------------------------------------------------------
      elseif ( 'content3' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="design1_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design1_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Three items will be displayed in each row.', 'tcd-w');  ?></p>
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
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
        <p><?php echo __('Image will automatically resize to circle shape.', 'tcd-w'); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '220', '220'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
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
        <p><?php echo __('Image will automatically resize to circle shape.', 'tcd-w'); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '220', '220'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="design1_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
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
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][list_desc_font_size]" value="<?php esc_attr_e( $value['list_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][list_desc_font_size_mobile]" value="<?php esc_attr_e( $value['list_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
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

   <p class="hidden"><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design1_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
   <ul class="design_radio_button">
    <li>
     <input type="radio" id="dc1_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="design1_content[<?php echo $cb_index; ?>][content_width]" value="type1" <?php checked( $value['content_width'], 'type1' ); ?> />
     <label for="dc1_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><span class="page_change_image_width"><?php echo esc_attr($page_content_width); ?></span>px</label>
    </li>
    <li>
     <input type="radio" id="dc1_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="design1_content[<?php echo $cb_index; ?>][content_width]" value="type2" <?php checked( $value['content_width'], 'type2' ); ?> />
     <label for="dc1_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php _e('Full screen width', 'tcd-w');  ?></label>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'design1_content[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php esc_attr_e( $value['desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][padding_top]" value="<?php esc_attr_e( $value['padding_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][padding_bottom]" value="<?php esc_attr_e( $value['padding_bottom'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin top (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][padding_top_mobile]" value="<?php esc_attr_e( $value['padding_top_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design1_content[<?php echo $cb_index; ?>][padding_bottom_mobile]" value="<?php esc_attr_e( $value['padding_bottom_mobile'] ); ?>" /><span>px</span></li>
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
function menu_cb_tiny_mce_before_init_lp( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'menu_cb_tiny_mce_before_init_lp', 10, 2 );


