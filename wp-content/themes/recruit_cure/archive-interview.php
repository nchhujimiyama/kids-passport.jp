<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['interview_label'];
     $title_font_type = $options['interview_title_font_type'];
     $title_direction = $options['interview_title_direction'];
     $sub_title = $options['interview_sub_title'];
     $sub_title_font_type = $options['interview_sub_title_font_type'];
     $image_id = $options['interview_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['interview_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['interview_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['interview_overlay_opacity'];
     }
     // overwrite the data if category data exist
     $current_cat_id = '';
     if (is_tax('interview_division') || is_tax('interview_occupation')) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $title = $query_obj->name;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       if (!empty($term_meta['image'])){
         $image_id = $term_meta['image'];
         $image = wp_get_attachment_image_src( $image_id, 'full' );
       }
       if (!empty($term_meta['use_overlay'])){
         if (!empty($term_meta['overlay_color'])){
           $overlay_color = hex2rgb($term_meta['overlay_color']);
           $overlay_color = implode(",",$overlay_color);
           if (!empty($term_meta['overlay_opacity'])){
             $overlay_opacity = $term_meta['overlay_opacity'];
           } else {
             $overlay_opacity = '0.3';
           }
         }
       }
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

 <div id="blog_archive">

  <?php
       $desc = '';
       if (is_tax('interview_division') || is_tax('interview_occupation')) {
         if (!empty($query_obj->description)){
           $desc = $query_obj->description;
         }
       } else {
         $desc = $options['archive_interview_desc'];
       }
       if($desc) {
  ?>
  <div id="content_header">
   <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  </div>
  <?php }; ?>

  <div id="blog_sort_button">
    <a href="#" class="active" data-filter="all">すべて</a>
    <?php
    $categories = get_terms('interview_division', ['parent' => 0]);
    if( $categories && !is_wp_error($category) ) {
      foreach( $categories as $category ) {
        ?>
        <a href="#" class="" data-filter="<?= $category->slug; ?>"><?= $category->name; ?></a>
        <?php
      }
    }
    ?>
  </div>

  <?php if ( have_posts() ) : ?>

  <div id="blog_list" class="clearfix">
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

          $category = '';
          $categories = get_the_terms( $post->ID, 'interview_division' , array( 'orderby' => 'term_order' ));
          if( $categories && !is_wp_error($categories) ) {
            foreach( $categories as $cat ) {
              if( !$cat->parent ) $category = $cat->slug;
            }
          }
   ?>
    <article class="item" data-category="<?= $category; ?>">
        <?php
        if ($options['show_archive_interview_category']){
          if( is_tax('interview_division') ) {
            ?>
            <p class="category cat_id_<?php echo esc_attr($query_obj->term_id); ?>"><a href="<?php echo esc_url(get_term_link($query_obj->term_id,'interview_division')); ?>"><?php echo esc_html($query_obj->name); ?></a></p>
            <?php
          } else if ( is_tax('interview_occupation') ) {
            ?>
            <p class="category cat_id_<?php echo esc_attr($query_obj->term_id); ?>"><a href="<?php echo esc_url(get_term_link($query_obj->term_id,'interview_occupation')); ?>"><?php echo esc_html($query_obj->name); ?></a></p>
            <?php
          } else {
            $blog_category = get_the_terms( $post->ID, 'interview_division' , array( 'orderby' => 'term_order' ));
            $blog_cat_name = '';
            $blog_cat_id = '';
            if ( $blog_category && ! is_wp_error($blog_category) ) {
              foreach ( $blog_category as $blog_cat ) :
                $blog_cat_name = $blog_cat->name;
                $blog_cat_id = $blog_cat->term_id;
                break;
              endforeach;
            };
            if ( $blog_cat_name && $blog_cat_id ) {
          ?>
          <p class="category cat_id_<?php echo esc_attr($blog_cat_id); ?>"><a href="<?php echo esc_url(get_term_link($blog_cat_id,'interview_division')); ?>"><?php echo esc_html($blog_cat_name); ?></a></p>
        <?php };};};  ?>
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <h4 class="title"><span><?php the_title(); ?></span></h4>
       <?php if ( $options['show_archive_interview_date'] ){ ?>
       <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
       <?php }; ?>
      </div>
     </a>
    </article>
   <?php endwhile; ?>
  </div><!-- END #blog_list -->

  <?php get_template_part('template-parts/navigation'); ?>

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

 </div><!-- END #blog_archive -->

</div><!-- END #main_contents -->

<?php get_footer(); ?>