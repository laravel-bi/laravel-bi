<template>

    <div class="inline-block relative mr-4">
        <a
            href="#"
            class="p-2 outline-none"
            :class="{
                'bg-gray-500 text-white' : active,
                'hover:bg-gray-200 hover:text-gray-600' : !active,
            }"
            @click="active = true"
        >
            <i class="fas fa-calendar"></i>
            <span v-if="internalValue == null">
                Select a date interval
            </span>
            <span v-else>
                Date interval: {{ startDate }} - {{ endDate }}
            </span>
        </a>

        <div
            class="absolute top-0 right-0 bg-white mt-8 p-4 shadow z-10"
            v-if="active"
        >
            <div class=mb-2>
                <v-date-picker
                    is-expanded
                    :show-day-popover="false"
                    mode='range'
                    v-model="internalValue"
                    is-inline
                ></v-date-picker>
            </div>

            <div class="flex">
                <button
                    @click="close"
                    class="bg-gray-200 p-4 py-2 text-gray-800 rounded mr-2 float-right"
                >Close</button>
                <button
                    @click="reset"
                    class="bg-gray-200 p-4 py-2 text-gray-800 rounded mr-2"
                >Reset</button>
                <button
                    @click="apply"
                    class="bg-indigo-600 p-4 py-2 text-white rounded"
                >Apply</button>
            </div>
        </div>

    </div>

</template>

<script>
import moment from "moment";

import Filter from "./Filter.vue";

export default {
    name: "bi-filter-date",
    extends: Filter,
    props: {
        value: Object
    },
    computed: {
        startDate() {
            if (this.internalValue == null) {
                return null;
            }
            return moment(new Date(this.internalValue.start)).format(
                "YYYY-MM-DD"
            );
        },
        endDate() {
            if (this.internalValue == null) {
                return null;
            }
            return moment(new Date(this.internalValue.end)).format(
                "YYYY-MM-DD"
            );
        }
    }
};
</script>