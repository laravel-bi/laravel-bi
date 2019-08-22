<template>
    <div class="bg-gray-100 border-r border-gray-500 relative" :style="{ width: width }">
        <svg viewBox="0 0 32 32" class="w-5 ml-4 fill-current cursor-pointer" @click="collapsed=!collapsed" >
            <path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/>
        </svg>
        <ul>
            <li v-for="dashboard in dashboards" v-bind:key="dashboard.uriKey" class="hover:bg-white hover:text-gray-800">
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