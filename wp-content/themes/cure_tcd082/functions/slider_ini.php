<?php
     $options = get_design_plus_option();
     if(is_mobile() && $options['mobile_show_index_slider']) {
       $index_slider = $options['mobile_index_slider'];
     } else {
       $index_slider = $options['index_slider'];
     }
     $slider_item_total = count($index_slider);
?>

  var slideWrapper = $('#header_slider'),
      iframes = slideWrapper.find('.youtube-player'),
      ytPlayers = {},
      timers = { slickNext: null };

  // YouTube IFrame Player API script load
  if ($('#header_slider .youtube-player').length) {
    if (!$('script[src="//www.youtube.com/iframe_api"]').length) {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
  }

  // YouTube IFrame Player API Ready
  window.onYouTubeIframeAPIReady = function(){
    slideWrapper.find('.youtube-player').each(function(){
      var ytPlayerId = $(this).attr('id');
      if (!ytPlayerId) return;
      var player = new YT.Player(ytPlayerId, {
        events: {
          onReady: function(e) {
            $('#'+ytPlayerId).css('opacity', 0).css('pointerEvents', 'none');
            iframes = slideWrapper.find('.youtube-player');
            ytPlayers[ytPlayerId] = player;
            ytPlayers[ytPlayerId].mute();
            ytPlayers[ytPlayerId].lastStatus = -1;
            var item = $('#'+ytPlayerId).closest('.item');
            if (item.hasClass('slick-current')) {
              playPauseVideo(item, 'play');
            }
          },
          onStateChange: function(e) {
            if (e.data === 0) { // ended
<?php if($slider_item_total > 1) { ?>
              $('#'+ytPlayerId).stop().css('opacity', 0);
              if (timers.slickNext) {
                clearTimeout(timers.slickNext);
                timers.slickNext = null;
              }
              slideWrapper.slick('slickNext');
<?php }; ?>
            } else if (e.data === 1) { // play
              $('#'+ytPlayerId).not(':animated').css('opacity', 1);
              var slide = $(e.target.a).closest('.item');
              var slickIndex = slide.attr('data-slick-index') || 0;
              clearInterval(timers[slickIndex]);
              timers[slickIndex] = setInterval(function(){
                var state = ytPlayers[ytPlayerId].getPlayerState();
                if (state != 1 && state != 3) {
                  clearInterval(timers[slickIndex]);
                } else if (ytPlayers[ytPlayerId].getDuration() - ytPlayers[ytPlayerId].getCurrentTime() < 1) {
                  clearInterval(timers[slickIndex]);
                  if (timers.slickNext) {
                    clearTimeout(timers.slickNext);
                    timers.slickNext = null;
                  }
                  slideWrapper.slick('slickNext');
                }
              }, 200);
            } else if (e.data === 3) { // buffering
              if (ytPlayers[ytPlayerId].lastStatus === -1) {
                $('#'+ytPlayerId).delay(100).animate({opacity: 1}, 400);
              }
            }
            ytPlayers[ytPlayerId].lastStatus = e.data;
          }
        }
      });
    });
  };

  // play or puase video
  function playPauseVideo(slide, control){
    if (!slide) {
      slide = slideWrapper.find('.slick-current');
    }
    if (slide.hasClass('youtube')) {
      var ytPlayerId = slide.find('.youtube-player').attr('id');
      if (ytPlayerId) {
        switch (control) {
          case 'play':
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].seekTo(0, true);
              ytPlayers[ytPlayerId].playVideo();
            }
            setTimeout(function(){
              slide.closest('.item').find(".catch").addclass('animate');
            }, 1000);
            break;
          case 'pause':
            slide.closest('.item').find(".catch").removeClass('animate');
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].pauseVideo();
            }
            break;
        }
      }
    } else if (slide.hasClass('video')) {
      var video = slide.find('video').get(0);
      if (video) {
        switch (control) {
          case 'play':
            video.currentTime = 0;
            video.play();
            setTimeout(function(){
              slide.closest('.item').find(".catch").addClass('animate');
            }, 1000);
            var slickIndex = slide.attr('data-slick-index') || 0;
            clearInterval(timers[slickIndex]);
            timers[slickIndex] = setInterval(function(){
              if (video.paused) {
                clearInterval(timers[slickIndex]);
              } else if (video.duration - video.currentTime < 2) {
                clearInterval(timers[slickIndex]);
                if (timers.slickNext) {
                  clearTimeout(timers.slickNext);
                  timers.slickNext = null;
                }
                slideWrapper.slick('slickNext');
                setTimeout(function(){
                  video.currentTime = 0;
                }, 2000);
              }
            }, 200);
            break;
          case 'pause':
            slide.closest('.item').find(".catch").removeClass('animate');
            video.pause();
            break;
        }
      }
    } else if (slide.hasClass('image_item')) {
      switch (control) {
        case 'play':
          setTimeout(function(){
            slide.closest('.item').find(".catch").addClass('animate');
          }, 1000);
          if (timers.slickNext) {
            clearTimeout(timers.slickNext);
            timers.slickNext = null;
          }
          timers.slickNext = setTimeout(function(){
            slideWrapper.slick('slickNext');
          }, <?php echo absint($options['index_slider_time']); ?>);
          break;
        case 'pause':
          slide.closest('.item').find(".catch").removeClass('animate');
          break;
      }
    }
  }

  // fix video size
  function fix_video_size(object){
    var slider_height = $('#header_slider').innerHeight();
    var slider_width = slider_height*(16/9);
    var win_width = $(window).width();
    var win_height = win_width*(9/16);
    if(win_width > slider_width) {
      object.addClass('type1');
      object.removeClass('type2');
      object.css({'width': '100%', 'height': win_height});
    } else {
      object.removeClass('type1');
      object.addClass('type2');
      object.css({'width':slider_width, 'height':slider_height });
    }
  }


  // Adjust height for mobile device
  function adjust_height(){
    var winH = $(window).innerHeight();
    var winW = $(window).width();
    var side_button_height = $("#side_button").height();
    var header_message_height = $('#header_message').innerHeight();
    if(winW < 1251 && winW > 750){
      var header_slider_height = '';
      var side_button_top_position = 375 - side_button_height / 2 + header_message_height;
    } else if(winW < 750) {
      var header_slider_height = winH;
      var side_button_top_position = 450 - side_button_height / 2 + header_message_height;
    } else {
      var header_slider_height = '';
      var side_button_top_position = 450 - side_button_height / 2 + header_message_height;
      if(winH < 900) {
        var header_slider_height = winH;
        var side_button_top_position = winH / 2 - side_button_height / 2 + header_message_height;
      }
    }
    $('#header_slider').css('height', header_slider_height);
    $('#header_slider .item').css('height', header_slider_height);
    $("#side_button").css('top', side_button_top_position + 'px');
    var side_button_position = $('#side_button').offset();
    $(window).scroll(function () {
      if($(window).scrollTop() > side_button_position.top - 149) {
        $("#side_button").addClass('fixed');
      } else {
        $("#side_button").removeClass('fixed');
      }
    });
  }


  // DOM Ready
  $(function() {
    slideWrapper.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
      if (currentSlide == nextSlide) return;
      slick.$slides.eq(nextSlide).addClass('animate');
      setTimeout(function(){
        playPauseVideo(slick.$slides.eq(currentSlide), 'pause');
      }, slick.options.speed);
      playPauseVideo(slick.$slides.eq(nextSlide), 'play');
    });
    slideWrapper.on('afterChange', function(event, slick, currentSlide) {
      slick.$slides.not(':eq(' + currentSlide + ')').removeClass('animate first_animate');
    });
    slideWrapper.on('swipe', function(event, slick, direction){
      slideWrapper.slick('setPosition');
    });

    //start the slider
    slideWrapper.slick({
      slide: '.item',
      infinite: true,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      swipe: false,
      pauseOnFocus: false,
      pauseOnHover: false,
      autoplay: false,
      fade: true,
      autoplaySpeed:<?php echo absint($options['index_slider_time']); ?>,
      speed:1500,
      easing: 'easeOutExpo'
    });

    // initialize / first animate
    $('#header').addClass('animate');
    adjust_height();
    fix_video_size($('.video_wrap'));
    $('#header_slider .item1').addClass('animate first_animate');
    <?php
         if( $options['show_index_box']) {
    ?>
    $('#index_box_content .box_item').addClass('start_animate');
    $('#index_box_content .box_item').each(function(){
      $(this).on('transitionend webkitTransitionEnd',function(){
        $(this).addClass('end_animate');
        $(this).removeClass('start_animate');
      });
    });
    $('#index_box_content .box_item:last-child').on('transitionend webkitTransitionEnd',function(){
      $('#index_box_content').slick('slickPlay');
    });
    <?php
         }
         if( $options['show_side_bar']) {
           echo "$('#side_button').addClass('animate');\n";
         }
    ?>
    playPauseVideo($('#header_slider .item1'), 'play');
  });

  // Resize event
  $(window).on('resize', function(){
     adjust_height();
     fix_video_size($('.video_wrap'));
  });
