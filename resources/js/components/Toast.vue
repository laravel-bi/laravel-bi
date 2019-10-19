<template>
    <div class="absolute bottom-0 right-0">
        <div v-for="toast in toasts" v-bind:key="'toast-' + toast.id" class="m-4">
            {{ toast.message }}
        </div>
    </div>
</template>

<script>
import EventBus from "../utils/EventBus.js";

export default {
    name: "bi-toast",
    data() {
        return {
            toasts: []
        };
    },
    mounted() {
        EventBus.$on("toast", toast => {
            this.toasts.push(toast);
            setTimeout(() => {
                this.toasts.splice(0, 1);
            }, 2000);
        });
    }
};
</script>