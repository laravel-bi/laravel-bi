<template>
    <div class="bg-gray-800 relative w-nav" :class="{'w-closed-nav': collapsed}">
        <div class="p-4 pt-3 bg-indigo-600 text-gray-800 hover:bg-indigo-400 hover:text-white cursor-pointer h-header" @click="collapsed=!collapsed">
            <i class="fas fa-bars text-sm text-center"></i>
        </div>
        <ul>
            <li v-for="dashboard in dashboards" v-bind:key="dashboard.uriKey" class="text-white hover:bg-gray-700">
                <router-link :to="'/' + dashboard.uriKey" class="text-sm block p-4 my-1">
                    <i class="fas fa-tachometer-alt text-sm"></i>
                    <span v-if="!collapsed" class="ml-1">{{ dashboard.name }}</span>
                </router-link>
            </li>
        </ul>
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
            return this.collapsed ? '50px' : 'auto';
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