<template>
    <div class="flex-grow flex flex-col content-start"
        :key="'dashboard-'+dashboardKey"
        v-if="ready">    

        <bi-filters-bar
            :filtersConfig="filtersConfig"
            :dashboardKey="dashboardKey"
            :key="'filters-bar-'+dashboardKey"
        ></bi-filters-bar>

        <div class="flex-grow flex flex-wrap content-start"
            :key="'widget-wrapper-'+dashboardKey">
            <div
                :class="'w-' + widget.width"
                v-for="widget in widgets"
                :key="'widget-' + widget.key"
            >
                <bi-widget-panel
                    :dashboardKey="dashboardKey"
                    :widget="widget"
                    :key="'widget-'+dashboardKey+'-'+widget.key"
                ></bi-widget-panel>
            </div>

        </div>
    </div>
</template>

<script>
import EventBus from "../utils/EventBus.js";

import api from "./mixins/api.js";
import toasts from "./mixins/toasts.js";

export default {ame: "bi-dashboard",
    mixins: [api, toasts],
    props: {
        dashboardKey: String
    },
    data() {
        return {
            name: null,
            filtersConfig: [],
            widgets: [],
            ready: false
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.api(`${this.dashboardKey}/widgets`).then(response => {
                this.widgets = response.data.data.widgets;
                this.name = response.data.data.name;
                this.filtersConfig = response.data.data.filters;
                this.ready = true;

                EventBus.$emit("dashboard-ready", {
                    name: this.name,
                    key: this.dashboardKey
                });
            });
        }
    }
};
</script>