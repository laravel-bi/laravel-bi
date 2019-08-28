<template>
    <div class="bg-white text-right text-gray-600 text-xs p-2 shadow relative">

        <a
            href="#"
            class="mr-4 p-2 outline-none"
            :class="{
                'bg-gray-500 text-white' : activeFilter == 'dates',
                'hover:bg-gray-200 hover:text-gray-600' : activeFilter != 'dates',
            }"
            @click="setActiveFilter('dates')"
        >
            <i class="fas fa-calendar"></i>
            <span v-if="filters.dates == null">
                Select a date interval
            </span>
            <span v-else>
                Date interval: {{ startDate }} - {{ endDate }}
            </span>
        </a>

        <a href="#">
            <i class="fas fa-calendar text-gray-600"></i>
            Select a blog
        </a>

        <div v-if="activeFilter == 'dates'">
            <div class="absolute top-0 right-0 bg-white mt-10 p-4 shadow">
                <div class=mb-2>
                    <v-date-picker
                        mode='range'
                        v-model="filters.dates"
                        is-inline
                    ></v-date-picker>
                </div>

                <div class="flex">
                    <button
                        @click="resetFilter('dates')"
                        class="bg-gray-200 p-4 py-2 text-gray-800 rounded mr-2"
                    >Reset</button>
                    <button
                        @click="confirmFilters"
                        class="bg-indigo-600 p-4 py-2 text-white rounded"
                    >Apply</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import moment from "moment";
import EventBus from "../utils/EventBus.js";

export default {
    name: "filters",
    data() {
        return {
            activeFilter: null,
            filters: {
                dates: null
            }
        };
    },
    computed: {
        startDate() {
            if (this.filters.dates == null) {
                return null;
            }
            return moment(new Date(this.filters.dates.start)).format(
                "YYYY-MM-DD"
            );
        },
        endDate() {
            if (this.filters.dates == null) {
                return null;
            }
            return moment(new Date(this.filters.dates.end)).format(
                "YYYY-MM-DD"
            );
        }
    },
    methods: {
        setActiveFilter(filter) {
            this.activeFilter = filter;
        },
        resetFilter(filter) {
            this.setActiveFilter(null);
            this.filters[filter] = null;
        },
        confirmFilters() {
            this.setActiveFilter(null);
            EventBus.$emit("filters-confirmed", this.filters);
        }
    }
};
</script>