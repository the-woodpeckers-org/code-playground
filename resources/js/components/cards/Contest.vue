<script>
import Countdown from "@/components/countdowns/Countdown.vue";

export default {
    name: "Contest",
    components: {Countdown},
    props: {
        imgUrl: String,
        title: String,
        contestId: {
            default: '0'
        }
    }
}
</script>

<template>
    <router-link class="card bg-base-100 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition" :to="'/contest/' + contestId">
        <figure class="h-40">
            <img :src="imgUrl" loading="lazy"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{title}}</h2>
            <p class="text-center">
                <span class="text-center font-mono">end after</span>
                <br>
                <Countdown></Countdown>
            </p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
