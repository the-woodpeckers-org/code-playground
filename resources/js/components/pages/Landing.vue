<script>
import Problem from "@/components/listItems/Problem.vue";
import CenteredSpinner from "@/components/loading/CenteredSpinner.vue";
import ProblemSkeleton from "@/components/loading/ProblemSkeleton.vue";
import Contest from "@/components/cards/Contest.vue";
import InterviewKit from "@/components/cards/InterviewKit.vue";
import Course from "@/components/cards/Course.vue";
import Ranking from "@/components/listItems/Ranking.vue";
import NewsSection from "@/components/listItems/NewsSection.vue";
import CardSkeleton from "@/components/loading/CardSkeleton.vue";
import {HTTP} from "@/http-common.js";
import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "ProblemList",
    components: {
        CardSkeleton,
        NewsSection, Ranking, InterviewKit, Course, Contest, ProblemSkeleton, CenteredSpinner, Problem
    },
    data: function () {
        return {
            problems: [],
            contests: [],
            loading: false
        }
    },
    async mounted() {
        let _this = this
        let _url = '/api/problem'
        if (getAuth()) {
            _url = '/api/problem/u'
        }
        await Promise.all([
            HTTP.get(_url)
                .then(function (response) {
                    _this.problems = response.data.data
                })
                .catch(function (error) {
                }),
            HTTP.get('api/contest/landing')
                .then(response => {
                    console.log("rs", response);
                    _this.contests = response.data;
                })
                .catch(error => {
                    window.location.reload();
                })
        ]);
        _this.loading = true
    }
}
</script>

<template>
    <div>
        <div class="my-6">
            <h1 class="text-2xl mb-3 font-bold">See what is happening!</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <NewsSection></NewsSection>
                <Ranking></Ranking>
            </div>
        </div>
        <div class="mt-6 border-b"></div>
        <div class="my-6">
            <h1 class="text-2xl mb-3 font-bold">Available Contests</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <CardSkeleton v-if="!loading" v-for="i in 3"></CardSkeleton>
                <Contest v-if="loading" v-for="contest in contests"
                         :p_Days="contest.remainingTime.days"
                         :p_Hours="contest.remainingTime.hours"
                         :p_Minutes="contest.remainingTime.minutes"
                         :p_Seconds="contest.remainingTime.seconds"
                         :contestId="contest.id"
                         :title="contest.title"
                         :imgUrl="contest.imgUrl"
                ></Contest>
                <span class="w-full text-center col-span-full"><router-link
                    class="btn rounded-3xl bg-primary hover:bg-cyan-700 text-white text-lg" to="/contests"><i
                    class="fa-solid fa-arrow-right"></i>SEE MORE</router-link></span>
            </div>
            <div class="mt-6 border-b"></div>
        </div>
        <div class="my-6">
            <h1 class="text-2xl font-bold">Problem Set</h1>
            <div class="grid grid-cols-6 mx-3 p-1 rounded-md h-9 border-b">
                <span>Status</span>
                <span class="col-span-2">Title</span>
                <span>Difficulty</span>
                <span>Acceptance</span>
                <span>Tags</span>
            </div>

        </div>
        <ProblemSkeleton v-if="!loading" v-for="index in 16" :key="index"></ProblemSkeleton>
        <Problem v-if="loading" v-for="problem in this.problems" :problem="problem"></Problem>
        <div class="w-full text-center col-span-full my-6">
            <span><router-link
                class="btn rounded-3xl bg-primary hover:bg-cyan-700 text-white text-lg" to="/problems"><i
                class="fa-solid fa-arrow-right"></i>SEE MORE</router-link></span>
        </div>
    </div>
</template>
