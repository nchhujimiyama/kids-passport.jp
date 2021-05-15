<?php
// 表示するCTAのセレクトボックス（記事下・フッター兼用）
global $cta_display_options;
$cta_display_options = array(
	1 => array( 'value' => 1, 'label' => 'CTA-A' ),
	2 => array( 'value' => 2, 'label' => 'CTA-B' ),
	3 => array( 'value' => 3, 'label' => 'CTA-C' ),
	4 => array( 'value' => 4, 'label' => 'ランダム表示' ),
	5 => array( 'value' => 5, 'label' => '非表示' )
);

global $footer_cta_type_options;
$footer_cta_type_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Template', 'tcd-w' ), ),
);




/*
 * マーケティングの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_marketing_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_marketing_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_marketing_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_marketing_theme_options_validate' );


// タブの名前
function add_marketing_tab_label( $tab_labels ) {
	$tab_labels['marketing'] = 'マーケティング';
	return $tab_labels;
}


// 初期値
function add_marketing_dp_default_options( $dp_default_options ) {

	$dp_default_options['cta_display'] = 5;

	$dp_default_options['footer_cta_display'] = 5;
	$dp_default_options['footer_cta_hide_on_front'] = 0;

	for ( $i = 1; $i<= 3; $i++ ) {
		$dp_default_options['cta_type' . $i] = 'type1';

		$dp_default_options['cta_type1_catch' . $i] = '';
		$dp_default_options['cta_type1_catch_font_size' . $i] = 22;
		$dp_default_options['cta_type1_btn_label' . $i] = '';
		$dp_default_options['cta_type1_btn_url' . $i] = '';
		$dp_default_options['cta_type1_btn_target' . $i] = 0;
		$dp_default_options['cta_type1_btn_bg' . $i] = '#004c66';
		$dp_default_options['cta_type1_btn_bg_hover' . $i] = '#444444';
		$dp_default_options['cta_type1_image' . $i] = '';
		$dp_default_options['cta_type1_image_sp' . $i] = '';

		$dp_default_options['cta_type2_catch' . $i] = '';
		$dp_default_options['cta_type2_catch_font_size' . $i] = 30;
		$dp_default_options['cta_type2_btn_label' . $i] = '';
		$dp_default_options['cta_type2_btn_url' . $i] = '';
		$dp_default_options['cta_type2_btn_target' . $i] = 0;
		$dp_default_options['cta_type2_btn_bg' . $i] = '#004c66';
		$dp_default_options['cta_type2_btn_bg_hover' . $i] = '#444444';
		$dp_default_options['cta_type2_image' . $i] = '';
		$dp_default_options['cta_type2_image_sp' . $i] = '';
		$dp_default_options['cta_type2_overlay' . $i] = '#000000';
		$dp_default_options['cta_type2_overlay_opacity' . $i] = 0.5;

		$dp_default_options['cta_type3_layout' . $i] = 'type1';
		$dp_default_options['cta_type3_catch' . $i] = '';
		$dp_default_options['cta_type3_catch_font_size' . $i] = 21;
		$dp_default_options['cta_type3_desc' . $i] = '';
		$dp_default_options['cta_type3_desc_font_size' . $i] = 14;
		$dp_default_options['cta_type3_btn_label' . $i] = '';
		$dp_default_options['cta_type3_btn_url' . $i] = '';
		$dp_default_options['cta_type3_btn_target' . $i] = 0;
		$dp_default_options['cta_type3_btn_bg' . $i] = '#004c66';
		$dp_default_options['cta_type3_btn_bg_hover' . $i] = '#444444';
		$dp_default_options['cta_type3_image' . $i] = '';
		$dp_default_options['cta_type3_image_sp' . $i] = '';

		$dp_default_options['cta_random' . $i] = 0;

		$dp_default_options['footer_cta_type' . $i] = 'type1';
		$dp_default_options['footer_cta_catch' . $i] = '';
		$dp_default_options['footer_cta_catch_font_color' . $i] = '#ffffff';
		$dp_default_options['footer_cta_desc' . $i] = '';
		$dp_default_options['footer_cta_desc_font_color' . $i] = '#999999';
		$dp_default_options['footer_cta_btn_label' . $i] = '';
		$dp_default_options['footer_cta_btn_url' . $i] = '';
		$dp_default_options['footer_cta_btn_target' . $i] = 0;
		$dp_default_options['footer_cta_btn_font_color' . $i] = '#ffffff';
		$dp_default_options['footer_cta_btn_font_color_hover' . $i] = '#ffffff';
		$dp_default_options['footer_cta_btn_bg_color' . $i] = '#004c66';
		$dp_default_options['footer_cta_btn_bg_color_hover' . $i] = '#444444';
		$dp_default_options['footer_cta_bg' . $i] = '#000000';
		$dp_default_options['footer_cta_bg_opacity' . $i] = 1;
		$dp_default_options['footer_cta_editor' . $i] = '';
		$dp_default_options['footer_cta_random' . $i] = 0;
	}

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_marketing_tab_panel( $options ) {

  global $dp_default_options, $cta_type_options, $cta_type3_layout_options, $cta_display_options, $footer_cta_type_options;

?>

<div id="tab-content-marketing" class="tab-content">

   <?php // フッターCTA -------------------------------------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline">フッターCTA</h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p>ページをスクロールした際にフッター最下部に表示されるCTAの設定を行います。</p>
      <p>最大３つまで登録することができます。</p>
     </div>

     <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline">CTA-<?php echo 1 === $i ? 'A' : ( 2 === $i ? 'B' : 'C' ); ?></h3>
      <div class="sub_box_content">

       <h5 class="theme_option_headline2">CTAのタイプ</h5>
       <?php foreach( $footer_cta_type_options as $option ) : ?>
       <p><label><input type="radio" class="cta-type" name="dp_options[footer_cta_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['footer_cta_type' . $i] ); ?>> <?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
       <?php endforeach; ?>

       <?php // cta-type1 ------------------------------------ ?>
       <div class="cta-type1-content cta-content <?php if ( 'type1' !== $options['footer_cta_type' . $i] ) { echo 'u-hidden'; } ?>">
        <h6 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h6>
        <p>スマートフォンの表示では改行が適用されます。</p>
        <textarea name="dp_options[footer_cta_catch<?php echo $i; ?>]" class="large-text"><?php echo esc_textarea( $options['footer_cta_catch' . $i] ); ?></textarea>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_cta_catch_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_catch_font_color'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        </ul>
        <h6 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h6>
        <textarea name="dp_options[footer_cta_desc<?php echo $i; ?>]" class="large-text"><?php echo esc_textarea( $options['footer_cta_desc' . $i] ); ?></textarea>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_cta_desc_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_desc_font_color'.$i] ); ?>" data-default-color="#999999" class="c-color-picker"></li>
        </ul>
        <h6 class="theme_option_headline2"><?php _e( 'Button settings', 'tcd-w' ); ?></h6>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_cta_btn_label<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_cta_btn_label'.$i] ); ?>" /></li>
         <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_cta_btn_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_cta_btn_url'.$i] ); ?>" /></li>
         <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[footer_cta_btn_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_cta_btn_target'.$i], 1 ); ?>></li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_cta_btn_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_btn_font_color'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
         <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_cta_btn_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_btn_bg_color'.$i] ); ?>" data-default-color="#004c66" class="c-color-picker"></li>
         <li class="cf"><span class="label">カーソルを合わせた時の文字色</span><input type="text" name="dp_options[footer_cta_btn_font_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_btn_font_color_hover'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
         <li class="cf"><span class="label">カーソルを合わせた時の背景色</span><input type="text" name="dp_options[footer_cta_btn_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_btn_bg_color_hover'.$i] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
        </ul>
        <h6 class="theme_option_headline2"><?php _e( 'Background color settings', 'tcd-w' ); ?></h6>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_cta_bg<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_bg'.$i] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
         <li class="cf"><span class="label">背景色の透明度</span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_cta_bg_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_cta_bg_opacity'.$i] ); ?>" /><p>0.1から0.9までの数値を入力してください。数字が小さくなるほど、より透明になります。</p></li>
        </ul>
        <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
       </div><!-- END .cta-type1-content -->
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php endfor; ?>

     <?php // 表示設定 --------------------------------------------- ?>
     <h4 class="theme_option_headline2">表示設定</h4>
     <div class="theme_option_message2">
      <p>表示するフッターCTAを選択してください。</p>
      <p>※フッターCTAを選択すると、スマホ用固定フッターバーは非表示となります。</p>
     </div>
     <select id="js-footer-cta-display" name="dp_options[footer_cta_display]">
      <?php foreach ( $cta_display_options as $option ) : ?>
      <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['footer_cta_display'] ); ?>><?php esc_html_e( $option['label'] ); ?></option>
      <?php endforeach; ?>
     </select>
     <p><label><input type="checkbox" name="dp_options[footer_cta_hide_on_front]" value="1" <?php checked( 1, $options['footer_cta_hide_on_front'] ); ?>> トップページのみ表示しない</label></p>

     <?php // ランダムの設定 --------------------------------------------- ?>
     <div id="js-footer-cta-random-display" class="<?php if ( '4' !== $options['footer_cta_display'] ) { echo 'u-hidden'; } ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Random display', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Please select CTA to use in random display.', 'tcd-w' ); ?></p>
      <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
      <p><label><input type="checkbox" name="dp_options[footer_cta_random<?php echo $i; ?>]" value="1" <?php checked( 1, $options['footer_cta_random' . $i] ); ?>>CTA-<?php echo 1 === $i ? 'A' : ( 2 === $i ? 'B' : 'C' ); ?></label></p>
      <?php endfor; ?>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<script>
// CTA
jQuery(function($) {
    var ctaType = $('.cta-type');
	var ctaContent = $('.cta-content');
	ctaType.click(function() {
		var parent = $(this).parents('.sub_box');
		parent.find('.cta-content').hide();
		parent.find('.cta-' + $(this).val() + '-content').show();
	});

	// CTA セレクトボックスでランダム表示を選択した時のみ表示
	$('#js-cta-display').change(function() {
		if ('4' === $(this).val()) {
			$('#js-cta-random-display').removeClass('u-hidden');
		} else {
			$('#js-cta-random-display').addClass('u-hidden');
		}
	});
	$('#js-footer-cta-display').change(function() {
		if ('4' === $(this).val()) {
			$('#js-footer-cta-random-display').removeClass('u-hidden');
		} else {
			$('#js-footer-cta-random-display').addClass('u-hidden');
		}
	});
});
</script>
<style>
.u-hidden { display: none; }
</style>
<?php
} // END add_marketing_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_marketing_theme_options_validate( $input ) {

  global $dp_default_options, $cta_type_options, $cta_type3_layout_options, $cta_display_options, $footer_cta_type_options;


	for ( $i = 1; $i <= 3; $i++ ) {

 		if ( ! isset( $input['cta_type' . $i] ) ) $input['cta_type' . $i] = null;
 		if ( ! array_key_exists( $input['cta_type' . $i], $cta_type_options ) ) $input['cta_type' . $i] = null;

    // CTA type1
		$input['cta_type1_catch' . $i] = $input['cta_type1_catch' . $i]; // HTML対応
		$input['cta_type1_catch_font_size' . $i] = wp_filter_nohtml_kses( $input['cta_type1_catch_font_size' . $i] );
		$input['cta_type1_btn_label' . $i] = wp_filter_nohtml_kses( $input['cta_type1_btn_label' . $i] );
		$input['cta_type1_btn_url' . $i] = wp_filter_nohtml_kses( $input['cta_type1_btn_url' . $i] );
 		if ( ! isset( $input['cta_type1_btn_target' . $i] ) ) $input['cta_type1_btn_target' . $i] = null;
  	$input['cta_type1_btn_target' . $i] = ( $input['cta_type1_btn_target' . $i] == 1 ? 1 : 0 );
		$input['cta_type1_btn_bg' . $i] = wp_filter_nohtml_kses( $input['cta_type1_btn_bg' . $i] );
		$input['cta_type1_btn_bg_hover' . $i] = wp_filter_nohtml_kses( $input['cta_type1_btn_bg_hover' . $i] );
		$input['cta_type1_image' . $i] = wp_filter_nohtml_kses( $input['cta_type1_image' . $i] );
		$input['cta_type1_image_sp' . $i] = wp_filter_nohtml_kses( $input['cta_type1_image_sp' . $i] );

    // CTA type2
		$input['cta_type2_catch' . $i] = $input['cta_type2_catch' . $i]; // HTML対応
		$input['cta_type2_catch_font_size' . $i] = wp_filter_nohtml_kses( $input['cta_type2_catch_font_size' . $i] );
		$input['cta_type2_btn_label' . $i] = wp_filter_nohtml_kses( $input['cta_type2_btn_label' . $i] );
		$input['cta_type2_btn_url' . $i] = wp_filter_nohtml_kses( $input['cta_type2_btn_url' . $i] );
 		if ( ! isset( $input['cta_type2_btn_target' . $i] ) ) $input['cta_type2_btn_target' . $i] = null;
  	$input['cta_type2_btn_target' . $i] = ( $input['cta_type2_btn_target' . $i] == 1 ? 1 : 0 );
		$input['cta_type2_btn_bg' . $i] = wp_filter_nohtml_kses( $input['cta_type2_btn_bg' . $i] );
		$input['cta_type2_btn_bg_hover' . $i] = wp_filter_nohtml_kses( $input['cta_type2_btn_bg_hover' . $i] );
		$input['cta_type2_image' . $i] = wp_filter_nohtml_kses( $input['cta_type2_image' . $i] );
		$input['cta_type2_image_sp' . $i] = wp_filter_nohtml_kses( $input['cta_type2_image_sp' . $i] );
		$input['cta_type2_overlay' . $i] = wp_filter_nohtml_kses( $input['cta_type2_overlay' . $i] );
		$input['cta_type2_overlay_opacity' . $i] = wp_filter_nohtml_kses( $input['cta_type2_overlay_opacity' . $i] );

    // CTA type3
 		if ( ! isset( $input['cta_type3_layout' . $i] ) ) $input['cta_type3_layout' . $i] = null;
 		if ( ! array_key_exists( $input['cta_type3_layout' . $i], $cta_type3_layout_options ) ) $input['cta_type3_layout' . $i] = null;
		$input['cta_type3_catch' . $i] = $input['cta_type3_catch' . $i]; // HTML対応
		$input['cta_type3_desc' . $i] = $input['cta_type3_desc' . $i]; // HTML対応
		$input['cta_type3_catch_font_size' . $i] = wp_filter_nohtml_kses( $input['cta_type3_catch_font_size' . $i] );
		$input['cta_type3_desc_font_size' . $i] = wp_filter_nohtml_kses( $input['cta_type3_desc_font_size' . $i] );
		$input['cta_type3_btn_label' . $i] = wp_filter_nohtml_kses( $input['cta_type3_btn_label' . $i] );
		$input['cta_type3_btn_url' . $i] = wp_filter_nohtml_kses( $input['cta_type3_btn_url' . $i] );
 		if ( ! isset( $input['cta_type3_btn_target' . $i] ) ) $input['cta_type3_btn_target' . $i] = null;
  	$input['cta_type3_btn_target' . $i] = ( $input['cta_type3_btn_target' . $i] == 1 ? 1 : 0 );
		$input['cta_type3_btn_bg' . $i] = wp_filter_nohtml_kses( $input['cta_type3_btn_bg' . $i] );
		$input['cta_type3_btn_bg_hover' . $i] = wp_filter_nohtml_kses( $input['cta_type3_btn_bg_hover' . $i] );
		$input['cta_type3_image' . $i] = wp_filter_nohtml_kses( $input['cta_type3_image' . $i] );
		$input['cta_type3_image_sp' . $i] = wp_filter_nohtml_kses( $input['cta_type3_image_sp' . $i] );

 		if ( ! isset( $input['cta_random' . $i] ) ) $input['cta_random' . $i] = null;
  	$input['cta_random' . $i] = ( $input['cta_random' . $i] == 1 ? 1 : 0 );

	}//endfor

 	if ( ! isset( $input['cta_display'] ) ) $input['cta_display'] = null;
 	if ( ! array_key_exists( $input['cta_display'], $cta_display_options ) ) $input['cta_display'] = null;

	for ( $i = 1; $i <= 3; $i++ ) {

 		if ( ! isset( $input['footer_cta_type' . $i] ) ) $input['footer_cta_type' . $i] = null;
 		if ( ! array_key_exists( $input['footer_cta_type' . $i], $footer_cta_type_options ) ) $input['footer_cta_type' . $i] = null;
		$input['footer_cta_catch' . $i] = $input['footer_cta_catch' . $i]; // HTML対応
		$input['footer_cta_catch_font_color' . $i] = wp_filter_nohtml_kses( $input['footer_cta_catch_font_color' . $i] );
		$input['footer_cta_desc' . $i] = $input['footer_cta_desc' . $i]; // HTML対応
		$input['footer_cta_desc_font_color' . $i] = wp_filter_nohtml_kses( $input['footer_cta_desc_font_color' . $i] );
		$input['footer_cta_btn_label' . $i] = wp_filter_nohtml_kses( $input['footer_cta_btn_label' . $i] );
		$input['footer_cta_btn_url' . $i] = wp_filter_nohtml_kses( $input['footer_cta_btn_url' . $i] );
 		if ( ! isset( $input['footer_cta_btn_target' . $i] ) ) $input['footer_cta_btn_target' . $i] = null;
  	$input['footer_cta_btn_target' . $i] = ( $input['footer_cta_btn_target' . $i] == 1 ? 1 : 0 );
		$input['footer_cta_btn_font_color' . $i] = wp_filter_nohtml_kses( $input['footer_cta_btn_font_color' . $i] );
		$input['footer_cta_btn_font_color_hover' . $i] = wp_filter_nohtml_kses( $input['footer_cta_btn_font_color_hover' . $i] );
		$input['footer_cta_btn_bg_color' . $i] = wp_filter_nohtml_kses( $input['footer_cta_btn_bg_color' . $i] );
		$input['footer_cta_btn_bg_color_hover' . $i] = wp_filter_nohtml_kses( $input['footer_cta_btn_bg_color_hover' . $i] );
		$input['footer_cta_bg' . $i] = wp_filter_nohtml_kses( $input['footer_cta_bg' . $i] );
		$input['footer_cta_editor' . $i] = $input['footer_cta_editor' . $i]; // HTML対応
 		if ( ! isset( $input['footer_cta_random' . $i] ) ) $input['footer_cta_random' . $i] = null;
  	$input['footer_cta_random' . $i] = ( $input['footer_cta_random' . $i] == 1 ? 1 : 0 );
	
	}//endfor

 	if ( ! isset( $input['footer_cta_display'] ) ) $input['footer_cta_display'] = null;
 	if ( ! array_key_exists( $input['footer_cta_display'], $cta_display_options ) ) $input['footer_cta_display'] = null;

 	if ( ! isset( $input['footer_cta_hide_on_front'] ) ) $input['footer_cta_hide_on_front'] = null;
  $input['footer_cta_hide_on_front'] = ( $input['footer_cta_hide_on_front'] == 1 ? 1 : 0 );


	return $input;

};




// head 要素にフッターCTAのスタイルを書き出す
// スタイルを適用するクラスの先頭に .p-footer-cta--{$i} を置くことで、CTA-A?C全てのスタイルを書きだす
function add_footer_cta_styles() {

	$options = get_design_plus_option();
	//if ( '5' === $options['cta_display'] ) return;
?>
<?php echo '<style type="text/css">'. "\n"; ?>
<?php
for ( $i = 1; $i <= 3; $i++ ) :
	if ( 'type1' == $options['footer_cta_type' . $i] ) :
		$footer_cta_bg = $options['footer_cta_bg' . $i];
		$footer_cta_bg_opacity = $options['footer_cta_bg_opacity' . $i];
		$footer_cta_btn_font_color = $options['footer_cta_btn_font_color' . $i];
		$footer_cta_btn_font_color_hover = $options['footer_cta_btn_font_color_hover' . $i];
		$footer_cta_btn_bg_color = $options['footer_cta_btn_bg_color' . $i];
		$footer_cta_btn_bg_color_hover = $options['footer_cta_btn_bg_color_hover' . $i];
		$footer_cta_catch_font_color = $options['footer_cta_catch_font_color'. $i];
		$footer_cta_desc_font_color = $options['footer_cta_desc_font_color'. $i];

		echo '.p-footer-cta--'. $i. ' .p-footer-cta__catch { color: '. esc_html( $footer_cta_catch_font_color ). '; }'. "\n";
		echo '.p-footer-cta--'. $i. ' .p-footer-cta__desc { color: '. esc_html( $footer_cta_desc_font_color ). '; }'. "\n";

		echo '.p-footer-cta--'. $i. ' .p-footer-cta__inner { background: rgba( '. esc_html( implode( ', ', hex2rgb( $footer_cta_bg ) ) ). ', '. esc_html( $footer_cta_bg_opacity ). '); }'. "\n";
		echo '.p-footer-cta--'. $i. ' .p-footer-cta__btn { color:'. esc_html( $footer_cta_btn_font_color ). '; background: '. esc_html( $footer_cta_btn_bg_color ). '; }'. "\n";
		echo '.p-footer-cta--'. $i. ' .p-footer-cta__btn:hover { color:'. esc_html( $footer_cta_btn_font_color_hover ). '; background: '. esc_html( $footer_cta_btn_bg_color_hover ). '; }'. "\n";

	endif;
endfor; 
?>
<?php echo '</style>'. "\n". "\n"; ?>
<?php
}
add_action( 'wp_head', 'add_footer_cta_styles' );


?>