<template>
    <div
        class="relative"
        :class="{ 'cursor-wait' : internalLoading }"
    >
        <div class="flex p-16">
            <div class="flex-grow">
                <p class="text-16">{{ widgetName }}</p>
            </div>
            <div v-if="!internalLoading">
                <i
                    class="fas fa-sync cursor-pointer text-14 text-icon"
                    @click="refresh"
                ></i>
                <i
                    class="fas fa-download cursor-pointer ml-4 text-14 text-icon"
                    @click="download"
                ></i>
            </div>
        </div>
        <div :class="widgetClass" class="border-t border-widget-border pt-8 relative">
            <bi-loader
                v-if="internalLoading"
                class="absolute"
                style="top: 50%; right: 50%; margin-top: -22px; margin-right: -22px"
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
            window.open(`/${window.bi.base}-apis/${this.dashboardKey}/widgets/${this.widgetKey}/csv`);
        }
    }
};
</script>