import axios from 'axios';
import router from './router/router';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = '/api';
window.axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            console.warn("Unauthorized! Redirecting to login...");
            // this.$router.push("/login"); // Redirect ke halaman login
            router.push('/login');
        }
        return Promise.reject(error); // Lempar error ke pemanggil
    }
)
