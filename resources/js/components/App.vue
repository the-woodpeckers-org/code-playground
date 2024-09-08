<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

export default {
    name: "App",
    components: {Footer, Header},
    data() {
        return {
            auth: window.auth
        }
    },
    created() {
        console.log(auth)
    }
}
</script>

<template>
    <Header></Header>
    <div class="grid grid-cols-12 w-full">
        <div class="col-span-2"></div>
        <div class="col-span-8">
            <router-view></router-view>
        </div>
        <div class="col-span-2"></div>
    </div>

    <Footer></Footer>
</template>

<style scoped>

</style>
