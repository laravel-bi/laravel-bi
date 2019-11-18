<template>
    <div class="flex-grow flex flex-col">    

        <bi-filters-bar
            v-if="filtersConfig.length"
            :filtersConfig="filtersConfig"
            :dashboardKey="dashboardKey"
        ></bi-filters-bar>

        <div class="flex-grow flex flex-wrap">
            <div
                :class="'w-' + widget.width"
                v-for="widget in widgets"
                :key="'widget-' + widget.key"
            >
                <bi-widget-panel
                    :dashboardKey="dashboardKey"
                    :widget="widget"
                    :filters="filters"
                    :filters-flag="filtersFlag"
                ></bi-widget-panel>
            </div>

        </div>
    </div>
</template>

<script>
import EventBus from "../utils/EventBus.js";

import api from "./mixins/api.js";
import toasts from "./mixins/toasts.js";

export default {
    name: "bi-dashboard",
    mixins: [api, toasts],
    props: {
        dashboardKey: String,
        filters: Object,
        filtersFlag: Number
    },
    data() {
        return {
            name: "",
            filtersConfig: [],
            widgets: []
        };
    },
    watch: {
        $route: "fetchData"
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.api(`${this.dashboardKey}/widgets`).then(response => {
                this.widgets = response.data.data.widgets;
                this.name = response.data.data.name;
                this.filtersConfig = response.data.data.filters;
                EventBus.$emit("dashboard-ready", {
                    name: this.name
                });
            });
        }
    }
};
</script>