<template>
    <div>
        <bi-filters
            v-if="filtersConfig.length"
            :filtersConfig="filtersConfig"
            :dashboardKey="dashboardKey"
        ></bi-filters>
        <div class="p-4">
            <div class="flex flex-wrap -mr-2 -ml-2">
                <div
                    :class="'w-' + widget.width"
                    v-for="widget in widgets"
                    :key="widget.key"
                >
                    <div class="m-2 bg-white shadow">
                        <component
                            :is="'bi-' + widget.component"
                            :dashboardKey="dashboardKey"
                            :widgetKey="widget.key"
                            :widgetName="widget.name"
                            :extra="widget.extra"
                            :filters="filters"
                            :filters-flag="filtersFlag"
                        ></component>
                    </div>
                </div>
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