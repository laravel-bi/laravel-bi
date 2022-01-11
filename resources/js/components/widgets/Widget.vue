<script>
import api from "../mixins/api.js";
import toasts from "../mixins/toasts.js";

import EventBus from "../../utils/EventBus.js";

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
        refreshFlag: Number,
        downloadFlag: Number,
        extra: Object
    },
    data() {
        return {
            loading: false,
            filters: {}
        };
    },
    watch: {
        refreshFlag() {
            this.fetchData();
        },
        downloadFlag() {
            this.downloadData();
        }
    },
    mounted() {
        EventBus.$on("filters-confirmed", this.onFilters);
    },
    destroyed() {
        EventBus.$off("filters-confirmed", this.onFilters);
    },
    methods: {
        onFilters(filters) {
            this.filters = filters;
            this.fetchData();
        },
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
        downloadData() {
            document.location = `/${window.bi.base}-apis/${this.dashboardKey}/widgets/${this.widgetKey}/csv?` + this.serialize(this.fetchParams());
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