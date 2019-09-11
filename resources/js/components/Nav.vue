<template>
    <div class="bg-nav relative w-nav flex-shrink-0" :class="{'w-closed-nav': collapsed}">
        <div class="p-4 pt-3 bg-primary text-gray-800 hover:bg-primary-600 hover:text-white cursor-pointer h-header" @click="collapsed=!collapsed">
            <i class="fas fa-bars text-sm text-center"></i>
        </div>
        <ul>
            <li v-for="dashboard in dashboards" v-bind:key="dashboard.uriKey" class="text-white hover:text-primary">
                <router-link :to="'/' + dashboard.uriKey" class="text-sm block p-4 my-1 outline-none">
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