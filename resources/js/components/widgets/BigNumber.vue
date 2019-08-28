<template>
    <div>
        <div class="p-2 text-sm">
            {{ widgetName }}
        </div>
        <div class="p-2 pt-0">
            <div class="text-big-number text-green-900 font-condensed">{{ number }}</div>
        </div>
    </div>
</template>

<script>
import api from "../mixins/api.js";
import toasts from "../mixins/toasts.js";

export default {
    name: "bi-big-number",
    mixins: [
        api,
        toasts
    ],
    props: {
        dashboardKey: String,
        widgetKey: String,
        widgetName: String,
        extra: Object,
        filters: Object
    },
    data() {
        return {
            number: ''
        };
    },
    watch: {
        filters() {
            this.fetchData()
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.api(`${this.dashboardKey}/${this.widgetKey}`).then((response) => {                
                this.number = response.data.data[this.extra.metric.key];
            });
        }
    }
};
</script>