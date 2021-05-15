<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['faq_label'];
     $title_font_type = $options['faq_title_font_type'];
     $title_direction = $options['faq_title_direction'];
     $sub_title = $options['faq_sub_title'];
     $sub_title_font_type = $options['faq_sub_title_font_type'];
     $image_id = $options['faq_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['faq_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['faq_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['faq_overlay_opacity'];
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

 <div id="faq_archive">

  <?php if($options['archive_faq_headline'] || $options['archive_faq_catch'] || $options['archive_faq_desc']) { ?>
  <div id="content_header">
   <?php if(!empty($options['archive_faq_headline'])) { ?>
   <h2 class="headline rich_font_<?php echo esc_attr($options['archive_faq_headline_font_type']); ?>"><?php echo esc_html($options['archive_faq_headline']); ?></h2>
   <?php }; ?>
   <?php if(!empty($options['archive_faq_catch'])) { ?>
   <h3 class="catch rich_font_<?php echo esc_attr($options['archive_faq_catch_font_type']); ?>"><?php echo esc_html($options['archive_faq_catch']); ?></h3>
   <?php }; ?>
   <?php if(!empty($options['archive_faq_desc'])) { ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($options['archive_faq_desc'])); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       if($options['show_faq_category_list']) {
         $category = get_terms( 'faq_category', array( 'orderby' => 'order' ) );
         if ( $category && ! is_wp_error( $category ) ) :
  ?>
  <ul id="faq_category_button" class="clearfix">
   <?php
        $i = 1;
        foreach ( $category as $cat ):
          $cat_id = $cat->term_id;
          $cat_name = $cat->name;
   ?>
   <li <?php if($i == 1){ echo 'class="active"'; }; ?> data-cat_id="faq_cat<?php echo esc_attr($cat_id); ?>"><p><?php echo esc_html($cat_name); ?></p></li>
   <?php $i++; endforeach; ?>
  </ul>
  <?php endif; }; ?>

  <?php
       if($options['show_faq_category_list']) {
         if ( $category && ! is_wp_error( $category ) ) :
           $i = 1;
           foreach ( $category as $cat ):
             $cat_id = $cat->term_id;
             $args = array( 'post_type' => 'faq', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'faq_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
             $faq_list = new wp_query($args);
             if($faq_list->have_posts()):

  ?>
  <div class="faq_list clearfix" id="faq_cat<?php echo esc_attr($cat_id); ?>" <?php if($i != 1) { echo 'style="display:none;"'; }; ?>>
   <?php while( $faq_list->have_posts() ) : $faq_list->the_post(); ?>
   <article class="item clearfix">
    <h4 class="question"><?php the_title(); ?></h4>
    <div class="answer post_content clearfix" style="display:none;">
     <?php the_content(); ?>
    </div>
   </article>
   <?php $i++; endwhile; wp_reset_query(); ?>
  </div><!-- END .faq_list -->
  <?php
             endif;
          endforeach;
        endif;
      } else {
        $args = array( 'post_type' => 'faq', 'posts_per_page' => -1);
        $faq_list = new wp_query($args);
        if($faq_list->have_posts()):
  ?>
  <div class="faq_list clearfix">
   <?php while( $faq_list->have_posts() ) : $faq_list->the_post(); ?>
   <article class="item clearfix">
    <h4 class="question"><?php the_title(); ?></h4>
    <div class="answer post_content clearfix" style="display:none;">
     <?php the_content(); ?>
    </div>
   </article>
   <?php endwhile; wp_reset_query(); ?>
  </div><!-- END .faq_list -->
  <?php
         endif;
       };
  ?>

 </div><!-- END #faq_archive -->

</div><!-- END #main_contents -->

<?php get_footer(); ?>