<?php
$options = get_design_plus_option();
get_header();
?>
<div id="index_content_builder">
  <?php
  // コンテンツビルダー
  if ($options['contents_builder'] || $options['mobile_contents_builder']) :
    $content_count = 1;
    if(is_mobile() && $options['mobile_show_contents_builder']) {
      $contents_builder = $options['mobile_contents_builder'];
    } else {
      $contents_builder = $options['contents_builder'];
    }
    foreach($contents_builder as $content) :

      // コンテンツカルーセル --------------------------------------------------------------------------------
      if ( $content['cb_content_select'] == 'content_slider' && $content['show_content'] ) {
        ?>
        <div class="index_content_slider cb_contents num<?php echo $content_count; ?> white" id="cb_content_<?php echo $content_count; ?>">

          <div class="cb_contents_inner clearfix">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="cb_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
            <?php }; ?>

            <?php if(!empty($content['catch'])) { ?>
              <h4 class="cb_catch rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
            <?php }; ?>

            <?php if(!empty($content['item_list'])) { ?>
              <div class="cb_content_slider_wrap">
                <div class="cb_content_slider">
                  <?php
                  $total_item = count($content['item_list']);
                  foreach ( $content['item_list'] as $key => $value ) :
                    $image = $value['image'];
                    $url = $value['url'];
                    $desc = $value['desc'];
                    if($image && $url){
                      $image = wp_get_attachment_image_src( $image, 'full' );
                      ?>
                      <div class="item">
                        <a class="animate_background clearfix" href="<?php echo esc_url($url); ?>">
                          <div class="image_wrap">
                            <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                          </div>
                          <div class="desc_area">
                            <?php if($desc) { ?><p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p><?php }; ?>
                          </div>
                        </a>
                      </div>
                  <?php }; endforeach; ?>
                </div>
                <?php if($total_item > 2){ ?>
                  <div class="carousel_arrow next_item"></div>
                  <div class="carousel_arrow prev_item"></div>
                <?php }; ?>
              </div>
            <?php }; ?>

            <?php if($content['show_button']){ ?>
              <div class="link_button">
                <a href="<?php echo esc_attr($content['button_url']); ?>"><?php echo esc_html($content['button_label']); ?></a>
              </div>
            <?php }; ?>

          </div><!-- END .cb_contents_inner -->

        </div><!-- END .index_content_slider -->

      <?php // サービス一覧 --------------------------------------------------------------------------------
      } elseif ( $content['cb_content_select'] == 'service_list' && $content['show_content'] ) { ?>
        <div class="index_service_list cb_contents num<?php echo $content_count; ?> white" id="cb_content_<?php echo $content_count; ?>">

          <div class="cb_contents_inner">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="cb_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
            <?php }; ?>

            <?php if(!empty($content['catch'])) { ?>
              <h4 class="cb_catch rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
            <?php }; ?>

            <?php if(!empty($content['desc'])) { ?>
              <p class="cb_desc"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
            <?php }; ?>

          </div><!-- END .cb_contents_inner -->

          <?php
          $args = array( 'post_type' => 'service', 'posts_per_page' => -1 );
          $post_list_query = new wp_query($args);
          if($post_list_query->have_posts()):
            ?>
            <div class="service_list_wrap">
              <div class="service_list clearfix">
                <?php
                while($post_list_query->have_posts()): $post_list_query->the_post();
                  $index_image = get_post_meta($post->ID, 'index_image', true);
                  if($index_image) {
                    $image = wp_get_attachment_image_src( $index_image, 'full' );
                  }
                  $desc = get_post_meta($post->ID, 'desc1', true);
                  ?>
                  <article class="item">
                    <a <?php if($content['use_animation_image']) { echo 'class="animate_background"'; }; ?> href="<?php the_permalink(); ?>">
                      <h3 class="title rich_font_<?php echo esc_attr($content['title_font_type']); ?>"><span><?php the_title(); ?></span></h3>
                      <?php if($index_image) { ?>
                        <div class="image_wrap">
                          <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                        </div>
                      <?php }; ?>
                      <?php if($desc) { ?>
                        <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
                      <?php }; ?>
                    </a>
                  </article>
                <?php endwhile; ?>
              </div><!-- END .service_list -->
              <?php if($content['show_button']){ ?>
                <div class="link_button">
                  <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php echo esc_html($content['button_label']); ?></a>
                </div>
              <?php };

              if($content['bg_use_overlay']){
                $bg_overlay_color = $content['bg_overlay_color'] ? $content['bg_overlay_color'] : '#000000';
                $bg_overlay_color = hex2rgb($bg_overlay_color);
                $bg_overlay_color = implode(",",$bg_overlay_color);
                $bg_overlay_opacity = $content['bg_overlay_opacity'] ? $content['bg_overlay_opacity'] : '0.3';
                ?>
                <div class="overlay" style="background:rgba(<?php echo $bg_overlay_color; ?>,<?php echo $bg_overlay_opacity; ?>)"></div>
              <?php };

              $image = $content['bg_image'] ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
              if($image) {
              ?>
                <div class="bg_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
              <?php }; ?>
            </div><!-- END .service_list_wrap -->
          <?php endif; wp_reset_query(); ?>

        </div><!-- END .index_service_list -->

      <?php // メッセージ --------------------------------------------------------------------------------
      } elseif ( $content['cb_content_select'] == 'message' && $content['show_content'] ) {
        if(is_mobile() && $options['mobile_show_contents_builder']) {
          $layout = 'type1';
        } else {
          $layout = $content['layout'];
        }
        ?>
        <div class="index_message cb_contents num<?php echo $content_count; ?> white" id="cb_content_<?php echo $content_count; ?>">

          <div class="cb_contents_inner">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="cb_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
            <?php }; ?>

            <?php if(!empty($content['catch'])) { ?>
              <h4 class="cb_catch rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
            <?php }; ?>

            <div class="message_area layout_<?php echo esc_attr($layout); ?>">
              <?php
              $image = $content['image'] ? wp_get_attachment_image_src( $content['image'], 'full' ) : '';
              if($image) { ?>
                <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
              <?php }; ?>
              <div class="content">
                <div class="content_inner">
                  <?php if(!empty($content['message_catch'])) { ?>
                    <h3 class="catch rich_font_<?php echo esc_attr($content['message_catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['message_catch'])); ?></h3>
                  <?php }; ?>
                  <?php if(!empty($content['desc'])) { ?>
                    <p class="desc"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
                  <?php }; ?>
                  <?php if($content['sub_title'] || $content['title']) { ?>
                    <div class="title_area">
                      <?php if(!empty($content['sub_title'])) { ?>
                        <p class="sub_title"><?php echo wp_kses_post(nl2br($content['sub_title'])); ?></p>
                      <?php }; ?>
                      <?php if(!empty($content['title'])) { ?>
                        <p class="title rich_font_<?php echo esc_attr($content['message_catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['title'])); ?></p>
                      <?php }; ?>
                    </div>
                  <?php }; ?>
                </div>
              </div>
            </div>

            <?php if($content['show_button']){ ?>
              <div class="link_button">
                <a href="<?php echo esc_attr($content['button_url']); ?>"><?php echo esc_html($content['button_label']); ?></a>
              </div>
            <?php }; ?>

          </div><!-- END .cb_contents_inner -->

        </div><!-- END .index_message -->

      <?php // 記事カルーセル --------------------------------------------------------------------------------
      } elseif ( $content['cb_content_select'] == 'post_slider' && $content['show_content'] ) {
        ?>
        <div class="index_post_slider cb_contents num<?php echo $content_count; ?>" style="background:<?php echo esc_attr($content['background_color']); ?>;" id="cb_content_<?php echo $content_count; ?>">

          <div class="cb_contents_inner">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="cb_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
            <?php }; ?>

            <?php if(!empty($content['catch'])) { ?>
              <h4 class="cb_catch rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
            <?php }; ?>

            <?php
            $post_num = $content['post_num'];
            $post_type = $content['post_type'];
            $post_order = $content['post_order'];
            if($post_order == 'rand') {
              $args = array( 'post_type' => $post_type, 'orderby' => 'rand', 'posts_per_page' => $post_num );
            } else {
              $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
            }
            $post_list_query = new wp_query($args);
            $total_post_num = $post_list_query->post_count;
            if($post_list_query->have_posts()):
              ?>
              <div class="post_list_slider_wrap">
                <div class="post_list clearfix">
                  <?php
                  while($post_list_query->have_posts()): $post_list_query->the_post();
                    if(has_post_thumbnail()) {
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
                    } elseif($options['no_image1']) {
                      $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
                    } else {
                      $image = array();
                      $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
                    }
                    if($post_type == 'post'){
                      $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
                      if ( $category && ! is_wp_error($category) ) {
                        foreach ( $category as $cat ) :
                          $cat_name = $cat->name;
                          $cat_id = $cat->term_id;
                          break;
                        endforeach;
                      };
                    };
                    ?>
                    <article class="item">
                      <?php if ( ($post_type == 'post') && $category && ! is_wp_error($category) && $content['show_category'] ) { ?>
                        <p class="category cat_id_<?php echo esc_attr($cat_id); ?>"><a href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a></p>
                      <?php }; ?>
                      <a class="image_link animate_background clearfix" href="<?php the_permalink(); ?>">
                        <div class="image_wrap">
                          <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                        </div>
                      </a>
                      <div class="title_area">
                        <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
                        <?php if ( $content['show_date'] ){ ?>
                          <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
                        <?php }; ?>
                      </div>
                    </article>
                  <?php endwhile; ?>
                </div><!-- END .post_list -->
                <?php if($total_post_num > 3){ ?>
                  <div class="carousel_arrow next_item"></div>
                  <div class="carousel_arrow prev_item"></div>
                <?php }; ?>
              </div><!-- END .post_list_slider_wrap -->
            <?php endif; wp_reset_query(); ?>

            <?php
            if($content['show_button']) {
              if($post_type == 'post') {
                ?>
                <div class="link_button">
                  <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($content['button_label']); ?></a>
                </div>
              <?php } else { ?>
                <div class="link_button">
                  <a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($content['button_label']); ?></a>
                </div>
            <?php }; }; ?>

          </div><!-- END .cb_contents_inner -->

        </div><!-- END .index_post_slider -->

      <?php // アクセス情報 --------------------------------------------------------------------------------
      } elseif ( $content['cb_content_select'] == 'access' && $content['show_content'] ) {
        if(is_mobile() && $options['mobile_show_contents_builder']) {
          $layout = 'type1';
        } else {
          $layout = $content['layout'];
        }
        ?>
        <div class="index_access cb_contents num<?php echo $content_count; ?> white" id="cb_content_<?php echo $content_count; ?>">

          <div class="cb_contents_inner">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="cb_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
            <?php }; ?>

            <?php if(!empty($content['catch'])) { ?>
              <h4 class="cb_catch rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
            <?php }; ?>

            <div class="access_info layout_<?php echo esc_attr($layout); ?>" style="background:<?php echo esc_attr($content['desc_bg_color']); ?>;">

              <div class="desc">
                <div class="desc_inner">
                  <div class="post_content clearfix">
                    <?php echo apply_filters('the_content', $options['basic_access_info'] ); ?>
                  </div>
                </div>
              </div>

              <?php
              // access map ------------------------------------------------------------
              if ($options['basic_access_address']){
                $use_custom_overlay = 'type2' === $options['basic_gmap_marker_type'] ? 1 : 0;
                $marker_img = $options['basic_gmap_marker_img'] ? wp_get_attachment_url( $options['basic_gmap_marker_img'] ) : '';
                if($options['basic_gmap_custom_marker_type'] == 'type2') {
                  $marker_text = '';
                } else {
                  $marker_text = $options['basic_gmap_marker_text'];
                }
                $access_saturation = $options['basic_access_saturation'] ? esc_html( $options['basic_access_saturation'] ) : '-100';
                ?>
                <div class="access_google_map page_animate_item">
                  <div class="pb_googlemap clearfix">
                    <div id="dc_google_map<?php echo esc_attr($content_count); ?>" class="pb_googlemap_embed"></div>
                  </div><!-- END .pb_googlemap -->
                  <?php $access_address = esc_attr($options['basic_access_address']); ?>
                  <script>
                    jQuery(function($) {
                      $(window).load(function() {
                        var address = "<?php echo html_entity_decode( $access_address ); ?>";
                        console.log(address);
                        initMap('dc_google_map<?php echo esc_attr($content_count); ?>', address, <?php echo esc_js( $access_saturation ); ?>, <?php echo esc_js( $use_custom_overlay ); ?>, '<?php if( $options['basic_gmap_custom_marker_type'] == 'type2' ) { echo esc_js( $marker_img ); }; ?>', '<?php echo esc_js( $marker_text ); ?>');
                      });
                    });
                  </script>
                </div><!-- END .access_google_map -->
              <?php }; ?>

            </div>

            <?php if($content['show_button']){ ?>
              <div class="link_button">
                <a href="<?php echo esc_attr($content['button_url']); ?>"><?php echo esc_html($content['button_label']); ?></a>
              </div>
            <?php }; ?>

          </div><!-- END .cb_contents_inner -->

        </div><!-- END .index_post_slider -->

      <?php // フリースペース -----------------------------------------------------
      } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
        if (!empty($content['free_space'])) {
          if(is_mobile() && $options['mobile_show_contents_builder']) {
            $content_width = 'type2';
          } else {
            $content_width = $content['content_width'];
          }
          ?>
          <div class="index_free_space cb_contents num<?php echo $content_count; ?> white cb_free_space <?php echo esc_attr($content_width); ?>" id="cb_content_<?php echo $content_count; ?>">

            <div class="cb_contents_inner">

              <div class="post_content clearfix">
                <?php echo apply_filters('the_content', $content['free_space'] ); ?>
              </div>

            </div><!-- END .cb_contents_inner -->

          </div><!-- END .index_free_space -->
          <?php
        };
      };
      $content_count++;
    endforeach;
  endif;
  // コンテンツビルダーここまで
  ?>
</div><!-- END #index_content_builder -->

<?php get_footer(); ?>