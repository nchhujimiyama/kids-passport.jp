<?php
     function tcd_head() {
       $options = get_design_plus_option();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1251px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1251px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/simplebar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/simplebar.min.js?ver=<?php echo version_num(); ?>"></script>

<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>

<?php
     if($options['header_fix'] != 'type1') {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>
<?php
     if($options['mobile_header_fix'] == 'type2') {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix_mobile.js?ver=<?php echo version_num(); ?>"></script>
<?php };  ?>

<?php
     // Googleマップ
     if(is_page_template('page-access.php')) {
       global $post;
       $access_content = get_post_meta( $post->ID, 'access_content', true );
       if ( $access_content && is_array( $access_content ) ) :
         foreach( $access_content as $key => $content ) :
           if ( ($content['cb_content_select'] == 'access_map') && $content['show_content']) {
             if($options['basic_access_address']){
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $options['basic_gmap_api_key'] ); ?>" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/pagebuilder/assets/js/googlemap.js?ver=<?php echo version_num(); ?>"></script>
<?php
             break;
             };
           };
         endforeach;
       endif;
     };
?>

<?php /* URLやモバイル等でcssが変わらないものをここで出力 */ ?>
<style type="text/css">
<?php
     // フォントタイプの設定　------------------------------------------------------------------
?>

<?php
     // 基本のフォントタイプ
     if($options['font_type'] == 'type1') {
?>
body, input, textarea { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['font_type'] == 'type2') { ?>
body, input, textarea { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
body, input, textarea { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php }; ?>

<?php
     // 見出しのフォントタイプ
     if($options['headline_font_type'] == 'type1') {
?>
.rich_font, .p-vertical { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['headline_font_type'] == 'type2') { ?>
.rich_font, .p-vertical { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:500; }
<?php } else { ?>
.rich_font, .p-vertical { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:500; }
<?php }; ?>

.rich_font_type1 { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
.rich_font_type2 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:500; }
.rich_font_type3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:500; }

<?php
     // 本文のフォントタイプ
     if(is_single()) {
       if($options['content_font_type'] == 'type1') {
?>
.post_content, #next_prev_post { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['content_font_type'] == 'type2') { ?>
.post_content, #next_prev_post { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
.post_content, #next_prev_post { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php
     };
     // ウィジェットのフォントタイプ
     if($options['widget_headline_font_type'] == 'type1') {
?>
.widget_headline { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['widget_headline_font_type'] == 'type2') { ?>
.widget_headline { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
.widget_headline { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php }; }; ?>

<?php
     // ヘッダー -------------------------------------------------------------------------------
?>
#header { background:<?php echo esc_html($options['header_bg_color2']); ?>; }
body.home #header.active { background:<?php echo esc_html($options['header_bg_color2']); ?>; }
<?php
     // サイドボタン
?>
#side_button a { background:<?php echo esc_html($options['side_bar_bg_color']); ?>; }
#side_button a:hover { background:<?php echo esc_html($options['side_bar_bg_color_hover']); ?>; }
<?php $i = 1; foreach ( $options['side_bar'] as $key => $value ) : ?>
#side_button .num<?php echo $i; ?>:before { color:<?php echo esc_attr($value['color']); ?>; }
<?php $i++; endforeach; ?>
<?php
     // グローバルメニュー
?>
body.home #header_logo .logo a, body.home #global_menu > ul > li > a { color:<?php echo esc_html($options['header_font_color']); ?>; }
body.home #header_logo .logo a:hover, body.home #global_menu > ul > li > a:hover, #global_menu > ul > li.active > a, #global_menu > ul > li.active_button > a { color:<?php echo esc_html($options['main_color']); ?> !important; }
body.home #header.active #header_logo .logo a, #global_menu > ul > li > a, body.home #header.active #global_menu > ul > li > a { color:<?php echo esc_html($options['header_font_color2']); ?>; }
#global_menu ul ul a { color:<?php echo esc_html($options['global_menu_child_font_color']); ?>; background:<?php echo esc_html($options['global_menu_child_bg_color']); ?>; }
#global_menu ul ul a:hover { background:<?php echo esc_html($options['global_menu_child_bg_color_hover']); ?>; }
<?php
     // ドロワーメニュー
?>
body.home #menu_button span { background:<?php echo esc_html($options['header_font_color']); ?>; }
#menu_button span { background:#000; }
#menu_button:hover span { background:<?php echo esc_html($options['main_color']); ?> !important; }
#drawer_menu { background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; }
#mobile_menu a, .mobile #lang_button a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; border-bottom:1px solid <?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#mobile_menu li li a { color:<?php echo esc_html($options['mobile_menu_child_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_sub_menu_bg_color']); ?>; }
#mobile_menu a:hover, #drawer_menu .close_button:hover, #mobile_menu .child_menu_button:hover, .mobile #lang_button a:hover { color:<?php echo esc_html($options['mobile_menu_font_hover_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>; }
#mobile_menu li li a:hover { color:<?php echo esc_html($options['mobile_menu_child_font_hover_color']); ?>; }
<?php
     // メガメニュー
?>
.megamenu_service_list { background:<?php echo esc_html($options['mega_menu_a_bg_color']); ?>; }
.megamenu_service_list .headline { font-size:<?php echo esc_html($options['mega_menu_a_catch_font_size']); ?>px; }
.megamenu_service_list .title { font-size:<?php echo esc_html($options['mega_menu_a_title_font_size']); ?>px; }
.megamenu_blog_list { background:<?php echo esc_html($options['mega_menu_b_bg_color']); ?>; }
.megamenu_blog_list .title { font-size:<?php echo esc_html($options['mega_menu_b_title_font_size']); ?>px; }
<?php
     // メッセージ -----------------------------------------------------------------------------------
      if($options['show_header_message'] && $options['header_message']) {
?>
#header_message { font-size:<?php echo esc_attr($options['header_message_font_size']); ?>px; }
#header_message a { color:<?php echo esc_attr($options['header_message_link_font_color']); ?>; }
#header_message a:hover { color:<?php echo esc_attr($options['main_color']); ?>; }
@media screen and (max-width:750px) {
  #header_message { font-size:<?php echo esc_attr($options['header_message_font_size_mobile']); ?>px; }
}
<?php
      };
     // フッター -----------------------------------------------------------------------------------
?>
#footer_banner .title { font-size:<?php echo esc_html($options['footer_banner_font_size']); ?>px; }
#footer .service_list, #footer .service_list a { color:<?php echo esc_html($options['footer_service_list_font_color']); ?>; }
#footer_contact .link_button a { color:<?php echo esc_html($options['basic_contact_button_font_color']); ?>; background:<?php echo esc_html($options['basic_contact_button_bg_color']); ?>; }
#footer_contact .link_button a:hover { color:<?php echo esc_html($options['basic_contact_button_font_color_hover']); ?>; background:<?php echo esc_html($options['basic_contact_button_bg_color_hover']); ?>; }
#footer_tel .tel_number .icon:before { color:<?php echo esc_html($options['basic_tel_icon_color']); ?>; }
#footer_schedule { font-size:<?php echo esc_html($options['footer_sd_font_size']); ?>px; border-color:<?php echo esc_html($options['footer_sd_border_color']); ?>; }
#footer_schedule td { border-color:<?php echo esc_html($options['footer_sd_border_color']); ?>; color:<?php echo esc_html($options['footer_sd_font_color']); ?>; }
.footer_info { font-size:<?php echo esc_html($options['footer_info_font_size']); ?>px; }
#return_top a:before { color:<?php echo esc_html($options['return_top_font_color']); ?>; }
#return_top a { background:<?php echo esc_html($options['return_top_bg_color']); ?>; }
#return_top a:hover { background:<?php echo esc_html($options['return_top_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  #footer_banner .title { font-size:<?php echo esc_html($options['footer_banner_font_size_mobile']); ?>px; }
  .footer_info { font-size:<?php echo esc_html($options['footer_info_font_size_mobile']); ?>px; }
  #footer_schedule { font-size:<?php echo esc_html($options['footer_sd_font_size_mobile']); ?>px; }
}

<?php
     // サムネイルのアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type4"){

       // ズーム ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
.author_profile a.avatar img, .animate_image img, .animate_background .image, #recipe_archive .blur_image {
  width:100%; height:auto;
  -webkit-transition: transform  0.75s ease;
  transition: transform  0.75s ease;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image, #recipe_archive a:hover .blur_image {
  -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
  transform: scale(<?php echo $options['hover1_zoom']; ?>);
}


<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type2"){
?>
.author_profile a.avatar, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover2_bgcolor']; ?>;
}
.animate_image img, .animate_background .image {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important; position:relative;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image:hover img, .animate_background:hover .image {
  opacity:<?php echo $options['hover2_opacity']; ?>;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-30px, 0px);
  transform: translate(-30px, 0px);
  <?php endif; ?>
}
.animate_image.square img {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important; position:relative;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, -15px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, -15px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, -15px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, -15px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image.square:hover img {
  opacity:<?php echo $options['hover2_opacity']; ?>;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(0px, -15px);
  transform: translate(0px, -15px);
  <?php else: ?>
  -webkit-transform: translate(-30px, -15px);
  transform: translate(-30px, -15px);
  <?php endif; ?>
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
?>
.author_profile a.avatar, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover3_bgcolor']; ?>;
}
.author_profile a.avatar img, .animate_image img, .animate_background .image {
  -webkit-transition-property: opacity; -webkit-transition: 0.5s;
  transition-property: opacity; transition: 0.5s;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  opacity: <?php echo $options['hover3_opacity']; ?>;
}
<?php }; }; // アニメーションここまで ?>

<?php
     // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // メインカラー ----------------------------------
     $main_color = esc_html($options['main_color']);
?>
a { color:#000; }

a:hover, #header_logo a:hover, #global_menu > ul > li.current-menu-item > a, .megamenu_blog_list a:hover .title, #footer a:hover, #footer_social_link li a:hover:before, #bread_crumb a:hover, #bread_crumb li.home a:hover:after, #bread_crumb, #bread_crumb li.last, #next_prev_post a:hover,
.megamenu_blog_slider a:hover , .megamenu_blog_slider .category a:hover, .megamenu_blog_slider_wrap .carousel_arrow:hover:before, .megamenu_menu_list .carousel_arrow:hover:before, .single_copy_title_url_btn:hover,
.p-dropdown__list li a:hover, .p-dropdown__title:hover, .p-dropdown__title:hover:after, .p-dropdown__title:hover:after, .p-dropdown__list li a:hover, .p-dropdown__list .child_menu_button:hover, .tcdw_search_box_widget .search_area .search_button:hover:before,
#index_news a .date, #index_news_slider a:hover .title, .tcd_category_list a:hover, .tcd_category_list .child_menu_button:hover, .styled_post_list1 a:hover .title,
#post_title_area .post_meta a:hover, #single_author_title_area .author_link li a:hover:before, .author_profile a:hover, .author_profile .author_link li a:hover:before, #post_meta_bottom a:hover, .cardlink_title a:hover, .comment a:hover, .comment_form_wrapper a:hover, #searchform .submit_button:hover:before
  { color: <?php echo $main_color; ?>; }

#comment_tab li.active a, #submit_comment:hover, #cancel_comment_reply a:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #wp-calendar td a:hover,
#post_pagination p, #post_pagination a:hover, #p_readmore .button:hover, .page_navi a:hover, .page_navi span.current, #post_pagination a:hover,.c-pw__btn:hover, #post_pagination a:hover, #comment_tab li a:hover,
.post_slider_widget .slick-dots button:hover::before, .post_slider_widget .slick-dots .slick-active button::before
  { background-color: <?php echo $main_color; ?>; }

.widget_headline, #comment_textarea textarea:focus, .c-pw__box-input:focus, .page_navi a:hover, .page_navi span.current, #post_pagination p, #post_pagination a:hover
  { border-color: <?php echo $main_color; ?>; }

<?php
     // その他のカラー ----------------------------------
?>
.post_content a { color:<?php echo esc_html($options['content_link_color']); ?>; }
.post_content a:hover { color:<?php echo esc_html($options['content_link_hover_color']); ?>; }
<?php
     // カテゴリーの色設定 ----------------------------------
       $blog_categories = get_terms( 'category', array( 'hide_empty' => true) );
       if ( $blog_categories && ! is_wp_error( $blog_categories ) ) :
         foreach ( $blog_categories as $cat ):
           $cat_id = $cat->term_id;
           $custom_fields = get_option( 'taxonomy_' . $cat_id, array() );
           $category_font_color = ( ! empty( $custom_fields['category_font_color'] ) ) ? $custom_fields['category_font_color'] : '#ffffff';
           $category_bg_color = ( ! empty( $custom_fields['category_bg_color'] ) ) ? $custom_fields['category_bg_color'] : '#02a8c6';
           $category_font_color_hover = ( ! empty( $custom_fields['category_font_color_hover'] ) ) ? $custom_fields['category_font_color_hover'] : '#ffffff';
           $category_bg_color_hover = ( ! empty( $custom_fields['category_bg_color_hover'] ) ) ? $custom_fields['category_bg_color_hover'] : '#007a96';
?>
.cat_id_<?php echo esc_attr($cat_id); ?> a { color:<?php echo esc_html($category_font_color); ?> !important; background:<?php echo esc_html($category_bg_color); ?> !important; }
.cat_id_<?php echo esc_attr($cat_id); ?> a:hover { color:<?php echo esc_html($category_font_color_hover); ?> !important; background:<?php echo esc_html($category_bg_color_hover); ?> !important; }
<?php
        endforeach;
       endif;
?>
<?php
     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo wp_kses_post($options['css_code']);
     };

     // クイックタグ --------------------------------------------
     if ( $options['use_quicktags'] ) :

     // 見出し
?>
.styled_h2 {
  font-size:<?php echo esc_attr($options['qt_h2_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h2_text_align']); ?>; color:<?php echo esc_attr($options['qt_h2_font_color']); ?>; <?php if($options['show_qt_h2_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h2_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h2_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h2_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h2_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h2_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h2_padding_top']); ?>px <?php echo esc_attr($options['qt_h2_padding_right']); ?>px <?php echo esc_attr($options['qt_h2_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h2_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h2_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h2_margin_bottom']); ?>px !important;
}
.styled_h3 {
  font-size:<?php echo esc_attr($options['qt_h3_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h3_text_align']); ?>; color:<?php echo esc_attr($options['qt_h3_font_color']); ?>; <?php if($options['show_qt_h3_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h3_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h3_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h3_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h3_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h3_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h3_padding_top']); ?>px <?php echo esc_attr($options['qt_h3_padding_right']); ?>px <?php echo esc_attr($options['qt_h3_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h3_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h3_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h3_margin_bottom']); ?>px !important;
}
.styled_h4 {
  font-size:<?php echo esc_attr($options['qt_h4_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h4_text_align']); ?>; color:<?php echo esc_attr($options['qt_h4_font_color']); ?>; <?php if($options['show_qt_h4_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h4_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h4_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h4_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h4_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h4_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h4_padding_top']); ?>px <?php echo esc_attr($options['qt_h4_padding_right']); ?>px <?php echo esc_attr($options['qt_h4_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h4_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h4_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h4_margin_bottom']); ?>px !important;
}
.styled_h5 {
  font-size:<?php echo esc_attr($options['qt_h5_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h5_text_align']); ?>; color:<?php echo esc_attr($options['qt_h5_font_color']); ?>; <?php if($options['show_qt_h5_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h5_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h5_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h5_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h5_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h5_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h5_padding_top']); ?>px <?php echo esc_attr($options['qt_h5_padding_right']); ?>px <?php echo esc_attr($options['qt_h5_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h5_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h5_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h5_margin_bottom']); ?>px !important;
}
<?php
     // ボタン
     for ( $i = 1; $i <= 3; $i++ ) :
       echo '.q_custom_button' . $i . ' { background: ' . esc_attr( $options['qt_custom_button_bg_color' . $i] ) . '; color: ' . esc_attr( $options['qt_custom_button_font_color' . $i] ) . ' !important; border-color: ' . esc_attr( $options['qt_custom_button_border_color' . $i] ) . ' !important; }' . "\n";
       echo '.q_custom_button' . $i . ':hover, .q_custom_button' . $i . ':focus { background: ' . esc_attr( $options['qt_custom_button_bg_color_hover' . $i] ) . '; color: ' . esc_attr( $options['qt_custom_button_font_color_hover' . $i] ) . ' !important; border-color: ' . esc_attr( $options['qt_custom_button_border_color_hover' . $i] ) . ' !important; }' . "\n";
     endfor;

     // 吹き出し
?>
.speech_balloon_left1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?> }
.speech_balloon_left2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?> }
.speech_balloon_right1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?> }
.speech_balloon_right2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?> }
<?php
     endif;
     // Google map
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($options['qt_gmap_marker_bg']); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($options['qt_gmap_marker_bg']); ?> transparent transparent transparent; }
</style>

