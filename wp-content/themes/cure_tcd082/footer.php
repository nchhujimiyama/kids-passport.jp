<?php $options = get_design_plus_option(); ?>

 <?php
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
      }
 ?>
 <footer id="footer">

  <?php
       // banner -----------------------------------------
       if($options['show_footer_banner1'] || $options['show_footer_banner2'] || $options['show_footer_banner3'] || $options['show_footer_banner4']) {
  ?>
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
            if (auto_play_movie()) {
   ?>
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
    </div><!-- END .service_list -->
    <?php endif; wp_reset_query(); ?>
    <?php }; ?>

    <?php
         // contact, tel, schedule area ----------------------
         if ($options['show_footer_button'] || $options['show_footer_tel'] || $options['show_footer_schedule']){
    ?>
    <div id="footer_data" class="position_<?php echo esc_attr($options['footer_schedule_position']); ?> <?php if(!$options['show_footer_schedule']){ echo 'no_schedule'; }; ?>">

     <?php if ($options['show_footer_button'] || $options['show_footer_tel']){ ?>
     <div class="item left position_<?php echo esc_attr($options['footer_button_position']); ?>">
      <?php
           // contact button ----------------------
           if ($options['show_footer_button']){
      ?>
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
           if ($options['show_footer_tel']){
      ?>
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
        if( $options['show_footer_logo']) {
   ?>
   <div id="footer_logo">
    <?php footer_logo(); ?>
   </div>
   <?php }; ?>

   <?php
        // footer info --------------------------------------------
        if($options['show_footer_info']){
   ?>
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
           if ($options['mobile_menu_ad_code'.$i]) {
  ?>
  <div class="banner">
   <?php echo $options['mobile_menu_ad_code'.$i]; ?>
  </div>
  <?php
       } else {
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
         if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
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
<?php
         endif;
         if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( $options['show_pinterest_top'] || $options['show_pinterest_btm'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
</body>
</html>