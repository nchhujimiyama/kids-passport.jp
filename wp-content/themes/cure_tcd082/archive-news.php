<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['news_label'];
     $title_font_type = $options['news_title_font_type'];
     $title_direction = $options['news_title_direction'];
     $sub_title = $options['news_sub_title'];
     $sub_title_font_type = $options['news_sub_title_font_type'];
     $image_id = $options['news_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['news_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['news_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['news_overlay_opacity'];
     }
?>
<div id="page_header" <?php if($image_id) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
 <div id="page_header_inner">
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

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents" class="clearfix">

  <?php if($options['archive_news_headline'] || $options['archive_news_catch'] || $options['archive_news_desc']) { ?>
  <div id="content_header">
   <?php if(!empty($options['archive_news_headline'])) { ?>
   <h2 class="headline rich_font_<?php echo esc_attr($options['archive_news_headline_font_type']); ?>"><?php echo esc_html($options['archive_news_headline']); ?></h2>
   <?php }; ?>
   <?php if(!empty($options['archive_news_catch'])) { ?>
   <h3 class="catch rich_font_<?php echo esc_attr($options['archive_news_catch_font_type']); ?>"><?php echo esc_html($options['archive_news_catch']); ?></h3>
   <?php }; ?>
   <?php if(!empty($options['archive_news_desc'])) { ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($options['archive_news_desc'])); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

 <div id="main_col">

  <?php if ( have_posts() ) : ?>

  <div id="news_list" class="clearfix">
   <?php
        while ( have_posts() ) : the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
   ?>
   <article class="item clearfix">
    <a class="link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <div class="title_area">
      <div class="title_area_inner">
       <?php if ( $options['archive_news_show_date'] ){ ?>
       <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
       <?php }; ?>
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </div>
    </a>
   </article>
  <?php endwhile; ?>
  </div><!-- END #news_list -->

  <?php get_template_part('template-parts/navigation'); ?>

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

 </div><!-- END #main_col -->

  <?php if($options['archive_news_layout'] != 'type3') { get_sidebar(); }; ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>