<template>
    <div class="flex relative" v-click-outside="clickOutside">

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