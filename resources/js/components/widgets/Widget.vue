<script>
import api from "../mixins/api.js";
import toasts from "../mixins/toasts.js";

import LoadingWidget from "./LoadingWidget";

export default {
    abstract: true,
    mixins: [api, toasts],
    components: {
        "loading-widget": LoadingWidget
    },
    props: {
        dashboardKey: String,
        widgetKey: String,
        widgetName: String,
        extra: Object,
        filters: Object,
        filtersFlag: Number
    },
    data() {
        return {
            loading: false
        };
    },
    watch: {
        filtersFlag() {
            this.fetchData();
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            const startTime = new Date().getTime();
            this.api(`${this.dashboardKey}/widgets/${this.widgetKey}`, {
                filters: this.getRequestFilters()
            }).then(response => {
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
        getRequestFilters() {
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