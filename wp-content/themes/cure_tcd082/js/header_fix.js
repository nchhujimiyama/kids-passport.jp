jQuery(document).ready(function($){

  var header_message_height = $('#header_message').innerHeight();

  if($(window).scrollTop() > 200 + header_message_height) {
    $("body").addClass("header_fix");
    $("#header").addClass("active");
  }

  $(window).scroll(function () {
    if($(this).scrollTop() > 200 + header_message_height) {
      $("body").addClass("header_fix");
      $("#header").addClass("active");
    } else {
      $("body").removeClass("header_fix");
      if (!$('body').hasClass('active_header')) {
        if (!$('header').hasClass('active_mega_menu')) {
          $("#header").removeClass("active");
        }
      };
    };
  });


});