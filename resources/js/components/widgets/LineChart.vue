<template>
    <div class="h-widget-sm">
        <div class="bg-gray-300 flex relative h-full" v-if="loading">
            <bi-loader class="absolute bi:loader"></bi-loader>
        </div>
        <div class="p-4 pt-0" v-if="!loading">
            <chartjs-line-chart ref="chart" :styles="{'height': '200px'}" :options="options"></chartjs-line-chart>
        </div>
    </div>
</template>

<script>
import { Line } from "vue-chartjs";
import colors from "randomcolor";

import Widget from "./Widget.vue";

export default {
    name: "line-chart",
    components: {
        "chartjs-line-chart": Line
    },
    extends: Widget,
    data() {
        return {
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "right"
                }
            }
        };
    },
    methods: {
        onFetchData(response) {
            const labels = response.data.data.map(item => {
                return item[this.dimensions[0].key];
            });
            const datasets = this.metrics.map(metric => {
                return {
                    label: metric.name,
                    data: response.data.data.map(item => {
                        return item[metric.key];
                    }),
                    backgroundColor: metric.color || colors({
                        count: 1,
                        luminosity: "light",
                        format: "rgba",
                        alpha: 0.5
                    })[0]
                };
            });
            setTimeout(() => {
                this.$refs.chart.renderChart(
                    {
                        labels,
                        datasets: datasets
                    },
                    this.options
                );
            }, 200);
        }
    }
};
</script>