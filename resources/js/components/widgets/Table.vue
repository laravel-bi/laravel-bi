<template>
    <div class="overflow-auto bi:table-container">
        <div class="bg-gray-300 flex relative h-full" v-if="loading">
            <bi-loader class="absolute bi:loader"></bi-loader>
        </div>

        <table class="w-full" v-if="!loading">
            <tr class="bg-gray-300">
                <th
                    class="uppercase text-xs text-gray-900 text-left p-2 cursor-pointer hover:text-gray-700"
                    v-for="dimension in dimensions"
                    :key="'table-' + widgetKey + '-dimension-' + dimension.key"
                    @click="changeSort(dimension.key)"
                >
                    {{ dimension.name }}
                    <span
                        class="text-gray-900 hover:text-gray-700"
                        v-if="sort.col == dimension.key && sort.dir == 'desc'"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            class="w-3 inline fill-current"
                        >
                            <path
                                class="heroicon-ui"
                                d="M13 5.41V21a1 1 0 0 1-2 0V5.41l-5.3 5.3a1 1 0 1 1-1.4-1.42l7-7a1 1 0 0 1 1.4 0l7 7a1 1 0 1 1-1.4 1.42L13 5.4z"
                            />
                        </svg>
                    </span>

                    <span
                        class="text-gray-900 hover:text-gray-700"
                        v-if="sort.col == dimension.key && sort.dir == 'asc'"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            class="w-3 inline fill-current"
                        >
                            <path
                                class="heroicon-ui"
                                d="M11 18.59V3a1 1 0 0 1 2 0v15.59l5.3-5.3a1 1 0 0 1 1.4 1.42l-7 7a1 1 0 0 1-1.4 0l-7-7a1 1 0 0 1 1.4-1.42l5.3 5.3z"
                            />
                        </svg>
                    </span>
                </th>
                <th
                    class="uppercase text-xs text-gray-900 text-left p-2 cursor-pointer hover:text-gray-700"
                    v-for="metric in metrics"
                    :key="'table-' + widgetKey + '-metric-' + metric.key"
                    @click="changeSort(metric.key)"
                >
                    {{ metric.name }}
                    <span
                        class="text-gray-900 hover:text-gray-700"
                        v-if="sort.col == metric.key && sort.dir == 'desc'"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            class="w-3 inline fill-current"
                        >
                            <path
                                class="heroicon-ui"
                                d="M13 5.41V21a1 1 0 0 1-2 0V5.41l-5.3 5.3a1 1 0 1 1-1.4-1.42l7-7a1 1 0 0 1 1.4 0l7 7a1 1 0 1 1-1.4 1.42L13 5.4z"
                            />
                        </svg>
                    </span>

                    <span
                        class="text-gray-900 hover:text-gray-700"
                        v-if="sort.col == metric.key && sort.dir == 'asc'"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            class="w-3 inline fill-current"
                        >
                            <path
                                class="heroicon-ui"
                                d="M11 18.59V3a1 1 0 0 1 2 0v15.59l5.3-5.3a1 1 0 0 1 1.4 1.42l-7 7a1 1 0 0 1-1.4 0l-7-7a1 1 0 0 1 1.4-1.42l5.3 5.3z"
                            />
                        </svg>
                    </span>
                </th>
            </tr>
            <tr
                class="border border-r-0"
                v-for="(row, i) in data"
                :key="'table-' + widgetKey + '-' + i"
            >
                <td
                    class="p-2"
                    v-for="dimension in dimensions"
                    :key="'table-' + widgetKey + '-dimension-col-' + dimension.key"
                >{{ row[dimension.key]}}</td>
                <td
                    class="p-2"
                    v-for="metric in metrics"
                    :key="'table-' + widgetKey + '-metric-col-' + metric.key"
                >{{ row[metric.key]}}</td>
            </tr>
        </table>
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
        this.sort.col = this.dimensions[0].key;
        if(this.extra && this.extra.orderBy) {
            this.sort.col = this.extra.orderBy.col;
            this.sort.dir = this.extra.orderBy.dir;
        }
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