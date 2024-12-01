<script>
import Header from "@/components/templates/Header.vue";
import Footer from "@/components/templates/Footer.vue";
export default {
    name: "UserLayout",
    components: {Header, Footer}
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
