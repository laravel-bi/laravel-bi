<template>
    <div class="flex relative" v-click-outside="clickOutside">
        <bi-filter-anchor :active="active" @activated="active = true">
            <span v-if="confirmedValue == null">{{ filterConfig.name }}</span>
            <span v-else>
                {{ filterConfig.name }}:
                <strong
                    v-for="(value, i) in confirmedValue"
                    :key="'filter-' + filterConfig.name + '-' + value.id"
                >
                    {{ value[otherColumn] }}
                    <span v-if="i !== confirmedValue.length -1">,</span>
                </strong>
            </span>
        </bi-filter-anchor>

        <bi-filter-dropdown
            @close="close"
            class="w-filter-dropdown-sm"
            @reset="reset"
            @apply="apply"
            v-if="active"
        >
            <multiselect
                v-model="internalValue"
                :options="options"
                :label="otherColumn"
                :track-by="'id'"
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
    name: "bi-filter-belongs-to",
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
                this.otherColumn = response.data.extra.otherColumn;
            });
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>