<?php
     function has_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(document).ready(function($){

  var winH = $(window).innerHeight();

  function after_load() {
    <?php if($options['load_screen_animation_type'] == 'type1'){ ?>
    $('#site_loader_overlay').delay(600).fadeOut(900);
    <?php } elseif($options['load_screen_animation_type'] == 'type2'){ ?>
    $('#site_loader_overlay').addClass('active slide_up');
    <?php } elseif($options['load_screen_animation_type'] == 'type3'){ ?>
    $('#site_loader_overlay').addClass('active slide_down');
    <?php } elseif($options['load_screen_animation_type'] == 'type4'){ ?>
    $('#site_loader_overlay').addClass('active slide_left');
    <?php } else { ?>
    $('#site_loader_overlay').addClass('active slide_right');
    <?php }; ?>
    <?php
         // front page -----------------------------------
         if(is_front_page()) {
           if($options['show_index_slider']) {
             get_template_part('functions/slider_ini');
           };
         };

         // #page header -----------------------------------
         echo "$('#page_header').addClass('animate2');\n";

         // 404 -----------------------------------
         if(is_404()) {
           echo "$('#page_404_header').addClass('animate');\n";
         };

         // page builder -----------------------------------
         if(is_single() || is_page()) {
           if(page_builder_has_widget('pb-widget-slider')) {
             echo "$('.pb_slider').slick('setPosition');\n";
           };
         };
    ?>
  }

  <?php if ($options['load_icon'] != 'type4') { ?>
  $(window).load(function () {
    $('#site_loader_overlay').css('height', winH);
    after_load();
  });
  <?php }; ?>

  $(function(){
    $('#site_loader_overlay').css('height', winH);
    <?php if ($options['load_icon'] == 'type4') { ?>
    $('#site_loader_logo').addClass('active');
    <?php }; ?>
    setTimeout(function(){
      if( $('#site_loader_overlay').is(':visible') ) {
        after_load();
      }
    }, <?php if($options['load_time']) { echo esc_html($options['load_time']); } else { echo '7000'; }; ?>);
  });

});
</script>
<?php } ?>
<?php
     // no loading ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(document).ready(function($){

  <?php
       // front page -----------------------------------
       if(is_front_page()) {
       };

       // Page header -----------------------------------
       echo "$('#page_header').addClass('animate');\n";

       // 404 -----------------------------------
       if(is_404()) {
         echo "$('#page_404_header').addClass('animate');\n";
       };
  ?>

});
</script>
<?php } ?>