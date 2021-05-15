<div id="overlay" v-show="showModal">
    <div class="content">
        <a class="close_modal" href="javascript:void(0)" @click="closeModal">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            <span>閉じる</span>
        </a>
        <div v-show="modalType === 'place'">
            <h2>勤務地を指定する</h2>
            <?php // 勤務地 --------------------------------------------------------------------------------
            $places = get_terms( 'place', array( 'parent' => 0 ) );
            foreach( $places as $place ) {
                ?>
                <div class="flexbox">
                    <h4>
                        <input type="checkbox"
                            id="search_place_<?= $place->term_id; ?>"
                            name="search_place"
                            v-model="place"
                            v-bind:value="<?= $place->term_id; ?>"
                        /><label for="search_place_<?= $place->term_id; ?>"><?= $place->name; ?></label>
                    </h4>
                    <ul>
                        <?php
                        $place_child = get_terms( 'place', array( 'parent' => $place->term_id ) );
                        foreach( $place_child as $child ) {
                            $place_g_child = get_terms( 'place', array( 'parent' => $child->term_id ) );
                            ?>
                            <li class="<?= $place_g_child ? 'g_child' : ''; ?>">
                                <input type="checkbox"
                                    id="search_place_<?= $child->term_id; ?>"
                                    name="search_place"
                                    v-model="place"
                                    v-bind:value="<?= $child->term_id; ?>"
                                /><label for="search_place_<?= $child->term_id; ?>"><?= $child->name; ?></label>
                                <?php if( $place_g_child ) { ?>
                                    <ul>
                                        <?php foreach( $place_g_child as $g_child ) { ?>
                                            <li>
                                                <input type="checkbox"
                                                    id="search_place_<?= $g_child->term_id; ?>"
                                                    name="search_place"
                                                    v-model="place"
                                                    v-bind:value="<?= $g_child->term_id; ?>"
                                                /><label for="search_place_<?= $g_child->term_id; ?>"><?= $g_child->name; ?></label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <div v-show="modalType === 'division'">
            <h2>事業部を指定する</h2>
            <?php // 事業部 --------------------------------------------------------------------------------
            $divisions = get_terms( 'division', array( 'parent' => 0 ) );
            foreach( $divisions as $division ) {
                ?>
                <div class="flexbox">
                    <h4>
                        <input
                            type="checkbox"
                            id="search_division_<?= $division->term_id; ?>"
                            name="search_division"
                            v-model="division"
                            v-bind:value="<?= $division->term_id; ?>"
                        /><label for="search_division_<?= $division->term_id; ?>"><?= $division->name; ?></label>
                    </h4>
                    <ul>
                        <?php
                        $division_child = get_terms( 'division', array( 'parent' => $division->term_id ) );
                        foreach( $division_child as $child ) {
                            ?>
                            <li>
                                <input
                                    type="checkbox"
                                    id="search_division_<?= $child->term_id; ?>"
                                    name="search_division"
                                    v-model="division"
                                    v-bind:value="<?= $child->term_id; ?>"
                                /><label for="search_division_<?= $child->term_id; ?>"><?= $child->name; ?></label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <div v-show="modalType === 'occupation'">
            <h2>職種を指定する</h2>
            <?php // 職種 --------------------------------------------------------------------------------
            $occupations = get_terms( 'occupation', array( 'parent' => 0 ) );
            foreach( $occupations as $occupation ) {
                ?>
                <div class="flexbox">
                    <h4>
                        <input type="checkbox"
                            id="search_occupation_<?= $occupation->term_id; ?>"
                            name="search_occupation"
                            v-model="occupation"
                            v-bind:value="<?= $occupation->term_id; ?>"
                        /><label for="search_occupation_<?= $occupation->term_id; ?>"><?= $occupation->name; ?></label>
                    </h4>
                    <ul>
                        <?php
                        $occupation_child = get_terms( 'occupation', array( 'parent' => $occupation->term_id ) );
                        foreach( $occupation_child as $child ) {
                            ?>
                            <li>
                                <input type="checkbox"
                                    id="search_occupation_<?= $child->term_id; ?>"
                                    name="search_occupation"
                                    v-model="occupation"
                                    v-bind:value="<?= $child->term_id; ?>"
                                /><label for="search_occupation_<?= $child->term_id; ?>"><?= $child->name; ?></label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <div v-show="modalType === 'feature'">
            <h2>こだわりを指定する</h2>
            <?php // こだわり --------------------------------------------------------------------------------
            $features = get_terms('feature', array('parent' => 0));
            foreach( $features as $feature ) {
                ?>
                <div class="flexbox">
                    <h4><?= $feature->name; ?></h4>
                    <ul>
                        <?php
                        $feature_child = get_terms('feature', array('parent' => $feature->term_id));
                        foreach( $feature_child as $f_child ) {
                            ?>
                            <li>
                                <input type="checkbox"
                                    id="search_feature_<?= $f_child->term_id; ?>"
                                    name="search_feature"
                                    v-model="feature"
                                    v-bind:value="<?= $f_child->term_id; ?>"
                                /><label for="search_feature_<?= $f_child->term_id; ?>"><?= $f_child->name; ?></label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>