<?php
     get_header();
     $options = get_design_plus_option();
     $title = get_the_title();
     $title_font_type = $options['service_title_font_type'];
     $title_direction = $options['service_title_direction'];
     $sub_title = $options['service_sub_title'];
     $sub_title_font_type = $options['service_sub_title_font_type'];
     if(has_post_thumbnail()) {
       $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
     }
     $use_overlay = $options['service_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['service_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['service_overlay_opacity'];
     }
?>
<div id="page_header" <?php if(has_post_thumbnail()) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
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

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div id="service_single">

  <?php
       $desc2 = get_post_meta($post->ID, 'desc2', true);
       if($desc2) {
  ?>
  <p id="service_top_desc"><?php echo wp_kses_post(nl2br($desc2)); ?></p>
  <?php }; ?>

  <?php
       // コンテンツビルダー
       $service_cf = get_post_meta( $post->ID, 'service_cf', true );
       if ( $service_cf && is_array( $service_cf ) ) :
         foreach( $service_cf as $key => $content ) :

           // コンテンツ１ -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
   ?>
   <div class="service_content service_content1 clearfix num<?php echo esc_attr($key); ?>">

    <?php if(!empty($content['headline'])) { ?>
    <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
    <?php }; ?>

    <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
    <div class="item_list">
     <?php
          foreach ( $content['item_list'] as $key => $value ) :
           $layout = $value['layout'] ? $value['layout'] : 'type1';
           $image = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
           $catch = $value['catch'];
           $catch_font_color = $value['catch_font_color'] ? $value['catch_font_color'] : '#00a7ce';
           $desc = $value['desc'];
     ?>
     <div class="item clearfix layout_<?php echo esc_attr($layout); ?>">
      <?php if($image){ ?>
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      <?php }; ?>
      <div class="content">
       <?php if($catch) { ?>
       <h3 class="catch" style="color:<?php echo esc_attr($catch_font_color); ?>;"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
       <?php }; ?>
       <?php if($desc) { ?>
       <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
       <?php }; ?>
      </div>
     </div>
     <?php endforeach; ?>
    </div><!-- END .item_list -->
    <?php endif; ?>

   </div><!-- END .service_content1 -->

   <?php
         // コンテンツ２ -----------------------------------------------------------------
         } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
   ?>
   <div class="service_content service_content2 clearfix num<?php echo esc_attr($key); ?>">

    <?php if(!empty($content['headline'])) { ?>
    <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
    <?php }; ?>

    <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
    <div class="item_list">
     <?php
          foreach ( $content['item_list'] as $key => $value ) :
           $image = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
           $desc = $value['desc'];
     ?>
     <div class="item clearfix">
      <?php if($image){ ?>
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      <?php }; ?>
      <div class="content">
       <?php if($desc) { ?>
       <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
       <?php }; ?>
      </div>
     </div>
     <?php endforeach; ?>
    </div><!-- END .item_list -->
    <?php endif; ?>

   </div><!-- END .service_content2 -->

   <?php
         // 料金一覧 -----------------------------------------------------------------
         } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
   ?>
   <div class="service_content service_content3 clearfix num<?php echo esc_attr($key); ?>">

    <?php if(!empty($content['headline'])) { ?>
    <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
    <?php }; ?>

    <?php if(!empty($content['list_headline'])) { ?>
    <h4 class="list_headline"><?php echo esc_html($content['list_headline']); ?></h4>
    <?php }; ?>
    <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
    <dl class="price_list">
     <?php
          foreach ( $content['item_list'] as $key => $value ) :
           $name = $value['name'];
           $price = $value['price'];
     ?>
     <?php if($name) { ?>
     <dt><?php echo wp_kses_post(nl2br($name)); ?></dt>
     <?php }; ?>
     <?php if($price) { ?>
     <dd><?php echo wp_kses_post(nl2br($price)); ?></dd>
     <?php }; ?>
     <?php endforeach; ?>
    </dl><!-- END .price_list -->
    <?php endif; ?>

   </div><!-- END .service_content3 -->

   <?php
        // フリースペース -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content'] ) {
   ?>
   <div class="service_content service_content4 clearfix num<?php echo esc_attr($key); ?> cb_free_space <?php if(!empty($content['content_width'])) { echo esc_attr($content['content_width']); }; ?>">
    <?php if(!empty($content['desc'])) { ?>
    <div class="post_content clearfix">
     <?php echo apply_filters('the_content', $content['desc'] ); ?>
    </div>
    <?php }; ?>
   </div><!-- END .product_content2 -->
   <?php
            };
          endforeach; // END 並び替え
        endif;
   ?>

   <?php
        // 診療科目一覧 -----------------------------------------------------------------
        if ($options['show_single_service_list']){
          $current_post_id = $post->ID;
          $post_num = $options['single_service_list_num'];
          $args = array( 'post_type' => 'service', 'posts_per_page' => $post_num );
          $post_list = new wp_query($args);
          if($post_list->have_posts()):
   ?>
   <div class="service_list">
   <?php if(!empty($options['single_service_list_headline'])) { ?>
   <h3 class="top_headline rich_font_<?php echo esc_attr($options['single_service_list_headline_font_type']); ?>"><?php echo esc_html($options['single_service_list_headline']); ?></h3>
   <?php }; ?>
   <ul class="clearfix">
     <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
     <li<?php if($current_post_id == $post->ID){ echo ' class="active"'; }; ?>><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></li>
     <?php endwhile; ?>
    </ul>
   </div><!-- END .service_list -->
   <?php endif; wp_reset_query(); ?>
   <?php }; ?>

 </div><!-- END #service_single -->

 <?php endwhile; endif; ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>