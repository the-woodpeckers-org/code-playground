<script>
import {HTTP} from "@/http-common.js";

const Header = defineAsyncComponent(() => import('@/components/templates/Header.vue'))
const Footer = defineAsyncComponent(() => import('@/components/templates/Footer.vue'))

import {defineAsyncComponent} from "vue";

export default {
    name: "App",
    components: {Footer, Header},
    data() {
        return {
            auth: undefined
        }
    },
    methods: {},
    beforeCreate() {
        let _this = this;
        console.log(localStorage.getItem("accessToken"))
        if (localStorage.getItem("accessToken") != null) {
            HTTP.get('/api/auth/get')
                .then((response) => {
                    _this.auth = response.data;
                })
                .catch((error) => {
                    localStorage.clear();
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
