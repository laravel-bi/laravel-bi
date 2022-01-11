import EventBus from "../../utils/EventBus";

export default {
    methods: {
        sendToast(message, error = true) {
            console.log('sendToast', message);
            EventBus.$emit('toast', {
                message,
                error,
                id: new Date().getTime()
            });
        }
    }
};
