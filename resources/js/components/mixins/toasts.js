import EventBus from "../../utils/EventBus";

export default {
    methods: {
        sendToast(message, error = true) {
            EventBus.$emit('toast', {
                message,
                error,
                id: new Date().getTime()
            });
        }
    }
};
