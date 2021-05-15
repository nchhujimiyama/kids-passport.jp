<?php
add_shortcode( 'review', 'top_review' );

function top_review($atts, $content = null) {
    $options = get_design_plus_option();
    $params = shortcode_atts(array(
        'title' => 'お客様の声',
        'catch' => 'キャッチフレーズ',
        'color' => '#00a6cc',
        'hover_color' => '#007a96',
        'link' => 'もっと見る'
    ), $atts);

    $str = '';
    $str .= '<div id="top_review">';

    /* ttl */
    $str .= '<h3 class="cb_headline rich_font_type2" style="color: ' . $params['color'] . ';">' . $params['title'] . '</h3>';
    $str .= '<h4 class="cb_catch rich_font_type3">' . $params['catch'] . '</h4>';
    if( $content ) :
        $str .= '<p class="cb_desc">' . $content . '</p>';
    endif;

    /* main content */
    $review_slug = $options['review_slug'] ? sanitize_title( $options['review_slug'] ) : 'review';
    $args = array(
        'post_type' => $review_slug,
        'posts_per_page' => 12
    );
    $query = new WP_Query($args);

    $str .= '<div id="review_slider" class="inner">';
        if( $query->have_posts() ) :
            while( $query->have_posts() ) :
                $query->the_post();
                $id = get_the_ID();

                $str .= '<div class="item slick-slide">';
                $str .= '<a href="' . get_the_permalink() . '">';
                /* image */
                $image = get_the_post_thumbnail_url();
                $str .= '<div class="image_wrap">';
                if( $image ) :
                    $str .= '<div class="image" style="background: url(' . $image . ') center / cover no-repeat;"></div>';
                else :
                    $str .= '<div class="image" style="background: #ccc;"></div>';
                endif;
                $str .= '<div class="name"></div>';
                $str .= '</div>'; /* close .image_wrap */
                /* info */
                $str .= '<div class="info">';
                $str .= '<h5>' . get_the_title() . '</h5>';
                $str .= '</div>'; /* close .info */
                $str .= '</a>';
                $str .= '</div>'; /* close .item */
            endwhile;
        endif;
        wp_reset_postdata();
    $str .= '</div>';

    $str .= '<div class="link_button"><a href="' . home_url('/review/') . '">' . $params['link'] . '</a></div>';

    $str .= '</div>'; /* close #top_review */

    $str .= '<style>
    #top_review .link_button a { background: ' . $params['color'] . '; }
    #top_review .link_button a:hover { background: ' . $params['hover_color'] . '; }
    </style>';

    return $str;
}