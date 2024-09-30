<script>
import CodePanel from "@/components/pages/CodePanel.vue";
import Countdown from "@/components/countdowns/Countdown.vue";
import BaseCountDown from "@/components/countdowns/BaseCountDown.vue";
import ContestCodePanel from "@/components/pages/ContestCodePanel.vue";
import {HTTP} from "@/http-common.js";

export default {
    name: "ContestPanel",
    components: {ContestCodePanel, BaseCountDown, Countdown, CodePanel},
    data: function () {
        return {
            title: 'Contest',
            days: 1,
            hours: 1,
            minutes: 1,
            seconds: 1,
            isLoaded: false
        }
    },
    mounted() {
        let _this = this;
        HTTP.get('api/contest/get/' + this.$route.params.c_id)
            .then(response => {
                console.log(response.data.remainingTime)
                _this.title = response.data.title;
                _this.days = response.data.remainingTime.days;
                _this.hours = response.data.remainingTime.hours;
                _this.minutes = response.data.remainingTime.minutes;
                _this.seconds = response.data.remainingTime.seconds;
                _this.isLoaded = true
            })
            .catch(error => {
                alert(error)
            })
    }
}
</script>

<template>
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div>
                <p class="font-semibold text-xl my-2"> {{ title }}</p>
                <p>Time remaining:
                    <BaseCountDown v-if="isLoaded" :days="days" :hours="hours" :minutes="minutes"
                                   :seconds="seconds"></BaseCountDown>
                </p>
            </div>
            <div class="h-full flex flex-wrap flex-col justify-center">
                <span class="w-full text-end">
                    <router-link to="#"
                                 class="p-4 rounded-xl bg-primary hover:bg-cyan-700 w-20 text-center text-base-200 font-semibold transition shadow-xl">Submit</router-link>
                </span>
            </div>
        </div>
        <div class="divider"></div>
        <div role="tablist" class="tabs tabs-bordered w-full">
            <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="Problem 1" checked="checked"/>
            <div role="tabpanel" class="tab-content">
                <ContestCodePanel :contestId="this.$route.params.c_id" :problemId="1"></ContestCodePanel>
            </div>
            <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="Problem 2"/>
            <div role="tabpanel" class="tab-content">
                <ContestCodePanel :contestId="this.$route.params.c_id" :problemId="2"></ContestCodePanel>
            </div>
            <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="Problem 3"/>
            <div role="tabpanel" class="tab-content">
                <ContestCodePanel :contestId="this.$route.params.c_id" :problemId="3"></ContestCodePanel>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
