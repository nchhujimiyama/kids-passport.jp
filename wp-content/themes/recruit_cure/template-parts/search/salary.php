<div class="search_item" v-show="showForm">
    <h3>希望給与</h3>
    <ul>
        <li>
            区分
            <select name="search_salary_unit" v-model="salary_unit">
                <option value="0">指定しない</value>
                <option value="HOUR">時給</value>
                <option value="MONTH">月給</value>
                <option value="YEAR">年収</value>
            </select>
        </li>
        <li>
            金額
            <select name="search_salary" v-model="salary">
                <option value="0">指定しない</option>
                <?php for( $i = 800; $i < 2501; $i = $i + 100 ) { ?>
                    <option v-if="salary_unit === 'HOUR'" value="<?= $i; ?>"><?= $i; ?>円以上</option>
                <?php }
                $month = [10, 15, 18, 20, 25, 30, 35, 40, 45, 50, 60, 70];
                foreach( $month as $num ) { ?>
                    <option v-if="salary_unit === 'MONTH'" value="<?= $num * 10000; ?>"><?= $num; ?>万円以上</option>
                <?php }
                for( $i = 150; $i < 701; $i += 50 ) { ?>
                    <option v-if="salary_unit === 'YEAR'" value="<?= $i * 10000; ?>"><?= $i; ?>万円以上</option>
                <?php } ?>
            </select>
        </li>
    </ul>
</div>