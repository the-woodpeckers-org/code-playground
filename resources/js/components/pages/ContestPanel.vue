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
            isLoaded: false,
            isModalClosing: false,
            participationId: 0,
            finishedProblemCount: 0,
            totalProblem: -1,
            contestId: -1,
        }
    },
    methods: {
        updateFinishedProblemCount(val) {
            this.finishedProblemCount++;
        },
        async finish() {
            let _this = this;
            HTTP.post('/api/participate/finish', {
                id: _this.participationId,
                finishedProblems: _this.finishedProblemCount
            })
                .then(response => {
                    _this.$router.push('/contest/' + _this.contestId + '/result/');
                })
                .catch(error => {
                })
        }
    },
    mounted() {
        let _this = this;
        HTTP.get('/api/participate?id=' + _this.$route.params.c_id)
            .then(response => {
                _this.title = response.data.contest.title;
                _this.days = response.data.contest.remainingTime.days;
                _this.hours = response.data.contest.remainingTime.hours;
                _this.minutes = response.data.contest.remainingTime.minutes;
                _this.seconds = response.data.contest.remainingTime.seconds;
                _this.problems = response.data.problems;
                _this.participationId = response.data.id;
                _this.totalProblem = response.data.problems.length;
                _this.contestId = response.data.contest_id;
                _this.isLoaded = true
            })
            .catch(error => {
            })
    }
}
</script>

<template>
    <dialog id="full_problems" class="modal"
            :class="{ 'modal-open' : finishedProblemCount === totalProblem && !isModalClosing }">
        <div class="modal-box">
            <h3 class="text-lg font-bold"></h3>
            <p class="py-4">You have finished all the problems of this contest. Great performance. Do you want to finish
                now?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm w-16 bg-amber-400 hover:bg-amber-600 transition"
                            @click="finish">Yes
                    </button>
                    <button class="btn btn-sm w-16 bg-amber-400 hover:bg-amber-600 transition"
                            @click="isModalClosing = true">No
                    </button>
                </form>
            </div>
        </div>
    </dialog>
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
                                 class="p-3.5 rounded-xl bg-primary hover:bg-cyan-700 w-20 text-center text-base-200 font-semibold transition shadow-xl"
                                 role="button"
                                 @click="finish">FINISH</router-link>
                </span>
            </div>
        </div>

        <div class="divider my-2"></div>
        <div role="tablist" class="tabs tabs-bordered w-full">
            <ContestProblemTab @problem-passed="updateFinishedProblemCount" v-if="participationId"
                               v-for="(problem, index) in problems"
                               :name="'code-tab'" :index="index"
                               :contestId="this.$route.params.c_id"
                               :problemId="problem.id"
                               :tabName="'Problem'"
                               :participationId="participationId"></ContestProblemTab>
        </div>

    </div>
</template>

<style scoped>

</style>
