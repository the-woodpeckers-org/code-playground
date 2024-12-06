<script>
import {HTTP} from "@/http-common.js";
import CardSkeleton from "@/components/loading/CardSkeleton.vue";
import Problem from "@/components/listItems/Problem.vue";
import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "Problems",
    data() {
        return {
            currentPage: '1',
            links: [],
            problems: [],
            categories: [""],
            searchString: '',
            category: '',
            difficulty: '',
        };
    },
    components: {
        Problem,
        CardSkeleton,
    },
    async mounted() {
        await this.getProblems(1);
        await this.getCategories();
    },
    methods: {
        async onDifficultyChanged(val) {
            this.searchString = this.category = '';
            this.difficulty = val;
            await this.getProblems(1);
        },
        async onSearchStringChanged(val) {
            this.difficulty = this.category = '';
            this.searchString = val;
            await this.getProblems(1);
        },
        async onCategoryChanged(val) {
            this.searchString = this.difficulty = '';
            this.category = val;
            await this.getProblems(1);
        },
        async getProblems(index) {
            let _this = this;
            let _url = '/api/problem/search?';
            if (_this.searchString != '') {
                _url += 'searchString=' + _this.searchString + '&';
            }
            if (_this.category != '') {
                _url += 'category=' + _this.category + '&';
            }
            if (_this.difficulty != '') {
                _url += 'difficulty=' + _this.difficulty + '&';
            }
            console.log(_url);
            await
                HTTP.get(_url + 'page=' + index)
                    .then(function (response) {
                        _this.currentPage = response.data.current_page;
                        _this.problems = response.data.data;
                        _this.links = response.data.links;
                    })
                    .catch(function (error) {
                    });
        },
        async getCategories() {
            await HTTP
                .get("/api/getProblemTags")
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch((error) => {
                });
        },
    },
}
</script>

<template>
    <div class="w-full">
        <div class="w-full mb-6">
            <p class="font-semibold text-xl">Search by name</p>
            <div class="w-full flex justify-between gap-3">
                <input v-model="searchString" class="w-10/12 h-10 border border-gray-300 rounded-md">
                <button class="w-2/12 bg-white border border-gray-300 font-semibold rounded-md h-10" @click="onSearchStringChanged(searchString)">Search</button>
            </div>
        </div>
        <p class="font-semibold text-xl">Topics</p>
        <div class="flex flex-row flex-wrap mb-6">
            <div class="m-1" v-for="(item, index) in categories" :key="index">
                <button class="btn bg-gray-300 text-gray-900 h-8" @click="onCategoryChanged(item.category_id)">
                    {{ item.category_name }}
                    <div class="badge">{{ item.count }}</div>
                </button>
            </div>
            <div class="m-1">
                <button class="btn bg-gray-300 text-gray-900 h-8">
                    All
                </button>
            </div>
        </div>
        <p class="font-semibold text-xl">Difficulty</p>
        <div class="flex flex-row flex-wrap">
            <div class="m-1">
                <button class="btn bg-green-400 text-gray-900 h-8" @click="onDifficultyChanged('Easy')">
                    Easy
                </button>
                <button class="btn bg-yellow-400 text-gray-900 h-8" @click="onDifficultyChanged('Medium')">
                    Medium
                </button>
                <button class="btn bg-red-400 text-gray-900 h-8" @click="onDifficultyChanged('Hard')">
                    Hard
                </button>
                <button class="btn bg-gray-300 text-gray-900 h-8" @click="onDifficultyChanged('')">
                    All
                </button>
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="my-6">
            <div class="grid grid-cols-6 mx-3 p-1 rounded-md h-9 border-b">
                <span>Status</span>
                <span class="col-span-2">Title</span>
                <span>Difficulty</span>
                <span>Acceptance</span>
                <span>Tags</span>
            </div>
        </div>
        <Problem v-for="problem in problems" :problem="problem"></Problem>
        <div class="flex">
            <div class="join mx-auto my-3">
                <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                        :class="{ 'btn-active' : link.label == currentPage}" @click="getProblems(link.label)"><span
                    v-html="link.label"></span></button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
