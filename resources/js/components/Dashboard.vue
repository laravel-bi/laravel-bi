<template>
    <div>
        <h3>{{ dashboardKey }}</h3>
        <div class="m-2 bg-white p-2 border border-gray-500">
            Ciao
        </div>
    </div>
</template>

<script>
import api from "./mixins/api.js";
import toasts from "./mixins/toasts.js";

export default {
    name: "bi-dashboard",
    mixins: [api, toasts],
    props: ["dashboardKey"],
    watch: {
        // call again the method if the route changes
        $route: "fetchData"
    },
    created() {
        this.fetchData()
    },
    methods: {
        fetchData() {
            this.api(`${this.dashboardKey}/widgets`).then(function(response) {
                console.log(response.data.data);
            });
            return true;
        }
    }
};

</script>