<?php
add_shortcode('diary_menu', 'get_diary_menu_posts');

function get_diary_menu_posts($atts) {
    extract(shortcode_atts(array(
        'color' => '#0094d1',
        'diary_name' => 'DIARY',
        'diary_catch' => '教室日記',
        'menu_name' => 'MENU',
        'menu_catch' => '今日のメニュー'
    ), $atts));

    $args = array(
        'post_type' => 'diary',
        'posts_per_page' => 3,
        'post_status' => 'publish'
    );
    $diary = '';
    $diary_query = new WP_Query($args);
    if( $diary_query->have_posts() ):
        while( $diary_query->have_posts() ):
            $diary_query->the_post();

            $image = get_the_post_thumbnail_url();

            $limit = 32;
            $text = get_the_title();
            if(mb_strlen($text) > $limit) { 
                $title = mb_substr($text,0,$limit) . '...';
            } else {
                $title = $text;
            }

            $diary .= '<article>
                <a href="' . get_the_permalink() . '">
                    <div class="thumb"><div class="image" style="background-image: url(' . $image . ');"></div></div>
                    <div class="info">
                        <h3>' . $title . '</h3>
                        <time>' . get_the_modified_date('Y.m.d') . '</time>
                    </div>
                </a>
            </article>';

        endwhile;
        wp_reset_postdata();
    endif;

    $args = array(
        'post_type' => 'menu',
        'posts_per_page' => 2,
        'post_status' => 'publish'
    );
    $menu = '';
    $menu_query = new WP_Query($args);
    if( $menu_query->have_posts() ):
        while( $menu_query->have_posts() ):
            $menu_query->the_post();

            $image = get_the_post_thumbnail_url();

            $limit = 32;
            $text = get_the_title();
            if(mb_strlen($text) > $limit) { 
                $title = mb_substr($text,0,$limit) . '...';
            } else {
                $title = $text;
            }

            $menu .= '<article>
                <a href="' . get_the_permalink() . '">
                    <div class="thumb"><img class="image" src="' . $image . '"></div>
                    <div class="info">
                        <h3>' . $title . '</h3>
                        <time>' . get_the_modified_date('Y.m.d') . '</time>
                    </div>
                </a>
            </article>';

        endwhile;
        wp_reset_postdata();
    endif;


    $str = '<div id="top_diary_menu">
        <div class="column menu">
            <h3 class="cb_headline rich_font_type2">' . $menu_name . '</h3>
            <h4 class="cb_catch rich_font_type3">' . $menu_catch . '</h4>
            <div class="list">' . $menu . '</div>
            <div class="link"><a href="' . get_post_type_archive_link('menu') . '">' . $menu_catch . '一覧</a></div>
        </div>
        <div class="column">
            <h3 class="cb_headline rich_font_type2">' . $diary_name . '</h3>
            <h4 class="cb_catch rich_font_type3">' . $diary_catch . '</h4>
            <div class="list">' . $diary . '</div>
            <div class="link"><a href="' . get_post_type_archive_link('diary') . '">' . $diary_catch . '一覧</a></div>
        </div>
    </div>
    <style>
    #top_diary_menu {
        display: flex;
        justify-content: space-between;
        padding: 60px 0;
        position: relative;
    }
    #top_diary_menu:before {
        content: "";
        display: block;
        width: 120vw;
        height: 100%;
        position: absolute;
        top: 0;
        left: -webkit-calc(50% - 60vw);
        left: calc(50% - 60vw);
        background: #efefef;
    }
    #top_diary_menu .cb_headline {
        margin: 0 0 18px 0;
        color: ' . $color . ';
        font-size: 14px;
        font-weight: 600;
        line-height: 1;
        text-align: center;
    }
    #top_diary_menu .cb_catch {
        text-align: center;
        font-size: 24px;
        font-weight: 500;
        margin: 0 0 30px 0;
    }
    #top_diary_menu .column {
        width: 48.51695%;
        position: relative;
    }
    #top_diary_menu article a {
        display: flex;
    }
    #top_diary_menu article .thumb {
        width: 207px;
        overflow: hidden;
    }
    #top_diary_menu article .thumb .image {
        height: 132px;
        background: #ccc center / cover no-repeat;
        transform: scale(1);
        transition: all .3s;
    }
    #top_diary_menu article a:hover .thumb .image {
        transform: scale(1.2);
    }
    #top_diary_menu article .info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0 6.11354%;
        background: #fff;
        border: 1px solid #ddd;
        border-left: none;
    }
    #top_diary_menu article + article .info {
        border-top: none;
    }
    #top_diary_menu article .info h3 {
        margin-bottom: 7px;
        font-size: 16px;
        font-weight: normal;
        line-height: 1.6;
    }
    #top_diary_menu article .info time {
        color: #999;
        font-size: 12px;
    }
    #top_diary_menu .link {
        margin-top: 30px;
        text-align: right;
    }
    #top_diary_menu .link a {
        font-size: 14px;
    }
    #top_diary_menu .link a:after {
        width: 14px;
        height: 14px;
        margin-left: 12px;
        font-family: "design_plus";
        content: "\e910";
    }
    @media screen and (max-width: 1024px) {
        #top_diary_menu {
            display: block;
        }
        #top_diary_menu .column {
            width: 100%;
        }
        #top_diary_menu .column + .column {
            margin-top: 60px;
        }
        #top_diary_menu article .thumb {
            display: none;
        }
        #top_diary_menu article .info {
            border-left: 1px solid #ddd;
            padding: 10px 20px 16px;
        }
    }

    @media screen and (min-width: 1025px) {
        #top_diary_menu .menu .list {
            display: flex;
        }
        #top_diary_menu .menu article {
            flex: 1;
        }
        #top_diary_menu .menu article:nth-of-type(2n) {
            margin-left: 16px;
        }
        #top_diary_menu .menu article a {
            flex-direction: column;
        }
        #top_diary_menu .menu article .thumb {
            width: 100%;
        }
        #top_diary_menu .menu article .thumb .image {
            display: block;
            width: 100%;
            height: auto;
            background: none;
        }
        #top_diary_menu .menu article .info {
            padding: 16px;
            border-left: 1px solid #ddd;
        }
    }
    </style>';

    return $str;
}