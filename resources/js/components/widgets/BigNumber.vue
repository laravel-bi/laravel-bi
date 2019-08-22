<template>
    <div>
        <div class="bg-gray-800 text-white p-2 text-sm">
            {{ widgetName }}
        </div>
        <div class="p-4">
            <div class="text-xl">{{ number }}</div>
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
        meta: Object
    },
    data() {
        return {
            number: ''
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.api(`${this.dashboardKey}/${this.widgetKey}`).then((response) => {
                this.number = response.data.data[this.meta.metric.key];
            });
        }
    }
};
</script>