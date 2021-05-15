window.addEventListener('load', () => {
    document.getElementById('overlay').classList.add('active')
})

const formatDate = (date, format) => {
    date = new Date(date);
    if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
    format = format.replace(/YYYY/g, date.getFullYear());
    format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
    format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
    format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
    format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
    format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
    if (format.match(/S/g)) {
        var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
        var length = format.match(/S/g).length;
        for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
    }
    return format;
};


var app = new Vue({
    el: "#offers",
    data: {
        posts: [],
        params: {
            posts_per_page: 12,
            page: 1,
            order: 'new',
        },
        count: 0,
        pages: [],
        showModal: false,
        modalType: '',
        showForm: false,
        taxonomies: [],
        occupation: [],
        division: [],
        place: [],
        feature: [],
        treatment: [],
        salary_unit: '0',
        salary: '',
        keyword: '',
        searches: {
            occupation: [],
            division: [],
            place: [],
            feature: [],
            treatment: [],
            salary: '',
            salary_unit: '',
            keyword: '',
        }
    },
    methods: {
        openModal(type) {
            this.showModal = true
            this.modalType = type
        },
        closeModal() {
            this.showModal = false
        },
        toggleForm() {
            this.showForm = !this.showForm
        },
        getPosts() {
            var _this = this
            let params = this.params

            axios.get("/wp-json/custom/v0/offer", { params }).then( ( response ) => {
                _this.posts = []
                response.data.forEach((elm) => {
                    var data = {
                        title: elm.title,
                        link: elm.link,
                        date_full: elm.modified_date,
                        date: formatDate( elm.modified_date, 'YYYY.MM.DD' ),
                        thumb: elm.thumb,
                        comment: elm.offer_comment,
                        views: elm.post_views_count,
                        place: elm.place,
                        division: elm.division,
                        division_name: elm.division_name,
                        // treatment: elm.treatment_status,
                    }
                    _this.posts.push(data)
                })
            })
            .catch((error) => {
                console.log("記事が取得できません：" + error)
            })
        },
        getTaxonomies() {
            let _this = this

            axios.get("/wp-json/custom/v0/taxonomies").then( ( response ) => {
                _this.taxonomies = []
                response.data.forEach((elm) => {
                    var data = {
                        id: elm.id,
                        name: elm.name,
                    }
                    _this.taxonomies.push(data)
                })
            })
            .catch((error) => {
                console.log("カテゴリーが取得できません：" + error)
            })
        },
        setPages () {
            var _this = this
            let params = this.params

            axios.get("/wp-json/custom/v0/count", { params }).then( ( response ) => {
                _this.count = response.data
            })
            .catch((error) => {
                console.log("記事が取得できません：" + error)
            })

            let numberOfPages = Math.ceil(this.count / this.params.posts_per_page)
            this.pages = []
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index)
            }

            return this.getPosts()
        },
        changeOrder(val){
            const sortEl = document.querySelector('.switch-list__order');
            // let sortClass = val == -1 ? 'new' : val == 1 ? 'old' : 'views';
            sortEl.classList.remove('new', 'old', 'views');
            sortEl.classList.add(val);

            this.params.order = val
            this.params.page = 1

            localStorage.params = JSON.stringify(this.params)

            return this.getPosts()
        },
        search() {
            const form = document.searchForm;

            this.params.page = 1

            // treatment
            this.params.treatment_status = [];
            if(form.search_treatment) {
                form.search_treatment.forEach( el => {
                    if(el.checked) this.params.treatment_status.push(el.value);
                })
            }

            // salary
            if(form.search_salary_unit) {
                form.search_salary_unit.forEach( el => {
                    if(el.selected) this.params.salary_unit = el.value;
                })
            }
            if(form.search_salary) {
                form.search_salary.forEach( el => {
                    if(el.selected) this.params.salary = el.value;
                })
            }

            // place
            this.params.place = []
            if( this.place ) this.params.place = this.place

            // division
            this.params.division = []
            if( this.division ) this.params.division = this.division

            // occupation
            this.params.occupation = []
            if( this.occupation ) this.params.occupation = this.occupation

            // feature
            this.params.feature = []
            if( this.feature ) this.params.feature = this.feature

            // treatment
            this.params.treatment_status = []
            if( this.treatment ) this.params.treatment_status = this.treatment

            // salary
            this.params.salary_unit = []
            if( this.salary_unit ) this.params.salary_unit = this.salary_unit

            this.params.salary = []
            if( this.salary ) this.params.salary = this.salary

            // keyword
            this.params.keyword = ''
            if( this.keyword ) this.params.keyword = this.keyword

            localStorage.params = JSON.stringify(this.params)

            return this.getPosts();
        },
        checkValue(val) {
            return true
        },
        searchCategory(cat) {
            this.params = {
                posts_per_page: 12,
                page: 1,
                order: 'new',
                division: [Number(cat)],
            }

            localStorage.params = JSON.stringify(this.params)

            window.location.href = '/offer/#sort'
        }
    },
    computed: {
        sortOccupation() {
            return (this.taxonomies || []).filter( tax => {
                return this.occupation.some( _occupation => Number(_occupation) === Number(tax.id) )
            })
        },
        sortDivision() {
            return (this.taxonomies || []).filter( tax => {
                return this.division.some( _division => Number(_division) === Number(tax.id) )
            })
        },
        sortPlace() {
            return (this.taxonomies || []).filter( tax => {
                return this.place.some( _place => Number(_place) === Number(tax.id) )
            })
        },
        sortFeature() {
            return (this.taxonomies || []).filter( tax => {
                return this.feature.some( _feature => Number(_feature) === Number(tax.id) )
            })
        }
    },
    watch: {
        posts () {
            this.debouncedSetPages()
        },
        params: function(newParams, oldParams) {
            this.debouncedSetPages()
        },
    },
    created: function() {
        this.params = JSON.parse(localStorage.params)

        this.debouncedSetPages = _.debounce(this.setPages, 500)
        this.taxonomies = this.getTaxonomies()

        this.occupation = this.params.occupation ? this.params.occupation : []
        this.division = this.params.division ? this.params.division : []
        this.place = this.params.place ? this.params.place : []
        this.feature = this.params.feature ? this.params.feature : []
        this.treatment = this.params.treatment_status ? this.params.treatment_status : []
        this.salary_unit = this.params.salary_unit
        this.salary = this.params.salary
        this.keyword = this.params.keyword

        this.searches.occupation = this.params.occupation ? this.params.occupation : []
        this.searches.division = this.params.division ? this.params.division : []
        this.searches.place = this.params.place ? this.params.place : []
        this.searches.feature = this.params.feature ? this.params.feature : []
        this.searches.treatment = this.params.treatment_status ? this.params.treatment_status : []
        this.searches.salary_unit = this.params.salary_unit
        this.searches.salary = this.params.salary
        this.searches.keyword = this.params.keyword
    },
    filters: {
        trimWords(value){
            return value.split(" ").splice(0,20).join(" ") + '...';
        }
    }
});