<?php /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */ ?>
<style id="current-page-style" type="text/css">
<?php
     // お知らせアーカイブページ -----------------------------------------------------------------------------
     if(is_post_type_archive('news')) {
?>
#page_header .title { font-size:<?php echo esc_attr($options['news_title_font_size']); ?>px; color:<?php echo esc_attr($options['news_title_font_color']); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($options['news_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['news_sub_title_font_color']); ?>; background:<?php echo esc_attr($options['news_sub_title_bg_color']); ?>; }
#content_header .headline { font-size:<?php echo esc_attr($options['archive_news_headline_font_size']); ?>px; color:<?php echo esc_attr($options['archive_news_headline_font_color']); ?>; }
#content_header .catch { font-size:<?php echo esc_attr($options['archive_news_catch_font_size']); ?>px; }
#content_header .desc { font-size:<?php echo esc_attr($options['archive_news_desc_font_size']); ?>px; }
#news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($options['news_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($options['news_sub_title_font_size_mobile']); ?>px; }
  #content_header .headline { font-size:<?php echo esc_attr($options['archive_news_headline_font_size_mobile']); ?>px; }
  #content_header .catch { font-size:<?php echo esc_attr($options['archive_news_catch_font_size_mobile']); ?>px; }
  #content_header .desc { font-size:<?php echo esc_attr($options['archive_news_desc_font_size_mobile']); ?>px; }
  #news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size_mobile']); ?>px; }
}
<?php
     // お知らせ詳細 -----------------------------------------------------------------------------
     } elseif(is_singular('news')) {
?>
#page_header .title { font-size:<?php echo esc_attr($options['news_title_font_size']); ?>px; color:<?php echo esc_attr($options['news_title_font_color']); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($options['news_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['news_sub_title_font_color']); ?>; background:<?php echo esc_attr($options['news_sub_title_bg_color']); ?>; }
#post_title_area .title { font-size:<?php echo esc_attr($options['single_news_title_font_size']); ?>px; }
#article .post_content { font-size:<?php echo esc_attr($options['single_news_content_font_size']); ?>px; }
#recent_news .headline { font-size:<?php echo esc_attr($options['recent_news_headline_font_size']); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
#recent_news .title { font-size:<?php echo esc_attr($options['recent_news_title_font_size']); ?>px; }
#recent_news .link_button a { color:<?php echo esc_html($options['recent_news_button_font_color']); ?>; background:<?php echo esc_html($options['recent_news_button_bg_color']); ?>; }
#recent_news .link_button a:hover { color:<?php echo esc_html($options['recent_news_button_font_color_hover']); ?>; background:<?php echo esc_html($options['recent_news_button_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($options['news_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($options['news_sub_title_font_size_mobile']); ?>px; }
  #post_title_area .title { font-size:<?php echo esc_attr($options['single_news_title_font_size_mobile']); ?>px; }
  #article .post_content { font-size:<?php echo esc_attr($options['single_news_content_font_size_mobile']); ?>px; }
  #recent_news .headline { font-size:<?php echo esc_attr($options['recent_news_headline_font_size_mobile']); ?>px; }
  #recent_news .title { font-size:<?php echo esc_attr($options['recent_news_title_font_size_mobile']); ?>px; }
}
<?php
     // FAQページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('faq')) {
