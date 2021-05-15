<?php
// count views --------------------------------------------------------------------------------
if (!is_user_logged_in() && !is_robots()) setPostViews( get_the_ID() );

get_header();
$options = get_design_plus_option();
$title = get_the_title();
$title_font_type = $options['offer_title_font_type'];
$title_direction = $options['offer_title_direction'];
$sub_title = $options['offer_sub_title'];
$sub_title_font_type = $options['offer_sub_title_font_type'];
if(has_post_thumbnail()) {
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
}
$use_overlay = $options['offer_use_overlay'];
if($use_overlay) {
  $overlay_color = $options['offer_overlay_color'];
  $overlay_color = hex2rgb($overlay_color);
  $overlay_color = implode(",",$overlay_color);
  $overlay_opacity = $options['offer_overlay_opacity'];
}
?>
<div id="page_header" <?php if(has_post_thumbnail()) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"<?php }; ?>>
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


<div id="main_contents" class="clearfix">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="article">

    <?php if($page == '1') { // ***** only show on first page ***** ?>

      <?php
      // banner top ------------------------------------------------------------------------------------------------------------------------
      if(!is_mobile()) {
        if( $options['single_top_ad_code'] || $options['single_top_ad_image'] ) {
        ?>
          <div id="single_banner_top" class="single_banner">
            <?php
            if ($options['single_top_ad_code']) {
              echo $options['single_top_ad_code'];
            } else {
              $banner_image = wp_get_attachment_image_src( $options['single_top_ad_image'], 'full' );
            ?>
              <a href="<?php echo esc_url( $options['single_top_ad_url'] ); ?>" target="_blank"><img class="single_banner_image" src="<?php echo esc_attr($banner_image[0]); ?>" alt="" title="" /></a>
            <?php }; ?>
          </div><!-- END #single_banner_top -->
        <?php
        };
      };
      ?>

    <?php }; // ***** END only show on first page ***** ?>

    <?php // CUSTOM FIELD ----------------------------------------------------------------------------------------------
    $fields = array(
      'management_code' => get_post_meta($post->ID, 'management_code', true), // 管理コード
      'update_num' => get_post_meta($post->ID, 'update_num', true), // 更新回数
      'offer_comment' => get_post_meta($post->ID, 'offer_comment', true), // 一言
      'offer_pr' => get_post_meta($post->ID, 'offer_pr', true), // PR情報
      'offer_detail' => get_post_meta($post->ID, 'offer_detail', true), // 仕事内容
      'offer_competence' => get_post_meta($post->ID, 'offer_competence', true), // 応募資格
      'treatment_status' => get_post_meta($post->ID, 'treatment_status', true), // 雇用形態
      'treatment_status_remarks' => get_post_meta($post->ID, 'treatment_status_remarks', true), // 雇用形態備考
      'treatment_hours' => get_post_meta($post->ID, 'treatment_hours', true), // 勤務時間
      'treatment_hours_remarks' => get_post_meta($post->ID, 'treatment_hours_remarks', true), // 勤務時間備考
      'treatment_trial' => get_post_meta($post->ID, 'treatment_trial', true), // 試用期間
      'treatment_holiday' => get_post_meta($post->ID, 'treatment_holiday', true), // 休日・休暇
      'treatment_other' => get_post_meta($post->ID, 'treatment_other', true), // 待遇・福利厚生
      'salary_flag' => get_post_meta($post->ID, 'salary_flag', true), // 給与指定の有無
      'salary_width_flag' => get_post_meta($post->ID, 'salary_width_flag', true), // 給与の幅の有無
      'salary_unit' => get_post_meta($post->ID, 'salary_unit', true), // 給与の単位
      'salary_value' => get_post_meta($post->ID, 'salary_value', true), // 固定値の給与
      'salary_value_min' => get_post_meta($post->ID, 'salary_value_min', true), // 給与の最小値
      'salary_value_max' => get_post_meta($post->ID, 'salary_value_max', true), // 給与の最大値
      'salary_remarks' => get_post_meta($post->ID, 'salary_remarks', true), // 給与備考
      'salary_bonus' => get_post_meta($post->ID, 'salary_bonus', true), // 賞与
      'salary_increase' => get_post_meta($post->ID, 'salary_increase', true), // 昇給
      'salary_allowance' => get_post_meta($post->ID, 'salary_allowance', true), // 諸手当
      'place_name' => get_post_meta($post->ID, 'place_name', true), // 勤務地名
      'place_code' => get_post_meta($post->ID, 'place_code', true), // 郵便番号
      'place_prefectures' => get_post_meta($post->ID, 'place_prefectures', true), // 都道府県
      'place_city' => get_post_meta($post->ID, 'place_city', true), // 市区郡
      'place_city_child' => get_post_meta($post->ID, 'place_city_child', true), // 町村・行政区
      'place_other' => get_post_meta($post->ID, 'place_other', true), // それ以降の住所
      'place_access' => get_post_meta($post->ID, 'place_access', true), // アクセス
    );
    ?>
    <div class="post-custom">
      <?php if( $fields['offer_pr'] ) : ?>
        <div class="post-custom__pr">
          <h3 class="headline"><span class="rich_font_type2">RECOMMENDED</span><span class="sub_title">PR情報</span></h3>
          <div><?= format_wpeditor( $fields['offer_pr'] ); ?></div>
        </div>
        <?php get_template_part( 'template-parts/offer', 'link'); ?>
      <?php endif; ?>

      <div class="post-custom__detail">
        <h3 class="headline"><span class="rich_font_type2">RECRUITMENT</span><span class="sub_title">募集要項</span></h3>
        <dl>
          <dt>職種</dt>
          <dd><?= get_the_title(); ?></dd>
          <?php if( $fields['management_code'] ) : ?>
            <dt>求人コード</dt>
            <dd>
              <?php
              $num = $fields['update_num'] ? $fields['update_num'] : 0;
              echo $fields['management_code'] . '-' . str_pad( $num, 3, 0, STR_PAD_LEFT );
              ?>
            </dd>
          <?php endif; ?>
          <?php if( $fields['offer_detail'] ) : ?>
            <dt>仕事内容</dt>
            <dd><?= format_wpeditor( $fields['offer_detail'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['treatment_status'] ) : ?>
            <dt>雇用形態</dt>
            <dd>
              <h4><?= format_treatment_status( $fields['treatment_status'] ); ?></h4>
              <?php if( $fields['treatment_status_remarks'] ) : ?><p><?= nl2br( $fields['treatment_status_remarks'] ); ?></p><?php endif; ?>
            </dd>
          <?php endif; ?>
          <?php if( $fields['salary_flag'] ) : ?>
          <dt>給与</dt>
          <dd>
            <?php
            $unit = $fields['salary_unit'] ? format_salary_unit( $fields['salary_unit'] ) : '';
            $salary = '';
            if( $fields['salary_width_flag'] ) :
              $min = $fields['salary_value_min'] ? number_format( $fields['salary_value_min'] ) : '';
              $max = $fields['salary_value_max'] ? number_format( $fields['salary_value_max'] ) : '';
              if( $min && $max ) :
                $salary = $min . '〜' . $max . '円';
              elseif( $min ) :
                $salary = $min .'円〜';
              elseif( $max ) :
                $salary = '〜' . $max . '円';
              endif;
            else :
              $salary = number_format( $fields['salary_value'] ) . '円';
            endif;
            ?>
            <h4><?= $unit . $salary; ?></h4>
            <?php if( $fields['salary_remarks'] ) : ?><p><?= nl2br( $fields['salary_remarks'] ); ?></p><?php endif; ?>
          </dd>
          <?php endif; ?>
          <?php if( $fields['place_prefectures'] && $fields['place_city'] ) : ?>
          <dt>勤務地</dt>
          <dd>
            <?php if( $fields['place_name'] ) : ?><h4><?= $fields['place_name']; ?></h4><?php endif; ?>
            <?php
            $code = '';
            $prefectures = '';
            $city = '';
            $city_child = '';
            $other = '';
            if( $fields['place_code'] ) $code = '〒' . $fields['place_code'] . '&nbsp;';
            if( $fields['place_prefectures'] ) $prefectures = get_term( $fields['place_prefectures'], 'place' )->name;
            if( $fields['place_city'] ) $city = get_term( $fields['place_city'], 'place' )->name;
            if( $fields['place_city_child'] ) $city_child = get_term( $fields['place_city_child'], 'place' )->name;
            if( $fields['place_other'] ) $other = $fields['place_other'];
            ?>
            <p><?= $code . $prefectures . $city . $city_child . $other; ?></p>
          </dd>
          <?php endif; ?>
          <?php if( $fields['place_access'] ) : ?>
            <dt>アクセス</dt>
            <dd><?= nl2br( $fields['place_access'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['treatment_hours'] ) : ?>
            <dt>勤務時間</dt>
            <dd>
              <h4><?= $fields['treatment_hours']; ?></h4>
              <?php if( $fields['treatment_hours_remarks'] ) : ?><p><?= nl2br( $fields['treatment_hours_remarks'] ); ?></p><?php endif; ?>
            </dd>
          <?php endif; ?>
          <?php if( $fields['offer_competence'] ) : ?>
            <dt>応募資格</dt>
            <dd><?= format_wpeditor( $fields['offer_competence'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['treatment_trial'] ) : ?>
            <dt>試用期間</dt>
            <dd><?= $fields['treatment_trial']; ?></dd>
          <?php endif; ?>
          <dt>応募方法</dt>
          <dd><a href="tel:">電話</a>・<a href="<?= home_url(); ?>/contact/?code=">エントリーフォーム</a>よりご応募ください。</dd>
        </dl>
      </div>

      <?php get_template_part( 'template-parts/offer', 'link'); ?>

      <div class="post-custom__salary">
        <h3 class="headline"><span class="rich_font_type2">ALLOWANCE</span><span class="sub_title">給与・福利厚生</span></h3>
        <dl>
          <?php if( $fields['salary_increase'] ) : ?>
            <dt>昇給</dt>
            <dd><?= nl2br( $fields['salary_increase'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['salary_bonus'] ) : ?>
            <dt>賞与</dt>
            <dd><?= nl2br( $fields['salary_bonus'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['treatment_holiday'] ) : ?>
            <dt>休日・休暇</dt>
            <dd><?= nl2br( $fields['treatment_holiday'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['salary_allowance'] ) : ?>
            <dt>諸手当</dt>
            <dd><?= nl2br( $fields['salary_allowance'] ); ?></dd>
          <?php endif; ?>
          <?php if( $fields['treatment_other'] ) : ?>
            <dt>福利厚生</dt>
            <dd><?= nl2br( $fields['treatment_other'] ); ?></dd>
          <?php endif; ?>
        </dl>
      </div>

      <?php get_template_part( 'template-parts/offer', 'link'); ?>

      <?php // 採用プロセス -----------------------------
      $process_group = SCF::get('process_group');
      $str = '';
      if( $process_group ) {
        foreach( $process_group as $process ) {
          if( $process['process_ttl'] && $process['process_content'] ) {
            $str .= '<li><h4>' . $process['process_ttl'] . '</h4><div>' . $process['process_content'] . '</div></li>';
          }
        }
      }
      if( $str ) {
      ?>
        <div class="post-custom__process">
          <h3 class="headline"><span class="rich_font_type2">PROCESS</span><span class="sub_title">採用プロセス</span></h3>
          <ul><?= $str; ?></ul>
        </div>

        <?php get_template_part( 'template-parts/offer', 'link'); ?>
      <?php } ?>

      <?php // 企業情報 -----------------------------
      $company = array(
        'name' => get_option('company_option_name'),
        'place' => get_option('company_option_place'),
        'tel' => get_option('company_option_tel'),
        'web' => get_option('company_option_web'),
        'business' => get_option('company_option_business'),
      );
      ?>
      <div class="post-custom__company">
        <h3 class="headline"><span class="rich_font_type2">COMPANY</span><span class="sub_title">企業情報</span></h3>
        <dl>
          <?php if( $company['name'] ) : ?>
            <dt>会社名・屋号</dt>
            <dd><?= $company['name']; ?></dd>
          <?php endif; ?>
          <?php if( $company['place'] ) : ?>
            <dt>所在地</dt>
            <dd><?= $company['place']; ?></dd>
          <?php endif; ?>
          <?php if( $company['tel'] ) : ?>
            <dt>電話番号</dt>
            <dd><a href="tel:<?= $company['tel']; ?>"><?= $company['tel']; ?></a></dd>
          <?php endif; ?>
          <?php if( $company['web'] ) : ?>
            <dt>ウェブサイト</dt>
            <dd><a href="<?= $company['web']; ?>" target="_blank"><?= $company['web']; ?></a></dd>
          <?php endif; ?>
          <?php if( $company['business'] ) : ?>
            <dt>事業内容</dt>
            <dd><?= nl2br( $company['business'] ); ?></dd>
          <?php endif; ?>
        </dl>
      </div>

      <?php get_template_part( 'template-parts/offer', 'link'); ?>
    </div>

    <?php
    // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if ($options['single_offer_show_nav']) :
    ?>
      <div id="next_prev_post" class="clearfix">
        <?php next_prev_post_link(); ?>
      </div>
    <?php endif; ?>

    <?php
    // banner bottom ------------------------------------------------------------------------------------------------------------------------
    if(!is_mobile()) {
      if( $options['single_bottom_ad_code'] || $options['single_bottom_ad_image'] ) {
      ?>
        <div id="single_banner_bottom" class="single_banner">
          <?php
          if ($options['single_bottom_ad_code']) {
            echo $options['single_bottom_ad_code'];
          } else {
            $banner_image = wp_get_attachment_image_src( $options['single_bottom_ad_image'], 'full' );
            ?>
            <a href="<?php echo esc_url( $options['single_bottom_ad_url'] ); ?>" target="_blank"><img class="single_banner_image" src="<?php echo esc_attr($banner_image[0]); ?>" alt="" title="" /></a>
          <?php }; ?>
        </div><!-- END #single_banner_bottom -->
      <?php
      };
    };
    ?>

  </article><!-- END #article -->

<?php endwhile; endif; ?>


</div><!-- END #main_contents -->

<?php include( STYLESHEETPATH . '/template-parts/offer-json.php' ); ?>

<?php get_footer(); ?>