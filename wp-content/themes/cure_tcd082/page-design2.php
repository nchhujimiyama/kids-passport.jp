<?php
/*
Template Name:Staff page
*/
__('Staff page', 'tcd-w');
?>
<?php
     get_header();
     $options = get_design_plus_option();
     $title = get_the_title();
     $title_font_type = get_post_meta($post->ID, 'page_header_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_title_font_type', true) : 'type3';
     $title_direction = get_post_meta($post->ID, 'page_header_title_direction', true);
     $sub_title = get_post_meta($post->ID, 'page_header_sub_title', true);
     $sub_title_font_type = get_post_meta($post->ID, 'page_header_sub_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_type', true) : 'type2';
     $image_id = get_post_meta($post->ID, 'page_header_bg_image', true);
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
     if($use_overlay) {
       $overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';
     }
     $page_sub_title_type = get_post_meta($post->ID, 'page_sub_title_type', true) ?  get_post_meta($post->ID, 'page_sub_title_type', true) : 'type1';
     $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';
     $page_header_width = get_post_meta($post->ID, 'page_header_width', true) ?  get_post_meta($post->ID, 'page_header_width', true) : 'type1';
     if($page_header_width == 'type1') {
       $page_header_width = '1200px';
     } elseif($page_header_width == 'type2') {
       $page_header_width = $page_content_width . 'px';
     } else {
       $page_header_width = '100%';
     }
     if( empty(get_post_meta($post->ID, 'page_hide_header_image', true)) ) {
?>
<div id="page_header" <?php if($page_sub_title_type == 'type2') { echo 'class="type2"'; }; ?> style="width:<?php echo esc_attr($page_header_width); ?>; <?php if($image_id) { ?>background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;<?php }; ?>">
 <div id="page_header_inner" style="width:<?php echo esc_attr($page_content_width); ?>px;">
  <?php if($title){ ?>
  <h2 class="title rich_font_<?php echo esc_attr($title_font_type); ?> <?php if($title_direction) { echo 'type2'; }; ?>"><?php echo wp_kses_post(nl2br($title)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <h3 class="sub_title rich_font_<?php echo esc_attr($sub_title_font_type); ?>"><span><?php echo wp_kses_post(nl2br($sub_title)); ?></span></h3>
  <?php }; ?>
 </div>
 <?php if($use_overlay) { ?>
 <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
 <?php }; ?>
</div>
<?php }; ?>

<?php
     if( empty(get_post_meta($post->ID, 'page_hide_bread', true)) ) {
       get_template_part('template-parts/breadcrumb');
     };
?>

<div id="main_contents" style="width:<?php echo esc_attr($page_content_width); ?>px;">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div id="design_page2">

  <?php
       $page_headline = get_post_meta($post->ID, 'dc2_headline', true);
       $page_headline_font_type = get_post_meta($post->ID, 'dc2_headline_font_type', true) ?  get_post_meta($post->ID, 'dc2_headline_font_type', true) : 'type2';
       $page_catch = get_post_meta($post->ID, 'dc2_catch', true);
       $page_catch_font_type = get_post_meta($post->ID, 'dc2_catch_font_type', true) ?  get_post_meta($post->ID, 'dc2_catch_font_type', true) : 'type3';
       $page_desc = get_post_meta($post->ID, 'dc2_desc', true);
       if($page_headline || $page_catch || $page_desc){
  ?>
  <div id="content_header">
   <?php if($page_headline) { ?>
   <h2 class="headline rich_font_<?php echo esc_attr($page_headline_font_type); ?>"><?php echo esc_html($page_headline); ?></h2>
   <?php }; ?>
   <?php if($page_catch) { ?>
   <h3 class="catch rich_font_<?php echo esc_attr($page_catch_font_type); ?>"><?php echo esc_html($page_catch); ?></h3>
   <?php }; ?>
   <?php if($page_desc) { ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($page_desc)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

 <?php
      // コンテンツビルダー
      $design2_content = get_post_meta( $post->ID, 'design2_content', true );
      if ( $design2_content && is_array( $design2_content ) ) :
        foreach( $design2_content as $key => $content ) :

        // コンテンツ１ -----------------------------------------------------------------
        if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
  ?>
  <div class="design2_content1 design2_content num<?php echo esc_attr($key); ?>" id="dc2_content_<?php echo $key; ?>">

   <?php if(!empty($content['headline'])) { ?>
   <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
   <?php }; ?>

   <?php
        $bg_image = $content['bg_image'] ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
        $use_overlay = $content['bg_use_overlay'];
        if($use_overlay) {
          $overlay_color = $content['bg_overlay_color'] ?  $content['bg_overlay_color'] : '#000000';
          $overlay_color = hex2rgb($overlay_color);
          $overlay_color = implode(",",$overlay_color);
          $overlay_opacity = $content['bg_overlay_opacity'] ?  $content['bg_overlay_opacity'] : '0.3';
        }
        $catch_font_type = $content['catch_font_type'] ?  $content['catch_font_type'] : 'type3';
   ?>
   <div class="content_area" style="background:<?php echo esc_attr($content['bg_color']); ?>;">

    <div class="main_image" <?php if($bg_image) { ?>style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
     <?php if($content['catch']){ ?>
     <h3 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> <?php if($content['catch_direction']) { echo 'type2'; }; ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h3>
     <?php }; ?>
     <?php if($use_overlay) { ?>
      <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
     <?php }; ?>
    </div><!-- END .main_image -->

    <?php
         if(!empty($content['display_author'])) {
           $user_data = get_userdata($content['display_author']);
           $name = $user_data->display_name;
           $category = $user_data->user_cat;
           $sub_title = $user_data->user_sub_title;
           $prof = $user_data->user_prof;
           $message = $user_data->user_message;
           $image = $user_data->profile_image;
    ?>
    <div class="user_info" style="background:<?php echo esc_attr($content['bg_color']); ?>;">

     <?php if(!empty($message)) { ?>
     <div class="post_content clearfix message">
      <?php echo apply_filters('the_content', $message ); ?>
     </div>
     <?php }; ?>

     <?php if(!empty($name)) { ?>
     <div class="name_area">
      <?php if(!empty($category)) { ?>
      <p class="category"><?php echo esc_html($category); ?></p>
      <?php }; ?>
      <?php if(!empty($name)) { ?>
      <h3 class="name rich_font_<?php echo esc_attr($content['author_title_font_type']); ?>"><?php echo esc_html($name); ?></h3>
      <?php }; ?>
      <?php if(!empty($sub_title)) { ?>
      <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
      <?php }; ?>
     </div>
     <?php }; ?>

     <?php if(!empty($prof)) { ?>
     <div class="post_content clearfix prof">
      <?php echo apply_filters('the_content', $prof ); ?>
     </div>
     <?php }; ?>

    </div>
    <?php }; ?>

   </div><!-- END .content_area -->

  </div><!-- END .design2_content1 -->

  <?php
        // コンテンツ２ -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
  ?>
  <div class="design2_content2 design2_content num<?php echo esc_attr($key); ?>" id="dc2_content_<?php echo $key; ?>">

   <?php if(!empty($content['headline'])) { ?>
   <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
   <?php }; ?>

   <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
   <div class="item_list layout_<?php echo esc_attr($content['layout']); ?>">
    <?php
         foreach ( $content['item_list'] as $key => $value ) :
           if(!empty($value['display_author'])) {
             $user_data = get_userdata($value['display_author']);
             $name = $user_data->display_name;
             $category = $user_data->user_cat;
             $sub_title = $user_data->user_sub_title;
             $message = $user_data->user_message;
             $image = $user_data->profile_image ? wp_get_attachment_image_src( $user_data->profile_image, 'full' ) : '';
    ?>
    <div class="item clearfix" style="background:<?php echo esc_attr($content['bg_color']); ?>;">
     <?php if($image){ ?>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div>
     <?php }; ?>
     <div class="content">
      <div class="content_inner">
       <div class="name_area clearfix">
        <?php if(!empty($category)) { ?>
        <p class="category"><?php echo esc_html($category); ?></p>
        <?php }; ?>
        <?php if(!empty($name)) { ?>
        <h3 class="name rich_font_<?php echo esc_attr($content['author_title_font_type']); ?> clearfix"><span class="title"><?php echo esc_html($name); ?></span><?php if(!empty($sub_title)) { ?><span class="sub_title"><?php echo esc_html($sub_title); ?></span><?php }; ?></h3>
        <?php }; ?>
       </div>
       <?php if(!empty($message)) { ?>
       <div class="post_content clearfix message">
        <?php echo apply_filters('the_content', $message ); ?>
       </div>
       <?php }; ?>
      </div>
     </div>
    </div>
    <?php }; endforeach; ?>
   </div><!-- END .item_list -->
   <?php endif; ?>

  </div><!-- END .design2_content2 -->

  <?php
       // フリースペース -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
  ?>
  <div class="design2_content3 design2_content num<?php echo esc_attr($key); ?> cb_free_space <?php if(!empty($content['content_width'])) { echo esc_attr($content['content_width']); }; ?>" id="dc2_content_<?php echo $key; ?>">

   <?php if(!empty($content['desc'])) { ?>
   <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $content['desc'] ); ?>
   </div>
   <?php }; ?>

  </div><!-- END .design2_content3 -->

  <?php
           };
         endforeach; // END 並び替え
       endif;
  ?>

 </div><!-- END #staff_page -->

 <?php endwhile; endif; ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>