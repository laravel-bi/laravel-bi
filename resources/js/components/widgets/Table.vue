<template>
    <div>
        <div class="p-2 text-sm flex">
            <div class="flex-grow">
                {{ widgetName }}
            </div>
            <div>    
                <svg viewBox="0 0 20 20" class="fill-current w-5 cursor-pointer" @click="fetchData">
                    <path d="M10,3 C6.13400675,3 3,6.13400675 3,10 C3,11.9329966 3.78350169,13.6829966 5.05025253,14.9497475 L6.46446609,13.5355339 C5.55964406,12.6307119 5,11.3807119 5,10 C5,7.23857625 7.23857625,5 10,5 L10,3 L10,3 Z M14.9497475,5.05025253 C16.2164983,6.31700338 17,8.06700338 17,10 C17,13.8659932 13.8659932,17 10,17 L10,15 C12.7614237,15 15,12.7614237 15,10 C15,8.61928813 14.4403559,7.36928813 13.5355339,6.46446609 L14.9497475,5.05025253 L14.9497475,5.05025253 Z M10,20 L6,16 L10,12 L10,20 L10,20 Z M10,8 L14,4 L10,0 L10,8 L10,8 Z"></path>
                </svg>
            </div>
        </div>
        <bi-loader v-if="loading" style="height: 400px"></bi-loader>
        <div v-else class=" overflow-auto" style="height: 400px">
            <div class="p-4">
            <table class="w-full text-sm">
                <tr class="border-b">
                    <th
                        v-for="dimension in extra.dimensions"
                        :key="dimension.key"
                        class="text-left p-1 py-2"
                    >{{ dimension.name }}</th>
                    <th
                        v-for="metric in extra.metrics"
                        :key="metric.key"
                        class="text-left p-1 py-2"
                    >{{ metric.name }}</th>
                </tr>
                <tbody>
                    <tr
                        v-for="(row, i) in data"
                        :key="i"
                        class="border-b last:border-b-0 hover:bg-gray-100"
                    >
                        <td
                            v-for="dimension in extra.dimensions"
                            :key="dimension.key"
                            class="p-1"
                        >
                            {{ row[dimension.key] }}
                        </td>
                        <td
                            v-for="metric in extra.metrics"
                            :key="metric.key"
                            class="p-1"
                        >
                            {{ row[metric.key] }}
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../mixins/api.js";
import toasts from "../mixins/toasts.js";

export default {
    name: "bi-table",
    mixins: [api, toasts],
    props: {
        dashboardKey: String,
        widgetKey: String,
        widgetName: String,
        extra: Object
    },
    data() {
        return {
            data: [],
            loading: true
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            const startTime = (new Date()).getTime();
            this.api(`${this.dashboardKey}/${this.widgetKey}`).then(
                response => {
                    const endTime = (new Date()).getTime();
                    const diffTime = endTime - startTime;
                    if(diffTime > 2000) {
                        this.data = response.data.data;
                        this.loading = false;
                    } else {
                        setTimeout(() => {
                            this.data = response.data.data;
                            this.loading = false;
                        }, 2000 - diffTime);
                    }
                }
            );
        }
    }
};
</script>