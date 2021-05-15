<?php
    $options = get_design_plus_option();


    if( is_page() || is_singular() ) :
      $post_id = get_the_ID();

      if( get_post_meta( $post_id, 'relation_display', true ) ) :
        $occupation = get_post_meta( $post_id, 'relation_occupation', true );
        $division = get_post_meta( $post_id, 'relation_division', true );
        $place = get_post_meta( $post_id, 'relation_place', true );

        $args = array(
          'post_type' => 'offer',
          'posts_per_page' => 3,
        );
        if( $occupation || $division || $place ) :
          if( $occupation ) :
            $args['tax_query'][] = array(
              'taxonomy' => 'occupation',
              'field' => 'id',
              'terms' => $occupation
            );
          endif;
          if( $division ) :
            $args['tax_query'][] = array(
              'taxonomy' => 'division',
              'field' => 'id',
              'terms' => $division
            );
          endif;
          if( $place ) :
            $args['tax_query'][] = array(
              'taxonomy' => 'place',
              'field' => 'id',
              'terms' => $place
            );
          endif;
        endif;
        $query = new WP_Query($args);
        if( $query->have_posts() ) :
          ?>
          <div id="single_relation_recruit">
            <h2 class=" rich_font_type3">関連求人</h2>
            <div class="inner">
              <?php while( $query->have_posts() ) :
                $query->the_post();
                $id = get_the_ID();

                $thumb = get_the_post_thumbnail_url();
                $comment = get_post_meta( $id, 'offer_comment', true );

                $division_term = '';
                if( $division ) {
                  $division_term = get_term($division);
                } else {
                  $terms = get_the_terms( $id, 'division' );
                  if( $terms && !is_wp_error($terms) ) :
                    foreach( $terms as $term ) :
                      $division_term = $term;
                    endforeach;
                  endif;
                }

                // ブランド
                $brand = '';
                $brands = get_the_terms($id, 'division');
                if(!empty($brands)) {
                  foreach($brands as $b) {
                    if($b->parent == 0) $parent_brand_id = $b->term_id;
                  }
                  if($parent_brand_id) {
                    foreach($brands as $b) {
                      if($b->parent == $parent_brand_id) $brand = '<span class="form-list__submit" onClick="clickTag(\'brand\', ' . $b->term_id . ')">' . $b->name . '</span>';
                    }
                  }
                }
                // 勤務形態
                $status = '';
                $status_en = get_post_meta( $id, 'treatment_status', true );
                if( $status_en ) $status = '<span class="form-list__submit" onClick="clickTag(\'status\', \'' . $status_en . '\')">' . format_treatment_status($status_en) . '</span>';
                //職種
                $occupation_tag = '';
                $occupations = get_the_terms($id, 'occupation');
                if(!empty($occupations)) {
                  foreach($occupations as $o) $occupation_tag = '<span class="form-list__submit" onClick="clickTag(\'occupation\', ' . $o->term_id . ')">' . $o->name . '</span>';
                }
                // 勤務地
                $place_city = '';
                $place_other = '';
                $areaSubmit = '';
                $parent_place = wp_get_post_terms($id, 'place', array('parent'=>0));
                if($parent_place) {
                  foreach($parent_place as $pp) {
                    $child_place = wp_get_post_terms($id, 'place', array('parent'=>$pp->term_id));
                    if($child_place) {
                      foreach($child_place as $cp) {
                        $areaSubmit = $cp->term_id;
                        $place_city = $cp->name;
                        $gchild_place = wp_get_post_terms($id, 'place', array('parent'=>$cp->term_id));
                        if($gchild_place) {
                          foreach($gchild_place as $gp) {
                            $areaSubmit = $gp->term_id;
                            $place_other = $gp->name;
                          }
                        }
                      }
                    }
                  }
                }
                if(($place_city || $place_other) && $areaSubmit) $area = '<span class="form-list__submit" onClick="clickTag(\'place\', ' . $areaSubmit . ')">' . $place_city . $place_other . '</span>';
                // 特徴
                $feature = '';
                $features = [];
                $parent_feature = wp_get_post_terms($id, 'feature', array('parent'=>0));
                if($parent_feature) {
                  foreach($parent_feature as $pf) {
                    $child_feature = wp_get_post_terms($id, 'feature', array('parent'=>$pf->term_id));
                    if($child_feature) {
                      foreach($child_feature as $cf) {
                        array_push($features, '<span class="sub form-list__submit" onClick="clickTag(\'feature\', ' . $cf->term_id . ')">' . $cf->name . '</span>');
                      }
                    }
                  }
                }
                $n = 0;
                if($features) {
                  foreach($features as $f) {
                    if( $n < 3 ) $feature .= $f;
                    $n++;
                    if($count != 0 && $count != -1 && $n == $count) break;
                  }
                }
                ?>
                <div class="item">
                  <div class="thumb">
                    <a href="<?= get_the_permalink(); ?>">
                      <div class="image" style="background: <?= $thumb ? 'url(' . $thumb . ')' : '#ccc'; ?> center / cover no-repeat;"></div>
                    </a>
                    <?php
                    if($division_term):
                      $bg_color = get_term_meta( $division_term->term_id, 'bg_color', true );
                      $text_color = get_term_meta( $term->term_id, 'text_color', true );
                      $style = '';
                      if( $bg_color || $text_color ):
                        $style = 'style="';
                        if( $bg_color ) $style .= 'background-color: ' . $bg_color . ';';
                        if( $text_color ) $style .= 'color: ' . $text_color . ';';
                        $style .= '"';
                      endif;
                      ?>
                      <div class="term" <?= $style; ?> onClick="clickTag('brand', <?= $division_term->term_id; ?>)"><?= $division_term->name; ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="info">
                    <a href="<?= get_the_permalink(); ?>">
                      <h3><?= get_the_title(); ?></h3>
                      <?php if( $comment ): ?><p class="offer_comment"><?= $comment; ?></p><?php endif; ?>
                    </a>
                    <div class="terms">
                      <?= $brand; ?>
                      <?= $status; ?>
                      <?= $occupation_tag; ?>
                      <?= $area; ?>
                      <?= $feature; ?>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
              wp_reset_postdata(); ?>
            </div>
          </div>
          <script>
            const clickTag = (type, val) => {
              params = {
                posts_per_page: 12,
                page: 1,
                order: 'new',
              }

              if( type == 'brand' ) {
                params.division = [Number(val)]
              } else if( type == 'status' ) {
                params.treatment_status = val
              } else if( type == 'occupation' ) {
                params.occupation = [Number(val)]
              } else if( type == 'place' ) {
                params.place = [Number(val)]
              } else if( type == 'feature' ) {
                params.feature = [Number(val)]
              }

              localStorage.params = JSON.stringify(params)

              window.location.href = '/offer/#sort'
            }
          </script>
          <?php
        endif;
      endif;
    endif;


    if(is_page()){
      $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
    } else {
      $page_hide_footer = '';
    }
    if(!$page_hide_footer){

      $bg_image = wp_get_attachment_image_src($options['footer_bg_image'], 'full');
      $bg_image_mobile = wp_get_attachment_image_src($options['footer_bg_image_mobile'], 'full');
      if($options['footer_bg_type'] == 'type2') {
        $bg_image = '';
        $video = $options['footer_bg_video'];
        if(!empty($video)) {
          if (!auto_play_movie()) {
            $video_image_id = $options['footer_bg_video_image'];
            if($video_image_id) {
              $bg_image = wp_get_attachment_image_src($video_image_id, 'full');
            }
          }
        }
      } ?>
      <footer id="footer">

        <?php
        // banner -----------------------------------------
        if($options['show_footer_banner1'] || $options['show_footer_banner2'] || $options['show_footer_banner3'] || $options['show_footer_banner4']) { ?>
          <div id="footer_banner">
            <?php
            for($i = 1; $i <= 4; $i++) {
              if($options['show_footer_banner'.$i]) {
                $image = wp_get_attachment_image_src($options['footer_banner_image'.$i], 'full');
                $footer_banner_overlay_color = hex2rgb($options['footer_banner_overlay_color'.$i]);
                $footer_banner_overlay_color = implode(",",$footer_banner_overlay_color);
                ?>
                <div class="item">
                  <a class="animate_background clearfix" href="<?php echo esc_html($options['footer_banner_url'.$i]); ?>">
                    <p class="title" style="color:<?php echo esc_html($options['footer_banner_font_color'.$i]); ?>;"><?php echo esc_html($options['footer_banner_title'.$i]); ?></p>
                    <div class="overlay" style="background: -moz-linear-gradient(left,  rgba(<?php echo esc_attr($footer_banner_overlay_color); ?>,1) 0%, rgba(<?php echo esc_attr($footer_banner_overlay_color); ?>,0) 50%); background: -webkit-linear-gradient(left,  rgba(<?php echo esc_attr($footer_banner_overlay_color); ?>,1) 0%,rgba(<?php echo esc_attr($footer_banner_overlay_color); ?>,0) 50%); background: linear-gradient(to right,  rgba(<?php echo esc_attr($footer_banner_overlay_color); ?>,1) 0%,rgba(<?php echo esc_attr($footer_banner_overlay_color); ?>,0) 50%);"></div>
                    <div class="image_wrap">
                      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                    </div>
                  </a>
                </div>
            <?php }; }; ?>
          </div>
        <?php }; ?>

        <div id="footer_top">

          <?php
          // video -----------------------------------------------------
          if($options['footer_bg_type'] == 'type2') {
            $video = $options['footer_bg_video'];
            if(!empty($video)) {
              if (auto_play_movie()) { ?>
                <video id="footer_video" src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" playsinline autoplay loop muted></video>
          <?php }; }; }; ?>

          <div id="footer_inner">

            <?php
            // service list -----------------------------------------------------------------
            if ($options['show_footer_service_list']){
              if($options['basic_service_list_num']){
                $post_num = $options['basic_service_list_num'];
              } else {
                $post_num = '-1';
              }
              $args = array( 'post_type' => 'service', 'posts_per_page' => $post_num );
              $post_list = new wp_query($args);
              if($post_list->have_posts()): ?>
                <div class="service_list">
                  <?php if(!empty($options['basic_service_list_headline'])) { ?>
                    <h3 class="headline rich_font"><?php echo esc_html($options['basic_service_list_headline']); ?></h3>
                  <?php }; ?>
                  <ul class="clearfix">
                    <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
                      <li><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></li>
                    <?php endwhile; ?>
                  </ul>
                </div><!-- END .service_list -->
              <?php endif; wp_reset_query(); ?>
            <?php }; ?>

            <?php
            // contact, tel, schedule area ----------------------
            if ($options['show_footer_button'] || $options['show_footer_tel'] || $options['show_footer_schedule']){ ?>
              <div id="footer_data" class="position_<?php echo esc_attr($options['footer_schedule_position']); ?> <?php if(!$options['show_footer_schedule']){ echo 'no_schedule'; }; ?>">

                <?php if ($options['show_footer_button'] || $options['show_footer_tel']){ ?>
                  <div class="item left position_<?php echo esc_attr($options['footer_button_position']); ?>">
                    <?php
                    // contact button ----------------------
                    if ($options['show_footer_button']){ ?>
                      <div class="sub_item" id="footer_contact">
                        <div class="sub_item_inner">
                          <?php if(!empty($options['basic_contact_button_headline'])) { ?>
                            <h3 class="headline rich_font"><?php echo esc_html($options['basic_contact_button_headline']); ?></h3>
                          <?php }; ?>
                          <div class="link_button">
                            <a href="<?php echo esc_attr($options['basic_contact_button_url']); ?>"><?php echo esc_html($options['basic_contact_button_label']); ?></a>
                          </div>
                        </div>
                      </div>
                    <?php }; ?>
                    <?php
                    // tel ----------------------
                    if ($options['show_footer_tel']){ ?>
                      <div class="sub_item" id="footer_tel">
                        <?php if(!empty($options['basic_tel_headline'])) { ?>
                          <h3 class="headline rich_font"><?php echo esc_html($options['basic_tel_headline']); ?></h3>
                        <?php }; ?>
                        <div class="number_area">
                          <?php if(!empty($options['basic_tel_num'])) { ?>
                            <p class="tel_number"><?php if($options['show_basic_tel_icon']) { echo '<span class="icon"></span>'; }; ?><span class="number"><?php echo esc_html($options['basic_tel_num']); ?></span></p>
                          <?php }; ?>
                          <?php if(!empty($options['basic_tel_desc'])) { ?>
                            <p class="tel_desc"><?php echo wp_kses_post(nl2br($options['basic_tel_desc'])); ?></p>
                          <?php }; ?>
                        </div>
                      </div>
                    <?php }; ?>
                  </div><!-- END .item left -->
                <?php }; ?>

                <?php
                // schedule ----------------------
                if ($options['show_footer_schedule']){
                  ?>
                  <div class="item right">
                    <table id="footer_schedule">
                      <tr>
                        <?php for ( $i = 1; $i <= 8; $i++ ) { ?>
                          <td class="col<?php echo $i; ?>"><?php if($options['footer_sd_row1_col'.$i]) { echo esc_textarea($options['footer_sd_row1_col'.$i]); }; ?></td>
                        <?php }; ?>
                      </tr>
                      <tr>
                        <?php for ( $i = 1; $i <= 8; $i++ ) { ?>
                          <td class="col<?php echo $i; ?>"><?php if($options['footer_sd_row2_col'.$i]) { echo esc_textarea($options['footer_sd_row2_col'.$i]); }; ?></td>
                        <?php }; ?>
                      </tr>
                      <tr>
                        <?php for ( $i = 1; $i <= 8; $i++ ) { ?>
                          <td class="col<?php echo $i; ?>"><?php if($options['footer_sd_row3_col'.$i]) { echo esc_textarea($options['footer_sd_row3_col'.$i]); }; ?></td>
                        <?php }; ?>
                      </tr>
                    </table>
                  </div><!-- END .item right -->
                <?php }; ?>

              </div>
            <?php }; ?>

          </div><!-- END #footer_inner -->

          <?php
          $use_overlay = $options['footer_bg_use_overlay'];
          if($use_overlay) {
            $overlay_color = hex2rgb($options['footer_bg_overlay_color']);
            $overlay_color = implode(",",$overlay_color);
            $overlay_opacity = $options['footer_bg_overlay_opacity'];
            ?>
            <div id="footer_overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
          <?php }; ?>

          <?php if(!empty($bg_image)) { ?>
            <div class="footer_bg_image <?php if(!empty($bg_image_mobile)) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
          <?php }; ?>
          <?php if(!empty($bg_image_mobile)) { ?>
            <div class="footer_bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div>
          <?php }; ?>

        </div><!-- END #footer_top -->

        <div id="footer_bottom">

          <?php
          // footer logo --------------------------------------------
          if( $options['show_footer_logo']) { ?>
            <div id="footer_logo">
              <?php footer_logo(); ?>
            </div>
          <?php }; ?>

          <?php
          // footer info --------------------------------------------
          if($options['show_footer_info']){ ?>
            <p class="footer_info"><?php echo wp_kses_post(nl2br($options['basic_address'])); ?></p>
          <?php }; ?>

          <?php
          // footer sns ------------------------------------
          if($options['show_footer_sns']) {
            $facebook = $options['footer_facebook_url'];
            $twitter = $options['footer_twitter_url'];
            $insta = $options['footer_instagram_url'];
            $pinterest = $options['footer_pinterest_url'];
            $youtube = $options['footer_youtube_url'];
            $contact = $options['footer_contact_url'];
            $show_rss = $options['footer_show_rss'];
            ?>
            <ul id="footer_sns" class="clearfix">
              <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
              <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
              <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
              <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
              <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
              <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
              <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>" rel="nofollow" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
            </ul>
          <?php }; ?>

        </div><!-- END #footer_bottom -->

        <?php // footer menu -------------------------------------------- ?>
        <?php if (has_nav_menu('footer-menu')) { ?>
          <div id="footer_menu" class="footer_menu" style="background:<?php echo esc_attr($options['footer_menu_bg_color']); ?>;">
            <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'container' => '' , 'depth' => '1') ); ?>
          </div>
        <?php }; ?>

        <p id="copyright" style="background:<?php echo esc_attr($options['copyright_bg_color']); ?>; color:<?php echo esc_attr($options['copyright_font_color']); ?>;"><?php echo wp_kses_post($options['copyright']); ?></p>

      </footer>

    <?php }; // END hide footer ?>

    <div id="return_top">
      <a href="#body"><span></span></a>
    </div>

    <?php
    // footer bar for mobile device -------------------
    if( is_mobile() && ($options['footer_bar_display'] != 'type3') ) {
      get_template_part('template-parts/footer-bar');
    };
    ?>

  </div><!-- #container -->

  <?php // drawer menu -------------------------------------------- ?>
  <?php if (has_nav_menu('global-menu')) { ?>
    <div id="drawer_menu">
      <nav>
        <?php wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
      </nav>
      <div id="mobile_banner">
        <?php
        for($i=1; $i<= 3; $i++):
          if( $options['mobile_menu_ad_code'.$i] || $options['mobile_menu_ad_image'.$i] ) {
            if ($options['mobile_menu_ad_code'.$i]) { ?>
              <div class="banner">
                <?php echo $options['mobile_menu_ad_code'.$i]; ?>
              </div>
            <?php } else {
              $mobile_menu_image = wp_get_attachment_image_src( $options['mobile_menu_ad_image'.$i], 'full' );
              ?>
              <div class="banner">
                <a href="<?php echo esc_url( $options['mobile_menu_ad_url'.$i] ); ?>"<?php if($options['mobile_menu_ad_target'.$i] == 1) { ?> target="_blank"<?php }; ?>><img src="<?php echo esc_attr($mobile_menu_image[0]); ?>" alt="" title="" /></a>
              </div>
        <?php }; }; endfor; ?>
      </div><!-- END #header_mobile_banner -->
    </div>
  <?php }; ?>

  <?php
  // load script -----------------------------------------------------------
  if ($options['show_load_screen'] == 'type2') {
    if(is_front_page()){
      has_loading_screen();
    } else {
      no_loading_screen();
    }
  } elseif ($options['show_load_screen'] == 'type3') {
    if(is_front_page() || is_home() || is_archive() ){
      has_loading_screen();
    } else {
      no_loading_screen();
    }
  } else {
    no_loading_screen();
  };
  ?>

  <?php
  // share button ----------------------------------------------------------------------
  if ( is_single() && ( $options['single_blog_show_sns_top'] || $options['single_blog_show_sns_btm'] || $options['single_news_show_sns_top'] || $options['single_news_show_sns_btm']) ) :
    if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
      if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) : ?>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      <?php endif;
      if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) : ?>
        <!-- facebook share button code -->
        <div id="fb-root"></div>
        <script>
          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
          fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        </script>
      <?php endif;
      if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) : ?>
        <script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
      <?php endif;
      if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) : ?>
        <script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
      <?php endif;
      if ( $options['show_pinterest_top'] || $options['show_pinterest_btm'] ) : ?>
        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
      <?php endif;
    endif;
  endif;
  ?>

  <?php wp_footer(); ?>
</body>
</html>