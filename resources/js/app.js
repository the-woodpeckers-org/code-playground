import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler'

import App from "@/components/App.vue";
import routes from "@/routes.js";

const app = createApp(App).use(routes).mount('#app')
