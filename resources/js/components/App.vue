<script>
const Header = defineAsyncComponent(() => import('@/components/templates/Header.vue'))
const Footer = defineAsyncComponent(() => import('@/components/templates/Footer.vue'))

import { defineAsyncComponent} from "vue";

export default {
    name: "App",
    components: {Footer, Header},
    data() {
        return {
            auth: window.auth
        }
    },
    methods: {

    }
}
</script>

<template :key="auth">
    <Header></Header>
    <div class="mx-auto max-w-7xl" style="min-height: 680px">
        <router-view></router-view>
    </div>
    <Footer></Footer>
</template>

<style scoped>

</style>
