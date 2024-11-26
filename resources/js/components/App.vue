<script>
import {HTTP} from "@/http-common.js";

const Header = defineAsyncComponent(() => import('@/components/templates/Header.vue'))
const Footer = defineAsyncComponent(() => import('@/components/templates/Footer.vue'))

import {defineAsyncComponent} from "vue";
import {getAuth, setAccessToken, setAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "App",
    components: {Footer, Header},
    data() {
        return {
            auth: getAuth()
        }
    },
    methods: {},
    mounted() {
        let _this = this;
        if (localStorage.getItem('accessToken')) {
            HTTP.get('api/auth/get')
                .then((response) => {
                    console.log(response);
                    setAuth(response.data);
                    _this.auth = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    }
}
</script>

<template>

    <Header></Header>
    <div class="mx-auto max-w-7xl my-6" style="min-height: 680px">
        <div class="mx-6 relative">
            <router-view></router-view>
        </div>
    </div>
    <Footer></Footer>

</template>

<style scoped>

</style>
