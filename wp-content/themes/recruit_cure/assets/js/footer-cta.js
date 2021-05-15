jQuery(function($){

	var footerCta = $('#js-footer-cta');
	var pageTop = $('#js-pagetop')
	var activeClass = 'is-active';

	if ( footerCta.length ) {

		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				footerCta.addClass(activeClass);
                var footerCtaHeight = footerCta.height();
				pageTop.css('bottom', footerCtaHeight);
			} else {
				footerCta.removeClass(activeClass);
			}
		});

        $(window).bind('resize orientationchange', function() {
            if (footerCta.hasClass(activeClass)) {
                var footerCtaHeight = footerCta.height();
                pageTop.css('bottom', footerCtaHeight);
            };
        });

        $('#js-footer-cta__close').click(function(event) {

            event.preventDefault();
            footerCta.remove();
            pageTop.css('bottom', 0);

            // Create session cookie
            $.cookie('tcdHideFooterCTA', 1);

		});
	}
});
