import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

import NavBar from "./components/NavBar.vue";
import Dashboard from "./components/Dashboard.vue";
import WidgetPanel from "./components/WidgetPanel.vue";
// import Toast from "./components/Toast.vue";
import Loader from "./components/Loader.vue";
import FiltersBar from "./components/FiltersBar.vue";

import BigNumber from "./components/widgets/BigNumber.vue";
import Table from "./components/widgets/Table.vue";
import PartitionPie from "./components/widgets/PartitionPie.vue";
import LineChart from "./components/widgets/LineChart.vue";

import FilterAnchor from "./components/filters/FilterAnchor.vue";
import FilterDropdown from "./components/filters/FilterDropdown.vue";
import FilterDate from "./components/filters/Date.vue";
import FilterDateInterval from "./components/filters/DateInterval.vue";
import FilterString from "./components/filters/String.vue";
import FilterNumber from "./components/filters/Number.vue";
import FilterBelongsTo from "./components/filters/BelongsTo.vue";

import VCalendar from "v-calendar";

Vue.component("bi-nav-bar", NavBar);
Vue.component("bi-dashboard", Dashboard);
Vue.component("bi-widget-panel", WidgetPanel);
// Vue.component("bi-toast", Toast);
Vue.component("bi-loader", Loader);
Vue.component("bi-filters-bar", FiltersBar);

Vue.component("bi-big-number", BigNumber);
Vue.component("bi-table", Table);
Vue.component("bi-partition-pie", PartitionPie);
Vue.component("bi-line-chart", LineChart);

Vue.component("bi-filter-anchor", FilterAnchor);
Vue.component("bi-filter-dropdown", FilterDropdown);
Vue.component("bi-filter-date", FilterDate);
Vue.component("bi-filter-date-interval", FilterDateInterval);
Vue.component("bi-filter-string", FilterString);
Vue.component("bi-filter-number", FilterNumber);
Vue.component("bi-filter-belongs-to", FilterBelongsTo);

import "v-calendar/lib/v-calendar.min.css";

const router = new Router({
    base: window.bi.base,
    mode: "history",
    routes: [
        {
            name: "homepage",
            path: "/",
            redirect: "/ceg"
        },
        {
            name: "dashboard",
            path: "/:dashboardKey",
            component: Dashboard,
            props: route => {
                return {
                    dashboardKey: route.params.dashboardKey
                };
            }
        }
    ]
});

Vue.use(VCalendar, {
    firstDayOfWeek: 2
});

import EventBus from "./utils/EventBus.js";

new Vue({
    el: "#laravel-bi",
    router,
    data: {
        nav: false,
        toast: null
    },
    watch: {
        $route() {
            this.nav = false;
        }
    },
    mounted() {
        EventBus.$on('toast', toast => {
            this.toast = toast;
            setTimeout(() => {
                this.toast = null;
            }, 5000);
        });
    }
});
