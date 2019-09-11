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
            <span v-if="internalValue == null">
                Select a {{ filterConfig.name }}
            </span>
            <span v-else>
                {{ filterConfig.name }}:
                <span
                    v-for="(value, i) in internalValue"
                    :key="value"
                >
                    {{ value }}<span v-if="i !== internalValue.length -1">,</span>
                </span>
            </span>
        </bi-filter-anchor>

        <bi-filter-dropdown
            @close="close"
            @reset="reset"
            @apply="apply"
            v-if="active"
        >
            <multiselect
                v-model="internalValue"
                :options="options"
                :multiple="true"
                :placeholder="`Select ${filterConfig.name}`"
                :showLabels="false"
            ></multiselect>
        </bi-filter-dropdown>

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
        value: Array
    },
    components: {
        Multiselect
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.api(
                `${this.dashboardKey}/filters/${this.filterConfig.key}`
            ).then(response => {
                this.options = response.data.data.options;
            });
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>