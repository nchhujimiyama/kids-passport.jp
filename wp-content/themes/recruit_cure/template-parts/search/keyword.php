<div class="search_item" v-show="showForm">
    <h3>キーワード</h3>
    <div>
        <input type="text"
            name="search_keyword"
            v-model="keyword"
            v-bind:value="keyword"
        />
    </div>
</div>