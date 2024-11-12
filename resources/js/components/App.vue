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
    created() {
        let _this = this;
        console.log(localStorage.accessToken)
        if (localStorage.accessToken) {
            this.auth = HTTP.get('/api/auth/get')
                .then((response) => {
                    if (response.data.id) {
                        _this.auth = response.data;
                        console.log(response);
                    }
                })
                .catch((error) => {
                    console.log(error);
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
