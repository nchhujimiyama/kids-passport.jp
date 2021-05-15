const btn = document.getElementById('submit_offer')

btn.addEventListener('click', e => {
    e.preventDefault()

    const getSelectValue = el => {
        let num = el.selectedIndex

        return el.options[num].value
    }

    const form = document.search_offer
    let treatment = getSelectValue( form.treatment )
    let place = getSelectValue( form.place )
    let occupation = getSelectValue( form.occupation )
    let keyword = form.keyword.value
    let params = {
        page: 1,
        posts_per_page: 12,
        order: 'new',
    }

    if ( treatment ) params.treatment_status = [treatment]
    if ( place ) params.place = [place]
    if ( occupation ) params.occupation = [occupation]
    if ( keyword ) params.keyword = keyword

    localStorage.params = JSON.stringify(params)

    location.href = location.href + 'offer'
})


jQuery('#offer_slider').slick({
    adaptiveHeight: true,
    autoplay: true,
    autoplaySpeed: 10000,
    arrows: true,
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    speed: 1000,
    prevArrow: '<div class="carousel_arrow prev_item"></div>',
    nextArrow: '<div class="carousel_arrow next_item"></div>',
    responsive: [
        {
            breakpoint: 1001,
            settings: {
                arrows: false,
                prevArrow: '',
                nextArrow: '',
            },
        },
        {
            breakpoint: 750,
            settings: {
                arrows: false,
                slidesToShow: 2,
            }
        }
    ]
});


const searchCategory = ( category ) => {
    let params = {
        posts_per_page: 12,
        page: 1,
        order: 'new',
        division: [category],
    }

    localStorage.params = JSON.stringify(params)
    window.location.href = '/offer/'
}