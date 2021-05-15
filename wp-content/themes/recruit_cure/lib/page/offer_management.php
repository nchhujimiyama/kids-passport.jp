<table>
    <tr>
        <th class="require">求人コード</th>
        <td><input type="text" name="management_code" value="<?= get_post_meta( $post->ID, 'management_code', true); ?>" require></td>
    </tr>
    <tr>
        <th>更新回数</th>
        <td>
            <?php $num = get_post_meta( $post->ID, 'update_num', true); ?>
        <input type="number" name="update_num" value="<?= $num ? $num : 0; ?>">
        </td>
    </tr>
</table>

<div class="bool_fields">
    <input type="checkbox" id="pickup" name="pickup" value="1" <?= get_post_meta( $post->ID, 'pickup', true ) ? 'checked' : ''; ?>><label for="pickup"><span></span>ピックアップ求人に指定する</label>
</div>


<style>
    #management_option table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
        border: 1px solid #ccd0d4;
    }
    #management_option th,
    #management_option td {
        padding: 0;
        border: 1px solid #ccd0d4;
    }
    #management_option th {
        width: 120px;
        padding-left: 10px;
        background: #efefef;
        font-size: 14px;
        text-align: left;
        box-sizing: border-box;
    }
    #management_option td {
        font-size: 0;
    }
    #management_option td input {
        width: 100%;
        margin: 0;
        padding: 10px;
        font-size: 14px;
        border-radius: 0;
        border: none;
    }
    #management_option .bool_fields {
        margin-top: 15px;
    }
    #management_option .bool_fields input {
        display: none;
    }
    #management_option .bool_fields label span {
        display: inline-block;
        position: relative;
        width: 60px;
        height: 30px;
        margin-right: 8px;
        border-radius: 15px;
        border: 2px solid #333;
        box-sizing: border-box;
        vertical-align: middle;
        transition: all .2s;
    }
    #management_option .bool_fields label span:after {
        content: '';
        display: block;
        position: absolute;
        top: 2px;
        left: 2px;
        width: 22px;
        height: 22px;
        background: #fff;
        border: 2px solid #333;
        border-radius: 11px;
        box-sizing: border-box;
        transition: all .2s;
    }
    #management_option .bool_fields input:checked + label span {
        background: #ff6361;
    }
    #management_option .bool_fields input:checked + label span:after {
        left: 32px;
    }
</style>