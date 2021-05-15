<?php
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

/* place */
$prefectures = get_term( $fields['place_prefectures'], 'place' )->name;
$city = get_term( $fields['place_city'], 'place' )->name;
if( $fields['place_city_child'] ) $city .= get_term( $fields['place_city_child'], 'place' )->name;

/* salary */
$salary = '';
$content_salary = '';
if ( $fields['salary_flag'] ) {
    $salary = '"baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "JPY",
        "value": {
            "@type": "QuantitativeValue",' . "\n";
    if( $fields['salary_width_flag'] ) {
        if( $fields['salary_value_min'] && $fields['salary_value_max'] ) {
            $salary .= '"value": ' . $fields['salary_value_min'] . ',' . "\n";
            $salary .= '"minValue": ' . $fields['salary_value_min'] . ',' . "\n";
            $salary .= '"maxValue": ' . $fields['salary_value_max'] . ',' . "\n";

            $content_salary = $fields['salary_value_min'] . '〜' . $fields['salary_value_max'] . '円';
        } else if( $fields['salary_value_min'] ) {
            $salary .= '"value": ' . $fields['salary_value_min'] . ',' . "\n";
            $salary .= '"minValue": ' . $fields['salary_value_min'] . ',' . "\n";

            $content_salary = $fields['salary_value_min'] . '円〜';
        } else if( $fields['salary_value_max'] ) {
            $salary .= '"value": ' . $fields['salary_value_max'] . ',' . "\n";
            $salary .= '"maxValue": ' . $fields['salary_value_max'] . ',' . "\n";

            $content_salary = '〜' . $fields['salary_value_max'] . '円';
        }
    } else {
        $salary .= '"value": "' . $fields['salary_value'] . '",' . "\n";
    }
    $salary .= '"unitText": "' . $fields['salary_unit'] . '"
        }
    },' . "\n";
}


/* process */
$process_group = SCF::get('process_group');
$process = '';
$prosess_str = '';
if( $process_group ) {
    foreach( $process_group as $p ) {
        if( $p['process_ttl'] && $p['process_content'] ) {
            $process_str .= '<dt>' . nl2br( $p['process_ttl'] ) . '</dt><dd>' . format_wpeditor( $p['process_content'] ) . '</dd>';
        }
    }
    if( $process_str ) $process = '<dl>' . $process_str . '</dl>';
}


/* contnet */
if( $fields['offer_detail'] ) {
    $content = '<p>⬛︎仕事内容</p>';
    $content .= addslashes( str_replace( array("\r\n", "\r", "\n"), '', format_wpeditor( $fields['offer_detail'] ) ) );
}
$content .= '<p>⬛︎職種<br>' . addslashes( get_the_title() ) . '</p>';
$content .= '<p>⬛︎雇用形態<br>' . addslashes( format_treatment_status( $fields['treatment_status'] ) ) . '</p>';
$content .= '<p>⬛︎勤務地</p>';
$content .= '〒' . addslashes( $fields['place_code'] . $prefectures . $city . $fields['place_other'] );
if( $fields['place_access'] ) $content .= '<p>⬛︎アクセス</p>' . addslashes( str_replace( array("\r\n", "\r", "\n"), '', nl2br( $fields['place_access'] ) ) );
$content .= '<p>⬛︎勤務時間および休日・休暇<br>';
$content .= '＜勤務時間＞' . addslashes( $fields['treatment_hours'] );
if( $fields['treatment_holiday'] ) $content .= '<br>＜休日・休暇＞<br>' . addslashes( str_replace( array("\r\n", "\r", "\n"), '', nl2br( $fields['treatment_holiday'] ) ) );
$content .= '</p>';
if( $content_salary ) $content .= '<p>⬛︎給与<br>' . addslashes( $content_salary ) . '</p>';
if( $fields['salary_bonus'] ) $content .= '<p>⬛︎賞与<br>' . addslashes( $fields['salary_bonus'] ) . '</p>';
if( $fields['salary_increase'] ) $content .= '<p>⬛︎昇給<br>' . addslashes( $fields['salary_increase'] ) . '</p>';
if( $fields['treatment_other'] ) $content .= '<p>⬛︎福利厚生</p>' . addslashes( str_replace( array("\r\n", "\r", "\n"), '', nl2br( $fields['treatment_other'] ) ) );
if( $fields['offer_competence'] ) $content .= '<p>⬛︎応募資格</p>' . addslashes( str_replace( array("\r\n", "\r", "\n"), '', format_wpeditor( $fields['offer_competence'] ) ) );
if( $process ) $content .= '<p>⬛︎選考プロセス</p>' . addslashes( str_replace( array("\r\n", "\r", "\n"), '', $process ) );
?>


<script type="application/ld+json">
{
    "@context" : "http://schema.org/",
    "@type" : "JobPosting",
    "title" : "<?= get_the_title(); ?>",
    "description" : "<?= $content; ?>",
    "identifier": {
        "@type": "PropertyValue",
        "name": "<?= get_option('company_option_name'); ?>",
        "value": "<?= $fields['management_code'] . '-' . $fields['update_num']; ?>"
    },
    "hiringOrganization" : {
        "@type" : "Organization",
        "name" : "<?= get_option('company_option_name'); ?>",
        "sameAs" : "<?= get_option('company_option_web'); ?>",
        "logo" : "<?= get_option('company_option_logo'); ?>"
    },
    "datePosted" : "<?= get_the_modified_time('Y-m-d'); ?>",
    "validThrough" : "<?= date( 'Y-m-d', strtotime('+1 month', strtotime(get_the_modified_time('Y-m-d'))) ); ?>",
    "employmentType" : "<?= $fields['treatment_status']; ?>",
    "jobLocation": {
        "@type": "Place",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= $fields['place_other']; ?>",
            "addressLocality": "<?= $city; ?>",
            "addressRegion": "<?= $prefectures; ?>",
            "postalCode": "<?= $fields['place_code']; ?>",
            "addressCountry": "JP"
        }
    },
    <?= $salary; ?>
}
</script>