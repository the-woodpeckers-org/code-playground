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
        },
        p_Days: {
            default: 0
        },
        p_Hours: {
            default: 0
        },
        p_Minutes: {
            default: 0
        },
        p_Seconds: {
            default: 0
        },
        statusContest:{
            default: 'running'
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
            <h2 class="card-title text-ellipsis line-clamp-2">{{title}}</h2>
            <p class="text-center" v-if="statusContest==='running'">
                <span  class="text-center font-mono">end after</span>
                <br>
                <Countdown :days="p_Days" :hours="p_Hours" :minutes="p_Minutes" :seconds="p_Seconds"></Countdown>
            </p>
            <p class="text-center" v-else>
                <span  class="text-center font-mono">start after</span>
                <br>
                <Countdown :days="p_Days" :hours="p_Hours" :minutes="p_Minutes" :seconds="p_Seconds"></Countdown>
            </p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
