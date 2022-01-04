<template>
    <div class="h-widget-sm">
        <div class="bg-gray-300 flex relative h-full" v-if="loading">
            <bi-loader class="absolute bi:loader"></bi-loader>
        </div>

        <div class="flex h-full" v-if="!loading">
            <div
                class="text-5xl font-bold font-condensed flex-grow text-center self-center"
                :style="style"
            >{{ number }}</div>
        </div>
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
                color: this.metrics[0].color
            };
        }
    },
    methods: {
        onFetchData(response) {
            this.number = response.data.data[0][this.metrics[0].key];
        }
    }
};
</script>