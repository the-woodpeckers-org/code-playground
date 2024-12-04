<script>
import { HTTP } from "@/http-common.js";
import CardSkeleton from "@/components/loading/CardSkeleton.vue";
import Problem from "@/components/listItems/Problem.vue";
import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "Problems",
    data() {
        return {
            problems: [],
            categories: [""]
        };
    },
    components: {
        Problem,
        CardSkeleton,
    },
    async mounted() {
      await  this.getProblems();
      await this.getCategories();
    },
    methods: {
     async getProblems() {
        let _this = this
        let _url = '/api/problem'
        if (getAuth()) {
            _url = '/api/problem/u'
        }
        await 
            HTTP.get(_url)
                .then(function (response) {
                    _this.problems = response.data.data
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error)
                }),
             _this.loading = true
        },
        async getCategories() {
            await HTTP
                .get("/api/getProblemTags")
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
}
</script>

<template>
    <div class="text-center">
        <div class="grid grid-cols-1 md:flex md:flex-row  md:flex-wrap  md:justify-center">
            <div class="m-3" v-for="(item, index) in this.categories" :key="index">
                <router-link >
                    <button class="btn bg-gray-300 text-gray-900 h-8">
                        {{ item.category_name }}
                        <div class="badge">{{ item.count }}</div>
                    </button>
                </router-link>
            </div>
        </div>
        <div class="mt-3"></div>
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
    </div>
</template>

<style scoped></style>
