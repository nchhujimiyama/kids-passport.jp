<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['service_label'];
     $title_font_type = $options['service_title_font_type'];
     $title_direction = $options['service_title_direction'];
     $sub_title = $options['service_sub_title'];
     $sub_title_font_type = $options['service_sub_title_font_type'];
     $image_id = $options['service_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['service_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['service_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['service_overlay_opacity'];
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

 <div id="service_archive">

  <?php if($options['archive_service_headline'] || $options['archive_service_catch'] || $options['archive_service_desc']) { ?>
  <div id="content_header">
   <?php if(!empty($options['archive_service_headline'])) { ?>
   <h2 class="headline rich_font_<?php echo esc_attr($options['archive_service_headline_font_type']); ?>"><?php echo esc_html($options['archive_service_headline']); ?></h2>
   <?php }; ?>
   <?php if(!empty($options['archive_service_catch'])) { ?>
   <h3 class="catch rich_font_<?php echo esc_attr($options['archive_service_catch_font_type']); ?>"><?php echo esc_html($options['archive_service_catch']); ?></h3>
   <?php }; ?>
   <?php if(!empty($options['archive_service_desc'])) { ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($options['archive_service_desc'])); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php if ( have_posts() ) : ?>

  <div id="service_list" class="clearfix">

   <?php
        while ( have_posts() ) : the_post();
          $desc1 = get_post_meta($post->ID, 'desc1', true);
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
   ?>
   <article class="item clearfix">
    <a class="animate_background clearfix" href="<?php the_permalink(); ?>">
     <?php if($image) { ?>
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <?php }; ?>
     <div class="title_area">
      <h4 class="title"><?php the_title(); ?></h4>
      <?php if($desc1) { ?>
      <p class="desc"><span><?php echo wp_kses_post(nl2br($desc1)); ?></span></p>
      <?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; ?>

  </div><!-- END #service_list -->

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

 </div><!-- END #service_archive -->

</div><!-- END #main_contents -->

<?php get_footer(); ?>