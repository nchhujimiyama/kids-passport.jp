jQuery(document).ready(function($){

    var $filters = $('#blog_sort_button [data-filter]'),
    $items = $('#blog_list [data-category]');

        $filters.on('click', function(e) {

        e.preventDefault();
        var $this = $(this);

        if( $this.hasClass('active') ) return false;

        $filters.removeClass('active');
        $this.addClass('active');

        var $filterCategory = $this.attr('data-filter');

        if ($filterCategory == 'all') {

            $items.removeClass('animate').fadeOut().finish().promise().done(function() {
                $items.each(function(i) {
                    $(this).css('opacity','0').show();
                        $(this).delay(i * 300).queue(function(next) {
                            $(this).addClass('animate').fadeIn();
                        next();
                    });
                });
            });

        } else {

            $items.removeClass('animate').fadeOut().finish().promise().done(function() {
                $items.filter('[data-category = "' + $filterCategory + '"]').each(function(i) {
                    $(this).css('opacity','0').show();
                    $(this).delay(i * 300).queue(function(next) {
                        $(this).addClass('animate').fadeIn();
                        next();
                    });
                });
            });

        }

    });

    var urlHash = location.hash.replace(/<[^>]+>/g, '');
    if(urlHash == '#all'){
    } else if(urlHash == '#author_cat_men'){
        $(".author_cat_men")[0].click();
    } else if(urlHash == '#author_cat_women'){
        $(".author_cat_women")[0].click();
    }

});