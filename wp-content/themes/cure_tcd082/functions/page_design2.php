<?php

function design2_meta_box() {
  $options = get_design_plus_option();
  add_meta_box(
    'design2_meta_box',//ID of meta box
    __('Staff page setting', 'tcd-w'),//label
    'show_design2_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'design2_meta_box');

function show_design2_meta_box() {

  global $post, $font_type_options;

  $dc2_headline = get_post_meta($post->ID, 'dc2_headline', true);
  $dc2_headline_font_size = get_post_meta($post->ID, 'dc2_headline_font_size', true) ?  get_post_meta($post->ID, 'dc2_headline_font_size', true) : '14';
  $dc2_headline_font_size_mobile = get_post_meta($post->ID, 'dc2_headline_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_headline_font_size_mobile', true) : '12';
  $dc2_headline_font_color = get_post_meta($post->ID, 'dc2_headline_font_color', true) ?  get_post_meta($post->ID, 'dc2_headline_font_color', true) : '#00a6cc';
  $dc2_headline_font_type = get_post_meta($post->ID, 'dc2_headline_font_type', true) ?  get_post_meta($post->ID, 'dc2_headline_font_type', true) : 'type2';

  $dc2_catch = get_post_meta($post->ID, 'dc2_catch', true);
  $dc2_catch_font_size = get_post_meta($post->ID, 'dc2_catch_font_size', true) ?  get_post_meta($post->ID, 'dc2_catch_font_size', true) : '38';
  $dc2_catch_font_size_mobile = get_post_meta($post->ID, 'dc2_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_catch_font_size_mobile', true) : '24';
  $dc2_catch_font_type = get_post_meta($post->ID, 'dc2_catch_font_type', true) ?  get_post_meta($post->ID, 'dc2_catch_font_type', true) : 'type3';

  $dc2_desc = get_post_meta($post->ID, 'dc2_desc', true);
  $dc2_desc_font_size = get_post_meta($post->ID, 'dc2_desc_font_size', true) ?  get_post_meta($post->ID, 'dc2_desc_font_size', true) : '16';
  $dc2_desc_font_size_mobile = get_post_meta($post->ID, 'dc2_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_desc_font_size_mobile', true) : '14';

  // コンテンツビルダー
  $design2_content = get_post_meta( $post->ID, 'design2_content', true );

  echo '<input type="hidden" name="design2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

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
     <input class="full_width" type="text" name="dc2_headline" value="<?php echo esc_attr( $dc2_headline ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dc2_headline_font_type">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $dc2_headline_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc2_headline_font_size" value="<?php esc_attr_e( $dc2_headline_font_size ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc2_headline_font_size_mobile" value="<?php esc_attr_e( $dc2_headline_font_size_mobile ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dc2_headline_font_color" value="<?php echo esc_attr( $dc2_headline_font_color ); ?>" data-default-color="#00a6cc" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dc2_catch"><?php echo esc_textarea(  $dc2_catch ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dc2_catch_font_type">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $dc2_catch_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc2_catch_font_size" value="<?php esc_attr_e( $dc2_catch_font_size ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc2_catch_font_size_mobile" value="<?php esc_attr_e( $dc2_catch_font_size_mobile ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dc2_desc"><?php echo esc_textarea(  $dc2_desc ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc2_desc_font_size" value="<?php esc_attr_e( $dc2_desc_font_size ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dc2_desc_font_size_mobile" value="<?php esc_attr_e( $dc2_desc_font_size_mobile ); ?>" /><span>px</span></li>
     </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <?php echo __( '<p>STEP1: Click add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
  <?php echo __( '<p>Margins will be automatically adjusted and displayed where the content is not set. You do not have to enter all the content.</p>', 'tcd-w' ); ?>
  <p class="rebox_group preview_page_image"><a href="<?php bloginfo('template_url'); ?>/admin/img/staff.jpg"><?php _e( 'Preview page image', 'tcd-w' ); ?></a></p>
 </div>

 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $design2_content && is_array( $design2_content ) ) :
         foreach( $design2_content as $key => $content ) :
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
          design2_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            design2_content_content_setting( $cb_index, $content['cb_content_select'], $content );
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
       <?php design2_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( design2_get_contents() as $key => $value ) :
         design2_content_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_design2_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['design2_meta_box_nonce']) || !wp_verify_nonce($_POST['design2_meta_box_nonce'], basename(__FILE__))) {
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
    'dc2_headline','dc2_headline_font_size','dc2_headline_font_size_mobile','dc2_headline_font_color','dc2_headline_font_type',
    'dc2_catch','dc2_catch_font_size','dc2_catch_font_size_mobile','dc2_catch_font_type',
    'dc2_desc','dc2_desc_font_size','dc2_desc_font_size_mobile',
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
	if ( ! empty( $_POST['design2_content'] ) && is_array( $_POST['design2_content'] ) ) {
		$cb_contents = design2_get_contents();
		$cb_data = array();

		foreach ( $_POST['design2_content'] as $key => $value ) {
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

				$value['display_author'] = absint($value['display_author']);

				$value['bg_color'] = sanitize_hex_color( $value['bg_color'] );

				$value['author_position_font_size'] = absint( $value['author_position_font_size'] );
				$value['author_position_font_size_mobile'] = absint( $value['author_position_font_size_mobile'] );
				$value['author_title_font_size'] = absint( $value['author_title_font_size'] );
				$value['author_title_font_size_mobile'] = absint( $value['author_title_font_size_mobile'] );
				$value['author_sub_title_font_size'] = absint( $value['author_sub_title_font_size'] );
				$value['author_sub_title_font_size_mobile'] = absint( $value['author_sub_title_font_size_mobile'] );
				$value['author_desc_font_size'] = absint( $value['author_desc_font_size'] );
				$value['author_desc_font_size_mobile'] = absint( $value['author_desc_font_size_mobile'] );
				$value['author_title_font_type'] = sanitize_text_field( $value['author_title_font_type'] );

			// コンテンツ２
			} elseif ( 'content2' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_textarea_field($value['headline']);
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_type'] = sanitize_text_field( $value['headline_font_type'] );

				$value['layout'] = sanitize_text_field($value['layout']);

				$value['bg_color'] = sanitize_hex_color( $value['bg_color'] );

				$value['author_position_font_size'] = absint( $value['author_position_font_size'] );
				$value['author_position_font_size_mobile'] = absint( $value['author_position_font_size_mobile'] );
				$value['author_position_font_color'] = sanitize_hex_color( $value['author_position_font_color'] );
				$value['author_position_border_color'] = sanitize_hex_color( $value['author_position_border_color'] );
				$value['author_position_bg_color'] = sanitize_hex_color( $value['author_position_bg_color'] );
				$value['author_title_font_size'] = absint( $value['author_title_font_size'] );
				$value['author_title_font_size_mobile'] = absint( $value['author_title_font_size_mobile'] );
				$value['author_sub_title_font_size'] = absint( $value['author_sub_title_font_size'] );
				$value['author_sub_title_font_size_mobile'] = absint( $value['author_sub_title_font_size_mobile'] );
				$value['author_desc_font_size'] = absint( $value['author_desc_font_size'] );
				$value['author_desc_font_size_mobile'] = absint( $value['author_desc_font_size_mobile'] );
				$value['author_title_font_type'] = sanitize_text_field( $value['author_title_font_type'] );

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
			update_post_meta( $post_id, 'design2_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'design2_content' );
		}
	}
}
add_action('save_post', 'save_design2_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function design2_get_contents() {
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __( 'Representative member contents', 'tcd-w' ),
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
				'display_author' => '',
				'bg_color' => '#f5f5f5',
				'author_position_font_size' => 14,
				'author_position_font_size_mobile' => 12,
				'author_title_font_size' => 22,
				'author_title_font_size_mobile' => 18,
				'author_sub_title_font_size' => 14,
				'author_sub_title_font_size_mobile' => 12,
				'author_desc_font_size' => 16,
				'author_desc_font_size_mobile' => 14,
				'author_title_font_type' => 'type2',
			)
		),
    // コンテンツ２
		'content2' => array(
			'name' => 'content2',
			'label' => __( 'User list', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 18,
				'headline_font_type' => 'type2',
				'layout' => 'type1',
				'bg_color' => '#f5f5f5',
				'author_position_font_size' => 14,
				'author_position_font_size_mobile' => 12,
				'author_position_font_color' => '#00a7ce',
				'author_position_border_color' => '#01a7ce',
				'author_position_bg_color' => '#ffffff',
				'author_title_font_size' => 22,
				'author_title_font_size_mobile' => 18,
				'author_sub_title_font_size' => 14,
				'author_sub_title_font_size_mobile' => 12,
				'author_desc_font_size' => 16,
				'author_desc_font_size_mobile' => 14,
				'author_title_font_type' => 'type2',
				'item_list' => array(),
			),
			'item_list_default' => array(
				'display_author' => ''
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
function design2_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = design2_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="design2_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
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
function design2_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $post, $font_type_options, $content_direction_options, $content_width_options;

	$cb_contents = design2_get_contents();

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

   <p class="hidden"><input name="design2_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design2_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="design2_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design2_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Main image', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), $page_content_width, '400' ); ?></p>
   </div>
   <div class="image_box cf">
    <div class="cf cf_media_field hide-if-no-js">
     <input type="hidden" class="cf_media_id" name="design2_content[<?php echo $cb_index; ?>][bg_image]" id="bg_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['bg_image'] ); ?>">
     <div class="preview_field"><?php if ( $value['bg_image'] ) echo wp_get_attachment_image( $value['bg_image'], 'medium' ); ?></div>
     <div class="buttton_area">
      <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
      <input type="button" class="cfmf-delete-img button<?php if ( ! $value['bg_image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Overlay setting for main image', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="design2_content[<?php echo $cb_index; ?>][bg_use_overlay]" type="checkbox" value="1" <?php checked( $value['bg_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['bg_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="design2_content[<?php echo $cb_index; ?>][bg_overlay_color]" value="<?php echo esc_attr( $value['bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="design2_content[<?php echo $cb_index; ?>][bg_overlay_opacity]" value="<?php echo esc_attr( $value['bg_overlay_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="2" name="design2_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea($value['catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design2_content[<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php esc_attr_e( $value['catch_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="design2_content[<?php echo $cb_index; ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font direction', 'tcd-w'); ?></span><input name="design2_content[<?php echo $cb_index; ?>][catch_direction]" type="checkbox" value="1" <?php checked( $value['catch_direction'], 1 ); ?>><?php _e( 'Display vertically', 'tcd-w' ); ?></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('User setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php echo __('Please register user information from user profile page.', 'tcd-w'); ?></p>
   </div>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('User', 'tcd-w'); ?></span>
     <?php
         $users = get_users(array(
           'fields' => array('ID','display_name'),
           'role__not_in' => array('subscriber'),
           'orderby' => 'ID',
           'order' => 'ASC'
         ));
         if(!empty($users)){
     ?>
     <select name="design2_content[<?php echo $cb_index; ?>][display_author]">
      <?php
           foreach ( $users as $key => $user ) {
             $user_id = $user->ID;
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($user_id); ?>" <?php selected( $value['display_author'], $user_id ); ?>><?php echo esc_attr($user->display_name); ?></option>
      <?php }; ?>
     </select>
     <?php }; ?>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of official position', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_font_size]" value="<?php esc_attr_e( $value['author_position_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of official position (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_font_size_mobile]" value="<?php esc_attr_e( $value['author_position_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of name', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_title_font_size]" value="<?php esc_attr_e( $value['author_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of name (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_title_font_size_mobile]" value="<?php esc_attr_e( $value['author_title_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font type of name', 'tcd-w');  ?></span>
     <select name="design2_content[<?php echo $cb_index; ?>][author_title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['author_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of subtitle', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_sub_title_font_size]" value="<?php esc_attr_e( $value['author_sub_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of subtitle (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_sub_title_font_size_mobile]" value="<?php esc_attr_e( $value['author_sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of message', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_desc_font_size]" value="<?php esc_attr_e( $value['author_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of message (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_desc_font_size_mobile]" value="<?php esc_attr_e( $value['author_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-w');  ?></h4>
   <p class="color_picker_bottom"><input type="text" name="design2_content[<?php echo $cb_index; ?>][bg_color]" value="<?php echo esc_attr( $value['bg_color'] ); ?>" data-default-color="#f5f5f5" class="c-color-picker"></p>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // コンテンツ２ -------------------------------------------------------------------------
      elseif ( 'content2' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content cb_user_list">

   <p class="hidden"><input name="design2_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design2_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="design2_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="design2_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Layout setting', 'tcd-w');  ?></h4>
   <ul class="design_radio_button">
    <li>
     <input type="radio" id="layout_<?php echo $cb_index; ?>_type1" name="design2_content[<?php echo $cb_index; ?>][layout]" value="type1" <?php checked( $value['layout'], 'type1' ); ?> />
     <label for="layout_<?php echo $cb_index; ?>_type1"><?php _e('Display large image', 'tcd-w');  ?></label>
    </li>
    <li>
     <input type="radio" id="layout_<?php echo $cb_index; ?>_type2" name="design2_content[<?php echo $cb_index; ?>][layout]" value="type2" <?php checked( $value['layout'], 'type2' ); ?> />
     <label for="layout_<?php echo $cb_index; ?>_type2"><?php _e('Display small image', 'tcd-w');  ?></label>
    </li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('User list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new user button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'User', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'User setting', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php echo __('Please register user information from user profile page.', 'tcd-w'); ?></p>
       </div>
       <?php
            $users = get_users(array(
              'fields' => array('ID','display_name'),
              'role__not_in' => array('subscriber'),
              'orderby' => 'ID',
              'order' => 'ASC'
            ));
            if(!empty($users)){
       ?>
       <select class="user_list_label" name="design2_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][display_author]">
        <?php
             foreach ( $users as $key => $user ) {
               $user_id = $user->ID;
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($user_id); ?>" <?php selected( $repeater_value['display_author'], $user_id ); ?>><?php echo esc_attr($user->display_name); ?></option>
        <?php }; ?>
       </select>
       <?php }; ?>
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete user', 'tcd-w' ); ?></a></li>
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
      <h4 class="theme_option_subbox_headline"><?php _e( 'New user', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'User setting', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php echo __('Please register user information from user profile page.', 'tcd-w'); ?></p>
       </div>
       <?php
            $users = get_users(array(
              'fields' => array('ID','display_name'),
              'role__not_in' => array('subscriber'),
              'orderby' => 'ID',
              'order' => 'ASC'
            ));
            if(!empty($users)){
       ?>
       <select class="user_list_label" name="design2_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][display_author]">
        <?php
             foreach ( $users as $key => $user ) {
               $user_id = $user->ID;
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($user_id); ?>" <?php selected( $repeater_value['display_author'], $user_id ); ?>><?php echo esc_attr($user->display_name); ?></option>
        <?php }; ?>
       </select>
       <?php }; ?>
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete user', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add user', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>

   <h4 class="theme_option_headline2"><?php _e('Font setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size of official position', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_font_size]" value="<?php esc_attr_e( $value['author_position_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of official position (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_font_size_mobile]" value="<?php esc_attr_e( $value['author_position_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of name', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_title_font_size]" value="<?php esc_attr_e( $value['author_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of name (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_title_font_size_mobile]" value="<?php esc_attr_e( $value['author_title_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font type of name', 'tcd-w');  ?></span>
     <select name="design2_content[<?php echo $cb_index; ?>][author_title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['author_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of subtitle', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_sub_title_font_size]" value="<?php esc_attr_e( $value['author_sub_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of subtitle (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_sub_title_font_size_mobile]" value="<?php esc_attr_e( $value['author_sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of message', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_desc_font_size]" value="<?php esc_attr_e( $value['author_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of message (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][author_desc_font_size_mobile]" value="<?php esc_attr_e( $value['author_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Color setting for official position', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_font_color]" value="<?php echo esc_attr( $value['author_position_font_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_bg_color]" value="<?php echo esc_attr( $value['author_position_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="design2_content[<?php echo $cb_index; ?>][author_position_border_color]" value="<?php echo esc_attr( $value['author_position_border_color'] ); ?>" data-default-color="#01a7ce" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-w');  ?></h4>
   <p class="color_picker_bottom"><input type="text" name="design2_content[<?php echo $cb_index; ?>][bg_color]" value="<?php echo esc_attr( $value['bg_color'] ); ?>" data-default-color="#f5f5f5" class="c-color-picker"></p>

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

   <p class="hidden"><input name="design2_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="design2_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
   <ul class="design_radio_button">
    <li>
     <input type="radio" id="dc2_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="design2_content[<?php echo $cb_index; ?>][content_width]" value="type1" <?php checked( $value['content_width'], 'type1' ); ?> />
     <label for="dc2_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><span class="page_change_image_width"><?php echo esc_attr($page_content_width); ?></span>px</label>
    </li>
    <li>
     <input type="radio" id="dc2_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="design2_content[<?php echo $cb_index; ?>][content_width]" value="type2" <?php checked( $value['content_width'], 'type2' ); ?> />
     <label for="dc2_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php _e('Full screen width', 'tcd-w');  ?></label>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'design2_content[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php esc_attr_e( $value['desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][padding_top]" value="<?php esc_attr_e( $value['padding_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][padding_bottom]" value="<?php esc_attr_e( $value['padding_bottom'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin top (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][padding_top_mobile]" value="<?php esc_attr_e( $value['padding_top_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="design2_content[<?php echo $cb_index; ?>][padding_bottom_mobile]" value="<?php esc_attr_e( $value['padding_bottom_mobile'] ); ?>" /><span>px</span></li>
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

