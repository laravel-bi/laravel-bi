<template>
    <div class="bg-white text-right text-gray-600 text-xs p-2 shadow relative">

        <div
            v-for="filter in filtersConfig"
            v-bind:key="filter.key"
        >

            <component
                :is="'bi-filter-' + filter.component"
                v-model="filters[filter.key]"
            ></component>

        </div>

        <!-- <a href="#">
            <i class="fas fa-calendar text-gray-600"></i>
            Select a blog
        </a> -->

        <div v-if="activeFilter == 'published_at'">

        </div>

    </div>
</template>

<script>
import moment from "moment";
import EventBus from "../utils/EventBus.js";

export default {
    name: "filters",
    props: {
        filtersConfig: Array
    },
    data() {
        return {
            activeFilter: null,
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
    }
};
</script>