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
        },
        isFuture: {
            default: false
        },
        startDate: {
            default: ''
        }
    }
}
</script>

<template>
    <router-link class="card bg-base-100 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition" :to="'/contest/' + contestId">
        <figure class="h-40 bg-gradient-to-br from-cyan-300 to-purple-300 p-3">
            <p class="text-6xl font-semibold bg-gradient-to-tl from-green-600 to-blue-600 p-3 inline-block bg-clip-text text-transparent">{{ title }}</p>
        </figure>
        <div class="card-body">
            <h2 class="card-title text-ellipsis line-clamp-2">{{title}}</h2>
            <section v-if="!isFuture">
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
            </section>
            <section v-if="isFuture">
                <p class="text-center font-mono">Will start at</p>
                <p class="text-center font-semibold text-lg font-mono">{{ startDate }}</p>
            </section>
        </div>
    </router-link>
</template>

<style scoped>

</style>
