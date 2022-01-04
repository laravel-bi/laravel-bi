<template>
    <div class="flex relative" v-click-outside="clickOutside">
        <bi-filter-anchor :active="active" @activated="active = true">
            <span v-if="confirmedValue == null">{{ filterConfig.name }}</span>
            <span v-else>
                {{ filterConfig.name }}:
                <strong
                    v-for="(value, i) in confirmedValue"
                    :key="'filter-' + filterConfig.name + '-' + value"
                >
                    {{ value }}
                    <span v-if="i !== confirmedValue.length -1">,</span>
                </strong>
            </span>
        </bi-filter-anchor>

        <bi-filter-dropdown
            @close="close"
            @reset="reset"
            @apply="apply"
            v-if="active"
            class="w-filter-dropdown-sm"
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
                this.options = response.data.extra.options;
            });
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>