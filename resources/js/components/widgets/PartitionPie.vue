<template>
    <div>
        <div class="p-2 text-sm">
            Pie
        </div>
        <div class="p-2 pt-0">
            <canvas ref="canvas"></canvas>
        </div>
    </div>
</template>

<script>
import { Pie } from "vue-chartjs";

export default {
    components: {
        "pie-chart": Pie
    },
    extends: Pie,
    data() {
        return {
            chartdata: {
                labels: ["VueJs", "EmberJs", "ReactJs", "AngularJs"],
                datasets: [
                    {
                        backgroundColor: [
                            "#41B883",
                            "#E46651",
                            "#00D8FF",
                            "#DD1B16"
                        ],
                        data: [40, 20, 80, 10]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        };
    },
    mounted() {
        this.renderChart(this.chartdata, this.options);
    }
};
</script>