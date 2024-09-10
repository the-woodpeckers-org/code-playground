<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {computed} from "vue";

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
    <div class="mx-auto max-w-7xl min-h-96">
        <router-view></router-view>
    </div>
    <Footer></Footer>
</template>

<style scoped>

</style>
