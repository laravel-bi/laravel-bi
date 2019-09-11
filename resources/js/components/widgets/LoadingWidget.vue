<template>
    <div
        class="relative"
        :class="{ 'cursor-wait' : internalLoading }"
    >
        <div class="p-2 text-sm flex">
            <div class="flex-grow">
                <span class="font-bold">{{ widgetName }}</span>
            </div>
            <div v-if="!internalLoading">
                <i
                    class="fas fa-sync cursor-pointer text-gray-600 hover:text-primary"
                    @click="refresh"
                ></i>
                <i
                    class="fas fa-download cursor-pointer text-gray-600 ml-2 hover:text-primary"
                    @click="download"
                ></i>
            </div>
        </div>
        <div :class="widgetClass">
            <bi-loader
                v-if="internalLoading"
                class="absolute"
                style="top: 50%; right: 50%; margin-top: -22px; margin-left: -22px"
            >
            </bi-loader>
            <div v-if="!internalLoading">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "loading-widget",
    props: {
        dashboardKey: String,
        widgetKey: String,
        widgetName: String,
        loading: Boolean,
        widgetClass: String
    },
    data() {
        return {
            internalLoading: false
        };
    },
    mounted() {
        this.internalLoading = this.loading;
    },
    watch: {
        loading: function(loading) {
            this.internalLoading = loading;
        }
    },
    methods: {
        refresh() {
            this.$emit("refresh");
        },
        download() {
            window.open(`bi-apis/${this.dashboardKey}/widgets/${this.widgetKey}/csv`);
        }
    }
};
</script>