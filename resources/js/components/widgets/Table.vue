<template>
    <div>
        <loading-widget
            :loading="loading"
            :dashboardKey="dashboardKey"
            :widgetKey="widgetKey"
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
                            class="text-left p-1 py-2 uppercase text-gray-600 text-xs cursor-pointer bg-gray-200 border-t"
                            @click="changeSort(dimension.key)"
                        >{{ dimension.name }}
                            <i
                                v-if="sort.col == dimension.key && sort.dir == 'asc'"
                                class="fas fa-sort-up"
                            ></i>
                            <i
                                v-if="sort.col == dimension.key && sort.dir == 'desc'"
                                class="fas fa-sort-down"
                            ></i>
                        </th>
                        <th
                            v-for="metric in extra.metrics"
                            :key="metric.key"
                            class="text-left p-1 py-2 uppercase text-gray-600 text-xs cursor-pointer bg-gray-200 border-t"
                            @click="changeSort(metric.key)"
                        >{{ metric.name }}
                            <i
                                v-if="sort.col == metric.key && sort.dir == 'asc'"
                                class="fas fa-sort-up"
                            ></i>
                            <i
                                v-if="sort.col == metric.key && sort.dir == 'desc'"
                                class="fas fa-sort-down"
                            ></i>
                        </th>
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
            sort: {
                col: null,
                dir: "asc"
            }
        };
    },
    mounted() {
        this.sort.col = this.extra.dimensions[0].key;
    },
    methods: {
        fetchParams() {
            return {
                filters: this.fetchFiltersParam(),
                sort: this.sort
            };
        },
        onFetchData(response) {
            this.data = response.data.data;
        },
        changeSort(key) {
            if (this.sort.col == key) {
                this.sort.dir = this.sort.dir == "asc" ? "desc" : "asc";
            } else {
                this.sort.col = key;
                this.sort.dir = "asc";
            }
            this.fetchData();
        }
    }
};
</script>