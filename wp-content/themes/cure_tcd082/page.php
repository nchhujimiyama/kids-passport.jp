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

 <article id="page_content">

  <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
  <div class="post_content clearfix">

   <?php
        the_content();
        if ( ! post_password_required() ) {
          $pagenation_type = $options['pagenation_type'];
          if ( $pagenation_type == 'type2' ) {
            if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
   ?>
   <div id="p_readmore">
    <a class="button" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
    <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
   </div>
   <?php
            endif;
          } else {
            custom_wp_link_pages();
          }
        }
   ?>

  </div>

 </article><!-- END #page_content -->

 <?php endwhile; endif; ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>