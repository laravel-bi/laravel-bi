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

    </div>
</template>

<script>
import moment from "moment";
import EventBus from "../utils/EventBus.js";

export default {
    name: "filters-bar",
    props: {
        filtersConfig: Array,
        dashboardKey: null
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
        setTimeout(() => {
            EventBus.$emit("filters-confirmed", this.filters);
        }, 500);
    }
};
</script>