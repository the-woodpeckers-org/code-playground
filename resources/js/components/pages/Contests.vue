<script>
import Contest from "@/components/cards/Contest.vue";
import { HTTP } from "@/http-common.js";
import Ranking from "@/components/listItems/Ranking.vue";
import { getAuth } from "@/utils/authLocalStorage.js";
export default {
    name: "ContestPage",
    components: {
        Contest, Ranking
    },
    data() {
        return {
            auth: getAuth(),
            contestRunning: [],
            contests: [],
            pastContests: [],
            myContests: [],
            contestFuture: [],
            activeTab: 0,
            tabs: ["Past Contests", "My Contests"]
        }
    },
    async mounted() {
        await this.getContests()
    },
    methods: {
        async getContests() {
            let _this = this
            await HTTP.get('/api/combinationContest')
                .then(response => {
                    console.log(response.data)
                    _this.pastContests = response.data.data.pastContests
                    _this.contestFuture = response.data.data.contestFuture
                    _this.contestRunning = response.data.data.contestRunning
                })
                .catch(error => {
                    window.location.reload();
                })
            _this.loading = true
        },
    }

}
</script>

<template>

    <div class="hero h-[300px] bg-base-200"
        style="background-image: url(https://img.freepik.com/premium-vector/winner-background-with-signs-first-second-third-place-round-pedestal-vector-winner_220217-4391.jpg);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-extrabold text-gray-50">Hello there</h1>
                <p class="mb-5 font-semibold text-balance text-gray-50">
                    Code Playground is providing the best competitions to compete. Break your limits!
                </p>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <h2 class="text-2xl text-gray-950 font-semibold">The contests is taking place</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <Contest v-for="contest in contestRunning" :key="contest.id" :title="contest.title" :contestId="contest.id"
                :p_Days="contest.remainingTime.days" :p_Hours="contest.remainingTime.hours"
                :p_Minutes="contest.remainingTime.minutes" :p_Seconds="contest.remainingTime.seconds"
                :imgUrl="contest.imgUrl"></Contest>
        </div>
    </div>
    <div class="mt-3">
        <h2 class="text-2xl text-gray-950 font-semibold">Featured Contests</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <Contest v-for="contest in contestFuture" :key="contest.id" :title="contest.title" :contestId="contest.id"
                :p_Days="contest.startTime.days" :p_Hours="contest.startTime.hours" :p_Minutes="contest.startTime.minutes" :p_Seconds="contest.startTime.seconds" :imgUrl="contest.imgUrl" :statusContest="'future'"></Contest>
        </div>
    </div>
</template>

<style scoped>
.tab-btn {
    padding: 10px 20px;
    margin-right: 10px;
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
}

.tab-btn:hover {
    background-color: #e2e2e2;
}

.tab-active {
    background-color: rgb(51, 165, 227);
    ;
    color: white;
    border-color: rgb(51, 165, 227);
    ;
}
</style>
