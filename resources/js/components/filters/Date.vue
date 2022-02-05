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
                v-model="cDatePickerValue"
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
    data: function() {
        return {
            datePickerValue: null
        };
    },
    computed: {
        cDatePickerValue: {
            get() {
                return this.datePickerValue;
            },
            set(value) {
                this.datePickerValue = value;

                if(this.value) {
                    this.setInternalValue({
                        date: moment(new Date(value)).format(
                            "YYYY-MM-DD"
                        )
                    });
                } else {
                    this.setInternalValue(null);
                }
            }
        },
        pickedDate() {
            if (this.confirmedValue == null) {
                return null;
            }
            return this.confirmedValue.date;
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.setDatePickerValue(this.initialValue);
        });
    },
    methods: {  
        setDatePickerValue(value) {
            this.datePickerValue = value;
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