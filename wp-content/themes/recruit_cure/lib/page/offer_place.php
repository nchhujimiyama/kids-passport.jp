<table>
    <tr>
        <th class="require">勤務地名</th>
        <td><input type="text" name="place_name" placeholder="ここに入力できます" value="<?= get_post_meta( $post->ID, 'place_name', true ); ?>" required></td>
    </tr>
    <tr>
        <th class="require">郵便番号</th>
        <td class="postal_code"><span>〒</span><input type="text" name="place_code" placeholder="000-0000" value="<?= get_post_meta( $post->ID, 'place_code', true ); ?>" required></td>
    </tr>
    <tr>
        <th class="require">都道府県</th>
        <td>
            <?php
            $terms = get_terms( 'place', array( 'hide_empty' => false, 'parent' => 0 ) );
            $prefectures = get_post_meta( $post->ID, 'place_prefectures', true );
            $city = get_post_meta( $post->ID, 'place_city', true );
            $city_child = get_post_meta( $post->ID, 'place_city_child', true );
            ?>
            <select id="prece_prefectures" name="place_prefectures" required>
                <?php foreach ( $terms as $val ) { ?>
                    <option value="<?= $val->term_id; ?>" <?= (int)$prefectures === $val->term_id ? 'selected' : ''; ?>><?= $val->name; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th class="require">市区郡</th>
        <td>
            <select id="place_city" name="place_city" required>
                <option data-parent="0" value="" <?= $city ? '' : 'selected'; ?>>-</option>
                <?php
                foreach ( $terms as $val ) {
                    $child_terms = get_terms( 'place', array( 'hide_empty' => false, 'parent' => $val->term_id ) );
                    foreach( $child_terms as $child_val ) {
                ?>
                    <option class="<?= $val->term_id === (int)$prefectures ? '' : 'off' ?>" data-parent="<?= $val->term_id; ?>" value="<?= $child_val->term_id; ?>" <?= (int)$city === $child_val->term_id ? 'selected' : ''; ?>><?= $child_val->name; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th>町村・行政区</th>
        <td>
            <select id="place_city_child" name="place_city_child">
                <option data-parent="0" value="0" <?= $city_child ? '' : 'selected'; ?>>-</option>
                <?php
                foreach ( $terms as $val ) {
                    $child_terms = get_terms( 'place', array( 'hide_empty' => false, 'parent' => $val->term_id ) );
                    foreach( $child_terms as $child_val ) {
                        $gchild_terms = get_terms( 'place', array( 'hide_empty' => false, 'parent' => $child_val->term_id ) );
                        foreach( $gchild_terms as $gchild_val ) {
                        ?>
                            <option class="<?= $child_val->term_id === (int)$city ? '' : 'off'; ?>" data-parent="<?= $child_val->term_id; ?>" value="<?= $gchild_val->term_id; ?>" <?= (int)$city_child === $gchild_val->term_id ? 'selected' : ''; ?>><?= $gchild_val->name; ?></option>
                        <?php
                        }
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th class="require">以降の住所</th>
        <td><input type="text" name="place_other" placeholder="ここに入力できます" value="<?= get_post_meta( $post->ID, 'place_other', true ); ?>" required></td>
    </tr>
    <tr>
        <th>アクセス</th>
        <td><textarea name="place_access" placeholder="ここに入力できます"><?= get_post_meta( $post->ID, 'place_access', true ); ?></textarea></td>
    </tr>
</table>

<style>
    #place_option table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
        border: 1px solid #ccd0d4;
    }
    #place_option th,
    #place_option td {
        padding: 0;
        border: 1px solid #ccd0d4;
    }
    #place_option th {
        width: 120px;
        padding-left: 10px;
        background: #efefef;
        font-size: 14px;
        text-align: left;
        box-sizing: border-box;
    }
    #place_option td {
        font-size: 0;
    }
    #place_option td select,
    #place_option td textarea,
    #place_option td input {
        width: 100%;
        margin: 0;
        padding: 10px;
        font-size: 14px;
        border-radius: 0;
        border: none;
    }
    #place_option td textarea {
        height: 5em;
    }
    #place_option .postal_code {
        display: flex;
        align-items: center;
        border: none;
    }
    #place_option .postal_code span {
        display: block;
        padding: 0 3px 0 10px;
        font-size: 14px;
    }
    #place_option .postal_code input {
        flex: 1;
        padding-left: 0;
    }
    #place_option select option.off {
        display: none;
    }
</style>
<script>
    document.getElementById('prece_prefectures').addEventListener('change', (e) => {
        let value = e.currentTarget.value;
        document.querySelectorAll('#place_city option').forEach( target => {
            if( target.dataset.parent == 0 ) {
                target.selected = true;
            } else {
                if( target.dataset.parent == value ) {
                    target.classList.remove('off');
                } else {
                    target.classList.add('off');
                }
            }
        });
        document.querySelector('#place_city_child option[data-parent="0"]').selected = true;
    });

    document.getElementById('place_city').addEventListener('change', (e) => {
        let value = e.currentTarget.value;
        document.querySelectorAll('#place_city_child option').forEach( target => {
            if( target.dataset.parent == 0 ) {
                target.selected = true;
            } else {
                if( target.dataset.parent == value ) {
                    target.classList.remove('off');
                } else {
                    target.classList.add('off');
                }
            }
        });
    });
</script>