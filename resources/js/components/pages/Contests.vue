<script>
import Contest from "@/components/cards/Contest.vue";
import { HTTP } from "@/http-common.js";
import Ranking from "@/components/listItems/Ranking.vue";
export default {
    name: "ContestPage",
    components: {
        Contest, Ranking
    },
    data() {
        return {
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
            await HTTP.get('api/contest/landing')
                .then(response => {
                    _this.contests = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    window.location.reload();
                })
            _this.loading = true
        }
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
                    Code Playground is a platform for developers to showcase their skills and get hired by top tech
                    companies.
                </p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <h2 class="text-2xl text-gray-950 font-semibold">The contests is taking place</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <Contest v-for="contest in contests" :key="contest.id" :title="contest.title" :contestId="contest.id"
                :p_Days="contest.remainingTime.days" :p_Hours="contest.remainingTime.hours"
                :p_Minutes="contest.remainingTime.minutes" :p_Seconds="contest.remainingTime.seconds"
                :imgUrl="contest.imgUrl"></Contest>
        </div>
    </div>
    <div class="mt-3">
        <h2 class="text-2xl text-gray-950 font-semibold">Featured Contests</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <Contest v-for="contest in contests" :key="contest.id" :title="contest.title" :contestId="contest.id"
                :p_Days="contest.remainingTime.days" :p_Hours="contest.remainingTime.hours"
                :p_Minutes="contest.remainingTime.minutes" :p_Seconds="contest.remainingTime.seconds"
                :imgUrl="contest.imgUrl"></Contest>
        </div>
    </div>
    <div class="w-full mt-2 p-3">
        <div class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 gap-2">
            <div class="col-span-8 bg-base-100">
                <div class="flex mb-4 p-3">
                    <button v-for="(tab, index) in tabs" :key="index"
                        :class="['tab-btn bg-slate-700', activeTab === index ? 'tab-active' : '']"
                        @click="activeTab = index">
                        {{ tab }}
                    </button>
                </div>

                <div v-show="activeTab === 0" class="p-2">
                    <h3 class="text-lg font-semibold">Past Contests</h3>
                    <p class="text-gray-600">View the contests that have already ended.</p>
                    <div class="grid grid-cols-1">

                    </div>
                </div>

                <div v-show="activeTab === 1" class="p-2">
                    <h3 class="text-lg font-semibold">My Contests</h3>
                    <p class="text-gray-600">View contests that you are currently participating in.</p>
                    <div class="grid grid-cols-1">
                    </div>
                </div>
            </div>

            <div class="col-span-4 bg-base-100">
                <Ranking></Ranking>
            </div>
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
