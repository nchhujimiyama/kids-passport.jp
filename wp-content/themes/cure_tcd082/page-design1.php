<?php
/*
Template Name:About page
*/
__('About page', 'tcd-w');
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

 <div id="design_page1">

  <?php
       $page_headline = get_post_meta($post->ID, 'dc1_headline', true);
       $page_headline_font_type = get_post_meta($post->ID, 'dc1_headline_font_type', true) ?  get_post_meta($post->ID, 'dc1_headline_font_type', true) : 'type2';
       $page_catch = get_post_meta($post->ID, 'dc1_catch', true);
       $page_catch_font_type = get_post_meta($post->ID, 'dc1_catch_font_type', true) ?  get_post_meta($post->ID, 'dc1_catch_font_type', true) : 'type3';
       $page_desc = get_post_meta($post->ID, 'dc1_desc', true);
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
      $design1_content = get_post_meta( $post->ID, 'design1_content', true );
      if ( $design1_content && is_array( $design1_content ) ) :
        foreach( $design1_content as $key => $content ) :

        // コンテンツ１ -----------------------------------------------------------------
        if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
  ?>
  <div class="design1_content1 design1_content num<?php echo esc_attr($key); ?>" id="dc1_content_<?php echo $key; ?>">

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
   <div class="content_area">

    <div class="main_image" <?php if($bg_image) { ?>style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
     <?php if($content['catch']){ ?>
     <h3 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> <?php if($content['catch_direction']) { echo 'type2'; }; ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h3>
     <?php }; ?>
     <?php if($use_overlay) { ?>
      <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
     <?php }; ?>
    </div><!-- END .main_image -->

    <?php if($content['item_headline1'] || $content['item_headline2'] || $content['item_headline3']){ ?>
    <div class="item_list clearfix">
     <?php
          for($i = 1; $i <= 3; $i++):
            $image = $content['item_image'.$i] ? wp_get_attachment_image_src( $content['item_image'.$i], 'full' ) : '';
            if($content['item_headline'.$i]){
     ?>
     <div class="item">
      <?php if($image){ ?>
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      <?php }; ?>
      <?php if($content['item_headline'.$i]){ ?>
      <h4 class="headline" style="color:<?php echo esc_attr($content['item_headline_font_color'.$i]); ?>;"><?php echo wp_kses_post(nl2br($content['item_headline'.$i])); ?></h4>
      <?php }; ?>
      <?php if($content['item_desc'.$i]){ ?>
      <p class="desc"><?php echo wp_kses_post(nl2br($content['item_desc'.$i])); ?></p>
      <?php }; ?>
     </div>
     <?php
            };
          endfor;
     ?>
    </div><!-- END .item_list -->
    <?php }; ?>

   </div><!-- END .content_area -->

  </div><!-- END .design1_content1 -->

  <?php
        // コンテンツ２ -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
  ?>
  <div class="design1_content2 design1_content num<?php echo esc_attr($key); ?>" id="dc1_content_<?php echo $key; ?>">

   <?php if(!empty($content['headline'])) { ?>
   <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
   <?php }; ?>

   <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
   <div class="item_list">
    <?php
         foreach ( $content['item_list'] as $key => $value ) :
          $layout = $value['layout'] ? $value['layout'] : 'type1';
          $image = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
          $catch = $value['catch'];
          $catch_font_color = $value['catch_font_color'] ? $value['catch_font_color'] : '#00a8cc';
          $desc = $value['desc'];
          $caption = $value['caption'];
    ?>
    <div class="item clearfix layout_<?php echo esc_attr($layout); ?>">
     <?php if($image){ ?>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;">
      <?php if($caption) { ?>
      <p class="caption"><?php echo wp_kses_post(nl2br($caption)); ?></p>
      <?php }; ?>
     </div>
     <?php }; ?>
     <div class="content">
      <div class="content_inner">
       <?php if($catch) { ?>
       <h3 class="catch rich_font_<?php echo esc_attr($content['list_catch_font_type']); ?>" style="color:<?php echo esc_attr($catch_font_color); ?>;"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
       <?php }; ?>
       <?php if($desc) { ?>
       <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
       <?php }; ?>
      </div>
     </div>
    </div>
    <?php endforeach; ?>
   </div><!-- END .item_list -->
   <?php endif; ?>

  </div><!-- END .design1_content2 -->

  <?php
        // コンテンツ３ -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
  ?>
  <div class="design1_content3 design1_content num<?php echo esc_attr($key); ?>" id="dc1_content_<?php echo $key; ?>">

   <?php if(!empty($content['headline'])) { ?>
   <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
   <?php }; ?>

   <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
   <div class="item_list clearfix">
    <?php
         foreach ( $content['item_list'] as $key => $value ) :
          $image = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
          $desc = $value['desc'];
    ?>
    <div class="item clearfix">
     <?php if($image){ ?>
     <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
     <?php }; ?>
     <?php if($desc) { ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
     <?php }; ?>
    </div>
    <?php endforeach; ?>
   </div><!-- END .item_list -->
   <?php endif; ?>

  </div><!-- END .design1_content3 -->

  <?php
       // フリースペース -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
  ?>
  <div class="design1_content4 design1_content num<?php echo esc_attr($key); ?> cb_free_space <?php if(!empty($content['content_width'])) { echo esc_attr($content['content_width']); }; ?>" id="dc1_content_<?php echo $key; ?>">

   <?php if(!empty($content['desc'])) { ?>
   <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $content['desc'] ); ?>
   </div>
   <?php }; ?>

  </div><!-- END .design1_content4 -->

  <?php
           };
         endforeach; // END 並び替え
       endif;
  ?>

 </div><!-- END #access_page -->

 <?php endwhile; endif; ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>