<div class="search_item" v-show="showForm">
    <h3>雇用形態</h3>
    <ul>
        <?php
        $treatments = array(
            'FULL_TIME' => '正社員',
            'PART_TIME' => 'パート・アルバイト',
            'CONTRACTOR' => '契約社員',
            'TEMPORARY' => '一時的な雇用',
            'INTERN' => 'インターンシップ',
            'VOLUNTEER' => 'ボランティア',
            'PER_DIEM' => '日雇い',
            'OTHER' => 'その他',
        );
        foreach( $treatments as $key => $name ) {
            ?>
            <li>
                <input type="checkbox"
                    id="search_treatment_<?= $key; ?>"
                    name="search_treatment"
                    v-model="treatment"
                    value="<?= $key; ?>"
                /><label for="search_treatment_<?= $key; ?>"><?= $name; ?></label>
            </li>
            <?php
        }
        ?>
    </ul>
</div>