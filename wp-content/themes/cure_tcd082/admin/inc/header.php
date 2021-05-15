<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

	// ヘッダーの設定
	$dp_default_options['header_fix'] = 'type1';
	$dp_default_options['mobile_header_fix'] = 'type1';

	$dp_default_options['header_font_color'] = '#ffffff';

	$dp_default_options['header_bg_color2'] = '#ffffff';
	$dp_default_options['header_font_color2'] = '#000000';

	// グローバルメニューの設定
	$dp_default_options['global_menu_child_font_color'] = '#ffffff';
	$dp_default_options['global_menu_child_bg_color'] = '#007997';
	$dp_default_options['global_menu_child_bg_color_hover'] = '#00a7ce';

	// ドロワーメニュー
	$dp_default_options['mobile_menu_font_color'] = '#ffffff';
	$dp_default_options['mobile_menu_font_hover_color'] = '#ffffff';
	$dp_default_options['mobile_menu_child_font_color'] = '#ffffff';
	$dp_default_options['mobile_menu_child_font_hover_color'] = '#ffffff';
	$dp_default_options['mobile_menu_bg_color'] = '#222222';
	$dp_default_options['mobile_menu_sub_menu_bg_color'] = '#333333';
	$dp_default_options['mobile_menu_bg_hover_color'] = '#00a7ce';
	$dp_default_options['mobile_menu_border_color'] = '#444444';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['mobile_menu_ad_code' . $i] = '';
		$dp_default_options['mobile_menu_ad_image' . $i] = false;
		$dp_default_options['mobile_menu_ad_url' . $i] = '';
		$dp_default_options['mobile_menu_ad_target' . $i] = '';
	}

  // メガメニュー
	$dp_default_options['mega_menu_a_bg_color'] = '#007995';
	$dp_default_options['mega_menu_a_catch'] = __( 'Catchphrase', 'tcd-w' );
	$dp_default_options['mega_menu_a_link_label'] = __( 'MORE', 'tcd-w' );
	$dp_default_options['mega_menu_a_catch_font_size'] = '16';
	$dp_default_options['mega_menu_a_title_font_size'] = '14';
	$dp_default_options['mega_menu_b_bg_color'] = '#007995';
	$dp_default_options['mega_menu_b_title_font_size'] = '14';
	$dp_default_options['mega_menu_b_post_order'] = 'date';
	$dp_default_options['mega_menu_b_post_num'] = '8';

  $dp_default_options['megamenu'] = array();

  // メッセージ
	$dp_default_options['show_header_message'] = '';
	$dp_default_options['header_message'] = '';
	$dp_default_options['header_message_font_color'] = '#000000';
	$dp_default_options['header_message_bg_color'] = '#ffff66';
	$dp_default_options['header_message_link_font_color'] = '#000000';
	$dp_default_options['show_header_message_top'] = '1';
	$dp_default_options['show_header_message_sub'] = '';
	$dp_default_options['header_message_font_size'] = '16';
	$dp_default_options['header_message_font_size_mobile'] = '14';
	$dp_default_options['header_message_width'] = 'type1';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $megamenu_options, $content_width_options;
  $blog_label = __( 'Blog', 'tcd-w' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

?>

<div id="tab-content-header" class="tab-content">


   <?php // ヘッダーの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header bar setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Display position', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $header_fix_options as $option ) { ?>
      <li>
       <input type="radio" id="header_fix_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['header_fix'], $option['value'] ); ?> />
       <label for="header_fix_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Display position (mobile)', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $header_fix_options as $option ) { ?>
      <li>
       <input type="radio" id="mobile_header_fix_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[mobile_header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['mobile_header_fix'], $option['value'] ); ?> />
       <label for="mobile_header_fix_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?>1</h4>
     <div class="theme_option_message2">
      <p><?php _e('This color will be used when header background is transparent.','tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_font_color]" value="<?php echo esc_attr( $options['header_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?>2</h4>
     <div class="theme_option_message2">
      <p><?php _e('This color will be used when header background color is white.','tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_bg_color2]" value="<?php echo esc_attr( $options['header_bg_color2'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_font_color2]" value="<?php echo esc_attr( $options['header_font_color2'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // グローバルメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Global menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Child menu setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_child_font_color]" value="<?php echo esc_attr( $options['global_menu_child_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_child_bg_color]" value="<?php echo esc_attr( $options['global_menu_child_bg_color'] ); ?>" data-default-color="#007997" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_child_bg_color_hover]" value="<?php echo esc_attr( $options['global_menu_child_bg_color_hover'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // ドロワーメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Drawer menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('Drawer menu is a menu which will be displayed in mobile device, and will be slide in displayed when user click the menu button on right top of the screen.', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color of parent menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_font_color]" value="<?php echo esc_attr( $options['mobile_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of parent menu on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_font_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_font_hover_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_child_font_color]" value="<?php echo esc_attr( $options['mobile_menu_child_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of child menu on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_child_font_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_child_font_hover_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_sub_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_sub_menu_bg_color'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_hover_color'] ); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_border_color]" value="<?php echo esc_attr( $options['mobile_menu_border_color'] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Banner setting', 'tcd-w');  ?></h4>
     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php echo sprintf( __( 'Banner%s', 'tcd-w' ), $i ); ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       <textarea id="dp_options[mobile_menu_ad_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[mobile_menu_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['mobile_menu_ad_code'.$i] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js mobile_menu_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['mobile_menu_ad_image'.$i] ); ?>" id="mobile_menu_ad_image<?php echo $i; ?>" name="dp_options[mobile_menu_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['mobile_menu_ad_image'.$i]){ echo wp_get_attachment_image($options['mobile_menu_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_menu_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[mobile_menu_ad_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[mobile_menu_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['mobile_menu_ad_url'.$i] ); ?>" />
       <p><label><input name="dp_options[mobile_menu_ad_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['mobile_menu_ad_target'.$i], 1 ); ?>><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
       <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php endfor; ?>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メガメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p><?php _e( 'Set the display format of the sub menu of the global menu', 'tcd-w' ); ?></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Dropdown menu - Display submenu in drop down.', 'tcd-w'); ?></p>
      <p><?php printf(__('Mega menu A - Display %s list.', 'tcd-w'),$service_label); ?></p>
      <p><?php printf(__('Mega menu B - Display %s list.', 'tcd-w'),$blog_label); ?></p>
     </div>
     <ul class="megamenu_image clearfix">
      <?php
           foreach ( $megamenu_options as $option ) :
             if(isset($option['img'])){
      ?>
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="<?php echo esc_attr( $option['title'] ); ?>" title="" />
       <p><?php echo esc_html($option['title']); ?></p>
      </li>
      <?php }; endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Menu type setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please create custom menu from <a href="./nav-menus.php">menu page</a> and set the position as <strong>"Global menu"</strong> before you use this option.', 'tcd-w');  ?></p>
     </div>
     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
          echo '<ul class="option_list">';
          foreach ( $global_nav_items as $item ) {
            if ( $item->menu_item_parent ) continue;
            $value = isset( $options['megamenu'][$item->ID] ) ? $options['megamenu'][$item->ID] : '';
            echo '<li class="cf"><span class="label">' . esc_html( $item->title ) . '</span>';
            echo '<select name="dp_options[megamenu][' . esc_attr( $item->ID ) . ']">';
            foreach ( $megamenu_options as $option ) {
              echo '<option value="' . esc_attr( $option['value'] ) . '" ' . selected( $option['value'], $value, false ) . '>' . esc_html( $option['label'] ) . '</option>';
            }
            echo '</select>';
            echo '</li>';
          }
          echo '</ul>' . "\n";
     ?>
     <h4 class="theme_option_headline2"><?php _e('Mega menu A setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mega_menu_a_bg_color]" value="<?php echo esc_attr( $options['mega_menu_a_bg_color'] ); ?>" data-default-color="#007995" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mega_menu_a_catch]" value="<?php esc_attr_e( $options['mega_menu_a_catch'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Link label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mega_menu_a_link_label]" value="<?php esc_attr_e( $options['mega_menu_a_link_label'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_a_catch_font_size]" value="<?php esc_attr_e( $options['mega_menu_a_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_a_title_font_size]" value="<?php esc_attr_e( $options['mega_menu_a_title_font_size'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Mega menu B setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mega_menu_b_bg_color]" value="<?php echo esc_attr( $options['mega_menu_b_bg_color'] ); ?>" data-default-color="#007995" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mega_menu_b_post_order]">
        <option style="padding-right: 10px;" value="date" <?php selected( $options['mega_menu_b_post_order'], 'date' ); ?>><?php _e('Date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $options['mega_menu_b_post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <select name="dp_options[mega_menu_b_post_num]">
        <?php for($i=4; $i<= 12; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['mega_menu_b_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_b_title_font_size]" value="<?php esc_attr_e( $options['mega_menu_b_title_font_size'] ); ?>" /><span>px</span></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[show_header_message]" type="checkbox" value="1" <?php checked( '1', $options['show_header_message'] ); ?> /> <?php _e('Display header message', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_header_message'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Message', 'tcd-w');  ?></h4>
      <?php wp_editor( $options['header_message'], 'header_message', array ( 'textarea_name' => 'dp_options[header_message]' ) ); ?>
      <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Display on front page', 'tcd-w'); ?></span><input name="dp_options[show_header_message_top]" type="checkbox" value="1" <?php checked( $options['show_header_message_top'], 1 ); ?>></li>
       <li class="cf"><span class="label"><?php _e('Display on sub pages', 'tcd-w'); ?></span><input name="dp_options[show_header_message_sub]" type="checkbox" value="1" <?php checked( $options['show_header_message_sub'], 1 ); ?>></li>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
      <ul class="design_radio_button">
       <?php foreach ( $content_width_options as $option ) { ?>
       <li>
        <input type="radio" id="header_message_width_<?php echo esc_attr($option['value']); ?>" name="dp_options[header_message_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['header_message_width'], $option['value'] ); ?> />
        <label for="header_message_width_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html( $option['label'] ); ?></label>
       </li>
       <?php } ?>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_message_font_size]" value="<?php esc_attr_e( $options['header_message_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_message_font_size_mobile]" value="<?php esc_attr_e( $options['header_message_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#ffff66" class="c-color-picker"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of text link', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_link_font_color]" value="<?php echo esc_attr( $options['header_message_link_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      </ul>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $megamenu_options, $content_width_options;

  // ヘッダーの設定
  $input['header_fix'] = wp_filter_nohtml_kses( $input['header_fix'] );
  $input['mobile_header_fix'] = wp_filter_nohtml_kses( $input['mobile_header_fix'] );

  $input['header_font_color'] = wp_filter_nohtml_kses( $input['header_font_color'] );

  $input['header_bg_color2'] = wp_filter_nohtml_kses( $input['header_bg_color2'] );
  $input['header_font_color2'] = wp_filter_nohtml_kses( $input['header_font_color2'] );

  // グローバルメニューの設定
  $input['global_menu_child_font_color'] = wp_filter_nohtml_kses( $input['global_menu_child_font_color'] );
  $input['global_menu_child_bg_color'] = wp_filter_nohtml_kses( $input['global_menu_child_bg_color'] );
  $input['global_menu_child_bg_color_hover'] = wp_filter_nohtml_kses( $input['global_menu_child_bg_color_hover'] );

  // ドロワーメニューの設定
  $input['mobile_menu_font_color'] = wp_filter_nohtml_kses( $input['mobile_menu_font_color'] );
  $input['mobile_menu_font_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_font_hover_color'] );
  $input['mobile_menu_child_font_color'] = wp_filter_nohtml_kses( $input['mobile_menu_child_font_color'] );
  $input['mobile_menu_child_font_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_child_font_hover_color'] );
  $input['mobile_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_color'] );
  $input['mobile_menu_sub_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_sub_menu_bg_color'] );
  $input['mobile_menu_bg_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_hover_color'] );
  $input['mobile_menu_border_color'] = wp_filter_nohtml_kses( $input['mobile_menu_border_color'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    $input['mobile_menu_ad_code'.$i] = $input['mobile_menu_ad_code'.$i];
    $input['mobile_menu_ad_image'.$i] = wp_filter_nohtml_kses( $input['mobile_menu_ad_image'.$i] );
    $input['mobile_menu_ad_url'.$i] = wp_filter_nohtml_kses( $input['mobile_menu_ad_url'.$i] );
    $input['mobile_menu_ad_target'.$i] = ! empty( $input['mobile_menu_ad_target'.$i] ) ? 1 : 0;
  }

  // メガメニュー
  $input['mega_menu_a_bg_color'] = wp_filter_nohtml_kses( $input['mega_menu_a_bg_color'] );
  $input['mega_menu_a_catch_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_a_catch_font_size'] );
  $input['mega_menu_a_title_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_a_title_font_size'] );
  $input['mega_menu_a_catch'] = wp_filter_nohtml_kses( $input['mega_menu_a_catch'] );
  $input['mega_menu_a_link_label'] = wp_filter_nohtml_kses( $input['mega_menu_a_link_label'] );
  $input['mega_menu_b_bg_color'] = wp_filter_nohtml_kses( $input['mega_menu_b_bg_color'] );
  $input['mega_menu_b_title_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_b_title_font_size'] );
  $input['mega_menu_b_post_order'] = wp_filter_nohtml_kses( $input['mega_menu_b_post_order'] );
  $input['mega_menu_b_post_num'] = wp_filter_nohtml_kses( $input['mega_menu_b_post_num'] );
  foreach ( array_keys( $input['megamenu'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu'][$index], $megamenu_options ) ) {
      $input['megamenu'][$index] = null;
    }
  }

  // メッセージ
  $input['show_header_message'] = ! empty( $input['show_header_message'] ) ? 1 : 0;
  $input['header_message'] = wp_kses_post( $input['header_message'] );
  $input['header_message_font_color'] = wp_filter_nohtml_kses( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = wp_filter_nohtml_kses( $input['header_message_bg_color'] );
  $input['header_message_link_font_color'] = wp_filter_nohtml_kses( $input['header_message_link_font_color'] );
  $input['show_header_message_top'] = ! empty( $input['show_header_message_top'] ) ? 1 : 0;
  $input['show_header_message_sub'] = ! empty( $input['show_header_message_sub'] ) ? 1 : 0;
  $input['header_message_font_size'] = wp_filter_nohtml_kses( $input['header_message_font_size'] );
  $input['header_message_font_size_mobile'] = wp_filter_nohtml_kses( $input['header_message_font_size_mobile'] );
  $input['header_message_width'] = wp_filter_nohtml_kses( $input['header_message_width'] );

  return $input;

};


?>