?>
#page_header .title { font-size:<?php echo esc_attr($options['faq_title_font_size']); ?>px; color:<?php echo esc_attr($options['faq_title_font_color']); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($options['faq_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['faq_sub_title_font_color']); ?>; background:<?php echo esc_attr($options['faq_sub_title_bg_color']); ?>; }
#content_header .headline { font-size:<?php echo esc_attr($options['archive_faq_headline_font_size']); ?>px; color:<?php echo esc_attr($options['archive_faq_headline_font_color']); ?>; }
#content_header .catch { font-size:<?php echo esc_attr($options['archive_faq_catch_font_size']); ?>px; }
#content_header .desc { font-size:<?php echo esc_attr($options['archive_faq_desc_font_size']); ?>px; }
#faq_category_button li p:hover, #faq_category_button li.active p { color:<?php echo esc_attr($options['archive_faq_category_font_color_hover']); ?>; background:<?php echo esc_attr($options['archive_faq_category_bg_color_hover']); ?>; }
.faq_list .question { font-size:<?php echo esc_attr($options['archive_faq_title_font_size']); ?>px; }
.faq_list .answer { font-size:<?php echo esc_attr($options['archive_faq_answer_font_size']); ?>px; background:<?php echo esc_attr($options['archive_faq_answer_bg_color']); ?>; }
.faq_list .question:hover, .faq_list .question:after { color:<?php echo esc_attr($options['main_color']); ?>; }
.faq_list .question:before { background:<?php echo esc_attr($options['main_color']); ?>; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($options['faq_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($options['faq_sub_title_font_size_mobile']); ?>px; }
  #content_header .headline { font-size:<?php echo esc_attr($options['archive_faq_headline_font_size_mobile']); ?>px; }
  #content_header .catch { font-size:<?php echo esc_attr($options['archive_faq_catch_font_size_mobile']); ?>px; }
  #content_header .desc { font-size:<?php echo esc_attr($options['archive_faq_desc_font_size_mobile']); ?>px; }
  .faq_list .question { font-size:<?php echo esc_attr($options['archive_faq_title_font_size_mobile']); ?>px; }
  .faq_list .answer { font-size:<?php echo esc_attr($options['archive_faq_answer_font_size_mobile']); ?>px; }
}
<?php
     // サービスアーカイブページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('service')) {
?>
#page_header .title { font-size:<?php echo esc_attr($options['service_title_font_size']); ?>px; color:<?php echo esc_attr($options['service_title_font_color']); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($options['service_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['service_sub_title_font_color']); ?>; background:<?php echo esc_attr($options['service_sub_title_bg_color']); ?>; }
#content_header .headline { font-size:<?php echo esc_attr($options['archive_service_headline_font_size']); ?>px; color:<?php echo esc_attr($options['archive_service_headline_font_color']); ?>; }
#content_header .catch { font-size:<?php echo esc_attr($options['archive_service_catch_font_size']); ?>px; }
#content_header .desc { font-size:<?php echo esc_attr($options['archive_service_desc_font_size']); ?>px; }
#service_list .title { font-size:<?php echo esc_attr($options['archive_service_title_font_size']); ?>px; color:<?php echo esc_attr($options['archive_service_title_font_color']); ?>; }
#service_list .desc { font-size:<?php echo esc_attr($options['archive_service_excerpt_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($options['service_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($options['service_sub_title_font_size_mobile']); ?>px; }
  #content_header .headline { font-size:<?php echo esc_attr($options['archive_service_headline_font_size_mobile']); ?>px; }
  #content_header .catch { font-size:<?php echo esc_attr($options['archive_service_catch_font_size_mobile']); ?>px; }
  #content_header .desc { font-size:<?php echo esc_attr($options['archive_service_desc_font_size_mobile']); ?>px; }
  #service_list .title { font-size:<?php echo esc_attr($options['archive_service_title_font_size_mobile']); ?>px; }
  #service_list .desc { font-size:<?php echo esc_attr($options['archive_service_excerpt_font_size_mobile']); ?>px; }
}
<?php
     // サービス詳細ページ -----------------------------------------------------------------------------
     } elseif(is_singular('service')) {
       global $post;
?>
#page_header .title { font-size:<?php echo esc_attr($options['service_title_font_size']); ?>px; color:<?php echo esc_attr($options['service_title_font_color']); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($options['service_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['service_sub_title_font_color']); ?>; background:<?php echo esc_attr($options['service_sub_title_bg_color']); ?>; }
#service_top_desc { font-size:<?php echo esc_attr($options['single_service_desc_font_size']); ?>px; }
#service_single .service_list .top_headline { font-size:<?php echo esc_attr($options['single_service_list_headline_font_size']); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
#service_single .service_list li a:hover, #service_single .service_list li.active a { color:<?php echo esc_attr($options['single_service_list_item_font_color_hover']); ?>; background:<?php echo esc_attr($options['single_service_list_item_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($options['service_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($options['service_sub_title_font_size_mobile']); ?>px !important; }
  #service_top_desc { font-size:<?php echo esc_attr($options['single_service_desc_font_size_mobile']); ?>px; }
  #service_single .service_list .top_headline { font-size:<?php echo esc_attr($options['single_service_list_headline_font_size_mobile']); ?>px; }
}
<?php
       $service_cf = get_post_meta( $post->ID, 'service_cf', true );
       if ( $service_cf && is_array( $service_cf ) ) :
         foreach( $service_cf as $key => $content ) :
           // コンテンツ1 -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $headline_border_color = $options['main_color'];
             $item_catch_font_size = $content['item_catch_font_size'] ? esc_html( $content['item_catch_font_size'] ) : '22';
             $item_catch_font_size_mobile = $content['item_catch_font_size_mobile'] ? esc_html( $content['item_catch_font_size_mobile'] ) : '18';
             $item_desc_font_size = $content['item_desc_font_size'] ? esc_html( $content['item_desc_font_size'] ) : '16';
             $item_desc_font_size_mobile = $content['item_desc_font_size_mobile'] ? esc_html( $content['item_desc_font_size_mobile'] ) : '14';
?>
.service_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px !important; border-color:<?php echo $headline_border_color; ?> !important; }
.service_content1.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $item_catch_font_size; ?>px; }
.service_content1.num<?php echo esc_attr($key); ?> .desc { font-size:<?php echo $item_desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .service_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px !important; }
  .service_content1.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $item_catch_font_size_mobile; ?>px; }
  .service_content1.num<?php echo esc_attr($key); ?> .desc { font-size:<?php echo $item_desc_font_size_mobile; ?>px; }
}
<?php
           // コンテンツ２ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $headline_border_color = $options['main_color'];
             $list_bg_color = $content['list_bg_color'] ? esc_html( $content['list_bg_color'] ) : '#f7f7f7';
             $item_desc_font_size = $content['item_desc_font_size'] ? esc_html( $content['item_desc_font_size'] ) : '16';
             $item_desc_font_size_mobile = $content['item_desc_font_size_mobile'] ? esc_html( $content['item_desc_font_size_mobile'] ) : '14';
?>
.service_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px !important; border-color:<?php echo $headline_border_color; ?> !important; }
.service_content2.num<?php echo esc_attr($key); ?> .item_list { background:<?php echo $list_bg_color; ?>; }
.service_content2.num<?php echo esc_attr($key); ?> .content .desc { font-size:<?php echo $item_desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .service_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px !important; }
  .service_content2.num<?php echo esc_attr($key); ?> .content .desc { font-size:<?php echo $item_desc_font_size_mobile; ?>px; }
}
<?php
           // コンテンツ３ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $headline_border_color = $options['main_color'];
             $list_headline_font_color = $content['list_headline_font_color'] ? esc_html( $content['list_headline_font_color'] ) : '#ffffff';
             $list_headline_bg_color = $content['list_headline_bg_color'] ? esc_html( $content['list_headline_bg_color'] ) : '#00a6d0';
             $item_font_size = $content['item_font_size'] ? esc_html( $content['item_font_size'] ) : '16';
             $item_font_size_mobile = $content['item_font_size_mobile'] ? esc_html( $content['item_font_size_mobile'] ) : '14';
?>
.service_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px !important; border-color:<?php echo $headline_border_color; ?> !important; }
.service_content3.num<?php echo esc_attr($key); ?> .list_headline { font-size:<?php echo $item_font_size; ?>px; color:<?php echo $list_headline_font_color; ?>; background:<?php echo $list_headline_bg_color; ?>; }
.service_content3.num<?php echo esc_attr($key); ?> .price_list { font-size:<?php echo $item_font_size; ?>px; }
@media screen and (max-width:750px) {
  .service_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px !important; }
  .service_content3.num<?php echo esc_attr($key); ?> .list_headline { font-size:<?php echo $item_font_size_mobile; ?>px; }
  .service_content3.num<?php echo esc_attr($key); ?> .price_list { font-size:<?php echo $item_font_size_mobile; ?>px; }
}
<?php
           // フリースペース -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content'] ) {
             $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';
