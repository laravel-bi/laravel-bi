<script>
import api from "../mixins/api.js";
import toasts from "../mixins/toasts.js";

// import LoadingWidget from "./LoadingWidget";

export default {
    abstract: true,
    mixins: [api, toasts],
    components: {
        // "loading-widget": LoadingWidget
    },
    props: {
        dashboardKey: String,
        widgetKey: String,
        widgetName: String,
        metrics: Array,
        dimensions: Array,
        filters: Object,
        filtersFlag: Number,
        refreshFlag: Number
    },
    data() {
        return {
            loading: false
        };
    },
    watch: {
        filtersFlag() {
            this.fetchData();
        },
        refreshFlag() {
            this.fetchData();
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchParams() {
            return {
                filters: this.fetchFiltersParam()
            }
        },
        fetchData() {
            this.loading = true;
            const startTime = new Date().getTime();
            this.api(`${this.dashboardKey}/widgets/${this.widgetKey}`, this.fetchParams()).then(response => {
                const endTime = new Date().getTime();
                const diffTime = endTime - startTime;
                if (diffTime > 2000) {
                    this.onFetchData(response);
                    this.loading = false;
                } else {
                    setTimeout(() => {
                        this.onFetchData(response);
                        this.loading = false;
                    }, 2000 - diffTime);
                }
            });
        },
        fetchFiltersParam() {
            return Object.keys(this.filters).reduce((carry, key) => {
                if (this.filters[key]) {
                    carry[key] = this.filters[key];
                }
                return carry;
            }, {});
        }
    }
};
</script>