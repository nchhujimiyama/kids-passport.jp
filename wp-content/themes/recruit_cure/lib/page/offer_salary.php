<p><label><input onClick="checkView(this)" type="checkbox" name="salary_flag" <?= get_post_meta( $post->ID, 'salary_flag', true ) ? 'checked' : ''; ?>>給与を表示する</label></p>
<div id="salary_field" class="<?= get_post_meta( $post->ID, 'salary_flag', true ) ? 'on' : ''; ?>">
    <div class="salary_number">
        <p><label><input onClick="checkWidth(this)" type="checkbox" name="salary_width_flag" <?= get_post_meta( $post->ID, 'salary_width_flag', true ) ? 'checked' : ''; ?>>給与に幅を持たせる</label></p>
        <?php $salary_unit = get_post_meta( $post->ID, 'salary_unit', true); ?>
        <select name="salary_unit">
            <option value="HOUR" <?= $salary_unit === 'HOUR' ? 'selected' : ''; ?>>時給</option>
            <option value="DAY" <?= $salary_unit === 'DAY' ? 'selected' : ''; ?>>日給</option>
            <option value="WEEK" <?= $salary_unit === 'WEEK' ? 'selected' : ''; ?>>週給</option>
            <option value="MONTH" <?= $salary_unit === 'MONTH' ? 'selected' : ''; ?>>月給</option>
            <option value="YEAR" <?= $salary_unit === 'YEAR' ? 'selected' : ''; ?>>年給</option>
        </select>
        <div id="salary_fixed" class="salary_value <?= get_post_meta( $post->ID, 'salary_width_flag', true ) ? '' : 'on'; ?>">
            <input type="number" name="salary_value" value="<?= get_post_meta( $post->ID, 'salary_value', true ); ?>">
        </div>
        <div id="salary_variable" class="salary_value <?= get_post_meta( $post->ID, 'salary_width_flag', true ) ? 'on' : ''; ?>">
            <input type="number" name="salary_value_min" value="<?= get_post_meta( $post->ID, 'salary_value_min', true ); ?>" placeholder="最小">
            〜
            <input type="number" name="salary_value_max" value="<?= get_post_meta( $post->ID, 'salary_value_max', true ); ?>" placeholder="最大">
        </div>
        円
    </div>
    <div class="salary_other">
        <table>
            <tr>
                <th>備考</th>
                <td><textarea name="salary_remarks" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'salary_remarks', true ); ?></textarea></td>
            </tr>
            <tr>
                <th>賞与</th>
                <td><textarea name="salary_bonus" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'salary_bonus', true ); ?></textarea></td>
            </tr>
            <tr>
                <th>昇給</th>
                <td><textarea name="salary_increase" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'salary_increase', true ); ?></textarea></td>
            </tr>
            <tr>
                <th>諸手当</th>
                <td><textarea name="salary_allowance" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'salary_allowance', true ); ?></textarea></td>
            </tr>
        </table>
    </div>
</div>
<style>
    #salary_field { display: none; padding-top: 10px; border-top: 1px solid #ccd0d4; }
    #salary_field.on { display: block; }
    #salary_field .salary_value { display: none; }
    #salary_field .salary_value.on { display: inline-block; }

    #salary_field .salary_other { margin-top: 15px; }
    #salary_field .salary_other table { width: 100%; border-collapse: collapse; border: 1px solid #ccd0d4; }
    #salary_field .salary_other table th,
    #salary_field .salary_other table td { padding: 0; border: 1px solid #ccd0d4; }
    #salary_field .salary_other table th { width: 120px; padding-left: 10px; background: #efefef; font-size: 14px; text-align: left; box-sizing: border-box; }
    #salary_field .salary_other table td { padding: 0; font-size: 0; }
    #salary_field .salary_other table td textarea { width: 100%; min-height: 3em; padding: 10px; font-size: 14px; border-radius: 0; border: none; }
</style>
<script>
    const checkView = (e) => {
        const target = document.getElementById('salary_field');
        if( e.checked ) {
            target.classList.add('on');
        } else {
            target.classList.remove('on');
        }
    }
    const checkWidth = (e) => {
        const variable = document.getElementById('salary_variable');
        const fixed = document.getElementById('salary_fixed');
        if( e.checked ) {
            variable.classList.add('on');
            fixed.classList.remove('on');
        } else {
            variable.classList.remove('on');
            fixed.classList.add('on');
        }
    }
</script>