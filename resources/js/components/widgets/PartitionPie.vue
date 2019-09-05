<template>
    <div>
        <loading-widget
            :loading="loading"
            :widgetName="widgetName"
            @refresh="fetchData"
            widgetClass="h-widget-sm"
        >
            <div class="p-2 pt-0">
                <pie-chart
                    ref="chart"
                    :styles="{'height': '100px'}"
                    :options="options"
                ></pie-chart>
            </div>
        </loading-widget>
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
                return item[this.extra.dimension.key];
            });
            const data = response.data.data.map(item => {
                return item[this.extra.metric.key];
            });

            setTimeout(() => {
                this.$refs.chart.renderChart(
                    {
                        labels,
                        datasets: [
                            {
                                backgroundColor: colors({
                                    count: data.length,
                                    luminosity: "bright",
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