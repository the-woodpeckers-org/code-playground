import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler'

import App from "@/components/App.vue";
import routes from "@/routes.js";
import {getAuth} from "@/utils/authLocalStorage.js";

routes.beforeEach(async (to, from) => {
    if (getAuth() && (to.name == 'login' || to.name == 'register')) {
        return '/';
    } else if (getAuth() && to.name != 'verify-email') {
        if (getAuth().email_verified_at == null) {
            return '/verify-email'
        }
    }
    else if (!getAuth() &&
        (
            to.name == 'profile' ||
            to.name == 'MyCv' ||
            to.name == 'contest-participate'
        )
    ) {
        return '/';
    }
});

const app = createApp(App).use(routes).mount('#app')
