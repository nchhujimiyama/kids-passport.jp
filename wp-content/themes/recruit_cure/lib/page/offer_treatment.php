<table>
    <tr>
        <th>雇用形態</th>
        <td>
            <?php $treatment_status = get_post_meta( $post->ID, 'treatment_status', true ); ?>
            <select name="treatment_status">
                <option value="FULL_TIME" <?= $treatment_status === 'FULL_TIME' ? 'selected' : ''; ?>>正社員</option>
                <option value="PART_TIME" <?= $treatment_status === 'PART_TIME' ? 'selected' : ''; ?>>パート・アルバイト</option>
                <option value="CONTRACTOR" <?= $treatment_status === 'CONTRACTOR' ? 'selected' : ''; ?>>契約社員</option>
                <option value="TEMPORARY" <?= $treatment_status === 'TEMPORARY' ? 'selected' : ''; ?>>一時的な雇用</option>
                <option value="INTERN" <?= $treatment_status === 'INTERN' ? 'selected' : ''; ?>>インターンシップ</option>
                <option value="VOLUNTEER" <?= $treatment_status === 'VOLUNTEER' ? 'selected' : ''; ?>>ボランティア</option>
                <option value="PER_DIEM" <?= $treatment_status === 'PER_DIEM' ? 'selected' : ''; ?>>日雇い</option>
                <option value="OTHER" <?= $treatment_status === 'OTHER' ? 'selected' : ''; ?>>その他</option>
            </select>
        </td>
    </tr>
    <tr>
        <th>雇用形態備考</th>
        <td><textarea name="treatment_status_remarks" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'treatment_status_remarks', true ); ?></textarea></td>
    </tr>
</table>

<table>
    <tr>
        <th class="require">勤務時間</th>
        <td><input type="text" name="treatment_hours" placeholder="00:00〜00:00" value="<?= get_post_meta( $post->ID, 'treatment_hours', true ); ?>" required></td>
    </tr>
    <tr>
        <th>勤務時間備考</th>
        <td><textarea name="treatment_hours_remarks" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'treatment_hours_remarks', true ); ?></textarea></td>
    </tr>
</table>

<table>
    <tr>
        <th>試用期間</th>
        <td><input type="text" name="treatment_trial" placeholder="ここに入力できます" value="<?= get_post_meta( $post->ID, 'treatment_trial', true ); ?>"></td>
    </tr>
    <tr>
        <th class="require">休日・休暇</th>
        <td><textarea name="treatment_holiday" placeholder="ここに入力できます" required><?= get_post_meta( $post->ID, 'treatment_holiday', true ); ?></textarea></td>
    </tr>
    <tr>
        <th>待遇・福利厚生</th>
        <td><textarea name="treatment_other" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'treatment_other', true ); ?></textarea></td>
    </tr>
</table>

<style>
    #treatment_option table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
        border: 1px solid #ccd0d4;
    }
    #treatment_option th,
    #treatment_option td {
        padding: 0;
        border: 1px solid #ccd0d4;
    }
    #treatment_option th {
        width: 120px;
        padding-left: 10px;
        background: #efefef;
        font-size: 14px;
        text-align: left;
        box-sizing: border-box;
    }
    #treatment_option td {
        font-size: 0;
    }
    #treatment_option td select,
    #treatment_option td textarea,
    #treatment_option td input {
        width: 100%;
        margin: 0;
        padding: 10px;
        font-size: 14px;
        border-radius: 0;
        border: none;
    }
    #treatment_option td textarea {
        height: 5em;
    }
</style>