?>
.service_content4.num<?php echo esc_attr($key); ?> { margin-top:<?php echo esc_html($content['padding_top']); ?>px; margin-bottom:<?php echo esc_html($content['padding_bottom']); ?>px; }
.service_content4.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .service_content4.num<?php echo esc_attr($key); ?> { margin-top:<?php echo esc_html($content['padding_top_mobile']); ?>px; margin-bottom:<?php echo esc_html($content['padding_bottom_mobile']); ?>px; }
  .service_content4.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           };
         endforeach;
       endif;

     // トップページ -----------------------------------------------------------------------------
     } elseif(is_front_page()) {

       if($options['show_index_slider'] || $options['mobile_show_index_slider']) {
         $i = 1;
         if(is_mobile() && $options['mobile_index_slider']) {
           $index_slider = $options['mobile_index_slider'];
         } else {
           $index_slider = $options['index_slider'];
         }
         foreach ( $index_slider as $key => $value ) :
           if(is_mobile() && $options['mobile_index_slider']) {
             $catch_font_size_mobile = $value['catch_font_size'];
           } else {
             $catch_font_size_mobile = $value['catch_font_size_mobile'];
           }
?>
#header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($value['catch_font_size']); ?>px; color:<?php echo esc_attr($value['catch_font_color']); ?>; <?php if($value['use_catch_shadow']) { ?>text-shadow:<?php echo esc_attr($value['catch_shadow_a']); ?>px <?php echo esc_attr($value['catch_shadow_b']); ?>px <?php echo esc_attr($value['catch_shadow_c']); ?>px <?php echo esc_attr($value['catch_shadow_color']); ?>;<?php }; ?> }
@media screen and (max-width:750px) {
  #header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
}
<?php
           if($value['use_overlay'] == 1) {
             $overlay_color_base = hex2rgb($value['overlay_color']);
             $overlay_color = implode(",",$overlay_color_base);
?>
#header_slider .item<?php echo $i; ?> .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($value['overlay_opacity']); ?>); }
<?php
           };
         $i++;
         endforeach;
       };

       // トップページ　コンテンツビルダー -------------------------------------------------------------------------------------------------------------
       if ($options['contents_builder'] || $options['mobile_contents_builder']) :
         $content_count = 1;
         if(is_mobile() && $options['mobile_show_contents_builder']) {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
         foreach($contents_builder as $content) :

           // コンテンツカルーセル
           if ( $content['cb_content_select'] == 'content_slider' && $content['show_content'] ) {
             if(is_mobile() && $options['mobile_show_contents_builder']) {
               $headline_font_size_mobile = $content['headline_font_size'];
               $catch_font_size_mobile = $content['catch_font_size'];
               $desc_font_size_mobile = $content['desc_font_size'];
             } else {
               $headline_font_size_mobile = $content['headline_font_size_mobile'];
               $catch_font_size_mobile = $content['catch_font_size_mobile'];
               $desc_font_size_mobile = $content['desc_font_size_mobile'];
             }
?>
.index_content_slider.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($content['headline_font_size']); ?>px; color:<?php echo esc_attr($content['headline_font_color']); ?>; }
.index_content_slider.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_content_slider.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; }
.index_content_slider.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_content_slider.num<?php echo $content_count; ?> .link_button a:hover { color:<?php echo esc_html($content['button_font_color_hover']); ?>; background:<?php echo esc_html($content['button_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_content_slider.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($headline_font_size_mobile); ?>px; }
  .index_content_slider.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_content_slider.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
}
<?php
     // サービス一覧
     } elseif ( $content['cb_content_select'] == 'service_list' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $headline_font_size_mobile = $content['headline_font_size'];
         $catch_font_size_mobile = $content['catch_font_size'];
         $desc_font_size_mobile = $content['desc_font_size'];
         $title_font_size_mobile = $content['title_font_size'];
         $excerpt_font_size_mobile = $content['excerpt_font_size'];
       } else {
         $headline_font_size_mobile = $content['headline_font_size_mobile'];
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $desc_font_size_mobile = $content['desc_font_size_mobile'];
         $title_font_size_mobile = $content['title_font_size_mobile'];
         $excerpt_font_size_mobile = $content['excerpt_font_size_mobile'];
       }
?>
.index_service_list.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($content['headline_font_size']); ?>px; color:<?php echo esc_attr($content['headline_font_color']); ?>; }
.index_service_list.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_service_list.num<?php echo $content_count; ?> .cb_desc { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; }
.index_service_list.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
.index_service_list.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($content['excerpt_font_size']); ?>px; }
.index_service_list.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_service_list.num<?php echo $content_count; ?> .link_button a:hover { color:<?php echo esc_html($content['button_font_color_hover']); ?>; background:<?php echo esc_html($content['button_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_service_list.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($headline_font_size_mobile); ?>px; }
  .index_service_list.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_service_list.num<?php echo $content_count; ?> .cb_desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
  .index_service_list.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  .index_service_list.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($excerpt_font_size_mobile); ?>px; }
}
<?php
     // メッセージ
     } elseif ( $content['cb_content_select'] == 'message' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $headline_font_size_mobile = $content['headline_font_size'];
         $catch_font_size_mobile = $content['catch_font_size'];
         $desc_font_size_mobile = $content['desc_font_size'];
         $message_catch_font_size_mobile = $content['message_catch_font_size'];
         $title_font_size_mobile = $content['title_font_size'];
         $sub_title_font_size_mobile = $content['sub_title_font_size'];
       } else {
         $headline_font_size_mobile = $content['headline_font_size_mobile'];
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $desc_font_size_mobile = $content['desc_font_size_mobile'];
         $message_catch_font_size_mobile = $content['message_catch_font_size_mobile'];
         $title_font_size_mobile = $content['title_font_size_mobile'];
         $sub_title_font_size_mobile = $content['sub_title_font_size_mobile'];
       }
