<?php
    get_header();
    $options = get_design_plus_option();
    $title = $options['offer_label'];
    $title_font_type = $options['offer_title_font_type'];
    $title_direction = $options['news_title_direction'];
    $sub_title = $options['offer_sub_title'];
    $sub_title_font_type = $options['news_sub_title_font_type'];
    $image_id = $options['offer_bg_image'];
    if(!empty($image_id)) {
        $image = wp_get_attachment_image_src($image_id, 'full');
    }
    $use_overlay = $options['offer_use_overlay'];
    if($use_overlay) {
        $overlay_color = hex2rgb($options['offer_overlay_color']);
        $overlay_color = implode(",",$overlay_color);
        $overlay_opacity = $options['offer_overlay_opacity'];
    }
?>

<div id="page_header" <?php if($image_id) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
    <div id="page_header_inner">
        <?php if($title){ ?>
            <h2 class="title rich_font_<?php echo esc_attr($title_font_type); ?> <?php if($title_direction) { echo 'type2'; }; ?>"><?php echo wp_kses_post(nl2br($title)); ?></h2>
        <?php }; ?>
        <?php if($sub_title){ ?>
            <h3 class="sub_title rich_font_<?php echo esc_attr($sub_title_font_type); ?>"><span><?php echo wp_kses_post(nl2br($sub_title)); ?></span></h3>
        <?php }; ?>
    </div>
    <?php if($use_overlay) { ?>
        <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
    <?php }; ?>
</div>

<?php get_template_part('template-parts/breadcrumb'); ?>


<div id="offers">
    <div id="search">
        <?php include( STYLESHEETPATH . '/template-parts/search-modal.php' ); ?>
        <div class="inner">
            <form name="searchForm">
                <?php
                // SEARCH FIELDS --------------------------------------------------------------------------------
                /* 職種 */
                include( STYLESHEETPATH . '/template-parts/search/occupation.php');

                /* 事業部 */
                include( STYLESHEETPATH . '/template-parts/search/division.php');

                /* 勤務地 */
                include( STYLESHEETPATH . '/template-parts/search/place.php');

                /* 雇用形態 */
                include( STYLESHEETPATH . '/template-parts/search/treatment.php' );

                /* 給与 */
                include( STYLESHEETPATH . '/template-parts/search/salary.php' );

                /* こだわり */
                include( STYLESHEETPATH . '/template-parts/search/feature.php' );

                /* 給与 */
                include( STYLESHEETPATH . '/template-parts/search/keyword.php' );
                ?>

            </form>
        </div>
        <p class="toggle_button">
            <a href="javascript:void(0)" @click="toggleForm()">
                <svg v-show="!showForm" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                <svg v-show="showForm" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13H5v-2h14v2z"/></svg>
                <span>詳しい条件を指定する</span>
            </a>
        </p>
        <p class="button"><a href="javascript:void(0)" @click="search()" v-scroll-to="'#sort'">この条件で検索する</a></p>
    </div>

    <?php /* 並べ替え -------------------------------------------------------------------------------- */ ?>
    <div id="sort">
        <ul class="switch-list__order" v-bind:class="params.order">
            <li>並べ替え条件</li>
            <li class="button new" @click="changeOrder('new')">新しい順</li>
            <li class="button old" @click="changeOrder('old')">古い順</li>
            <li class="button views" @click="changeOrder('views')">閲覧数順</li>
        </ul>
    </div>

    <?php /* 求人リスト -------------------------------------------------------------------------------- */ ?>
    <div v-if="posts.length !== 0" class="post_list clearfix">
        <article class="item" v-for="post in posts" :key="post.id">
            <p class="category cat_id_2"><a href="javascript:void(0)" @click="searchCategory(post.division)" tabindex="0">{{ post.division_name }}</a></p>
            <a class="image_link animate_background clearfix" :href="post.link" tabindex="0">
                <div class="image_wrap">
                    <div v-if="post.thumb" :style="{'background': 'url(' + post.thumb + ') center / cover no-repeat'}" class="image"></div>
                    <div v-else class="image" style="background: url(<?= esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif"; ?>) center / cover no-repeat;"></div>
                </div>
            </a>
            <div class="title_area">
                <h3 class="title"><a :href="post.link" tabindex="0"><span>{{ post.title }}</span></a></h3>
                <p class="date"><time class="entry-date updated" :datetime="post.date_full">{{ post.date }}</time></p>
            </div>
        </article>
    </div>
    <div v-else class="no_posts">
        <p>求人が見つかりませんでした。<br>検索条件を変更して再度検索してください。</p>
    </div>

    <?php /* ナビゲーション -------------------------------------------------------------------------------- */ ?>
    <div v-if="pages.length !== 0" class="page_navi clearfix">
        <ul class="pagination">
            <li class="page-item" v-scroll-to="'#sort'">
                <span v-if="params.page != 1" class="prev page-numbers" @click="params.page--"></span>
            </li>
            <li class="page-item" v-for="pageNumber in pages">
                <span v-bind:class="[pageNumber === params.page ? 'current page-numbers' : 'page-numbers']" @click="params.page = pageNumber" v-scroll-to="'#sort'">{{ pageNumber }}</span>
            </li>
            <li class="page-item" v-scroll-to="'#sort'">
                <span v-if="params.page < pages.length" class="next page-numbers" @click="params.page++"></span>
            </li>
        </ul>
    </div>
</div>
<?php get_footer(); ?>