import './bootstrap';
import router from "./router/router";
import { createApp } from "vue";
import '../css/app.css';

import App from "./App.vue";

createApp(App).use(router).mount("#app");
