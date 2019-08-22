<template>
    <div class="bg-gray-100 p-4 border-r border-gray-500 relative" :style="{ width: width }">
        <p class="border-b-2 border-gray-500">Dashboards:</p>
        <ul>
            <li v-for="dashboard in dashboards" v-bind:key="dashboard.uriKey">
                <router-link :to="'/' + dashboard.uriKey" class="text-sm">
                    {{ dashboard.name }}
                </router-link>
            </li>
        </ul>
        <a href="#" @click="collapsed=true" class="absolute bottom-0 right-0" style="bottom: 100px">Collapse</a>
    </div>
</template>

<script>
import api from './mixins/api.js';
import toasts from './mixins/toasts.js';

export default {
    name: 'bi-nav',
    mixins: [
        api,
        toasts
    ],
    data() {
        return {
            dashboards: [],
            collapsed: false
        };
    },
    computed: {
        width() {
            return this.collapsed ? '100px' : 'auto';
        }
    },
    mounted() {
        this.api('dashboards').then(response => {            
            this.dashboards = response.data.data;
        });
        this.sendToast('ciao');
    }
}
</script>