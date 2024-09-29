<script>
import BaseCountDown from "@/components/countdowns/BaseCountDown.vue";

export default {
    name: "ContestDetail",
    components: {BaseCountDown},
    props: {
        title: {
            default: 'This is an contest'
        },
        description: {
            default: 'N/A'
        }
    },
    data: function () {
        return {
            days: {
                default: 0
            },
            hours: {
                default: 0
            },
            minutes: {
                default: 0
            },
            seconds: {
                default: 0
            },
            isLoaded: false
        }
    },
    mounted() {
        let _this = this;
        axios.get('/api/contest/' + this.$route.params.c_id)
            .then(function (response) {
                console.log(response.data);
                console.log(response.data.remainingTime)
                _this.isLoaded = true;
                _this.days = response.data.remainingTime.days;
                _this.hours = response.data.remainingTime.hours;
                _this.minutes = response.data.remainingTime.minutes;
                _this.seconds = response.data.remainingTime.seconds;
            })
            .catch(function (error) {
                console.log(error)
            })
    }
}
</script>

<template>
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <h1 class="text-2xl font-bold col-span-full">{{ title }}</h1>
            <div class="col-span-2">
                <div class="divider"></div>
                <p class="border-b text-lg font-semibold me-1">Description</p>
                <p class="mt-3"> {{ description }}</p>
            </div>
            <div>
                <div class="divider"></div>
                <div class="border rounded-xl bg-gradient-to-br from-cyan-200 to-purple-200 px-3 py-6">
                    <p class="text-start"><span class="font-semibold">Host by: </span> {{ 'Viettel Corporation' }}</p>
                    <p class="text-start"><span class="font-semibold">Time remaining: </span>
                        <BaseCountDown v-if="isLoaded" :days="days" :hours="hours" :minutes="minutes" :seconds="seconds"></BaseCountDown>
                    </p>
                    <p class="text-start"><span class="font-semibold">Participants: </span> {{ '8' }}</p>
                    <p class="text-start"><span class="font-semibold">Rounds: </span> {{ '3' }}</p>
                    <p class="text-start"><span class="font-semibold">Tags: </span></p>
                    <div class="flex flex-row flex-wrap">
                        <p class="border bg-base-100 px-2 m-1">Hackathon</p>
                        <p class="border bg-base-100 px-2 m-1">Settle-in</p>
                        <p class="border bg-base-100 px-2 m-1">Viettel</p>
                        <p class="border bg-base-100 px-2 m-1">Algorithm</p>
                        <p class="border bg-base-100 px-2 m-1">Speedup</p>
                    </div>
                    <p class="text-start"><span class="font-semibold">Skills: </span></p>
                    <div class="flex flex-row flex-wrap">
                        <p class="border bg-base-100 px-2 m-1">Two pointers</p>
                        <p class="border bg-base-100 px-2 m-1">Dynamic Programming</p>
                        <p class="border bg-base-100 px-2 m-1">Data Structure</p>
                        <p class="border bg-base-100 px-2 m-1">Window Slider</p>
                    </div>
                    <div class="flex flex-row flex-wrap justify-center mt-6">
                        <router-link to="/123s"
                                     class="shadow-xl hover:bg-cyan-700 bg-primary p-2 font-semibold text-lg text-white rounded-xl transition">
                            Set me in!
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
