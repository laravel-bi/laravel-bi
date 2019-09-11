<template>

    <div
        class="inline-block relative mr-4"
        v-click-outside="close"
    >

        <bi-filter-anchor
            :active="active"
            @activated="active = true"
        >
            <i class="fas fa-calendar"></i>
            <span v-if="internalValue == null || internalValue.operator == null">
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
        >
            <div class="w-32">
                <multiselect
                    v-model="internalValue.operator"
                    :options="options"
                    placeholder="Operator"
                    :showLabels="false"
                ></multiselect>
            </div>

            <input
                type="text"
                v-model="internalValue.values[0]"
                class="w-20 border ml-2 px-2"
            >
            <span
                v-if="internalValue.operator == 'between'"
                class="ml-2 self-center"
            >and</span>
            <input
                type="text"
                v-model="internalValue.values[1]"
                class="w-20 border ml-2 px-2"
                v-if="internalValue.operator == 'between'"
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
                if (this.internalValue.operator == "between") {
                    return `Between ${this.internalValue.values[0] ||
                        ""} and ${this.internalValue.values[1] || ""}`;
                }
                return `${this.internalValue.operator} ${this.internalValue
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