<template>
    <div>
        <h3 class="text-xl border-gray-800 border-b-4">{{ name }}</h3>
        <div class="flex flex-wrap -mr-2 -ml-2">
            <div 
                :class="'w-' + widget.width"
                v-for="widget in widgets" 
                :key="widget.key">
                <div class="m-2 bg-white shadow">
                    <component 
                        :is="'bi-' + widget.component" 
                        :dashboardKey="dashboardKey"
                        :widgetKey="widget.key"
                        :widgetName="widget.name"
                        :extra="widget.extra"
                    ></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "./mixins/api.js";
import toasts from "./mixins/toasts.js";

export default {
    name: "bi-dashboard",
    mixins: [api, toasts],
    props: {
        dashboardKey: String
    },
    data() {
        return {
            name: '',
            widgets: []
        }
    },
    watch: {
        $route: "fetchData"
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.api(`${this.dashboardKey}/widgets`).then((response) => {
                this.widgets = response.data.data.widgets;
                this.name = response.data.data.name;
            });
            return true;
        }
    }
};
</script>