?>
.index_message.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($content['headline_font_size']); ?>px; color:<?php echo esc_attr($content['headline_font_color']); ?>; }
.index_message.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_message.num<?php echo $content_count; ?> .content .catch { font-size:<?php echo esc_html($content['message_catch_font_size']); ?>px; color:<?php echo esc_html($content['message_catch_font_color']); ?>; }
.index_message.num<?php echo $content_count; ?> .content .desc { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; }
.index_message.num<?php echo $content_count; ?> .content .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
.index_message.num<?php echo $content_count; ?> .content .sub_title { font-size:<?php echo esc_html($content['sub_title_font_size']); ?>px; }
.index_message.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_message.num<?php echo $content_count; ?> .link_button a:hover { color:<?php echo esc_html($content['button_font_color_hover']); ?>; background:<?php echo esc_html($content['button_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_message.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($headline_font_size_mobile); ?>px; }
  .index_message.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_message.num<?php echo $content_count; ?> .content .catch { font-size:<?php echo esc_html($message_catch_font_size_mobile); ?>px; }
  .index_message.num<?php echo $content_count; ?> .content .desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
  .index_message.num<?php echo $content_count; ?> .content .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  .index_message.num<?php echo $content_count; ?> .content .sub_title { font-size:<?php echo esc_html($sub_title_font_size_mobile); ?>px; }
}
<?php
     // 記事スライダー
     } elseif ( $content['cb_content_select'] == 'post_slider' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $headline_font_size_mobile = $content['headline_font_size'];
         $catch_font_size_mobile = $content['catch_font_size'];
         $title_font_size_mobile = $content['title_font_size'];
       } else {
         $headline_font_size_mobile = $content['headline_font_size_mobile'];
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $title_font_size_mobile = $content['title_font_size_mobile'];
       }
?>
.index_post_slider.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($content['headline_font_size']); ?>px; color:<?php echo esc_attr($content['headline_font_color']); ?>; }
.index_post_slider.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_post_slider.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
.index_post_slider.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_post_slider.num<?php echo $content_count; ?> .link_button a:hover { color:<?php echo esc_html($content['button_font_color_hover']); ?>; background:<?php echo esc_html($content['button_bg_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_post_slider.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($headline_font_size_mobile); ?>px; }
  .index_post_slider.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_post_slider.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
     // アクセス情報
     } elseif ( $content['cb_content_select'] == 'access' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $headline_font_size_mobile = $content['headline_font_size'];
         $catch_font_size_mobile = $content['catch_font_size'];
         $desc_font_size_mobile = $options['basic_access_info_font_size'];
       } else {
         $headline_font_size_mobile = $content['headline_font_size_mobile'];
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $desc_font_size_mobile = $options['basic_access_info_font_size_mobile'];
       }
       $gmap_marker_color = $options['basic_gmap_marker_color'] ? esc_html( $options['basic_gmap_marker_color'] ) : '#ffffff';
       $gmap_marker_bg = $options['basic_gmap_marker_bg'] ? esc_html( $options['basic_gmap_marker_bg'] ) : '#000000';
?>
.index_access.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($content['headline_font_size']); ?>px; color:<?php echo esc_attr($content['headline_font_color']); ?>; }
.index_access.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_access.num<?php echo $content_count; ?> .content { font-size:<?php echo esc_html($options['basic_access_info_font_size']); ?>px; }
.index_access.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_access.num<?php echo $content_count; ?> .link_button a:hover { color:<?php echo esc_html($content['button_font_color_hover']); ?>; background:<?php echo esc_html($content['button_bg_color_hover']); ?>; }
.index_access.num<?php echo $content_count; ?> .access_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo $gmap_marker_bg; ?>; color:<?php echo $gmap_marker_color; ?>; }
.index_access.num<?php echo $content_count; ?> .access_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo $gmap_marker_bg; ?> transparent transparent transparent; }
.index_access.num<?php echo $content_count; ?> .access_info .post_content { font-size:<?php echo esc_html($options['basic_access_info_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .index_access.num<?php echo $content_count; ?> .cb_headline { font-size:<?php echo esc_html($headline_font_size_mobile); ?>px; }
  .index_access.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_access.num<?php echo $content_count; ?> .content { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
  .index_access.num<?php echo $content_count; ?> .access_info .post_content { font-size:<?php echo esc_html($options['basic_access_info_font_size_mobile']); ?>px; }
}
<?php
     // フリースペース
     } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $padding_top_mobile = $content['padding_top'];
         $padding_bottom_mobile = $content['padding_bottom'];
         $desc_font_size_mobile = $content['desc_font_size'];
       } else {
         $padding_top_mobile = $content['padding_top_mobile'];
         $padding_bottom_mobile = $content['padding_bottom_mobile'];
         $desc_font_size_mobile = $content['desc_font_size_mobile'];
       }
?>
.index_free_space.num<?php echo $content_count; ?> { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; margin-top:<?php echo esc_html($content['padding_top']); ?>px; margin-bottom:<?php echo esc_html($content['padding_bottom']); ?>px; }
@media screen and (max-width:750px) {
  .index_free_space.num<?php echo $content_count; ?> { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; margin-top:<?php echo esc_html($padding_top_mobile); ?>px; margin-bottom:<?php echo esc_html($padding_bottom_mobile); ?>px; }
}
<?php
       };
       $content_count++;
       endforeach;
     endif; // END コンテンツビルダーここまで

     // ボックスコンテンツ
     if($options['show_index_box']){
       for ( $i = 1; $i <= 3; $i++ ) :
         if( $options['show_index_box'.$i]) {
?>
#index_box_content .box_item<?php echo $i; ?> .title { color:<?php echo esc_attr($options['index_box_content_title_font_color'.$i]); ?>; background:<?php echo esc_attr($options['index_box_content_title_bg_color'.$i]); ?>; }
#index_box_content .box_item<?php echo $i; ?> .title:before { border-color:<?php echo esc_attr($options['index_box_content_title_font_color'.$i]); ?>; }
<?php
         };
       endfor;
?>
#index_box_content .title { font-size:<?php echo esc_attr($options['index_box_content_title_font_size']); ?>px; }
#index_box_content .desc { font-size:<?php echo esc_attr($options['index_box_content_desc_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #index_box_content .title { font-size:<?php echo esc_html($options['index_box_content_title_font_size_mobile']); ?>px; }
  #index_box_content .desc { font-size:<?php echo esc_attr($options['index_box_content_desc_font_size_mobile']); ?>px; }
}
<?php
     }

     // ブログアーカイブ -----------------------------------------------------------------------------
     } elseif(is_archive() || is_home() || is_search()) {
?>
#page_header .title { font-size:<?php echo esc_attr($options['blog_title_font_size']); ?>px; color:<?php echo esc_attr($options['blog_title_font_color']); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($options['blog_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['blog_sub_title_font_color']); ?>; background:<?php echo esc_attr($options['blog_sub_title_bg_color']); ?>; }
#content_header .desc { font-size:<?php echo esc_attr($options['archive_blog_desc_font_size']); ?>px; }
#blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($options['blog_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($options['blog_sub_title_font_size_mobile']); ?>px; }
  #content_header .desc { font-size:<?php echo esc_attr($options['archive_blog_desc_font_size_mobile']); ?>px; }
  #blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size_mobile']); ?>px; }
}
<?php
     // ブログ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_single()){
?>
#post_title_area .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size']); ?>px; }
#article .post_content { font-size:<?php echo esc_attr($options['single_blog_content_font_size']); ?>px; }
#related_post .headline { font-size:<?php echo esc_attr($options['related_post_headline_font_size']); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
#comments .headline { font-size:<?php echo esc_attr($options['comment_headline_font_size']); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
@media screen and (max-width:750px) {
  #post_title_area .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size_mobile']); ?>px; }
  #article .post_content { font-size:<?php echo esc_attr($options['single_blog_content_font_size_mobile']); ?>px; }
  #related_post .headline { font-size:<?php echo esc_attr($options['related_post_headline_font_size_mobile']); ?>px; }
  #comments .headline { font-size:<?php echo esc_attr($options['comment_headline_font_size_mobile']); ?>px; }
}
<?php
     // 固定ページ --------------------------------------------------------------------
     } elseif(is_page()) {

       global $post;

       $page_header_title_font_size = get_post_meta($post->ID, 'page_header_title_font_size', true) ?  get_post_meta($post->ID, 'page_header_title_font_size', true) : '32';
       $page_header_title_font_size_mobile = get_post_meta($post->ID, 'page_header_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_title_font_size_mobile', true) : '24';
       $page_header_title_font_color = get_post_meta($post->ID, 'page_header_title_font_color', true) ?  get_post_meta($post->ID, 'page_header_title_font_color', true) : '#ffffff';

       $page_header_sub_title_font_size = get_post_meta($post->ID, 'page_header_sub_title_font_size', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size', true) : '14';
       $page_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) : '12';
       $page_header_sub_title_font_color = get_post_meta($post->ID, 'page_header_sub_title_font_color', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_color', true) : '#ffffff';
       $page_header_sub_title_bg_color = get_post_meta($post->ID, 'page_header_sub_title_bg_color', true) ?  get_post_meta($post->ID, 'page_header_sub_title_bg_color', true) : '#00a7ce';

       $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
       $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';
?>
#page_header .title { font-size:<?php echo esc_attr($page_header_title_font_size); ?>px; color:<?php echo esc_attr($page_header_title_font_color); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; color:<?php echo esc_attr($page_header_sub_title_font_color); ?>; background:<?php echo esc_attr($page_header_sub_title_bg_color); ?>; }
#main_contents { font-size:<?php echo esc_attr($page_content_font_size); ?>px; }
@media screen and (max-width:750px) {
  #page_header .title { font-size:<?php echo esc_attr($page_header_title_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
  #main_contents { font-size:<?php echo esc_attr($page_content_font_size_mobile); ?>px; }
}
<?php
     // デザインページ１ --------------------------------------------------------------------
     if(is_page_template('page-design1.php')) {
       $page_headline_font_size = get_post_meta($post->ID, 'dc1_headline_font_size', true) ?  get_post_meta($post->ID, 'dc1_headline_font_size', true) : '14';
       $page_headline_font_size_mobile = get_post_meta($post->ID, 'dc1_headline_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc1_headline_font_size_mobile', true) : '12';
       $page_headline_font_color = get_post_meta($post->ID, 'dc1_headline_font_color', true) ?  get_post_meta($post->ID, 'dc1_headline_font_color', true) : '#00a6cc';
       $page_catch_font_size = get_post_meta($post->ID, 'dc1_catch_font_size', true) ?  get_post_meta($post->ID, 'dc1_catch_font_size', true) : '38';
       $page_catch_font_size_mobile = get_post_meta($post->ID, 'dc1_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc1_catch_font_size_mobile', true) : '24';
       $page_desc_font_size = get_post_meta($post->ID, 'dc1_desc_font_size', true) ?  get_post_meta($post->ID, 'dc1_desc_font_size', true) : '16';
       $page_desc_font_size_mobile = get_post_meta($post->ID, 'dc1_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc1_desc_font_size_mobile', true) : '14';
?>
#content_header .headline { font-size:<?php echo esc_attr($page_headline_font_size); ?>px; color:<?php echo esc_attr($page_headline_font_color); ?>; }
#content_header .catch { font-size:<?php echo esc_attr($page_catch_font_size); ?>px; }
#content_header .desc { font-size:<?php echo esc_attr($page_desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  #content_header .headline { font-size:<?php echo esc_attr($page_headline_font_size_mobile); ?>px; }
  #content_header .catch { font-size:<?php echo esc_attr($page_catch_font_size_mobile); ?>px; }
  #content_header .desc { font-size:<?php echo esc_attr($page_desc_font_size_mobile); ?>px; }
}
<?php
       $design1_content = get_post_meta( $post->ID, 'design1_content', true );
       if ( $design1_content && is_array( $design1_content ) ) :
         foreach( $design1_content as $key => $content ) :
           // コンテンツ１ -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
             $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '28';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '24';
             $catch_font_color = $content['catch_font_color'] ?  $content['catch_font_color'] : '#ffffff';
             $item_headline_font_size = $content['item_headline_font_size'] ?  $content['item_headline_font_size'] : '22';
             $item_headline_font_size_mobile = $content['item_headline_font_size_mobile'] ?  $content['item_headline_font_size_mobile'] : '18';
             $item_desc_font_size = $content['item_desc_font_size'] ?  $content['item_desc_font_size'] : '16';
             $item_desc_font_size_mobile = $content['item_desc_font_size_mobile'] ?  $content['item_desc_font_size_mobile'] : '14';
?>
.design1_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
.design1_content1.num<?php echo esc_attr($key); ?> .main_image .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; color:<?php echo esc_attr($catch_font_color); ?>; }
.design1_content1.num<?php echo esc_attr($key); ?> .item_list .headline { font-size:<?php echo esc_attr($item_headline_font_size); ?>px; }
.design1_content1.num<?php echo esc_attr($key); ?> .item_list .desc { font-size:<?php echo esc_attr($item_desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .design1_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .main_image .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .item_list .headline { font-size:<?php echo esc_attr($item_headline_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .item_list .desc { font-size:<?php echo esc_attr($item_desc_font_size_mobile); ?>px; }
}
<?php
           // コンテンツ２ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
             $catch_font_size = $content['list_catch_font_size'] ?  $content['list_catch_font_size'] : '22';
             $catch_font_size_mobile = $content['list_catch_font_size_mobile'] ?  $content['list_catch_font_size_mobile'] : '18';
             $desc_font_size = $content['list_desc_font_size'] ?  $content['list_desc_font_size'] : '16';
             $desc_font_size_mobile = $content['list_desc_font_size_mobile'] ?  $content['list_desc_font_size_mobile'] : '14';
?>
.design1_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
.design1_content2.num<?php echo esc_attr($key); ?> .item .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; }
.design1_content2.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .design1_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design1_content2.num<?php echo esc_attr($key); ?> .item .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  .design1_content2.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
           // コンテンツ３ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
             $desc_font_size = $content['list_desc_font_size'] ?  $content['list_desc_font_size'] : '16';
             $desc_font_size_mobile = $content['list_desc_font_size_mobile'] ?  $content['list_desc_font_size_mobile'] : '14';
?>
.design1_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
.design1_content3.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .design1_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design1_content3.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
           // フリースペース -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
             $desc_font_size = $content['desc_font_size'] ?  esc_html($content['desc_font_size']) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  esc_html($content['desc_font_size_mobile']) : '14';
             $padding_top = $content['padding_top'] ?  esc_html($content['padding_top']) : '50';
             $padding_bottom = $content['padding_bottom'] ?  esc_html($content['padding_bottom']) : '50';
             $padding_top_mobile = $content['padding_top_mobile'] ?  esc_html($content['padding_top_mobile']) : '30';
             $padding_bottom_mobile = $content['padding_bottom_mobile'] ?  esc_html($content['padding_bottom_mobile']) : '30';
?>
.design1_content4.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top; ?>px; margin-bottom:<?php echo $padding_bottom; ?>px; }
.design1_content4.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .design1_content4.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top_mobile; ?>px; margin-bottom:<?php echo $padding_bottom_mobile; ?>px; }
  .design1_content4.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           };
         endforeach;
       endif;
     } // END デザインページ１
