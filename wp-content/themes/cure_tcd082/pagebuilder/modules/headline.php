<?php

/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget(array(
	'id' => 'pb-widget-headline',
	'form' => 'form_page_builder_widget_headline',
	'form_rightbar' => 'form_rightbar_page_builder_widget', // 標準右サイドバー
	'display' => 'display_page_builder_widget_headline',
	'title' => __('Headline', 'tcd-w'),
	'priority' => 6
));

/**
 * フォーム
 */
function form_page_builder_widget_headline($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_headline_default_values', array(
		'widget_index' => '',
		'headline' => '',
		'font_size' => '20',
		'font_size_mobile' => '20',
		'font_color' => '#333333',
		'font_family' => 'type1',
		'text_align' => 'left'
	), 'form');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);

	// 旧カラーピッカー対策
	if (preg_match('/^[0-9a-f]{6}$/i', $values['font_color'])) {
		$values['font_color'] = '#'.strtolower($values['font_color']);
	}
?>

<div class="form-field">
	<h4><?php _e('Headline', 'tcd-w'); ?></h4>
	<textarea name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][headline]" rows="4"><?php echo esc_textarea($values['headline']); ?></textarea>
</div>

<div class="form-field">
	<h4><?php _e('Font size', 'tcd-w'); ?></h4>
	<input type="number" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][font_size]" value="<?php echo esc_attr($values['font_size']); ?>" class="small-text" min="0" /> px
</div>

<div class="form-field">
	<h4><?php _e('Font size for mobile', 'tcd-w'); ?></h4>
	<input type="number" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][font_size_mobile]" value="<?php echo esc_attr($values['font_size_mobile']); ?>" class="small-text" min="0" /> px
</div>

<div class="form-field">
	<h4><?php _e('Font color', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][font_color]" value="<?php echo esc_attr($values['font_color']); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['font_color']); ?>" />
</div>

<div class="form-field">
	<h4><?php _e('Font family', 'tcd-w'); ?></h4>
	<select name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][font_family]">
		<?php
			$select_options = array(
				'type1' => __('Meiryo', 'tcd-w'),
				'type2' => __('YuGothic', 'tcd-w'),
				'type3' => __('YuMincho', 'tcd-w'),
			);
			foreach($select_options as $key => $value) {
				$attr = '';
				if ($values['font_family'] == $key) {
					$attr .= ' selected="selected"';
				}
				echo '<option value="'.esc_attr($key).'"'.$attr.'>'.esc_html($value).'</option>';
			}
		?>
	</select>
</div>

<div class="form-field form-field-radio">
	<h4><?php _e('Text align', 'tcd-w'); ?></h4>
	<?php
		$radio_options = array(
			'left' => __('Align left', 'tcd-w'),
			'center' => __('Align center', 'tcd-w'),
			'right' => __('Align right', 'tcd-w')
		);
		$radio_html = array();
		foreach($radio_options as $key => $value) {
			$attr = '';
			if ($values['text_align'] == $key) {
				$attr .= ' checked="checked"';
			}
			$radio_html[] = '<label><input type="radio" name="pagebuilder[widget]['.esc_attr($values['widget_index']).'][text_align]" value="'.esc_attr($key).'"'.$attr.' />'.esc_html($value).'</label>';
		}
		echo implode("<br>\n\t", $radio_html);
	?>
</div>

<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_headline($values = array()) {
	if (empty($values['headline'])) return;

	$class = 'pb_headline';
	$style = '';

	if (!empty($values['font_size'])) {
		$style .= 'font-size:'.$values['font_size'].'px;';
	}
	if (!empty($values['font_color'])) {
		// 旧カラーピッカー対策
		if (preg_match('/^[0-9a-f]{6}$/i', $values['font_color'])) {
			$values['font_color'] = '#'.$values['font_color'];
		}
		$style .= ' color:'.$values['font_color'].';';
	}
	if (!empty($values['text_align'])) {
		$style .= ' text-align:'.$values['text_align'].';';
	}
	if (!empty($values['font_family'])) {
		$class .= ' pb_font_family_'.$values['font_family'];
	}

	echo '<h3 class="'.$class.'" style="'.trim($style).'">'.str_replace(array("\r\n", "\r", "\n"), '<br>', esc_html($values['headline'])).'</h3>';
}

/**
 * フロント用css
 */
function page_builder_widget_headline_sctipts_styles() {
	if (is_singular() && is_page_builder() && page_builder_has_widget('pb-widget-headline')) {
		add_action('page_builder_css', 'page_builder_widget_headline_css');
	}
}
add_action('wp', 'page_builder_widget_headline_sctipts_styles');

function page_builder_widget_headline_css() {
	// 現記事で使用しているheadlineコンテンツデータを取得
	$post_widgets = get_page_builder_post_widgets(get_the_ID(), 'pb-widget-headline');
	if ($post_widgets) {

		$css_mobile = '';

		foreach($post_widgets as $post_widget) {
			$widget_index = $post_widget['widget_index'];
			$values = $post_widget['widget_value'];

			$css_mobile .= '  '.$post_widget['css_class'].' .pb_headline { font-size: '.esc_attr($values['font_size_mobile']).'px !important; }'."\n";
		}

		echo "@media only screen and (max-width: 767px) {\n";
		echo $css_mobile;
		echo "}\n";

	}
}
