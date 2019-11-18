<template>
    <div class="h-widget-sm">
        <div class="bg-gray-300 flex relative h-full" v-if="loading">
            <bi-loader class="absolute bi:loader"></bi-loader>
        </div>
        <div class="p-4" v-if="!loading">
            <pie-chart ref="chart" :styles="{'height': '168px'}" :options="options"></pie-chart>
        </div>
    </div>
</template>

<script>
import { Pie } from "vue-chartjs";
import colors from "randomcolor";

import Widget from "./Widget.vue";

export default {
    name: "partition-pie",
    components: {
        "pie-chart": Pie
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
            const data = response.data.data.map(item => {
                return item[this.metrics[0].key];
            });

            setTimeout(() => {
                this.$refs.chart.renderChart(
                    {
                        labels,
                        datasets: [
                            {
                                backgroundColor: colors({
                                    count: data.length,
                                    luminosity: "light",
                                    format: "rgb"
                                }),
                                data
                            }
                        ]
                    },
                    this.options
                );
            }, 200);
        }
    }
};
</script>