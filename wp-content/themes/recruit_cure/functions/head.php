<?php
function tcd_head_child() {
    global $post;
    $options = get_design_plus_option();
?>

<style type="text/css">
<?php
    // フォントタイプの設定　------------------------------------------------------------------
?>

<?php
    // メニューアーカイブ -----------------------------------------------------------------------------
    if(is_post_type_archive('menu')) {
        ?>
        #page_header .title { font-size:<?php echo esc_attr($options['menu_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['menu_title_font_color']); ?> !important; }
        #page_header .sub_title { font-size:<?php echo esc_attr($options['menu_sub_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['menu_sub_title_font_color']); ?> !important; background:<?php echo esc_attr($options['menu_sub_title_bg_color']); ?> !important; }
        #content_header .headline { font-size:<?php echo esc_attr($options['archive_menu_headline_font_size']); ?>px !important; color:<?php echo esc_attr($options['archive_menu_headline_font_color']); ?> !important; }
        #content_header .catch { font-size:<?php echo esc_attr($options['archive_menu_catch_font_size']); ?>px !important; }
        #content_header .desc { font-size:<?php echo esc_attr($options['archive_menu_desc_font_size']); ?>px !important; }
        #news_list .title { font-size:<?php echo esc_attr($options['archive_menu_title_font_size']); ?>px !important; }
        @media screen and (max-width:750px) {
            #page_header .title { font-size:<?php echo esc_attr($options['menu_title_font_size_mobile']); ?>px !important; }
            #page_header .sub_title { font-size:<?php echo esc_attr($options['menu_sub_title_font_size_mobile']); ?>px !important; }
            #content_header .headline { font-size:<?php echo esc_attr($options['archive_menu_headline_font_size_mobile']); ?>px !important; }
            #content_header .catch { font-size:<?php echo esc_attr($options['archive_menu_catch_font_size_mobile']); ?>px !important; }
            #content_header .desc { font-size:<?php echo esc_attr($options['archive_menu_desc_font_size_mobile']); ?>px !important; }
            #news_list .title { font-size:<?php echo esc_attr($options['archive_menu_title_font_size_mobile']); ?>px !important; }
        }
        <?php
    // メニュー詳細 -----------------------------------------------------------------------------
    } elseif(is_singular('menu')) {
        ?>
        #page_header .title { font-size:<?php echo esc_attr($options['menu_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['menu_title_font_color']); ?> !important; }
        #page_header .sub_title { font-size:<?php echo esc_attr($options['menu_sub_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['menu_sub_title_font_color']); ?> !important; background:<?php echo esc_attr($options['menu_sub_title_bg_color']); ?> !important; }
        #post_title_area .title { font-size:<?php echo esc_attr($options['single_menu_title_font_size']); ?>px !important; }
        #article .post_content { font-size:<?php echo esc_attr($options['single_menu_content_font_size']); ?>px !important; }
        #recent_news .headline { font-size:<?php echo esc_attr($options['recent_menu_headline_font_size']); ?>px !important; border-color:<?php echo esc_attr($options['main_color']); ?> !important; }
        #recent_news .title { font-size:<?php echo esc_attr($options['recent_menu_title_font_size']); ?>px !important; }
        #recent_news .link_button a { color:<?php echo esc_html($options['recent_menu_button_font_color']); ?> !important; background:<?php echo esc_html($options['recent_menu_button_bg_color']); ?> !important; }
        #recent_news .link_button a:hover { color:<?php echo esc_html($options['recent_menu_button_font_color_hover']); ?> !important; background:<?php echo esc_html($options['recent_menu_button_bg_color_hover']); ?> !important; }
        @media screen and (max-width:750px) {
            #page_header .title { font-size:<?php echo esc_attr($options['menu_title_font_size_mobile']); ?>px !important; }
            #page_header .sub_title { font-size:<?php echo esc_attr($options['menu_sub_title_font_size_mobile']); ?>px !important; }
            #post_title_area .title { font-size:<?php echo esc_attr($options['single_menu_title_font_size_mobile']); ?>px !important; }
            #article .post_content { font-size:<?php echo esc_attr($options['single_menu_content_font_size_mobile']); ?>px !important; }
            #recent_news .headline { font-size:<?php echo esc_attr($options['recent_menu_headline_font_size_mobile']); ?>px !important; }
            #recent_news .title { font-size:<?php echo esc_attr($options['recent_menu_title_font_size_mobile']); ?>px !important; }
        }
        <?php
    // ダイアリーアーカイブ -----------------------------------------------------------------------------
    } elseif(is_post_type_archive('diary')) {
        ?>
        #page_header .title { font-size:<?php echo esc_attr($options['diary_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['diary_title_font_color']); ?> !important; }
        #page_header .sub_title { font-size:<?php echo esc_attr($options['diary_sub_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['diary_sub_title_font_color']); ?> !important; background:<?php echo esc_attr($options['diary_sub_title_bg_color']); ?> !important; }
        #content_header .headline { font-size:<?php echo esc_attr($options['archive_diary_headline_font_size']); ?>px !important; color:<?php echo esc_attr($options['archive_diary_headline_font_color']); ?> !important; }
        #content_header .catch { font-size:<?php echo esc_attr($options['archive_diary_catch_font_size']); ?>px !important; }
        #content_header .desc { font-size:<?php echo esc_attr($options['archive_diary_desc_font_size']); ?>px !important; }
        #news_list .title { font-size:<?php echo esc_attr($options['archive_diary_title_font_size']); ?>px !important; }
        @media screen and (max-width:750px) {
            #page_header .title { font-size:<?php echo esc_attr($options['diary_title_font_size_mobile']); ?>px !important; }
            #page_header .sub_title { font-size:<?php echo esc_attr($options['diary_sub_title_font_size_mobile']); ?>px !important; }
            #content_header .headline { font-size:<?php echo esc_attr($options['archive_diary_headline_font_size_mobile']); ?>px !important; }
            #content_header .catch { font-size:<?php echo esc_attr($options['archive_diary_catch_font_size_mobile']); ?>px !important; }
            #content_header .desc { font-size:<?php echo esc_attr($options['archive_diary_desc_font_size_mobile']); ?>px !important; }
            #news_list .title { font-size:<?php echo esc_attr($options['archive_diary_title_font_size_mobile']); ?>px !important; }
        }
        <?php
    // ダイアリー詳細 -----------------------------------------------------------------------------
    } elseif(is_singular('diary')) {
        ?>
        #page_header .title { font-size:<?php echo esc_attr($options['diary_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['diary_title_font_color']); ?> !important; }
        #page_header .sub_title { font-size:<?php echo esc_attr($options['diary_sub_title_font_size']); ?>px !important; color:<?php echo esc_attr($options['diary_sub_title_font_color']); ?> !important; background:<?php echo esc_attr($options['diary_sub_title_bg_color']); ?> !important; }
        #post_title_area .title { font-size:<?php echo esc_attr($options['single_diary_title_font_size']); ?>px !important; }
        #article .post_content { font-size:<?php echo esc_attr($options['single_diary_content_font_size']); ?>px !important; }
        #recent_news .headline { font-size:<?php echo esc_attr($options['recent_diary_headline_font_size']); ?>px !important; border-color:<?php echo esc_attr($options['main_color']); ?> !important; }
        #recent_news .title { font-size:<?php echo esc_attr($options['recent_diary_title_font_size']); ?>px !important; }
        #recent_news .link_button a { color:<?php echo esc_html($options['recent_diary_button_font_color']); ?> !important; background:<?php echo esc_html($options['recent_diary_button_bg_color']); ?> !important; }
        #recent_news .link_button a:hover { color:<?php echo esc_html($options['recent_diary_button_font_color_hover']); ?> !important; background:<?php echo esc_html($options['recent_diary_button_bg_color_hover']); ?> !important; }
        @media screen and (max-width:750px) {
            #page_header .title { font-size:<?php echo esc_attr($options['diary_title_font_size_mobile']); ?>px !important; }
            #page_header .sub_title { font-size:<?php echo esc_attr($options['diary_sub_title_font_size_mobile']); ?>px !important; }
            #post_title_area .title { font-size:<?php echo esc_attr($options['single_diary_title_font_size_mobile']); ?>px !important; }
            #article .post_content { font-size:<?php echo esc_attr($options['single_diary_content_font_size_mobile']); ?>px !important; }
            #recent_news .headline { font-size:<?php echo esc_attr($options['recent_diary_headline_font_size_mobile']); ?>px !important; }
            #recent_news .title { font-size:<?php echo esc_attr($options['recent_diary_title_font_size_mobile']); ?>px !important; }
        }
        <?php
    }

    $blog_categories = get_terms( 'diary_category', array( 'hide_empty' => true) );
    if ( $blog_categories && ! is_wp_error( $blog_categories ) ) :
        foreach ( $blog_categories as $cat ):
            $cat_id = $cat->term_id;
            $custom_fields = get_option( 'taxonomy_' . $cat_id, array() );
            $category_font_color = ( ! empty( $custom_fields['category_font_color'] ) ) ? $custom_fields['category_font_color'] : '#ffffff';
            $category_bg_color = ( ! empty( $custom_fields['category_bg_color'] ) ) ? $custom_fields['category_bg_color'] : '#02a8c6';
            $category_font_color_hover = ( ! empty( $custom_fields['category_font_color_hover'] ) ) ? $custom_fields['category_font_color_hover'] : '#ffffff';
            $category_bg_color_hover = ( ! empty( $custom_fields['category_bg_color_hover'] ) ) ? $custom_fields['category_bg_color_hover'] : '#007a96';
            ?>
            .cat_id_<?php echo esc_attr($cat_id); ?> a { color:<?php echo esc_html($category_font_color); ?> !important; background:<?php echo esc_html($category_bg_color); ?> !important; }
            .cat_id_<?php echo esc_attr($cat_id); ?> a:hover { color:<?php echo esc_html($category_font_color_hover); ?> !important; background:<?php echo esc_html($category_bg_color_hover); ?> !important; }
            <?php
        endforeach;
    endif;
?>

</style>


<?php
    // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    // Googleマップ
    if(is_page_template('page-hybrid.php')) {
        ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $options['basic_gmap_api_key'] ); ?>" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/pagebuilder/assets/js/googlemap.js"></script>
        <style>
            <?php
            $page_headline_font_size = get_post_meta($post->ID, 'dc2_headline_font_size', true) ?  get_post_meta($post->ID, 'dc2_headline_font_size', true) : '14';
            $page_headline_font_size_mobile = get_post_meta($post->ID, 'dc2_headline_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_headline_font_size_mobile', true) : '12';
            $page_headline_font_color = get_post_meta($post->ID, 'dc2_headline_font_color', true) ?  get_post_meta($post->ID, 'dc2_headline_font_color', true) : '#00a6cc';
            $page_catch_font_size = get_post_meta($post->ID, 'dc2_catch_font_size', true) ?  get_post_meta($post->ID, 'dc2_catch_font_size', true) : '38';
            $page_catch_font_size_mobile = get_post_meta($post->ID, 'dc2_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_catch_font_size_mobile', true) : '24';
            $page_desc_font_size = get_post_meta($post->ID, 'dc2_desc_font_size', true) ?  get_post_meta($post->ID, 'dc2_desc_font_size', true) : '16';
            $page_desc_font_size_mobile = get_post_meta($post->ID, 'dc2_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'dc2_desc_font_size_mobile', true) : '14';
            ?>
            #content_header .headline { font-size:<?php echo esc_attr($page_headline_font_size); ?>px; color:<?php echo esc_attr($page_headline_font_color); ?>; }
            #content_header .catch { font-size:<?php echo esc_attr($page_catch_font_size); ?>px; }
            #content_header .desc { font-size:<?php echo esc_attr($page_desc_font_size); ?>px; }
            @media screen and (max-width:750px) {
                #content_header .headline { font-size:<?php echo esc_attr($page_headline_font_size_mobile); ?>px; }
                #content_header .catch { font-size:<?php echo esc_attr($page_catch_font_size_mobile); ?>px; }
                #content_header .desc { font-size:<?php echo esc_attr($page_desc_font_size_mobile); ?>px; }
            }
            <?php
            $design2_content = get_post_meta( $post->ID, 'design2_content', true );
            if ( $design2_content && is_array( $design2_content ) ) :
                foreach( $design2_content as $key => $content ) :
                    // コンテンツ１ -----------------------------------------------------------------
                    if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
                        $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
                        $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
                        $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '28';
                        $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '24';
                        $catch_font_color = $content['catch_font_color'] ?  $content['catch_font_color'] : '#ffffff';
                        $author_position_font_size = $content['author_position_font_size'] ?  $content['author_position_font_size'] : '14';
                        $author_position_font_size_mobile = $content['author_position_font_size_mobile'] ?  $content['author_position_font_size_mobile'] : '12';
                        $author_title_font_size = $content['author_title_font_size'] ?  $content['author_title_font_size'] : '22';
                        $author_title_font_size_mobile = $content['author_title_font_size_mobile'] ?  $content['author_title_font_size_mobile'] : '18';
                        $author_sub_title_font_size = $content['author_sub_title_font_size'] ?  $content['author_sub_title_font_size'] : '14';
                        $author_sub_title_font_size_mobile = $content['author_sub_title_font_size_mobile'] ?  $content['author_sub_title_font_size_mobile'] : '12';
                        $author_desc_font_size = $content['author_desc_font_size'] ?  $content['author_desc_font_size'] : '16';
                        $author_desc_font_size_mobile = $content['author_desc_font_size_mobile'] ?  $content['author_desc_font_size_mobile'] : '14';
                        ?>

            .design2_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
            .design2_content1.num<?php echo esc_attr($key); ?> .main_image .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; color:<?php echo esc_attr($catch_font_color); ?>; }
            .design2_content1.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size); ?>px; }
            .design2_content1.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size); ?>px; }
            .design2_content1.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size); ?>px; }
            .design2_content1.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size); ?>px; }
            @media screen and (max-width:750px) {
                .design2_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
                .design2_content1.num<?php echo esc_attr($key); ?> .main_image .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
                .design2_content1.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size_mobile); ?>px; }
                .design2_content1.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size_mobile); ?>px; }
                .design2_content1.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size_mobile); ?>px; }
                .design2_content1.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size_mobile); ?>px; }
            }
                        <?php
                    // コンテンツ２ -----------------------------------------------------------------
                    } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
                        $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '24';
                        $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '18';
                        $author_position_font_size = $content['author_position_font_size'] ?  $content['author_position_font_size'] : '14';
                        $author_position_font_size_mobile = $content['author_position_font_size_mobile'] ?  $content['author_position_font_size_mobile'] : '12';
                        $author_title_font_size = $content['author_title_font_size'] ?  $content['author_title_font_size'] : '22';
                        $author_title_font_size_mobile = $content['author_title_font_size_mobile'] ?  $content['author_title_font_size_mobile'] : '18';
                        $author_sub_title_font_size = $content['author_sub_title_font_size'] ?  $content['author_sub_title_font_size'] : '14';
                        $author_sub_title_font_size_mobile = $content['author_sub_title_font_size_mobile'] ?  $content['author_sub_title_font_size_mobile'] : '12';
                        $author_desc_font_size = $content['author_desc_font_size'] ?  $content['author_desc_font_size'] : '16';
                        $author_desc_font_size_mobile = $content['author_desc_font_size_mobile'] ?  $content['author_desc_font_size_mobile'] : '14';
                        $author_position_font_color = $content['author_position_font_color'] ?  $content['author_position_font_color'] : '#00a7ce';
                        $author_position_border_color = $content['author_position_border_color'] ?  $content['author_position_border_color'] : '#01a7ce';
                        $author_position_bg_color = $content['author_position_bg_color'] ?  $content['author_position_bg_color'] : '#ffffff';
                        ?>
            .design2_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; border-color:<?php echo esc_attr($options['main_color']); ?>; }
            .design2_content2.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size); ?>px; color:<?php echo esc_attr($author_position_font_color); ?>; border-color:<?php echo esc_attr($author_position_border_color); ?>; background:<?php echo esc_attr($author_position_bg_color); ?>; }
            .design2_content2.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size); ?>px; }
            .design2_content2.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size); ?>px; }
            .design2_content2.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size); ?>px; }
            @media screen and (max-width:750px) {
                .design2_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
                .design2_content2.num<?php echo esc_attr($key); ?> .category { font-size:<?php echo esc_attr($author_position_font_size_mobile); ?>px; }
                .design2_content2.num<?php echo esc_attr($key); ?> .name { font-size:<?php echo esc_attr($author_title_font_size_mobile); ?>px; }
                .design2_content2.num<?php echo esc_attr($key); ?> .sub_title { font-size:<?php echo esc_attr($author_sub_title_font_size_mobile); ?>px; }
                .design2_content2.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($author_desc_font_size_mobile); ?>px; }
            }
                        <?php
                    // フリースペース -----------------------------------------------------------------
                    } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
                        $desc_font_size = $content['desc_font_size'] ?  esc_html($content['desc_font_size']) : '16';
                        $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  esc_html($content['desc_font_size_mobile']) : '14';
                        $padding_top = $content['padding_top'] ?  esc_html($content['padding_top']) : '50';
                        $padding_bottom = $content['padding_bottom'] ?  esc_html($content['padding_bottom']) : '50';
                        $padding_top_mobile = $content['padding_top_mobile'] ?  esc_html($content['padding_top_mobile']) : '30';
                        $padding_bottom_mobile = $content['padding_bottom_mobile'] ?  esc_html($content['padding_bottom_mobile']) : '30';
                        ?>
            .design2_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top; ?>px; margin-bottom:<?php echo $padding_bottom; ?>px; }
            .design2_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
            @media screen and (max-width:750px) {
                .design2_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top_mobile; ?>px; margin-bottom:<?php echo $padding_bottom_mobile; ?>px; }
                .design2_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
            }
                        <?php
                    };
                endforeach;
            endif;

            $access_content = get_post_meta( $post->ID, 'access_content', true );
            if ( $access_content && is_array( $access_content ) ) :
                foreach( $access_content as $key => $content ) :
                    // コンテンツ１ -----------------------------------------------------------------
                    if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
                        $headline_font_size = $content['headline_font_size'] ?  esc_html($content['headline_font_size']) : '14';
                        $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  esc_html($content['headline_font_size_mobile']) : '12';
                        $headline_font_color = $content['headline_font_color'] ?  esc_html($content['headline_font_color']) : '#00a5d0';
                        $catch_font_size = $content['catch_font_size'] ?  esc_html($content['catch_font_size']) : '38';
                        $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  esc_html($content['catch_font_size_mobile']) : '24';
                        $list_catch_font_size = $content['list_catch_font_size'] ?  esc_html($content['list_catch_font_size']) : '22';
                        $list_catch_font_size_mobile = $content['list_catch_font_size_mobile'] ?  esc_html($content['list_catch_font_size_mobile']) : '18';
                        $list_desc_font_size = $content['list_desc_font_size'] ?  esc_html($content['list_desc_font_size']) : '16';
                        $list_desc_font_size_mobile = $content['list_desc_font_size_mobile'] ?  esc_html($content['list_desc_font_size_mobile']) : '14';
                        ?>
            .access_content1.num<?php echo esc_attr($key); ?> .top_headline { color:<?php echo $headline_font_color; ?>; font-size:<?php echo $headline_font_size; ?>px; }
            .access_content1.num<?php echo esc_attr($key); ?> .top_catch { font-size:<?php echo $catch_font_size; ?>px; }
            .access_content1.num<?php echo esc_attr($key); ?> .item .catch { font-size:<?php echo $list_catch_font_size; ?>px; }
            .access_content1.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo $list_desc_font_size; ?>px; }
            @media screen and (max-width:750px) {
                .access_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
                .access_content1.num<?php echo esc_attr($key); ?> .top_catch { font-size:<?php echo $catch_font_size_mobile; ?>px; }
                .access_content1.num<?php echo esc_attr($key); ?> .item .catch { font-size:<?php echo $list_catch_font_size_mobile; ?>px; }
                .access_content1.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo $list_desc_font_size_mobile; ?>px; }
            }
                        <?php
                    } elseif ( ($content['cb_content_select'] == 'access_map') && $content['show_content']) {
                        $headline_font_size = $content['headline_font_size'] ?  esc_html($content['headline_font_size']) : '24';
                        $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  esc_html($content['headline_font_size_mobile']) : '18';
                        $button_font_color = $content['button_font_color'] ? esc_html( $content['button_font_color'] ) : '#000000';
                        $button_bg_color = $content['button_bg_color'] ? esc_html( $content['button_bg_color'] ) : '#ffffff';
                        $button_border_color = $content['button_border_color'] ? esc_html( $content['button_border_color'] ) : '#dddddd';
                        $button_font_color_hover = $content['button_font_color_hover'] ? esc_html( $content['button_font_color_hover'] ) : '#ffffff';
                        $button_bg_color_hover = $content['button_bg_color_hover'] ? esc_html( $content['button_bg_color_hover'] ) : '#00a7ce';
                        $button_border_color_hover = $content['button_border_color_hover'] ? esc_html( $content['button_border_color_hover'] ) : '#00a7ce';
                        $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
                        $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';
                        $gmap_marker_color = $options['basic_gmap_marker_color'] ? esc_html( $options['basic_gmap_marker_color'] ) : '#ffffff';
                        $gmap_marker_bg = $options['basic_gmap_marker_bg'] ? esc_html( $options['basic_gmap_marker_bg'] ) : '#000000';
                        ?>
            .access_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px; }
            .access_content2.num<?php echo esc_attr($key); ?> .access_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo $gmap_marker_bg; ?>; color:<?php echo $gmap_marker_color; ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .access_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo $gmap_marker_bg; ?> transparent transparent transparent; }
            .access_content2.num<?php echo esc_attr($key); ?> .map_link_button a { color:<?php echo $button_font_color; ?>; background:<?php echo $button_bg_color; ?>; border-color:<?php echo $button_border_color; ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .map_link_button a:hover { color:<?php echo $button_font_color_hover; ?>; background:<?php echo $button_bg_color_hover; ?>; border-color:<?php echo $button_border_color_hover; ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .access_info .post_content { font-size:<?php echo esc_html($options['basic_access_info_font_size']); ?>px; }
            .access_content2.num<?php echo esc_attr($key); ?> .contact .headline { color:<?php echo esc_html($options['main_color']); ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .contact .link_button a { color:<?php echo esc_html($options['basic_contact_button_font_color']); ?>; background:<?php echo esc_html($options['basic_contact_button_bg_color']); ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .contact .link_button a:hover { color:<?php echo esc_html($options['basic_contact_button_font_color_hover']); ?>; background:<?php echo esc_html($options['basic_contact_button_bg_color_hover']); ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .tel .headline { color:<?php echo esc_html($options['main_color']); ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .tel_number .icon:before { color:<?php echo esc_html($options['basic_tel_icon_color']); ?>; }
            .access_content2.num<?php echo esc_attr($key); ?> .service_list .headline { color:<?php echo esc_html($options['main_color']); ?>; }
            @media screen and (max-width:750px) {
                .access_content2.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
                .access_content2.num<?php echo esc_attr($key); ?> .access_info .post_content { font-size:<?php echo esc_html($options['basic_access_info_font_size_mobile']); ?>px; }
            }
                        <?php
                    } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
                        $desc_font_size = $content['desc_font_size'] ?  esc_html($content['desc_font_size']) : '16';
                        $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  esc_html($content['desc_font_size_mobile']) : '14';
                        $padding_top = $content['padding_top'] ?  esc_html($content['padding_top']) : '50';
                        $padding_bottom = $content['padding_bottom'] ?  esc_html($content['padding_bottom']) : '50';
                        $padding_top_mobile = $content['padding_top_mobile'] ?  esc_html($content['padding_top_mobile']) : '30';
                        $padding_bottom_mobile = $content['padding_bottom_mobile'] ?  esc_html($content['padding_bottom_mobile']) : '30';
                        ?>
            .access_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top; ?>px; margin-bottom:<?php echo $padding_bottom; ?>px; }
            .access_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
            @media screen and (max-width:750px) {
                .access_content3.num<?php echo esc_attr($key); ?> { margin-top:<?php echo $padding_top_mobile; ?>px; margin-bottom:<?php echo $padding_bottom_mobile; ?>px; }
                .access_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
            }
                        <?php
                    }
                endforeach;
            endif;

            ?>
        </style>
        <?php
    };


}; // END function tcd_head_child()

add_action("wp_head", "tcd_head_child");
?>