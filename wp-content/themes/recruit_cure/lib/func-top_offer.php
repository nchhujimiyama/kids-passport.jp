<?php
function topOffer() {
    $site_url = home_url();

echo <<<EOM
<h3 class="cb_headline rich_font_type2 offer_ttl">求人情報</h3>
<h4 class="cb_catch rich_font_type3">キャッチフレーズ</h4>
EOM;

    // PICKUP OFFER LIST ----------------------------------------------------------------
    $offers = new WP_Query( array(
        'post_type' => 'offer',
        'posts_per_page' => 12,
        'meta_key' => 'pickup',
        'meta_value' => 1
    ) );
    if ( $offers->have_posts() ) :
        echo '<div id="offer_slider" class="offer_list clearfix">';
        while ( $offers->have_posts() ) : $offers->the_post();
            $title = get_the_title();
            $link = get_permalink();
            $time_full = get_the_modified_date('c');
            $time = get_the_modified_time('Y.m.d');
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if( empty( $image ) ) $image = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";

            $parent_division = wp_get_post_terms(get_the_ID(), 'division', array('parent'=>0));
			if($parent_division) {
				foreach($parent_division as $pd) {
					$parent_term = $pd;
				}
            }
echo <<<EOM
<article class="item slick-slide">
    <p class="category cat_id_2">
        <a href="javascript:void(0)" onClick="searchCategory($parent_term->term_id)" tabindex="-1">$parent_term->name</a>
    </p>
    <a class="link animate_background" href="$link" tabindex="0">
        <div class="image_wrap">
            <div class="image" style="background:url($image) no-repeat center center; background-size:cover;"></div>
        </div>
        <div class="title_area">
            <h3 class="title"><span>$title</span></h3>
            <p class="date"><time class="entry-date updated" datetime="$time_full">$time</time></p>
        </div>
    </a>
</article>
EOM;
        endwhile;
        echo '</div>';

        wp_reset_postdata();
    endif;


    // SEARCH FORM ----------------------------------------------------------------
    $occupation = '';
    $terms = get_terms( 'occupation', array( 'parent' => 0 ) );
    if ( $terms ) :
        foreach ( $terms as $term ) :
            $occupation .= '<option value="' . $term->term_id . '">' . $term->name . '</option>';

            $term_childs = get_terms( 'occupation', array( 'parent' => $term->term_id ) );
            if ( $term_childs ) :
                foreach ( $term_childs as $child ) :
                    $occupation .= '<option class="child" value="' . $child->term_id . '">' . $child->name . '</option>';

                    $term_g_childs = get_terms( 'occupation', array( 'parent' => $child->term_id ) );
                    if ( $term_g_childs ) :
                        foreach ( $term_g_childs as $g_child ) :
                            $occupation .= '<option class="g_child" value="' . $g_child->term_id . '">' . $g_child->name . '</option>';
                        endforeach;
                    endif;
                endforeach;
            endif;
        endforeach;
    endif;

    $place = '';
    $terms = get_terms( 'place', array( 'parent' => 0 ) );
    if ( $terms ) :
        foreach ( $terms as $term ) :
            $place .= '<option value="' . $term->term_id . '">' . $term->name . '</option>';

            $term_childs = get_terms( 'place', array( 'parent' => $term->term_id ) );
            if ( $term_childs ) :
                foreach ( $term_childs as $child ) :
                    $place .= '<option class="child" value="' . $child->term_id . '">' . $child->name . '</option>';

                    $term_g_childs = get_terms( 'place', array( 'parent' => $child->term_id ) );
                    if ( $term_g_childs ) :
                        foreach ( $term_g_childs as $g_child ) :
                            $place .= '<option class="g_child" value="' . $g_child->term_id . '">' . $g_child->name . '</option>';
                        endforeach;
                    endif;
                endforeach;
            endif;
        endforeach;
    endif;


echo <<<EOM
<div class="search_fields">
    <h4>求人を検索する</h4>
    <form name="search_offer" action="$site_url/offer/" method="POST">
        <div>
            <input type="text" name="keyword" placeholder="キーワード">
        </div>
        <div>
            <select name="occupation" class="chosen-select">
                <option value="">職種から選ぶ</option>
                $occupation
            </select>
        </div>
        <div>
            <select name="place" class="chosen-select">
                <option value="">勤務地から選ぶ</option>
                $place
            </select>
        </div>
        <div>
            <select name="treatment" class="chosen-select">
                <option value="">雇用形態から選ぶ</option>
                <option value="FULL_TIME">正社員</option>
                <option value="PART_TIME">パート・アルバイト</option>
                <option value="CONTRACTOR">契約社員</option>
                <option value="TEMPORARY">一時的な雇用</option>
                <option value="INTERN">インターンシップ</option>
                <option value="VOLUNTEER">ボランティア</option>
                <option value="PER_DIEM">日雇い</option>
                <option value="OTHER">その他</option>
            </select>
        </div>
        <div>
            <button id="submit_offer">検索する</button>
        </div>
    </form>
</div>
EOM;


    // NEW OFFER LIST ----------------------------------------------------------------
    $offers = new WP_Query( array(
        'post_type' => 'offer',
        'posts_per_page' => 6,
    ) );
    if ( $offers->have_posts() ) :
        echo '<div id="offers" class="offer_list">';
        while ( $offers->have_posts() ) : $offers->the_post();
            $title = get_the_title();
            $comment = get_post_meta(get_the_ID(), 'offer_comment', true);
            $link = get_permalink();
            $time_full = get_the_modified_date('c');
            $time = get_the_modified_time('Y.m.d');
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if( empty( $image ) ) $image = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";

            $parent_division = wp_get_post_terms(get_the_ID(), 'division', array('parent'=>0));
			if($parent_division) {
				foreach($parent_division as $pd) {
					$parent_term = $pd;
				}
            }

echo <<<EOM
<article class="item">
    <p class="category cat_id_2">
        <a href="javascript:void(0)" onClick="searchCategory($parent_term->term_id)" tabindex="-1">$parent_term->name</a>
    </p>
    <a class="link animate_background" href="$link" tabindex="0">
        <div class="image_wrap">
            <div class="image" style="background:url($image) no-repeat center center; background-size:cover;"></div>
        </div>
        <div class="title_area">
            <h3 class="title"><span>$title</span></h3>
            <p class="excerpt"><span>$comment</span></p>
            <p class="date"><time class="entry-date updated" datetime="$time_full">$time</time></p>
        </div>
    </a>
</article>
EOM;
        endwhile;
        echo '</div>';

        wp_reset_postdata();
    endif;


echo <<<EOM
<p class="button_custom"><a href="$site_url/offer/">OFFER</a></p>
<script>
jQuery(function($) {
    $('.chosen-select').chosen();
});
</script>
EOM;

    return false;
}

add_shortcode( 'offer', 'topOffer' );