<?php

/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget(array(
	'id' => 'pb-widget-image',
	'form' => 'form_page_builder_widget_image',
	'form_rightbar' => 'form_rightbar_page_builder_widget', // 標準右サイドバー
	'display' => 'display_page_builder_widget_image',
	'title' => __('Image', 'tcd-w'),
	'priority' => 1
));

/**
 * フォーム
 */
function form_page_builder_widget_image($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_image_default_values', array(
		'widget_index' => '',
		'image' => '',
		'size' => 'full',
		'link' => '',
		'target_blank' => ''
	), 'form');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);
?>

<div class="form-field">
	<h4><?php _e('Image', 'tcd-w'); ?></h4>
	<?php
		$input_name = 'pagebuilder[widget]['.$values['widget_index'].'][image]';
		$media_id = $values['image'];
		pb_media_form($input_name, $media_id);
	?>
</div>

<div class="form-field">
	<h4><?php _e('Image size', 'tcd-w'); ?></h4>
	<select name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][size]">
		<?php
			// This filter is documented in wp-admin/includes/media.php
			$select_options = apply_filters('image_size_names_choose', array(
				'thumbnail' => __('Thumbnail size', 'tcd-w'),
				'medium'    => __('Medium size', 'tcd-w'),
				'large'     => __('Large size', 'tcd-w'),
				'full'      => __('Full size', 'tcd-w'),
			));
			foreach($select_options as $key => $value) {
				$attr = '';
				if ($values['size'] == $key) {
					$attr .= ' selected="selected"';
				}
				echo '<option value="'.esc_attr($key).'"'.$attr.'>'.esc_html($value).'</option>';
			}
		?>
	</select>
</div>

<div class="form-field">
	<h4><?php _e('Link URL for image', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][link]" value="<?php echo esc_attr($values['link']); ?>" />
</div>

<div class="form-field">
	<h4><?php _e('Link target', 'tcd-w'); ?></h4>
	<input type="hidden" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][target_blank]" value="0" />
	<label><input type="checkbox" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][target_blank]" value="1"<?php if ($values['target_blank']) echo ' checked="checked"'; ?> /> <?php _e('Use target blank for this link', 'tcd-w') ?></label>
</div>

<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_image($values = array()) {
	if (!empty($values['image'])) {
		if (!empty($values['size'])) {
			$image_size = $values['size'];
		} else {
			$image_size = 'full';
		}
		$image = wp_get_attachment_image($values['image'], $image_size);
	}
	if (empty($image)) return;

	if (!empty($values['link'])) {
		echo '<a href="'.esc_attr($values['link']).'"';
		if (!empty($values['target_blank'])) {
			echo ' target="_blank"';
		}
		echo '>';
	}

	echo $image;

	if (!empty($values['link'])) {
		echo '</a>';
	}
}
