<?php
/*
Template Name:Access & Staff page
*/
__('Access & Staff page', 'tcd-w');


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
<?php
};


if( empty(get_post_meta($post->ID, 'page_hide_bread', true)) ) {
  get_template_part('template-parts/breadcrumb');
};
?>

<div id="main_contents" style="width:<?php echo esc_attr($page_content_width); ?>px;">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div id="access_page">

    <?php
    // ???R?????????e?????????c???r?????????_???[
    $design2_content = get_post_meta( $post->ID, 'design2_content', true );
    if ( $design2_content && is_array( $design2_content ) ) :
      foreach( $design2_content as $key => $content ) :

        // ???R?????????e?????????c???P -----------------------------------------------------------------
        if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
        ?>
          <div class="design2_content1 design2_content num<?php echo esc_attr($key); ?>" id="dc2_content_<?php echo $key; ?>">

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
            <div class="content_area" style="background:<?php echo esc_attr($content['bg_color']); ?>;">

              <div class="main_image" <?php if($bg_image) { ?>style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
                <?php if($content['catch']){ ?>
                  <h3 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> <?php if($content['catch_direction']) { echo 'type2'; }; ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h3>
                <?php }; ?>
                <?php if($use_overlay) { ?>
                  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
                <?php }; ?>
              </div><!-- END .main_image -->

              <?php
              if(!empty($content['display_author'])) {
                $user_data = get_userdata($content['display_author']);
                $name = $user_data->display_name;
                $category = $user_data->user_cat;
                $sub_title = $user_data->user_sub_title;
                $prof = $user_data->user_prof;
                $message = $user_data->user_message;
                $image = $user_data->profile_image;
                ?>
                <div class="user_info" style="background:<?php echo esc_attr($content['bg_color']); ?>;">

                  <?php if(!empty($message)) { ?>
                    <div class="post_content clearfix message">
                      <?php echo apply_filters('the_content', $message ); ?>
                    </div>
                  <?php }; ?>

                  <?php if(!empty($name)) { ?>
                    <div class="name_area">
                      <?php if(!empty($category)) { ?>
                        <p class="category"><?php echo esc_html($category); ?></p>
                      <?php }; ?>
                      <?php if(!empty($name)) { ?>
                        <h3 class="name rich_font_<?php echo esc_attr($content['author_title_font_type']); ?>"><?php echo esc_html($name); ?></h3>
                      <?php }; ?>
                      <?php if(!empty($sub_title)) { ?>
                        <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
                      <?php }; ?>
                    </div>
                  <?php }; ?>

                  <?php if(!empty($prof)) { ?>
                    <div class="post_content clearfix prof">
                      <?php echo apply_filters('the_content', $prof ); ?>
                    </div>
                  <?php }; ?>

                </div><!-- END .user_info -->
              <?php }; ?>

            </div><!-- END .content_area -->

          </div><!-- END .design2_content1 -->

        <?php
        // ???R?????????e?????????c???Q -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
        ?>

          <div class="design2_content2 design2_content num<?php echo esc_attr($key); ?>" id="dc2_content_<?php echo $key; ?>">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
            <?php }; ?>

            <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
              <div class="item_list layout_<?php echo esc_attr($content['layout']); ?>">
                <?php
                foreach ( $content['item_list'] as $key => $value ) :
                  if(!empty($value['display_author'])) {
                    $user_data = get_userdata($value['display_author']);
                    $name = $user_data->display_name;
                    $category = $user_data->user_cat;
                    $sub_title = $user_data->user_sub_title;
                    $message = $user_data->user_message;
                    $image = $user_data->profile_image ? wp_get_attachment_image_src( $user_data->profile_image, 'full' ) : '';
                    ?>
                    <div class="item clearfix" style="background:<?php echo esc_attr($content['bg_color']); ?>;">
                      <?php if($image){ ?>
                        <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div>
                      <?php }; ?>
                      <div class="content">
                        <div class="content_inner">
                          <div class="name_area clearfix">
                            <?php if(!empty($category)) { ?>
                              <p class="category"><?php echo esc_html($category); ?></p>
                            <?php }; ?>
                            <?php if(!empty($name)) { ?>
                              <h3 class="name rich_font_<?php echo esc_attr($content['author_title_font_type']); ?> clearfix"><span class="title"><?php echo esc_html($name); ?></span><?php if(!empty($sub_title)) { ?><span class="sub_title"><?php echo esc_html($sub_title); ?></span><?php }; ?></h3>
                            <?php }; ?>
                          </div>
                          <?php if(!empty($message)) { ?>
                            <div class="post_content clearfix message">
                              <?php echo apply_filters('the_content', $message ); ?>
                            </div>
                          <?php }; ?>
                        </div>
                      </div>
                    </div>
                <?php }; endforeach; ?>
              </div><!-- END .item_list -->
            <?php endif; ?>
          </div><!-- END .design2_content2 -->

        <?php
        // ???t?????????[???X???y???[???X -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
        ?>

          <div class="design2_content3 design2_content num<?php echo esc_attr($key); ?> cb_free_space <?php if(!empty($content['content_width'])) { echo esc_attr($content['content_width']); }; ?>" id="dc2_content_<?php echo $key; ?>">

            <?php if(!empty($content['desc'])) { ?>
              <div class="post_content clearfix">
                <?php echo apply_filters('the_content', $content['desc'] ); ?>
              </div>
            <?php }; ?>

          </div><!-- END .design2_content3 -->

        <?php
        };
      endforeach; // END ????????????????
    endif;



    // ???????????????????????????
    $access_content = get_post_meta( $post->ID, 'access_content', true );
    if ( $access_content && is_array( $access_content ) ) :
      foreach( $access_content as $key => $content ) :

        // ?????????????????? -----------------------------------------------------------------
        if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
        ?>
          <div class="access_content1 access_content num<?php echo esc_attr($key); ?>" id="ac_content_<?php echo $key; ?>">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
            <?php }; ?>

            <?php if(!empty($content['catch'])) { ?>
              <h4 class="top_catch rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo esc_html($content['catch']); ?></h4>
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

          </div><!-- END .access_content1 -->

        <?php
        // ?????????????????? -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'access_map') && $content['show_content']) {
        ?>
          <div class="access_content2 access_content num<?php echo esc_attr($key); ?>" id="ac_content_<?php echo $key; ?>">

            <?php if(!empty($content['headline'])) { ?>
              <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
            <?php }; ?>

            <?php
            // Google Map -----------------------------------------------------------------
            if ($options['basic_access_address']){
              $use_custom_overlay = 'type2' === $options['gmap_marker_type'] ? 1 : 0;
              $marker_img = $options['gmap_marker_img'] ? wp_get_attachment_url( $options['gmap_marker_img'] ) : '';
              if($options['gmap_custom_marker_type'] == 'type2') {
                $marker_text = '';
              } else {
                $marker_text = $options['gmap_marker_text'];
              }
              $access_saturation = $options['basic_access_saturation'] ? esc_html( $options['basic_access_saturation'] ) : '-100';

              $address = get_post_meta(get_the_ID(), 'custom_access_address', true) ? get_post_meta(get_the_ID(), 'custom_access_address', true) : $options['basic_access_address'];
              ?>
              <div class="access_google_map">
                <div class="pb_googlemap clearfix">
                  <div id="dc_google_map<?php echo esc_attr($key); ?>" class="pb_googlemap_embed"></div>
                </div><!-- END .pb_googlemap -->
                <script>
                jQuery(function($) {
                  $(window).on('load', function() {
                    initMap('dc_google_map<?php echo esc_attr($key); ?>', '<?php echo esc_js( $address ); ?>', <?php echo esc_js( $access_saturation ); ?>, <?php echo esc_js( $use_custom_overlay ); ?>, '<?php if( $options['gmap_custom_marker_type'] == 'type2' ) { echo esc_js( $marker_img ); }; ?>', '<?php echo esc_js( $marker_text ); ?>');
                  });
                });
                </script>
              </div><!-- END .access_google_map -->
            <?php
            };


    // ????????? -----------------------------------------------------------------
    if($content['show_button'] && $content['button_url']) {
   ?>
   <div class="map_link_button">
    <a href="<?php echo esc_url($content['button_url']); ?>" target="_blank"><span><?php echo esc_html($content['button_label']); ?></span></a>
   </div>
   <?php }; ?>

      <?php if($content['show_access_info'] || $content['show_contact'] || $content['show_tel'] || $content['show_service_list'] || $content['show_logo'] || $content['show_address']) { ?>
        <div class="info_area" style="background:<?php echo esc_attr($content['access_info_bg_color']); ?>;">

          <?php if($content['show_access_info'] || $content['show_contact'] || $content['show_tel']) { ?>
            <div class="address_area">
              <?php
              // ?????????????????? -----------------------------------------------------------------
              if($content['show_access_info'] && $options['basic_access_info']) {
                $info = get_post_meta(get_the_ID(), 'custom_access_info', true) ? get_post_meta(get_the_ID(), 'custom_access_info', true) : $options['basic_access_info'];
                ?>
                <div class="item access_info">
                  <div class="post_content clearfix">
                    <?php echo apply_filters('the_content', $info ); ?>
                  </div>
                </div>
              <?php }; ?>

              <?php if($content['show_contact'] || $content['show_tel']) { ?>
                <div class="item">
                  <div class="item_inner">
                    <?php
                    // ?????????????????? -----------------------------------------------------------------
                    if ($content['show_contact']){
                      ?>
                      <div class="sub_item contact">
                        <?php
                          $btn_headline = get_post_meta(get_the_ID(), 'custom_access_button_headline', true) ? get_post_meta(get_the_ID(), 'custom_access_button_headline', true) : $options['basic_contact_button_headline'];
                          if(!empty($btn_headline)) echo '<h3 class="headline rich_font">' . esc_html($btn_headline) . '</h3>';
                        ?>

                        <div class="link_button">
                          <?php
                          $btn_url = get_post_meta(get_the_ID(), 'custom_access_button_url', true) ? get_post_meta(get_the_ID(), 'custom_access_button_url', true) : $options['basic_contact_button_url'];
                          $btn_label = get_post_meta(get_the_ID(), 'custom_access_button_label', true) ? get_post_meta(get_the_ID(), 'custom_access_button_label', true) : $options['basic_contact_button_label'];
                          ?>
                          <a href="<?= esc_attr($btn_url); ?>"><?= esc_html($btn_label); ?></a>
                        </div>
                      </div>
                    <?php }; ?>
                    <?php
                    // ???????????? -----------------------------------------------------------------
                    if ($content['show_tel']){
                      ?>
                      <div class="sub_item tel">
                        <?php
                        $tel_headline = get_post_meta(get_the_ID(), 'custom_access_tel_headline', true) ? get_post_meta(get_the_ID(), 'custom_access_tel_headline', true) : $options['basic_tel_headline'];
                        if(!empty($tel_headline)) echo '<h3 class="headline rich_font">' . esc_html($tel_headline) . '</h3>';
                        ?>
                        <div class="number_area">
                          <?php
                          $tel_num = get_post_meta(get_the_ID(), 'custom_access_tel', true) ? get_post_meta(get_the_ID(), 'custom_access_tel', true) : $options['basic_tel_num'];
                          if(!empty($tel_num)) {
                            echo '<p class="tel_number">';
                            if($options['show_basic_tel_icon']) echo '<span class="icon"></span>';
                            echo '<span class="number">' . esc_html($tel_num) . '</span>';
                            echo '</p>';
                          }

                          $tel_desc = get_post_meta(get_the_ID(), 'custom_access_tel_desc', true) ? get_post_meta(get_the_ID(), 'custom_access_tel_desc', true) : $options['basic_tel_desc'];
                          if(!empty($tel_desc)) echo '<p class="tel_desc">' . wp_kses_post(nl2br($tel_desc)) . '</p>';
                          ?>
                        </div>
                      </div>
                    <?php }; ?>

                  </div>
                </div>
              <?php }; ?>
            </div>
          <?php }; ?>

          <?php
          // ?????????????????? -----------------------------------------------------------------

          if ($content['show_service_list']){
            $services = get_post_meta(get_the_ID(), 'custom_access_service', true);

            if( $services && is_array( $services ) ) {

              $args = array( 'post_type' => 'service', 'post__in' => $services);

            } else {

              if($options['basic_service_list_num']){
                $post_num = $options['basic_service_list_num'];
              } else {
                $post_num = '-1';
              }
              $args = array( 'post_type' => 'service', 'posts_per_page' => $post_num );
            }
            $post_list = new wp_query($args);
            if($post_list->have_posts()):
            ?>
              <div class="service_list">
                <?php if(!empty($options['basic_service_list_headline'])) { ?>
                <h3 class="headline rich_font"><?php echo esc_html($options['basic_service_list_headline']); ?></h3>
                <?php }; ?>
                <ul class="clearfix">
                  <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></li>
                  <?php endwhile; ?>
                </ul>
              </div>
            <?php
            endif;
            wp_reset_query();
          };
          ?>

          <?php
          // ?????? ----------------------------------------------------------------- ?>
          <?php if ($content['show_logo']){ ?>
            <div class="logo_area">
              <?php footer_logo(); ?>
            </div>
          <?php }; ?>

          <?php
          // ?????? --------------------------------------------
          if($content['show_address']){
            $address = get_post_meta(get_the_ID(), 'custom_access_address', true) ? get_post_meta(get_the_ID(), 'custom_access_address', true) : $options['basic_address'];
            ?>
            <p class="bottom_address"><?php echo wp_kses_post(nl2br($address)); ?></p>
          <?php }; ?>

        </div><!-- END info_area -->
      <?php }; ?>

      </div><!-- END .access_content2 -->

          <?php
          // ????????????????????? ----------------------------------------------------------------- ?>
          <?php } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) { ?>
            <div class="access_content3 access_content num<?php echo esc_attr($key); ?> cb_free_space <?php if(!empty($content['content_width'])) { echo esc_attr($content['content_width']); }; ?>" id="ac_content_<?php echo $key; ?>">
              <?php if(!empty($content['desc'])) { ?>
                <div class="post_content clearfix">
                  <?php echo apply_filters('the_content', $content['desc'] ); ?>
                </div>
              <?php }; ?>
            </div><!-- END .access_content4 -->

          <?php
          };
        endforeach; // END ????????????
      endif;
      ?>

    </div><!-- END #access_page -->

  <?php endwhile; endif; ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>