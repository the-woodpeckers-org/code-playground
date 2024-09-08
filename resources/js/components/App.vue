<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

export default {
    name: "App",
    components: {Footer, Header}
}
</script>

<template>
    <Header></Header>
    <router-view></router-view>
    <Footer></Footer>
</template>

<style scoped>

</style>
