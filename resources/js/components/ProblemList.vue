<template>
    <div class="w-full mt-2">
        <div class="mx-3 border-b">
            <h1 class="text-xl font-bold">Interview Preparation Kit</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                <div class="card bg-base-200 shadow-xl my-1 mx-2 text-sm hover:bg-gray-200 transition">
                    <figure class="h-40">
                        <img
                            src="https://waya.media/wp-content/uploads/sites/3/2022/05/banner-01.png"
                            alt="car!"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Top 150 Companies Interview</h2>
                        <p  >See the Google, Microsoft, Apple and many more company's interview...</p>
                    </div>
                </div>
                <div class="card bg-base-200 shadow-xl my-1 mx-2 text-sm hover:bg-gray-200 transition">
                    <figure class="h-40">
                        <img
                            src="https://searchengineland.com/wp-content/seloads/2020/03/code-SS_634574354-1920x1080-1.jpg"
                            alt="car!" class="object-scale-down"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">CodePlayground Top 50</h2>
                        <p>Check CodePlayground Top 50 Problems Set. Change your mindset and improve your problem solving skill!</p>
                    </div>
                </div>
                <div class="card bg-base-200 shadow-xl my-1 mx-2 text-sm hover:bg-gray-200 transition">
                    <figure class="h-40">
                        <img
                            src="https://static.vecteezy.com/system/resources/previews/019/766/240/non_2x/amazon-logo-amazon-icon-transparent-free-png.png"
                            alt="car!" class="object-contain"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Amazon Spring '23 High Frequency</h2>
                        <p>A ma zôn hê hê bôi :D &#128557</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-3 border-b">
            <h1 class="text-xl font-bold">Courses</h1>

        </div>
        <div class="mx-3">
            <h1 class="text-xl font-bold">Problem Set</h1>
        </div>
        <div class="grid grid-cols-6 mx-3 p-1 rounded-md h-9 border-b">
            <span>Status</span>
            <span class="col-span-2">Title</span>
            <span>Difficulty</span>
            <span>Acceptance</span>
            <span>Tags</span>
        </div>
        <ProblemSkeleton v-if="!loading" v-for="index in 16" :key="index"></ProblemSkeleton>
        <Problem v-if="loading" v-for="problem in this.problems" :problem="problem"></Problem>
    </div>
</template>

<script>
import Problem from "@/components/Problem.vue";
import CenteredSpinner from "@/components/loading/CenteredSpinner.vue";
import ProblemSkeleton from "@/components/loading/ProblemSkeleton.vue";

export default {
    name: "ProblemList",
    components: {ProblemSkeleton, CenteredSpinner, Problem},
    data: function () {
        return {
            problems: Array,
            loading: false
        }
    },
    async created() {
        let _this = this
        setTimeout(async () => {
            await axios.get('/api/getProblems')
                .then(function (response) {
                    _this.problems = response.data.data
                    _this.loading = true
                    console.log(_this.problems)
                })
                .catch(function (error) {
                    alert(error)
                })
        }, 1000)

    }
}
</script>
