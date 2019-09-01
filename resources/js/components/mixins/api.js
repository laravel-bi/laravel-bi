import axios from "axios";
import qs from 'qs';

// Format nested params correctly
axios.interceptors.request.use(config => {
    config.paramsSerializer = params => {
        // Qs is already included in the Axios package
        return qs.stringify(params, {
            arrayFormat: "brackets",
            encode: false
        });
    };
    return config;
});

export default {
    methods: {
        api(url, params) {
            return axios
                .get(`bi-apis/${url}`, {
                    params: params
                })
                .then(response => {
                    const status = response.data.status;
                    if (status === 200) {
                        return response;
                    }
                    this.sendToast(response.data.error);
                })
                .catch(error => {
                    console.log(error);
                    this.sendToast(error.message);
                });
        }
    }
};
