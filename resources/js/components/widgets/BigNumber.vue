<template>
    <div>
        <loading-widget
            :loading="loading"
            :widgetName="widgetName"
            @refresh="fetchData"
            widgetClass="h-widget-sm"
        >
            <div class="p-2 pt-0">
                <div class="text-big-number text-green-900 font-condensed">{{ number }}</div>
            </div>
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
    methods: {
        onFetchData(response) {
            this.number = response.data.data[this.extra.metric.key];
        }
    }
};
</script>