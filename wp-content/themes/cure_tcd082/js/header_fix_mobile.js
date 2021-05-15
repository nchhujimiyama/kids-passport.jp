jQuery(document).ready(function($){

  var header_message_height = $('#header_message').innerHeight();

  if($(window).scrollTop() > 60 + header_message_height) {
    $("body").addClass("header_fix_mobile");
  }

  $(window).scroll(function () {
    if($(this).scrollTop() > 60 + header_message_height) {
      $("body").addClass("header_fix_mobile");
      if ($('html').hasClass('mobile')) {
        $('#header').addClass('active');
      }
    } else {
      $("body").removeClass("header_fix_mobile");
      if ($('html').hasClass('mobile')) {
        $('#header').removeClass('active');
      }
    };
  });


});