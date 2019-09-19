<template>
    <div>
        <loading-widget
            :loading="loading"
            :dashboardKey="dashboardKey"
            :widgetKey="widgetKey"
            :widgetName="widgetName"
            @refresh="fetchData"
            widgetClass="h-widget-sm"
        >
            <div class="text-big-number font-condensed text-center" :style="style">{{ number }}</div>
        </loading-widget>
    </div>
</template>

<script>
import Widget from "./Widget.vue";

export default {
    name: "bi-big-number",
    extends: Widget,
    data() {
        return {
            number: ""
        };
    },
    computed: {
        style() {
            return {
                'color': this.extra.metric.color
            }
        }
    },
    methods: {
        onFetchData(response) {
            this.number = response.data.data[this.extra.metric.key];
        }
    }
};
</script>