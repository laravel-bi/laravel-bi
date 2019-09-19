<template>

    <div
        class="relative mr-4"
        v-click-outside="close"
    >

        <bi-filter-anchor
            :active="active"
            @activated="active = true"
        >
            <i class="fas fa-calendar"></i>
            <span v-if="confirmedValue == null || confirmedValue.operator == null">
                Select a {{ filterConfig.name }}
            </span>
            <span v-else>
                {{ filterConfig.name }}:
                {{ label }}
            </span>
        </bi-filter-anchor>

        <bi-filter-dropdown
            @close="close"
            @reset="reset"
            @apply="apply"
            v-if="active"
            class="w-filter-dropdown-lg"
        >

            <div class="w-1/2">
                <multiselect
                    class=""
                    v-model="internalValue.operator"
                    :options="options"
                    placeholder="Operator"
                    :showLabels="false"
                ></multiselect>
            </div>

            <input
                type="text"
                v-model="internalValue.values[0]"
                class="flex-1 min-w-0 border ml-10 text-14 px-2"
            >
            <span
                :class="{ 
                    'visible': internalValue.operator == 'between',
                    'invisible': internalValue.operator != 'between'
                }"
                class="ml-2 self-center text-14 ml-10"
            >and</span>

            <input
                type="text"
                v-model="internalValue.values[1]"
                class="flex-1 min-w-0 border ml-10 text-14 px-2"
                :class="{ 
                    'visible': internalValue.operator == 'between',
                    'invisible': internalValue.operator != 'between'
                }"
            >
        </bi-filter-dropdown>

    </div>

</template>

<script>
import api from "../mixins/api.js";
import toasts from "../mixins/toasts.js";

import Filter from "./Filter.vue";

import Multiselect from "vue-multiselect";

export default {
    name: "bi-filter-number",
    mixins: [api, toasts],
    extends: Filter,
    props: {
        value: Object
    },
    components: {
        Multiselect
    },
    computed: {
        label() {
            try {
                if (this.confirmedValue.operator == "between") {
                    return `Between ${this.confirmedValue.values[0] ||
                        ""} and ${this.confirmedValue.values[1] || ""}`;
                }
                return `${this.confirmedValue.operator} ${this.confirmedValue
                    .values[0] || ""}`;
            } catch (error) {
                return "";
            }
        }
    },
    mounted() {
        this.options = [">", ">=", "<", "<=", "between"];
    },
    methods: {
        defaultValue() {
            return {
                operator: null,
                values: [null, null]
            };
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>