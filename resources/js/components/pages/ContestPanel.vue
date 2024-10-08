<script>
import CodePanel from "@/components/pages/CodePanel.vue";
import Countdown from "@/components/countdowns/Countdown.vue";
import BaseCountDown from "@/components/countdowns/BaseCountDown.vue";
import ContestCodePanel from "@/components/pages/ContestCodePanel.vue";
import {HTTP} from "@/http-common.js";
import ContestProblemTab from "@/components/listItems/ContestProblemTab.vue";

export default {
    name: "ContestPanel",
    components: {ContestProblemTab, ContestCodePanel, BaseCountDown, Countdown, CodePanel},
    data: function () {
        return {
            title: 'Contest',
            days: 1,
            hours: 1,
            minutes: 1,
            seconds: 1,
            problems: [],
            isLoaded: false
        }
    },
    mounted() {
        let _this = this;
        HTTP.get('api/participate?id=' + _this.$route.params.c_id)
            .then(response => {
                _this.title = response.data.contest.title;
                _this.days = response.data.contest.remainingTime.days;
                _this.hours = response.data.contest.remainingTime.hours;
                _this.minutes = response.data.contest.remainingTime.minutes;
                _this.seconds = response.data.contest.remainingTime.seconds;
                _this.problems = response.data.problems;
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
                                 class="p-3.5 rounded-xl bg-primary hover:bg-cyan-700 w-20 text-center text-base-200 font-semibold transition shadow-xl">FINISH</router-link>
                </span>
            </div>
        </div>
  
        <div class="divider my-2"></div>
        <div role="tablist" class="tabs tabs-bordered w-full">
            <ContestProblemTab v-for="(problem, index) in problems"
                               :name="'code-tab'" :index="index"
                               :contestId="this.$route.params.c_id"
                               :problemId="problem.id"
                               :tabName="'Problem'"></ContestProblemTab>
        </div>

    </div>
</template>

<style scoped>

</style>
