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
            return new Promise((resolve, reject) => {
            axios
                .get(`/${window.bi.base}-apis/${url}`, {
                    params: params
                })
                .then(response => {
                    const status = response.data.status;
                    if (status === 200) {
                        return resolve(response);
                    }
                    this.sendToast(response.data.error);
                })
                .catch(error => {
                    this.sendToast(error.response.data.message || error.message);
                });
            });
        },
        serialize(obj, prefix) {
            var str = [],
                p;
            for (p in obj) {
                if (obj.hasOwnProperty(p)) {
                var k = prefix ? prefix + "[" + p + "]" : p,
                    v = obj[p];
                str.push((v !== null && typeof v === "object") ?
                    this.serialize(v, k) :
                    encodeURIComponent(k) + "=" + encodeURIComponent(v));
                }
            }
            return str.join("&");
        }
    }
};
