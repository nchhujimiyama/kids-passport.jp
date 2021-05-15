<div class="search_item" v-show="showForm">
    <h3>こだわり</h3>
    <dl>
        <dt>
            <a class="term_btn" href="javascript:void(0)" @click="openModal('feature')">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                <span>こだわりを選択する</span>
            </a>
        </dt>
        <dd>
            <div v-if="sortFeature.length === 0">指定しない</div>
            <div v-else class="tags">
                <span v-for="f in sortFeature">{{ f.name }}</span>
            </div>
        </dd>
    </dl>
</div>