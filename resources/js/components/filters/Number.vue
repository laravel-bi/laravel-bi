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
            <span v-if="internalValue == null || internalValue.operator == null">
                Select a {{ filterConfig.name }}
            </span>
            <span v-else>
                {{ filterConfig.name }}:
                {{ label }}
            </span>
        </a>

        <div
            class="absolute top-0 right-0 bg-white mt-8 p-4 shadow z-10"
            v-if="active"
        >
            <div class="mb-2 flex">
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