import axios from 'axios';

export default {
    methods: {
        api(url) {            
            return axios.get(`bi-apis/${url}`).then(response => {
                const status = response.data.status;
                if(status === 200) {
                    return response;
                }
                this.sendToast(response.data.error);
            }).catch((error) => {
                this.sendToast(error.message);
            });
        }
    }
}
