<template>
    <div class="w-full mt-2">
        <div class="mx-3 my-6">
            <h1 class="text-2xl mb-3 font-bold">Available Contests</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <Contest :days="2" :hours="1" :minutes="0" :seconds="1" :imgUrl="'https://idx.edu.vn/wp-content/uploads/2023/04/logo-idx.png'" :title="'HUIT iDX Annual Faculty-Level Programming Competition #21'"></Contest>
                <Contest :days="3" :hours="7" :minutes="11" :seconds="31" :imgUrl="'https://viettel.com.vn/media/viettel/original_images/Viettel_logo_2021.png'" :title="'Viettel Group Coda-A-Thon Celebrate 5yrs Anniversary 2024'"></Contest>
                <Contest :days="0" :hours="13" :minutes="23" :seconds="46" :imgUrl="'https://www.vinasa.org.vn/SiteFolders/vinasa-en/393/cmcglobal.jpg'" :title="'CMC GLOBAL ProjectEuler+ 2024'"></Contest>
            </div>
            <div class="mt-6 border-b"></div>
            <h1 class="text-2xl my-6 font-bold">Interview Preparation Kit</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition">
                    <figure class="h-40">
                        <img
                            src="https://waya.media/wp-content/uploads/sites/3/2022/05/banner-01.png"
                            alt="car!"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Top 150 Companies Interview</h2>
                        <p  >See the Google, Microsoft, Apple and many more company's interview...</p>
                    </div>
                </router-link>
                <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition">
                    <figure class="h-40">
                        <img
                            src="https://searchengineland.com/wp-content/seloads/2020/03/code-SS_634574354-1920x1080-1.jpg"
                            alt="car!" class="object-scale-down"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">CodePlayground Top 50</h2>
                        <p>Check CodePlayground Top 50 Problems Set. Change your mindset and improve your problem solving skill!</p>
                    </div>
                </router-link>
                <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition">
                    <figure class="h-40">
                        <img
                            src="https://static.vecteezy.com/system/resources/previews/019/766/240/non_2x/amazon-logo-amazon-icon-transparent-free-png.png"
                            alt="car!" class="object-contain"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Amazon Spring '23 High Frequency</h2>
                        <p></p>
                    </div>
                </router-link>
            </div>
            <div class="mt-6 border-b"></div>
        </div>
        <div class="mx-3 my-6">
            <h1 class="text-2xl mb-3 font-bold">Courses</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition">
                    <figure class="h-40">
                        <img
                            src="https://www.synergisticit.com/wp-content/uploads/2020/09/Data-structures-and-algorithms-new.webp"
                            alt="car!"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Basic Data Structures & Algoritms</h2>
                        <p>Familiarize yourself with common data structures and algorithms such as lists, trees, maps, graphs, Big-O analysis, and more!</p>
                    </div>
                </router-link>
                <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition">
                    <figure class="h-40">
                        <img
                            src="https://giaiphapso.com/wp-content/uploads/2021/08/cplusplus.png"
                            alt="car!" class="object-scale-down"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">C++ Introductory Course</h2>
                        <p>Introductory course for beginners who want to approach C++, a high-performance and general-purpose programming language!</p>
                    </div>
                </router-link>
                <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition">
                    <figure class="h-40">
                        <img
                            src="https://kama-software.com/wp-content/uploads/2022/11/cac-ky-nang-cua-mot-python-developer.jpg"
                            alt="car!" class="object-contain"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">The Road to Python</h2>
                        <p>An experienced programmer in any programming language (whatever it may be) can pick up Python very quickly. It's also easy for beginners to use and learn!</p>
                    </div>
                </router-link>
            </div>
            <div class="mt-6 border-b"></div>
        </div>
        <div class="mx-3">
            <h1 class="text-2xl font-bold">Problem Set</h1>
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
import Contest from "@/components/cards/Contest.vue";

export default {
    name: "ProblemList",
    components: {Contest, ProblemSkeleton, CenteredSpinner, Problem},
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
