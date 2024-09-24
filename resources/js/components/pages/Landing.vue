<script>
import Problem from "@/components/listItems/Problem.vue";
import CenteredSpinner from "@/components/loading/CenteredSpinner.vue";
import ProblemSkeleton from "@/components/loading/ProblemSkeleton.vue";
import Contest from "@/components/cards/Contest.vue";
import InterviewKit from "@/components/cards/InterviewKit.vue";
import Course from "@/components/cards/Course.vue";
import Ranking from "@/components/listItems/Ranking.vue";
import NewsSection from "@/components/listItems/NewsSection.vue";

export default {
    name: "ProblemList",
    components: {NewsSection, Ranking, InterviewKit, Course, Contest, ProblemSkeleton, CenteredSpinner, Problem},
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

<template>
    <div class="w-full mt-2">
        <div class="mx-3 my-6">
            <h1 class="text-2xl mb-3 font-bold">See what is happening!</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <NewsSection></NewsSection>
                <Ranking></Ranking>
            </div>
        </div>
        <div class="mt-6 border-b"></div>
        <div class="mx-3 my-6">
            <h1 class="text-2xl mb-3 font-bold">Available Contests</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <Contest :days="2" :hours="1" :minutes="0" :seconds="1"
                         :imgUrl="'https://idx.edu.vn/wp-content/uploads/2023/04/logo-idx.png'"
                         :title="'HUIT iDX Annual Faculty-Level Programming Competition #21'"></Contest>
                <Contest :days="3" :hours="7" :minutes="11" :seconds="31"
                         :imgUrl="'https://viettel.com.vn/media/viettel/original_images/Viettel_logo_2021.png'"
                         :title="'Viettel Group Coda-A-Thon Celebrate 5yrs Anniversary 2024'"></Contest>
                <Contest :days="0" :hours="13" :minutes="23" :seconds="46"
                         :imgUrl="'https://www.vinasa.org.vn/SiteFolders/vinasa-en/393/cmcglobal.jpg'"
                         :title="'CMC GLOBAL ProjectEuler+ 2024'"></Contest>
                <span class="w-full text-center col-span-full"><router-link
                    class="btn rounded-3xl bg-primary hover:bg-cyan-700 text-white text-lg" to="/contests"><i
                    class="fa-solid fa-arrow-right"></i>SEE MORE</router-link></span>
            </div>
            <div class="mt-6 border-b"></div>
            <h1 class="text-2xl my-6 font-bold">Interview Preparation Kit</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <InterviewKit :title="'Top 150 Companies Interview'"
                              :description="'See the Google, Microsoft, Apple and many more company\'s interview...'"
                              :imgUrl="'https://waya.media/wp-content/uploads/sites/3/2022/05/banner-01.png'"></InterviewKit>
                <InterviewKit :title="'CodePlayground Top 50'"
                              :description="'Check CodePlayground Top 50 Problems Set. Change your mindset and improve your problem solving skill!'"
                              :imgUrl="'https://searchengineland.com/wp-content/seloads/2020/03/code-SS_634574354-1920x1080-1.jpg'"></InterviewKit>
                <InterviewKit :title="'Amazon Spring \'23 High Frequency'"
                              :description="'See the Google, Microsoft, Apple and many more company\'s interview...'"
                              :imgUrl="'https://static.vecteezy.com/system/resources/previews/019/766/240/non_2x/amazon-logo-amazon-icon-transparent-free-png.png'"></InterviewKit>
                <span class="w-full text-center col-span-full"><router-link
                    class="btn rounded-3xl bg-primary hover:bg-cyan-700 text-white text-lg" to=""><i
                    class="fa-solid fa-arrow-right"></i>SEE MORE</router-link></span>
            </div>
            <div class="mt-6 border-b"></div>
        </div>
        <div class="mx-3 my-6">
            <h1 class="text-2xl mb-3 font-bold">Courses</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <Course :title="'Basic Data Structures & Algorithms'"
                        :description="'Familiarize yourself with common data structures and algorithms such as lists, trees, maps, graphs, Big-O analysis, and more!'"
                        :imgUrl="'https://www.synergisticit.com/wp-content/uploads/2020/09/Data-structures-and-algorithms-new.webp'"></Course>
                <Course :title="'The Road to Python'"
                        :description="'An experienced programmer in any programming language (whatever it may be) can pick up Python very quickly. It\'s also easy for beginners to use and learn!'"
                        :imgUrl="'https://kama-software.com/wp-content/uploads/2022/11/cac-ky-nang-cua-mot-python-developer.jpg'"></Course>
                <Course :title="'C++ Introductory Course'"
                        :description="'Introductory course for beginners who want to approach C++, a high-performance and general-purpose programming language!'"
                        :imgUrl="'https://giaiphapso.com/wp-content/uploads/2021/08/cplusplus.png'"></Course>
                <span class="w-full text-center col-span-full"><router-link
                    class="btn rounded-3xl bg-primary hover:bg-cyan-700 text-white text-lg" to="/courses"><i
                    class="fa-solid fa-arrow-right"></i>SEE MORE</router-link></span>
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
