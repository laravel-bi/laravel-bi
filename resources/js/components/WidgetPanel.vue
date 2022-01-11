<template>
    <div class="rounded shadow-lg bg-white m-4 text-sm">
        <div
            class="bg-gray-400 text-white p-2 rounded-t uppercase text-xs text-gray-900 font-bold flex"
        >
            <div class="flex-grow">{{ widget.name }}</div>
            <div>
                <a
                    href="#"
                    class="text-gray-700 outline-none hover:text-gray-900"
                    title="Refresh data"
                    @click.prevent="refresh"
                >
                    <svg
                        class="w-5 fill-current inline"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M6 17.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"
                        />
                    </svg>
                </a>
                <a
                    href="#"
                    class="text-gray-700 outline-none hover:text-gray-900"
                    title="Download CSV"
                    @click.prevent="download"
                >
                    <svg
                        class="w-5 fill-current inline"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"
                        />
                    </svg>
                </a>
            </div>
        </div>

        <component
            :is="'bi-' + widget.component"
            :dashboardKey="dashboardKey"
            :widgetKey="widget.key"
            :widgetName="widget.name"
            :dimensions="widget.dimensions"
            :extra="widget.extra"
            :metrics="widget.metrics"
            :refresh-flag="refreshFlag"
            :download-flag="downloadFlag"
        ></component>
    </div>
</template>

<script>
export default {
    props: {
        dashboardKey: String,
        widget: Object
    },
    data() {
        return {
            refreshFlag: 0,
            downloadFlag: 0
        };
    },
    methods: {
        refresh() {
            this.refreshFlag++;
        },
        download() {
            this.downloadFlag++;
        }
    }
};
</script>