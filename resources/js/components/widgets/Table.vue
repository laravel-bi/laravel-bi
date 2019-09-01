<template>
    <div>
        <loading-widget
            :loading="loading"
            :widgetName="widgetName"
            @refresh="fetchData"
            widgetClass="overflow-auto h-widget-lg"
        >
            <div class="py-4">
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <th
                            v-for="dimension in extra.dimensions"
                            :key="dimension.key"
                            class="text-left p-1 py-2 uppercase text-gray-600 text-xs"
                        >{{ dimension.name }}</th>
                        <th
                            v-for="metric in extra.metrics"
                            :key="metric.key"
                            class="text-left p-1 py-2 uppercase text-gray-600 text-xs"
                        >{{ metric.name }}</th>
                    </tr>
                    <tbody>
                        <tr
                            v-for="(row, i) in data"
                            :key="i"
                            class="border-b last:border-b-0 hover:bg-gray-100"
                        >
                            <td
                                v-for="dimension in extra.dimensions"
                                :key="dimension.key"
                                class="p-1"
                            >
                                {{ row[dimension.key] }}
                            </td>
                            <td
                                v-for="metric in extra.metrics"
                                :key="metric.key"
                                class="p-1"
                            >
                                {{ row[metric.key] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </loading-widget>
    </div>
</template>

<script>
import Widget from "./Widget.vue";

export default {
    name: "bi-table",
    extends: Widget,
    data() {
        return {
            data: [],
            loading: true
        };
    },
    methods: {
        onFetchData(response) {
            this.data = response.data.data;
        }
    }
};
</script>