?>
<?php
     // デザインページ２ --------------------------------------------------------------------
     if(is_page_template('page-design2.php')) {
       $page_headline_font_size = get_post_meta($post->ID, 'dc2_headline_font_size', true) ?  get_post_meta($post->ID, 'dc2_headline_font_size', true) : '14';
       $page_headline_font_size_mobile = get_post_meta($post->ID, 'dc2_headline_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_headline_font_size_mobile', true) : '12';
       $page_headline_font_color = get_post_meta($post->ID, 'dc2_headline_font_color', true) ?  get_post_meta($post->ID, 'dc2_headline_font_color', true) : '#00a6cc';
       $page_catch_font_size = get_post_meta($post->ID, 'dc2_catch_font_size', true) ?  get_post_meta($post->ID, 'dc2_catch_font_size', true) : '38';
       $page_catch_font_size_mobile = get_post_meta($post->ID, 'dc2_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_catch_font_size_mobile', true) : '24';
       $page_desc_font_size = get_post_meta($post->ID, 'dc2_desc_font_size', true) ?  get_post_meta($post->ID, 'dc2_desc_font_size', true) : '16';
       $page_desc_font_size_mobile = get_post_meta($post->ID, 'dc2_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_desc_font_size_mobile', true) : '14';
?>
#content_header .headline { font-size:<?php echo esc_attr($page_headline_font_size); ?>px; color:<?php echo esc_attr($page_headline_font_color); ?>; }
#content_header .catch { font-size:<?php echo esc_attr($page_catch_font_size); ?>px; }
#content_header .desc { font-size:<?php echo esc_attr($page_desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  #content_header .headline { font-size:<?php echo esc_attr($page_headline_font_size_mobile); ?>px; }
  #content_header .catch { font-size:<?php echo esc_attr($page_catch_font_size_mobile); ?>px; }
  #content_header .desc { font-size:<?php echo esc_attr($page_desc_font_size_mobile); ?>px; }
}
<?php
       $design2_content = get_post_meta( $post->ID, 'design2_content', true );
       if ( $design2_content && is_array( $design2_content ) ) :
         foreach( $design2_content as $key => $content ) :
           // コンテンツ１ -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
             $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '28';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '24';
             $catch_font_color = $content['catch_font_color'] ?  $content['catch_font_color'] : '#ffffff';
             $author_position_font_size = $content['author_position_font_size'] ?  $content['author_position_font_size'] : '14';
             $author_position_font_size_mobile = $content['author_position_font_size_mobile'] ?  $content['author_position_font_size_mobile'] : '12';
             $author_title_font_size = $content['author_title_font_size'] ?  $content['author_title_font_size'] : '22';
             $author_title_font_size_mobile = $content['author_title_font_size_mobile'] ?  $content['author_title_font_size_mobile'] : '18';
             $author_sub_title_font_size = $content['author_sub_title_font_size'] ?  $content['author_sub_title_font_size'] : '14';
             $author_sub_title_font_size_mobile = $content['author_sub_title_font_size_mobile'] ?  $content['author_sub_title_font_size_mobile'] : '12';
             $author_desc_font_size = $content['author_desc_font_size'] ?  $content['author_desc_font_size'] : '16';
             $author_desc_font_size_mobile = $content['author_desc_font_size_mobile'] ?  $content['author_desc_font_size_mobile'] : '14';

?>
.design2_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
.design2_content1.num<?php echo esc_attr($key); ?> .main_image .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; color:<?php echo esc_attr($catch_font_color); ?>; }
.design2_content1.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size); ?>px; }
.design2_content1.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size); ?>px; }
.design2_content1.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size); ?>px; }
.design2_content1.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .design2_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design2_content1.num<?php echo esc_attr($key); ?> .main_image .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  .design2_content1.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size_mobile); ?>px; }
  .design2_content1.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size_mobile); ?>px; }
  .design2_content1.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size_mobile); ?>px; }
  .design2_content1.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size_mobile); ?>px; }
}
<?php
           // コンテンツ２ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
             $author_position_font_size = $content['author_position_font_size'] ?  $content['author_position_font_size'] : '14';
             $author_position_font_size_mobile = $content['author_position_font_size_mobile'] ?  $content['author_position_font_size_mobile'] : '12';
             $author_title_font_size = $content['author_title_font_size'] ?  $content['author_title_font_size'] : '22';
             $author_title_font_size_mobile = $content['author_title_font_size_mobile'] ?  $content['author_title_font_size_mobile'] : '18';
             $author_sub_title_font_size = $content['author_sub_title_font_size'] ?  $content['author_sub_title_font_size'] : '14';
             $author_sub_title_font_size_mobile = $content['author_sub_title_font_size_mobile'] ?  $content['author_sub_title_font_size_mobile'] : '12';
             $author_desc_font_size = $content['author_desc_font_size'] ?  $content['author_desc_font_size'] : '16';
             $author_desc_font_size_mobile = $content['author_desc_font_size_mobile'] ?  $content['author_desc_font_size_mobile'] : '14';
             $author_position_font_color = $content['author_position_font_color'] ?  $content['author_position_font_color'] : '#00a7ce';
             $author_position_border_color = $content['author_position_border_color'] ?  $content['author_position_border_color'] : '#01a7ce';
             $author_position_bg_color = $content['author_position_bg_color'] ?  $content['author_position_bg_color'] : '#ffffff';
?>
.design2_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
.design2_content2.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size); ?>px; color:<?php echo esc_attr($author_position_font_color); ?>; border-color:<?php echo esc_attr($author_position_border_color); ?>; background:<?php echo esc_attr($author_position_bg_color); ?>; }
.design2_content2.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size); ?>px; }
.design2_content2.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size); ?>px; }
.design2_content2.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .design2_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design2_content2.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size_mobile); ?>px; }
  .design2_content2.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size_mobile); ?>px; }
  .design2_content2.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size_mobile); ?>px; }
  .design2_content2.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size_mobile); ?>px; }
}
<?php
           // フリースペース -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
             $desc_font_size = $content['desc_font_size'] ?  esc_html($content['desc_font_size']) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  esc_html($content['desc_font_size_mobile']) : '14';
             $padding_top = $content['padding_top'] ?  esc_html($content['padding_top']) : '50';
             $padding_bottom = $content['padding_bottom'] ?  esc_html($content['padding_bottom']) : '50';
             $padding_top_mobile = $content['padding_top_mobile'] ?  esc_html($content['padding_top_mobile']) : '30';
             $padding_bottom_mobile = $content['padding_bottom_mobile'] ?  esc_html($content['padding_bottom_mobile']) : '30';
?>
.design2_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top; ?>px; margin-bottom:<?php echo $padding_bottom; ?>px; }
.design2_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .design2_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top_mobile; ?>px; margin-bottom:<?php echo $padding_bottom_mobile; ?>px; }
  .design2_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           };
         endforeach;
       endif;
     } // END デザインページ２
