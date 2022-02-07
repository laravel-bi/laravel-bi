<template>
    <div class="flex relative" v-click-outside="clickOutside">
        <bi-filter-anchor :active="active" @activated="active = true">
            <span v-if="confirmedValue == null">{{ filterConfig.name }}</span>
            <span v-else>
                {{ filterConfig.name }}:
                <strong>{{ pickedDate }}</strong>
            </span>
        </bi-filter-anchor>

        <bi-filter-dropdown @close="close" @reset="reset" @apply="apply" v-if="active">
            <v-date-picker
                is-expanded
                :show-day-popover="false"
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
    name: "bi-filter-date",
    extends: Filter,
    props: {
        value: Array
    },
    data: function() {
        return {
            datePickerValue: null
        };
    },
    watch: {
        datePickerValue: function() {
            if(this.datePickerValue) {
                this.setInternalValue([
                    moment(new Date(this.datePickerValue)).format(
                        "YYYY-MM-DD"
                    )
                ]);
            } else {
                this.setInternalValue([null]);
            }
        }
    },
    computed: {
        pickedDate() {
            if (this.confirmedValue.length == 0 || this.confirmedValue[0] == null) {
                return null;
            }
            return this.confirmedValue[0];
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.setDatePickerValue(this.initialValue);
        });
    },
    methods: {  
        setDatePickerValue(value) {
            this.datePickerValue = new Date(value[0]);
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