<template>
    <div class="bg-white text-right text-gray-600 text-xs p-2 shadow relative">

        <span
            v-for="filter in filtersConfig"
            v-bind:key="filter.key"
        >

            <component
                :is="'bi-filter-' + filter.component"
                :ref="'filter-' + filter.key"
                v-model="filters[filter.key]"
                :filter-config="filter"
                :dashboardKey="dashboardKey"
                @activated="closeOthers"
            ></component>

        </span>

    </div>
</template>

<script>
import moment from "moment";
import EventBus from "../utils/EventBus.js";

export default {
    name: "filters",
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
            carry[filterConfig.key] = null;
            return carry;
        }, {});
        this.filtersConfig.forEach(filterConfig => {
            this.$watch("filters." + filterConfig.key, () => {
                EventBus.$emit("filters-confirmed", this.filters);
            });
        });
    },
    methods: {
        closeOthers(filterKey) {
            Object.keys(this.$refs).filter(filter => {
                return filter != `filter-${filterKey}`;
            }).forEach(filter => {
                this.$refs[filter][0].active = false;
            });
        }
    }
};
</script>