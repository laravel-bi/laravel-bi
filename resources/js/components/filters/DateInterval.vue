<template>
    <div class="flex relative" v-click-outside="clickOutside">
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
                v-model="datePickerValue"
                is-inline
            ></v-date-picker>
        </bi-filter-dropdown>
    </div>
</template>

<script>
import moment from "moment";

import Filter from "./Filter.vue";

export default {
    name: "bi-filter-date-interval",
    extends: Filter,
    props: {
        value: Object
    },
    data: function() {
        return {
            datePickerValue: null
        };
    },
    watch: {
        datePickerValue: function() {
            if(this.datePickerValue) {
                this.setInternalValue({
                    start: moment(new Date(this.datePickerValue.start)).format(
                        "YYYY-MM-DD"
                    ),
                    end: moment(new Date(this.datePickerValue.end)).format(
                        "YYYY-MM-DD"
                    )
                });
            } else {
                this.setInternalValue(null);
            }
        }
    },
    computed: {
        startDate() {
            if (this.confirmedValue == null) {
                return null;
            }
            return this.confirmedValue.start;
        },
        endDate() {
            if (this.confirmedValue == null) {
                return null;
            }
            return this.confirmedValue.end;
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.setDatePickerValue(this.initialValue);
        });
    },
    methods: {  
        setDatePickerValue(value) {
            this.datePickerValue = JSON.parse(JSON.stringify(value));
        },
        close() {
            this.setInternalValue(this.confirmedOrInitialValue);
            this.setDatePickerValue(this.confirmedOrInitialValue);
            this.active = false;
        },
        reset: function() {
            this.setInternalValue(this.initialValue);
            this.setConfirmedValue(this.initialValue);
            this.setDatePickerValue(this.initialValue);
            this.active = false;
            this.emitValue();
        },
    }
};
</script>