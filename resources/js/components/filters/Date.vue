<template>
    <div class="flex relative" v-click-outside="close">
        <bi-filter-anchor :active="active" @activated="active = true">
            <span v-if="confirmedValue == null">{{ filterConfig.name }}</span>
            <span v-else>
                {{ filterConfig.name }}:
                <strong>{{ startDate }} - {{ endDate }}</strong>
            </span>
        </bi-filter-anchor>

        <bi-filter-dropdown @close="close" @reset="reset" @apply="apply" v-if="active">
            <v-date-picker
                is-expanded
                :show-day-popover="false"
                mode="range"
                v-model="internalValue"
                is-inline
            ></v-date-picker>
        </bi-filter-dropdown>
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
            if (this.confirmedValue == null) {
                return null;
            }
            return moment(new Date(this.confirmedValue.start)).format(
                "YYYY-MM-DD"
            );
        },
        endDate() {
            if (this.confirmedValue == null) {
                return null;
            }
            return moment(new Date(this.confirmedValue.end)).format(
                "YYYY-MM-DD"
            );
        },
    }
};
</script>