?>
<?php
     // アクセスページ --------------------------------------------------------------------
     if(is_page_template('page-access.php')) {
       $access_content = get_post_meta( $post->ID, 'access_content', true );
       if ( $access_content && is_array( $access_content ) ) :
         foreach( $access_content as $key => $content ) :
           // コンテンツ１ -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  esc_html($content['headline_font_size']) : '14';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  esc_html($content['headline_font_size_mobile']) : '12';
             $headline_font_color = $content['headline_font_color'] ?  esc_html($content['headline_font_color']) : '#00a5d0';
             $catch_font_size = $content['catch_font_size'] ?  esc_html($content['catch_font_size']) : '38';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  esc_html($content['catch_font_size_mobile']) : '24';
             $list_catch_font_size = $content['list_catch_font_size'] ?  esc_html($content['list_catch_font_size']) : '22';
             $list_catch_font_size_mobile = $content['list_catch_font_size_mobile'] ?  esc_html($content['list_catch_font_size_mobile']) : '18';
             $list_desc_font_size = $content['list_desc_font_size'] ?  esc_html($content['list_desc_font_size']) : '16';
             $list_desc_font_size_mobile = $content['list_desc_font_size_mobile'] ?  esc_html($content['list_desc_font_size_mobile']) : '14';
?>
.access_content1.num<?php echo esc_attr($key); ?> .top_headline { color:<?php echo $headline_font_color; ?>; font-size:<?php echo $headline_font_size; ?>px; }
.access_content1.num<?php echo esc_attr($key); ?> .top_catch { font-size:<?php echo $catch_font_size; ?>px; }
.access_content1.num<?php echo esc_attr($key); ?> .item .catch { font-size:<?php echo $list_catch_font_size; ?>px; }
.access_content1.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo $list_desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .access_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .access_content1.num<?php echo esc_attr($key); ?> .top_catch { font-size:<?php echo $catch_font_size_mobile; ?>px; }
  .access_content1.num<?php echo esc_attr($key); ?> .item .catch { font-size:<?php echo $list_catch_font_size_mobile; ?>px; }
  .access_content1.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo $list_desc_font_size_mobile; ?>px; }
}
<?php
           // アクセス情報 -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'access_map') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ?  esc_html($content['headline_font_size']) : '24';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  esc_html($content['headline_font_size_mobile']) : '18';
             $button_font_color = $content['button_font_color'] ? esc_html( $content['button_font_color'] ) : '#000000';
             $button_bg_color = $content['button_bg_color'] ? esc_html( $content['button_bg_color'] ) : '#ffffff';
             $button_border_color = $content['button_border_color'] ? esc_html( $content['button_border_color'] ) : '#dddddd';
             $button_font_color_hover = $content['button_font_color_hover'] ? esc_html( $content['button_font_color_hover'] ) : '#ffffff';
             $button_bg_color_hover = $content['button_bg_color_hover'] ? esc_html( $content['button_bg_color_hover'] ) : '#00a7ce';
             $button_border_color_hover = $content['button_border_color_hover'] ? esc_html( $content['button_border_color_hover'] ) : '#00a7ce';

             $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
             $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';

             $gmap_marker_color = $options['basic_gmap_marker_color'] ? esc_html( $options['basic_gmap_marker_color'] ) : '#ffffff';
             $gmap_marker_bg = $options['basic_gmap_marker_bg'] ? esc_html( $options['basic_gmap_marker_bg'] ) : '#000000';
?>
.access_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px; }
.access_content2.num<?php echo esc_attr($key); ?> .access_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo $gmap_marker_bg; ?>; color:<?php echo $gmap_marker_color; ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .access_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo $gmap_marker_bg; ?> transparent transparent transparent; }
.access_content2.num<?php echo esc_attr($key); ?> .map_link_button a { color:<?php echo $button_font_color; ?>; background:<?php echo $button_bg_color; ?>; border-color:<?php echo $button_border_color; ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .map_link_button a:hover { color:<?php echo $button_font_color_hover; ?>; background:<?php echo $button_bg_color_hover; ?>; border-color:<?php echo $button_border_color_hover; ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .access_info .post_content { font-size:<?php echo esc_html($options['basic_access_info_font_size']); ?>px; }
.access_content2.num<?php echo esc_attr($key); ?> .contact .headline { color:<?php echo esc_html($options['main_color']); ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .contact .link_button a { color:<?php echo esc_html($options['basic_contact_button_font_color']); ?>; background:<?php echo esc_html($options['basic_contact_button_bg_color']); ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .contact .link_button a:hover { color:<?php echo esc_html($options['basic_contact_button_font_color_hover']); ?>; background:<?php echo esc_html($options['basic_contact_button_bg_color_hover']); ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .tel .headline { color:<?php echo esc_html($options['main_color']); ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .tel_number .icon:before { color:<?php echo esc_html($options['basic_tel_icon_color']); ?>; }
.access_content2.num<?php echo esc_attr($key); ?> .service_list .headline { color:<?php echo esc_html($options['main_color']); ?>; }
@media screen and (max-width:750px) {
  .access_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .access_content2.num<?php echo esc_attr($key); ?> .access_info .post_content { font-size:<?php echo esc_html($options['basic_access_info_font_size_mobile']); ?>px; }
}
<?php
           // フリースペース -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
             $desc_font_size = $content['desc_font_size'] ?  esc_html($content['desc_font_size']) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  esc_html($content['desc_font_size_mobile']) : '14';
             $padding_top = $content['padding_top'] ?  esc_html($content['padding_top']) : '50';
             $padding_bottom = $content['padding_bottom'] ?  esc_html($content['padding_bottom']) : '50';
             $padding_top_mobile = $content['padding_top_mobile'] ?  esc_html($content['padding_top_mobile']) : '30';
             $padding_bottom_mobile = $content['padding_bottom_mobile'] ?  esc_html($content['padding_bottom_mobile']) : '30';
?>
.access_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top; ?>px; margin-bottom:<?php echo $padding_bottom; ?>px; }
.access_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .access_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top_mobile; ?>px; margin-bottom:<?php echo $padding_bottom_mobile; ?>px; }
  .access_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           };
         endforeach;
       endif;
     } // END アクセスページ
?>
<?php
     // 404ページ -----------------------------------------------------------------------------
     } elseif( is_404()) {
       $title_font_size_pc = ( ! empty( $options['header_txt_size_404'] ) ) ? $options['header_txt_size_404'] : 38;
       $sub_title_font_size_pc = ( ! empty( $options['header_sub_txt_size_404'] ) ) ? $options['header_sub_txt_size_404'] : 16;
       $title_font_size_mobile = ( ! empty( $options['header_txt_size_404_mobile'] ) ) ? $options['header_txt_size_404_mobile'] : 28;
       $sub_title_font_size_mobile = ( ! empty( $options['header_sub_txt_size_404_mobile'] ) ) ? $options['header_sub_txt_size_404_mobile'] : 14;
?>
#page_404_header .catch { font-size:<?php echo esc_html($title_font_size_pc); ?>px; }
#page_404_header .desc { font-size:<?php echo esc_html($sub_title_font_size_pc); ?>px; }
@media screen and (max-width:750px) {
  #page_404_header .catch { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  #page_404_header .desc { font-size:<?php echo esc_html($sub_title_font_size_mobile); ?>px; }
}
<?php
     }; //END page setting

     // カスタムCSS --------------------------------------------
     if(is_single() || is_page()) {
       global $post;
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo $custom_css;
       };
     }

     // ロード画面 -----------------------------------------
     get_template_part('functions/loader');
     if($options['load_icon'] == 'type4'){
?>
#site_loader_logo_inner .message { font-size:<?php echo esc_html($options['load_type4_catch_font_size']); ?>px; color:<?php echo esc_html($options['load_type4_catch_color']); ?>; }
#site_loader_logo_inner i { background:<?php echo esc_html($options['load_type4_catch_color']); ?>; }
@media screen and (max-width:750px) {
  #site_loader_logo_inner .message { font-size:<?php echo esc_html($options['load_type4_catch_font_size_sp']); ?>px; }
}
<?php
     };

     //フッターバー --------------------------------------------
     if(is_mobile()) {
       if($options['footer_bar_display'] == 'type1' || $options['footer_bar_display'] == 'type2') {
         $footer_bar_border_color = hex2rgb($options['footer_bar_border_color']);
         $footer_bar_border_color = implode(",",$footer_bar_border_color);
?>
#dp-footer-bar { background:<?php echo esc_attr($options['footer_bar_bg_color']); ?>; color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a { border-color:rgba(<?php echo esc_attr($footer_bar_border_color); ?>,<?php echo esc_html($options['footer_bar_border_color_opacity']); ?>); color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a:hover { border-color:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; background:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; }
<?php
       };
     };
