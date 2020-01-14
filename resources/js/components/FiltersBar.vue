<template>
    <div class="bg-white shadow-lg flex" id="filter-bar">
        <div class="uppercase p-4 py-2 text-gray-700 text-sm font-bold">Filters:</div>

            <component
                v-for="filter in filtersConfig"
                v-bind:key="'filter' + filter.key"
                :is="'bi-filter-' + filter.component"
                :ref="'filter-' + filter.key"
                v-model="filters[filter.key]"
                :filter-config="filter"
                :dashboardKey="dashboardKey"
                
            ></component>

        <!-- <div class="text-sm p-4 py-2 ml-auto hover:bg-gray-100 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path
                    class="heroicon-ui"
                    d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"
                />
            </svg>
        </div> -->
    </div>
</template>

<script>
import moment from "moment";
import EventBus from "../utils/EventBus.js";

export default {
    name: "filters-bar",
    props: {
        filtersConfig: Array,
        dashboardKey: null,
        year: false
    },
    data() {
        return {
            filters: {}
        };
    },
    mounted() {
        // create empty property to improve watchers
        this.filters = this.filtersConfig.reduce((carry, filterConfig) => {
            carry[filterConfig.key] = filterConfig.defaultValue;
            return carry;
        }, {});
        this.filtersConfig.forEach(filterConfig => {
            this.$watch(
                "filters." + filterConfig.key,
                () => {
                    EventBus.$emit("filters-confirmed", this.filters);
                },
                {
                    deep: true
                }
            );
        });
    }
};
</script>