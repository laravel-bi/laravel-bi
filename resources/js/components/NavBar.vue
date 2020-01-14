<template>
    <div
        class="bg-gray-800 min-h-full p-4 text-gray-300 text-sm shadow-lg flex-shrink-0"
        :class="collapsingClass"
        id="nav-bar"
        ref="nav-bar"
    >
        <div
            class="uppercase text-sm text-gray-500 font-bold m-2 bi:navbar-title"
        >Dashboard list</div>
        <ul>
            <li class="py-2" v-for="dashboard in dashboards" v-bind:key="'nav-' + dashboard.uriKey">
                <router-link
                    :to="'/' + dashboard.uriKey"
                    class="flex outline-none select-none hover:text-gray-500 bi:navbar-link"
                >
                    <span class="text-gray-400 self-center">
                        <svg
                            class="w-4 fill-current mr-2"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM5.68 7.1A7.96 7.96 0 0 0 4.06 11H5a1 1 0 0 1 0 2h-.94a7.95 7.95 0 0 0 1.32 3.5A9.96 9.96 0 0 1 11 14.05V9a1 1 0 0 1 2 0v5.05a9.96 9.96 0 0 1 5.62 2.45 7.95 7.95 0 0 0 1.32-3.5H19a1 1 0 0 1 0-2h.94a7.96 7.96 0 0 0-1.62-3.9l-.66.66a1 1 0 1 1-1.42-1.42l.67-.66A7.96 7.96 0 0 0 13 4.06V5a1 1 0 0 1-2 0v-.94c-1.46.18-2.8.76-3.9 1.62l.66.66a1 1 0 0 1-1.42 1.42l-.66-.67zM6.71 18a7.97 7.97 0 0 0 10.58 0 7.97 7.97 0 0 0-10.58 0z"
                            />
                        </svg>
                    </span>
                    <span class="bi:navbar-label self-center">{{ dashboard.name }}</span>
                </router-link>
            </li>
        </ul>

        <div class="uppercase text-sm text-gray-500 font-bold m-2 mt-4 bi:navbar-title">Actions</div>
        <ul>
            <li class="py-2">
                <a href="#" class="flex outline-none select-none bi:navbar-link" @click.prevent="toggleCollapse">
                    <span class="text-gray-400 self-center">
                        <svg
                            class="w-4 fill-current mr-2"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                            />
                        </svg>
                    </span>
                    <span class="bi:navbar-label self-center">Collapse menu</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import api from "./mixins/api.js";
import toasts from "./mixins/toasts.js";

export default {
    name: "bi-nav",
    mixins: [api, toasts],
    data() {
        return {
            dashboards: [],
            collapsed: false,
            collapsingClass: "expanded"
        };
    },
    mounted() {
        this.api("dashboards").then(response => {
            this.dashboards = response.data.data;
        });
        this.$refs["nav-bar"].addEventListener('transitionend', () => {
            this.onTransitionEnd();
        });
    },
    methods: {
        toggleCollapse() {
            this.collapsingClass = this.collapsed ? "expanding" : "collapsing";
        },
        onTransitionEnd() {
            this.collapsingClass = this.collapsed ? "expanded" : "collapsed";
            this.collapsed = !this.collapsed;
        }
    }
};
</script>