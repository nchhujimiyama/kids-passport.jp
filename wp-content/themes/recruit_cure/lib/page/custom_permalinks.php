<?php
//=== URL設定画面
$_query = new WP_Query( array(
    'post_type'      => 'offer',
    "paged"          => $paged,
    'posts_per_page' => - 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
$_cnts  = $_query->found_posts;

$rand = my_recruit_custom_permalinks_rand();
?>
<div class="wrap">
    <h2>求人URL設定</h2>

    <form method="post" name="urlForm" action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>" class="my_recruit_job_url_form" onsubmit="javascript: return confirm('こちらの内容で更新しますが、よろしいでしょうか？');">
        <div class="tablenav">
            <div class="alignleft">
                <input type="submit" value="更新" name="submit" class="button-primary"/>
            </div>
        </div>
        <?php
        //時間のSELECT
        $hour = '<select name="modified_hour" onchange="dateFunc()">';
        for( $i = 0; $i < 24; ++$i ) {
            $selected = ( $i == $modified_time[0] ) ? ' selected' : null;
            $hour .= '<option value="'.sprintf( '%02d', $i ).'"' . $selected . '>'.sprintf( '%02d', $i ).'</option>';
        }
        $hour .= '</select>';

        //分のSELECT
        $minute = '<select name="modified_minute" onchange="dateFunc()">';
        for( $i = 0; $i < 60; ++$i ) {
            $selected = ( $i == $modified_time[1] ) ? ' selected' : null;
            $minute .= '<option value="'.sprintf( '%02d', $i ).'"' . $selected . '>'.sprintf( '%02d', $i ).'</option>';
        }
        $minute .= '</select>';
        ?>
        <div class="datenav" style="display: flex; margin: 10px auto; background: #fff; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04);">
            <div style="width: 100px; padding: 15px 10px; background: #333; color: #fff;">更新日</div>
            <div style="flex: 1; padding: 15px 10px;">
                <p>
                    <label><input type="radio" name="modified_type" value="1" checked>更新時の日時（wordpress標準）</label>
                    <input type="hidden" name="now_date" value="<?= htmlspecialchars( $rand ); ?>">
                </p>
                <p><label><input type="radio" name="modified_type" value="2">指定</label></p>
                <p class="modified_select"><input type="text" name="modified_date" class="datepicker" onchange="dateFunc();"><?= $hour; ?>時<?= $minute; ?>分</p>
            </div>
        </div>
        <table class="widefat">
            <thead>
                <tr>
                    <th scope="col" class="check-column"><input type="checkbox"/></th>
                    <th scope="col" width=40%>タイトル</th>
                    <th scope="col">求人ID</th>
                    <th scope="col">更新回数</th>
                    <th scope="col">求人URL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ( $_query->have_posts() ) {
                    $_query->the_post();

                    $post_id = get_the_ID();
                    $job_id = get_post_meta($post_id, 'management_code', true);
                    $job_num = get_post_meta($post_id, 'update_num', true);
                    $job_url_auto_change = true;
                    $job_url_uuid = get_post_meta($post_id, 'uuid', true);

                    if ( empty( $job_id ) ) $job_id = "offer-" . $post_id;

                    $job_url  = my_recruit_custom_permalinks_url( $job_id, $rand, $job_num + 1 );
                    $editlink = 'post.php?action=edit&post=' . $post_id;

                    $job_url_org = my_recruit_custom_permalinks_url( $job_id, $job_url_uuid, $job_num );
                    ?>
                    <tr class="post_row" valign="top" data-id="<?= $post_id; ?>" data-uuid="<?= htmlspecialchars( $job_url_uuid ); ?>" data-rand="<?= htmlspecialchars( $rand ); ?>">
                        <input type="hidden" name="job[<?=$post_id; ?>][uuid]" value="<?= htmlspecialchars( $job_url_uuid ); ?>"/>
                        <input type="hidden" name="job[<?= $post_id; ?>][rand]" value="<?= htmlspecialchars( $rand ); ?>"/>
                        <input type="hidden" name="job[<?= $post_id; ?>][custom_permalink]" class="custom_permalink" value=""/>

                        <th scope="row" class="check-column">
                            <input type="checkbox" name="job_checked[]" value="<?= get_the_ID(); ?>" class="job_check"/>
                        </th>
                        <td>
                            <strong><a class="row-title" href="<?= htmlspecialchars( $editlink ) ?>"><?= get_the_title(); ?></a></strong>
                        </td>
                        <td>
                            <input type="text" class="job_id" name="job[<?= $post_id; ?>][job_id]" value="<?= htmlspecialchars( $job_id ) ?>"/>
                            <span>
                                <label>
                                    <input type="checkbox" name="job[<?= $post_id; ?>][job_url_auto_change]" class="job_url_auto_change" value="true" checked />
                                    URLを変更する
                                </label>
                            </span>
                        </td>
                        <td>
                            <input type="number" class="job_num" name="job[<?= $post_id; ?>][job_num]" value="<?= $job_num ? $job_num : 0; ?>"/>
                        </td>
                        <td>
                            <?= home_url( "/" ); ?><span class="job_url" style="display: none;"><?= htmlspecialchars( $job_url, ENT_QUOTES ); ?></span><span class="job_url_org"><?= htmlspecialchars( $job_url_org, ENT_QUOTES ); ?></span>
                        </td>
                    </tr>
                <?php
                }
                wp_reset_postdata();
                ?>
            </tbody>
        </table>

        <br class="clear"/>

        <div class="tablenav">
            <div class="alignleft">
                <input type="submit" value="更新" name="submit" class="button-primary"/>
            </div>
            <br class="clear"/>
        </div>
    </form>
</div>
<script>
    jQuery(function($) {
        $('.datepicker').datepicker();
        $('.datepicker').datepicker('option', 'dateFormat', 'yy-mm-dd');
        $('.datepicker').datepicker('setDate', '{$modified[0]}');

        var $form = $('.my_recruit_job_url_form');
        var raf = window.requestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            (function(callback) {
                setTimeout(callback, 100);
            });
        var check_ = function() {
            $form.find('tr').each(function() {
            var $tr = $(this);

            var job_id = $tr.find('.job_id').val();
            var auto_change = $tr.find('.job_url_auto_change').attr('checked');

            var format_ = <?= json_encode( cr_get_option( "job_url_format" ) ); ?>;

            var url = (format_ + '').split('%job_id%').join(job_id);
            if (auto_change) {
                url = url.split('%job_rand%').join($.trim($tr.attr('data-rand')));
            } else {
                url = url.split('%job_rand%').join('' + $.trim($tr.attr('data-uuid')));
            }

            // $tr.find('.job_url').text(url);
            // $tr.find('.custom_permalink').val(url);

            if ($tr.find('.job_check').attr('checked')) {
                $tr.find('.job_url').show();
                $tr.find('.job_url_org').hide();
                $tr.css('background', '#fdd');
            } else {
                $tr.find('.job_url').hide();
                $tr.find('.job_url_org').show();
                $tr.css('background', 'none');
            }
            if ($.trim($tr.find('.job_url').text()) != $.trim($tr.find('.job_url_org').text())) {
                $tr.find('.job_url').css('background', '#fd0');
            } else {
                $tr.find('.job_url').css('background', 'none');
            }
            });
            raf(check_);
        };
        check_();
    });

    const dateFunc = () => {
        let type = document.querySelector('input:checked[name=modified_type]').value;
        if(type == 2) {
            let date = document.urlForm.modified_date.value.replace(/-/g, '');

            dataSet(date);
        } else {
            let now = document.urlForm.now_date.value;

            dataSet(now);
        }
    }
    const dataSet = (date) => {
        document.querySelectorAll('.post_row').forEach( (e) => {
            let id = e.dataset.id;

            // rand
            let target = document.querySelector('input[name="job[' + id + '][rand]"]');
            target.value = date;

            // code
            let codeEl = document.querySelector('input[name="job[' + id + '][job_id]"]');
            let code = codeEl.value;

            // num
            let numEl = document.querySelector('input[name="job[' + id + '][job_num]"]');
            let num = parseInt(numEl.value, 10) + 1;
            num = ('000' + num).slice( -3 );

            // custom_permalink
            let permalink = document.querySelector('input[name="job[' + id + '][custom_permalink]"]');
            permalink.value = code + '-' + num + '-' + date;
        });
    }
    (function() {
        let modifiedType = 1;
        modifiedType = document.querySelectorAll('input[name=modified_type]').forEach( (e) => {
            e.addEventListener('click', dateFunc, false);
        });
        dateFunc();
    })();
</script>
<style>
.modified_select input,
.modified_select select {
    max-width:7em;
    line-height:100%;
    height:auto;
    vertical-align:middle;
}
.modified_select select {
    margin:0 5px;
}
</style>