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
                Select a {{ filterConfig.name }}
            </span>
            <span v-else>
                {{ filterConfig.name }}:
                <!-- <span
                    v-for="(value, i) in internalValue"
                    :key="value"
                >
                    {{ value }}<span v-if="i !== internalValue.length -1">,</span>
                </span> -->
            </span>
        </a>

        <div
            class="absolute top-0 right-0 bg-white mt-8 p-4 shadow z-10"
            v-if="active"
        >
            <div class=mb-2>
                <!-- <multiselect
                    v-model="internalValue.operator"
                    :options="options"
                    placeholder="Select an operator"
                ></multiselect> -->
                
                <!-- <input type="value" v-model="internalValue.values[0]">
                <input type="value" v-model="internalValue.values[1]" v-if="internalValue.operator == 'between'"> -->
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
    name: "bi-filter-string",
    mixins: [api, toasts],
    extends: Filter,
    props: {
        value: Object
    },
    components: {
        Multiselect
    },
    mounted() {
        this.options = [
            '>', '>=', '<', '<=', 'between'
        ]
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>