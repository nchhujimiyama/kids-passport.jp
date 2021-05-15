jQuery('#interview_slider').slick({
    adaptiveHeight: true,
    autoplay: true,
    autoplaySpeed: 10000,
    arrows: false,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    speed: 1000,
    responsive: [
        {
            breakpoint: 750,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        }
    ]
});

jQuery('#review_slider').slick({
    adaptiveHeight: true,
    autoplay: false,
    // autoplaySpeed: 10000,
    arrows: false,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    speed: 1000,
    responsive: [
        {
            breakpoint: 750,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        }
    ]
});