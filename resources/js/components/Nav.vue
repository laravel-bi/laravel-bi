<template>
    <div class="bg-nav absolute h-full w-nav z-20 shadow p-4" :class="{'w-closed-nav': collapsed}">
        <a href="#" class="float-right text-white text-24 p-8 py-12" @click="$emit('close')"><i class="fa fa-window-close"></i></a>
        <div class="h-head-box text-white text-24 p-8 py-12">
            Dashboard List:
        </div>
        <ul>
            <li v-for="dashboard in dashboards" v-bind:key="'nav-' + dashboard.uriKey">
                <router-link :to="'/' + dashboard.uriKey" class="block px-8 my-1 outline-none text-16 text-white hover:bg-white hover:text-head">
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
    mounted() {
        this.api('dashboards').then(response => {            
            this.dashboards = response.data.data;
        });
        this.sendToast('ciao');
    }
}
</script>