?>
</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // メガメニュー ------------------------------------------------------------
     wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
     wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('.megamenu_blog_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    touchThreshold: 20,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: false,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: 5000
  });
  $('.megamenu_blog_list .prev_item').on('click', function() {
    $(this).closest('.megamenu_blog_list').find('.megamenu_blog_slider').slick('slickPrev');
  });
  $('.megamenu_blog_list .next_item').on('click', function() {
    $(this).closest('.megamenu_blog_list').find('.megamenu_blog_slider').slick('slickNext');
  });

});
</script>
<?php
     // トップページ
     if(is_front_page()) {
       // ヘッダースライダー --------------------------------------------------
       if($options['show_index_slider'] || $options['mobile_show_index_slider']){
         wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
         wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
         if($options['show_load_screen'] == 'type1'){
?>
<script type="text/javascript">
jQuery(document).ready(function($){
<?php get_template_part('functions/slider_ini'); ?>
});
</script>
<?php
         };
       };

       // コンテンツビルダー　記事一覧スライダー ------------------------------------------------------------
       if ($options['contents_builder'] || $options['mobile_contents_builder']) :
         if(is_mobile() && $options['mobile_show_contents_builder']) {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
         $content_count = 1;
         foreach($contents_builder as $content) :
           if ($content['cb_content_select'] == 'content_slider' || $content['cb_content_select'] == 'post_slider') {
             wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
             wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){
<?php if ($content['cb_content_select'] == 'content_slider') { ?>
  $('.index_content_slider.num<?php echo $content_count; ?> .cb_content_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 2,
    slidesToScroll: 1,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: <?php echo esc_attr($content['slider_time']); ?>,
    responsive: [
      {
        breakpoint: 550,
        settings: { slidesToShow: 1 }
      }
    ]
  });
  $('.index_content_slider .prev_item').on('click', function() {
    $(this).closest('.index_content_slider').find('.cb_content_slider').slick('slickPrev');
  });
  $('.index_content_slider .next_item').on('click', function() {
    $(this).closest('.index_content_slider').find('.cb_content_slider').slick('slickNext');
  });

<?php } elseif ($content['cb_content_select'] == 'post_slider') { ?>
  $('.index_post_slider.num<?php echo $content_count; ?> .post_list').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: <?php echo esc_attr($content['slider_time']); ?>,
    responsive: [
      {
        breakpoint: 750,
        settings: { slidesToShow: 2 }
      }
    ]
  });
  $('.index_post_slider .prev_item').on('click', function() {
    $(this).closest('.index_post_slider').find('.post_list').slick('slickPrev');
  });
  $('.index_post_slider .next_item').on('click', function() {
    $(this).closest('.index_post_slider').find('.post_list').slick('slickNext');
  });

<?php }; ?>
});
</script>
<?php
           } elseif ($content['cb_content_select'] == 'access') {
             if($options['basic_access_address']){
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $options['basic_gmap_api_key'] ); ?>" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/pagebuilder/assets/js/googlemap.js?ver=<?php echo version_num(); ?>"></script>
<?php
             };
           };
           $content_count++;
         endforeach;
       endif;

       // ニュースティッカー --------------------------------------------------------------
       if($options['show_header_news']){
         wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
         wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('#index_news_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipeToSlide: false,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: false,
    vertical: true,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: 5000
  });

});
</script>
<?php
       }
       // ボックスコンテンツ ----------------------------------------------------------
       if( $options['show_index_box']) {
         wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
         wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
       };
?>
<script type="text/javascript">
jQuery(document).ready(function($){

<?php
     // ボックスコンテンツ
     if( $options['show_index_box']) {
?>

  $('#index_box_content').slick({
    infinite: false,
    dots: false,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    swipeToSlide: true,
    adaptiveHeight: false,
    pauseOnHover: false,
    pauseOnFocus: false,
    autoplay: true,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 950,
        settings: { slidesToShow: 2 }
      },
      {
        breakpoint: 650,
        settings: { slidesToShow: 1 }
      }
    ]
  });

  function jumpBack() {
    setTimeout(function() {
      $('#index_box_content').slick("slickGoTo", 0, false);
    }, 3000);
    setTimeout(function() {
      $('#index_box_content').slick('refresh');
    }, 4000);
  }
  $('#index_box_content').on("afterChange", function(event, slick, currentSlide, nextSlide) {
    if (currentSlide === 2) {
      jumpBack();
    }
  });

  $('#index_box_content').slick('slickPause');

  var winW = $(window).width();

  var box_item_num = $('#index_box_content .box_item').length;
  $('#index_box_content').addClass('type'+ box_item_num);

  if(winW < 750) {
    $('#index_box_content .box_item').each(function(){
      $(this).off('mouseenter mouseleave');
      var box_height = $(this).height() - 60;
      $(this).on('click',function() {
        if($(this).hasClass('active')){
          $(this).css('bottom','0px');
          $(this).removeClass('active');
        } else {
          $(this).addClass('active');
          $(this).css({'cssText':'bottom:' + box_height + 'px !important;'});
        };
      });
    });
  } else {
    $('#index_box_content .box_item').each(function(){
      $(this).off('click');
      var box_height = $(this).height() - 60;
      $(this).hover(
        function(){
          $(this).css({'cssText':'bottom:' + box_height + 'px !important;'});
        },
        function(){
          $(this).css('bottom','0px');
        }
      );
    });
  }

  $(window).on('resize', function(){
    var winW = $(window).width();
    $('#index_box_content').slick('setPosition');
    if(winW < 750) {
      $('#index_box_content').on('setPosition', function(event, slick){
        $('#index_box_content .box_item').each(function(){
          $(this).off('mouseenter mouseleave');
          var box_height = $(this).height() - 60;
          $(this).on('click',function() {
            if($(this).hasClass('active')){
              $(this).css('bottom','0px');
              $(this).removeClass('active');
            } else {
              $(this).addClass('active');
              $(this).css({'cssText':'bottom:' + box_height + 'px !important;'});
            };
          });
        });
      });
    } else {
      $('#index_box_content').on('setPosition', function(event, slick){
        $('#index_box_content .box_item').each(function(){
          $(this).off('click');
          var box_height = $(this).height() - 60;
          $(this).hover(
            function(){
              $(this).css({'cssText':'bottom:' + box_height + 'px !important;'});
            },
            function(){
              $(this).css('bottom','0px');
            }
          );
        });
      });
    };
  });

<?php }; ?>


  $(window).on('scroll load', function(i) {
    var scTop = $(this).scrollTop();
    var scBottom = scTop + $(this).height();
    $('.animate_item').each( function(i) {
      var thisPos = $(this).offset().top + 100;
      if ( thisPos < scBottom ) {
        $(this).addClass('active');
      }
    });
    $('.animate_item2').each( function(i) {
      var thisPos = $(this).offset().top;
      if ( thisPos < scBottom ) {
        $(this).addClass('active');
      }
    });
  });

  $('.index_free_space.type2').each( function(i) {
    var winW = $(window).innerWidth();
    $(this).css('width', winW);
  });

  $(window).on('resize',function(){
    $('.index_free_space.type2').each( function(i) {
      var winW = $(window).innerWidth();
      $(this).css('width', winW);
    });
  });

});
</script>
<?php
     }; // END front page

     // FAQページ --------------------------------------
     if(is_post_type_archive('faq')) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

<?php if($options['show_faq_category_list']) { ?>
  $('#faq_category_button li').on('click', function() {
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    var cat_id = '#' + $(this).data("cat_id");
    $(".faq_list").hide();
    $(cat_id).fadeIn();
  });
<?php }; ?>

  $('.faq_list .question').on('click', function() {
    $('.faq_list .question').not($(this)).removeClass('active');
    if( $(this).hasClass('active') ){
      $(this).removeClass('active');
    } else {
      $(this).addClass('active');
    }
    $(this).next('.answer').slideToggle(600 ,'easeOutExpo');
    $('.faq_list .answer').not($(this).next('.answer')).slideUp(600 ,'easeOutExpo');
  });

});
</script>
<?php
       };

       // サイドボタン ------------------------------
       if( $options['show_side_bar']) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  var side_button_width = $("#side_button").width();
<?php if($options['side_bar_position'] == 'right'){ ?>
  $("#side_button").css('width',side_button_width + 'px').css('left','calc(100% - 60px)').css('opacity','1');
  $("#side_button").hover(function(){
     $(this).css('left','calc(100% - ' + side_button_width + 'px)');
  }, function(){
     $(this).css('left','calc(100% - 60px)');
  });
<?php } else { ?>
  $("#side_button").css('width',side_button_width + 'px').css('right','calc(100% - 60px)').css('opacity','1');
  $("#side_button").hover(function(){
     $(this).css('right','calc(100% - ' + side_button_width + 'px)');
  }, function(){
     $(this).css('right','calc(100% - 60px)');
  });
<?php }; ?>

<?php if(!is_front_page()) { ?>
  var side_button_height = $("#side_button").height();
  var header_message_height = $('#header_message').innerHeight();
  var winW = $(window).width();
  if( winW > 1251 ){
    $("#side_button").css('top', header_message_height + 149 + 'px');
  } else {
    $("#side_button").css('top', header_message_height + 157 + 'px');
  }
  $(window).on('resize', function(){
    var winW = $(window).width();
    if( winW > 1251 ){
      $("#side_button").css('top', header_message_height + 149 + 'px');
    } else {
      $("#side_button").css('top', header_message_height + 157 + 'px');
    }
  });
  var side_button_position = $('#side_button').offset();
  $(window).scroll(function () {
    if($(window).scrollTop() > side_button_position.top - 150) {
      $("#side_button").addClass('fixed');
    } else {
      $("#side_button").removeClass('fixed');
    }
  });
<?php }; ?>

});
</script>
<?php
       };

       // スライダーウィジェット --------------------
       if ( (is_single() && is_active_widget(false, false, 'post_slider_widget', true)) || (is_post_type_archive('news') && is_active_widget(false, false, 'post_slider_widget', true)) ) {
         wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
         wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  if( $('.post_slider').length ){
    $('.post_slider').slick({
      infinite: true,
      dots: true,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: false,
      pauseOnHover: false,
      autoplay: true,
      fade: false,
      easing: 'easeOutExpo',
      speed: 700,
      autoplaySpeed: 7000,
      responsive: [
        {
          breakpoint: 750,
          settings: { slidesToShow: 2 }
        },
        {
          breakpoint: 550,
          settings: { slidesToShow: 1 }
        }
      ]
    });
  }

});
</script>
<?php
       } // スライダーウィジェット

       // カスタムスクリプト--------------------------------------------
       if($options['script_code']) {
         echo "<script type='text/javascript'>\n" . $options['script_code'] . "\n</script>\n";
       };
       if(is_single() || is_page()) {
         global $post;
         $custom_script = get_post_meta($post->ID, 'custom_script', true);
         if($custom_script) {
           echo "<script type='text/javascript'>\n" . $custom_script . "\n</script>\n";
         };
       };

     }; // END function tcd_head()

     add_action("wp_head", "tcd_head");
?>