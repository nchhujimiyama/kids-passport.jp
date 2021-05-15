<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu'][$item->ID] ) ) return $item_output;

  if ( 'type1' === $options['megamenu'][$item->ID] ) return $item_output;

  return sprintf( '<a href="%s" class="megamenu_button" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A - Service list ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu_service_list" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_service_list_inner clearfix">

  <?php if($options['mega_menu_a_catch']) { ?>
  <h3 class="headline"><?php echo esc_html($options['mega_menu_a_catch']); ?></h3>
  <?php }; ?>

  <?php if($options['mega_menu_a_link_label']) { ?>
  <div class="link_button">
   <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php echo esc_html($options['mega_menu_a_link_label']); ?></a>
  </div>
  <?php }; ?>

  <?php
       $args = array( 'post_type' => 'service', 'posts_per_page' => 8 );
       $post_list = new wp_query($args);
       $num_post = $post_list->post_count;
       if($post_list->have_posts()):
  ?>
  <div class="service_list clearfix">
   <?php
        while( $post_list->have_posts() ) : $post_list->the_post();
          $mega_image = get_post_meta($post->ID, 'mega_image', true);
          if($mega_image) {
            $image = wp_get_attachment_image_src( $mega_image, 'full' );
          }
   ?>
   <article class="item">
    <a href="<?php the_permalink(); ?>">
     <?php if($mega_image) { ?>
      <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
     <?php }; ?>
     <div class="title_area">
      <p class="title"><span><?php the_title(); ?></span></p>
     </div>
    </a>
   </article>
   <?php endwhile; ?>
  </div><!-- END .service_list -->
  <?php endif; wp_reset_query(); ?>

 </div>
</div>
<?php
}

// Mega menu B - Blog list ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu_blog_list" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_blog_list_inner clearfix">
  <?php
       $post_type = 'post';
       $post_num = $options['mega_menu_b_post_num'];
       if($options['mega_menu_b_post_order'] == 'rand') {
         $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => 'rand' );
       } else {
         $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
       }
       $post_list = new wp_query($args);
       $num_post = $post_list->post_count;
       if($post_list->have_posts()):
  ?>
  <div class="megamenu_blog_slider_wrap">
   <div class="megamenu_blog_slider">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
           }
    ?>
    <article class="item">
     <?php
          $blog_category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
          if ( $blog_category && ! is_wp_error($blog_category) ) {
            foreach ( $blog_category as $blog_cat ) :
              $blog_cat_name = $blog_cat->name;
              $blog_cat_id = $blog_cat->term_id;
              break;
            endforeach;
          };
     ?>
     <p class="category cat_id_<?php echo esc_attr($blog_cat_id); ?>"><a href="<?php echo esc_url(get_term_link($blog_cat_id,'category')); ?>"><?php echo esc_html($blog_cat_name); ?></a></p>
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <h4 class="title"><span><?php the_title(); ?></span></h4>
      </div>
     </a>
    </article>
    <?php endwhile; ?>
   </div><!-- END .megamenu_blog_slider -->
   <?php endif; wp_reset_query(); ?>
  </div><!-- END .megamenu_blog_slider_wrap -->
  <?php if($num_post > 4){ ?>
  <div class="carousel_arrow next_item"></div>
  <div class="carousel_arrow prev_item"></div>
  <?php }; ?>
 </div>
</div>
<?php
}
?>