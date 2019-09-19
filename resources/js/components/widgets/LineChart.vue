<template>
    <div>
        <loading-widget
            :loading="loading"
            :dashboardKey="dashboardKey"
            :widgetKey="widgetKey"
            :widgetName="widgetName"
            @refresh="fetchData"
            widgetClass="h-widget-sm"
        >
            <div class="p-2 pt-0">
                <chartjs-line-chart ref="chart" :styles="{'height': '130px'}" :options="options"></chartjs-line-chart>
            </div>
        </loading-widget>
    </div>
</template>

<script>
import { Line } from "vue-chartjs";
import Widget from "./Widget.vue";

export default {
    name: 'line-chart',
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
                    position: 'right'
                }
            }
        };
    },
    methods: {
        onFetchData(response) {
            const labels = response.data.data.map(item => {
                return item[this.extra.dimension.key];
            });
            const datasets = this.extra.metrics.map((metric) => {
                return {
                    label: metric.name,
                    data: response.data.data.map(item => {
                        return item[metric.key];
                    }),
                    backgroundColor: metric.color
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