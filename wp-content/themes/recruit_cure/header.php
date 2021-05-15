<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
  <head>
<?php }; ?>
  <meta charset="<?php bloginfo('charset'); ?>">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="description" content="<?php seo_description(); ?>">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php
  if ( $options['favicon'] ) {
    $favicon_image = wp_get_attachment_image_src( $options['favicon'], 'full');
    if(!empty($favicon_image)) { ?>
      <link rel="shortcut icon" href="<?php echo esc_url($favicon_image[0]); ?>">
  <?php }; }; ?>
  <?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>

  <?php
  if ($options['show_load_screen'] == 'type2') {
    if(is_front_page()){
      load_icon();
    }
  } elseif ($options['show_load_screen'] == 'type3') {
    if(is_front_page() || is_home() || is_archive() ){
      load_icon();
    }
  };
  ?>

  <?php require get_stylesheet_directory() . '/lib/custom_post/footer-cta.php'; ?>

  <div id="container">

  <?php
  // Message --------------------------------------------------------------------
  if($options['show_header_message'] && $options['header_message']) {
    if( (is_front_page() && $options['show_header_message_top']) || (!is_front_page() && $options['show_header_message_sub']) ) { ?>
      <div id="header_message" class="<?php echo esc_attr($options['header_message_width']); ?>" style="background:<?php echo esc_attr($options['header_message_bg_color']); ?>; color:<?php echo esc_attr($options['header_message_font_color']); ?>;">
        <div class="post_content clearfix">
          <?php echo apply_filters('the_content', $options['header_message'] ); ?>
        </div>
      </div>
  <?php }; }; ?>

  <header id="header">
    <?php
    // logo
    if( is_page() && get_post_meta($post->ID, 'page_hide_logo', true) ) { } else { ?>
      <div id="header_logo">
        <?php header_logo(); ?>
      </div>
    <?php };

    // global menu
    if (has_nav_menu('global-menu')) {
      if( is_page() && get_post_meta($post->ID, 'page_hide_global_menu', true) ) { } else { ?>
        <a id="menu_button" href="#"><span></span><span></span><span></span></a>
        <nav id="global_menu">
          <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
        </nav>
        <?php get_template_part( 'template-parts/megamenu' ); ?>
    <?php }; }; ?>
  </header>

  <?php
  // Side bar --------------------------------------------------------------------
  if( $options['show_side_bar']) {
    if(
        (is_page() && !get_post_meta($post->ID, 'page_hide_side_bar', true)) ||
        (is_singular('post') && $options['show_blog_single_sidebar']) ||
        (empty(get_query_var('post_type')) && $options['show_blog_archive_sidebar'] && (is_archive() || is_home() || is_search()) ) ||
        (is_singular('news') && $options['show_news_single_sidebar']) ||
        (is_post_type_archive('news') && $options['show_news_archive_sidebar']) ||
        (is_post_type_archive('offer') && $options['show_offer_archive_sidebar']) ||
        (is_singular('offer') && $options['show_offer_archive_sidebar']) ||
        (is_singular('service') && $options['show_service_single_sidebar']) ||
        (is_post_type_archive('service') && $options['show_service_archive_sidebar']) ||
        (is_post_type_archive('faq') && $options['show_faq_archive_sidebar'])
    ){ ?>
      <div id="side_button" class="<?php echo esc_attr($options['side_bar_position']); ?>">
        <?php
        $i = 1;
        foreach ( $options['side_bar'] as $key => $value ) :
          if($value['icon'] != 'tel'){ ?>
            <div class="item num<?php echo $i; ?> side_button_icon_<?php echo esc_attr($value['icon']); ?>"><a href="<?php if($value['url']) { echo esc_url($value['url']); }; ?>" <?php if($value['target']) { echo 'target="_blank"'; }; ?>><?php if($value['label']) { echo esc_html($value['label']); }; ?></a></div>
          <?php } else { ?>
            <div class="item num<?php echo $i; ?> side_button_icon_tel"><a href="tel:<?php if($value['tel']) { echo esc_attr($value['tel']); }; ?>"><?php if($value['tel']) { echo esc_html($value['tel']); }; ?></a></div>
          <?php };
          $i++;
        endforeach; ?>
      </div>
    <?php }
  }

  //  Header slider -------------------------------------------------------------------------
  if(is_front_page()) {
    if($options['show_index_slider'] || $options['mobile_show_index_slider']) { ?>
      <div id="header_slider">
        <?php
        $i = 1;
        if(is_mobile() && $options['mobile_show_index_slider']) {
          $index_slider = $options['mobile_index_slider'];
        } else {
          $index_slider = $options['index_slider'];
        }
        $slider_item_total = count($index_slider);
        foreach ( $index_slider as $key => $value ) :
          $slider_type = $value['slider_type'];
          $animation_type = $value['animation_type'];
          if($slider_type == 'type1') {
            // image slider ------------------------------------------------------
            $image = wp_get_attachment_image_src( $value['image'], 'full');
            if(!empty($image)) {
              $catch = esc_html($value['catch']);
              if(!empty($catch)){
                $catch = '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($catch,"\n\r")).'</span>';
              } ?>
              <div class="item image_item item<?php echo $i; ?> slick-slide animation_<?php echo esc_attr($animation_type); ?>">
                <?php if(!empty($catch)){ ?><h3 class="catch <?php if($value['catch_direction']) { echo 'type2'; }; ?> rich_font_<?php echo esc_attr($value['catch_font_type']); ?>"><?php echo $catch; ?></h3><?php }; ?>
                <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>
                <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
              </div><!-- END .item -->
            <?php } // END if has image
          // video slider ------------------------------------------------------
          } elseif($slider_type == 'type2') {
            $video = $value['video'];
            if($video && auto_play_movie()) {
              $video_image = wp_get_attachment_image_src( $value['video_image'], 'full');
              $catch = esc_html($value['catch']);
              if(!empty($catch)){
                $catch = '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($catch,"\n\r")).'</span>';
              } ?>
              <div class="item video item<?php echo $i; ?>">
                <h3 class="catch animation_<?php echo esc_attr($value['catch_animation_type']); ?> rich_font_<?php echo esc_attr($value['catch_font_type']); ?><?php if($value['catch_direction']){ echo ' type2'; }; ?>"><?php echo $catch; ?></h3>
                <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>
                <div class="video_wrap">
                <div class="video_inner">
                  <video class="slide-video slide-media" preload="auto" muted playsinline <?php if($slider_item_total == 1) { echo "loop"; }; ?>>
                  <source src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" type="video/mp4" />
                  </video>
                </div>
                </div>
              </div><!-- END .item -->
            <?php } else {
              $image = wp_get_attachment_image_src( $value['video_image'], 'full');
              if($image) {
                $catch = esc_html($value['catch']);
                if(!empty($catch)){
                  $catch = '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($catch,"\n\r")).'</span>';
                } ?>
                <div class="item image_item item<?php echo $i; ?> slick-slide">
                  <h3 class="catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?><?php if($value['catch_direction']){ echo ' type2'; }; ?>"><?php echo $catch; ?></h3>
                  <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>
                  <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                </div><!-- END .item -->
              <?php }; // END has image
            }; // END has video

            // youtube slider ------------------------------------------------------
          } elseif($slider_type == 'type3') {
            $youtube_url = $value['youtube'];
            if($youtube_url && auto_play_movie()) {
              if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube_url, $matches)) {
                $catch = esc_html($value['catch']);
                if(!empty($catch)){
                  $catch = '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($catch,"\n\r")).'</span>';
                } ?>
                <div class="item youtube item<?php echo $i; ?>">
                  <h3 class="catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?><?php if($value['catch_direction']){ echo ' type2'; }; ?>"><?php echo $catch; ?></h3>
                  <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>
                  <div class="video_wrap">
                    <div class="video_inner">
                      <iframe id="youtube-player-<?php echo $i; ?>" class="youtube-player slide-youtube slide-media" src="https://www.youtube.com/embed/<?php echo esc_attr($matches[1]); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&<?php if($slider_item_total > 1) { echo "loop=0"; } else { echo "playlist=" . esc_attr($matches[1]); }; ?>&playsinline=1" frameborder="0"></iframe>
                    </div>
                  </div>
                </div><!-- END .item -->
              <?php };
            } else {
              $image = wp_get_attachment_image_src( $value['youtube_image'], 'full');
              if(!empty($image)) {
                $catch = esc_html($value['catch']);
                if(!empty($catch)){
                  $catch = '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($catch,"\n\r")).'</span>';
                } ?>
                <div class="item image_item item<?php echo $i; ?> slick-slide">
                  <h3 class="catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?><?php if($value['catch_direction']){ echo ' type2'; }; ?>"><?php echo $catch; ?></h3>
                  <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>
                  <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                </div><!-- END .item -->
              <?php }; // END has image
            }; // END has youtube
          }; // END slider type
          $i++;
        endforeach;

        // Box content --------------------------------------------------------------------
        if( $options['show_index_box']) { ?>
          <div id="index_box_content" class="clearfix">
            <?php
            for ( $i = 1; $i <= 3; $i++ ) :
              if( $options['show_index_box'.$i]) { ?>
                <div class="box_item box_item<?php echo $i; ?>">
                  <h3 class="title rich_font"><?php echo esc_html($options['index_box_content_title'.$i]); ?></h3>
                  <div class="desc">
                    <p><?php echo esc_html($options['index_box_content_desc'.$i]); ?></p>
                  </div>
                  <a class="link" href="<?php echo esc_url($options['index_box_content_url'.$i]); ?>"><?php echo esc_html($options['index_box_content_link_label'.$i]); ?></a>
                </div>
            <?php }; endfor; ?>
          </div><!-- END #index_box_content -->
        <?php }; ?>
      </div><!-- END #header_slider -->
    <?php };

    // News --------------------------------------------------------------------
    if( $options['show_header_news']) {
      $post_num = $options['header_news_num'];
      $post_type = $options['header_news_type'];
      if($options['header_news_order'] == 'rand') {
        $args = array( 'post_type' => $post_type, 'orderby' => 'rand', 'posts_per_page' => $post_num );
      } else {
        $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
      }
      $news_query = new wp_query($args);
      if ($news_query->have_posts()) : ?>
        <div id="index_news">
          <div id="index_news_inner">
            <div id="index_news_slider">
              <?php while($news_query->have_posts()): $news_query->the_post(); ?>
                <article class="item">
                  <a href="<?php the_permalink() ?>" class="clearfix">
                    <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p>
                    <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
                  </a>
                </article>
              <?php endwhile;  ?>
            </div>
            <?php if($post_type == 'post') { ?>
              <a class="archive_link" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($options['header_news_link_label']); ?></a>
            <?php } else { ?>
              <a class="archive_link" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($options['header_news_link_label']); ?></a>
            <?php }; ?>
          </div>
        </div>
      <?php endif;
      wp_reset_postdata();
    }; // END news
  }; // END front page
?>
