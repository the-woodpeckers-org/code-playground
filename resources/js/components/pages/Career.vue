<script>
import BaseCard from "@/components/cards/BaseCard.vue";
import Company from "@/components/cards/Company.vue";
import Job from "@/components/cards/Job.vue";
import LoginRequiredDialog from "@/components/authentication/LoginRequiredDialog.vue";
import {HTTP} from "@/http-common.js";
export default {
    name: "Careers",
    components: {LoginRequiredDialog, Job, Company, BaseCard},
    data() {
        return {
            searchQuery: "",
            allItems: [],
            filteredSuggestions: [],
            listCompany: [],
            listJob: []
        };
    },
   async mounted() {
        await this.fetchData();
    },  
    methods: {
       async fetchData()
        {
            await HTTP.get('/api/listCompanyHiring')
                .then(response => {
                    console.log("cong ty: ",response.data);
                    this.listCompany = response.data.companies;
                    this.listJob = response.data.jobs;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }

}
</script>

<template>
    <LoginRequiredDialog></LoginRequiredDialog>
    <div>
        <h1 class="text-2xl font-bold border-b">Career</h1>
        <h1 class="text-xl font-semibold my-3">Search for job...</h1>
        <div class="flex gap-2">
            <input type="text" class="input h-14 shadow-xl w-full"
                   placeholder="React, Flutter, Laravel, Team Leader, Front-end,...">
            <button class="w-32 rounded-2xl bg-teal-200 hover:bg-teal-300 transition shadow-xl"><span class="font-bold">Search</span>
            </button>
        </div>
        <h1 class="my-3">Suggested keywords: </h1>
        <div class="flex flex-row flex-wrap">
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">PHP</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Laravel</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">React</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Vue.js</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Typescript</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Angular</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Ruby on Rails</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Golang</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">React Native</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Flutter</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Javascript</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Technical Leader</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">Project Manager</a>
            <a href="#" class="p-3 border rounded-sm bg-base-100 m-1">QA/QC</a>
        </div>
        <h1 class="text-xl font-semibold my-3">Let's "level-up" your profile! &#127775;</h1>
        <div class="flex flex-row flex-wrap justify-center">
            <router-link to="/ProfileCV">
                <div
                    class="border rounded-xl h-40 w-96 my-2 mx-3 p-3 bg-gradient-to-tr from-cyan-300 to-purple-300 bg-size-200 transition-all hover:bg-pos-100 bg-pos-0 transition-all hover:scale-105 duration-300">
                    <i class="fa-solid fa-file-pen text-3xl text-orange-500 border bg-base-200 p-1 rounded-xl shadow-xl"></i>
                    <h1 class="text-xl font-semibold">Start build your CV now</h1>
                    <p>Our powerful CV Builder will help you create beautiful CV</p>
                </div>
            </router-link>
           
            <router-link to="">
                <div
                    class="border rounded-xl h-40 w-96 my-2 mx-3 p-3 bg-gradient-to-tr from-lime-300 to-violet-300 bg-size-200 transition-all hover:bg-pos-100 bg-pos-0 transition-all hover:scale-105 duration-300">
                    <i class="fa-solid fa-keyboard text-3xl text-orange-500 border bg-base-200 p-1 rounded-xl shadow-xl"></i>
                    <h1 class="text-xl font-semibold">Internship Opportunities</h1>
                    <p>Earn an internship allowance throughout the program.</p>
                </div>
            </router-link>
            <router-link to="">
                <div
                    class="border rounded-xl h-40 w-96 my-2 mx-3 p-3 bg-gradient-to-tr from-cyan-300 to-lime-300 bg-size-200 transition-all hover:bg-pos-100 bg-pos-0 transition-all hover:scale-105 duration-300">
                    <i class="fa-solid fa-comments text-3xl text-orange-500 border bg-base-200 p-1 rounded-xl shadow-xl"></i>
                    <h1 class="text-xl font-semibold">Interview Questions</h1>
                    <p>Learn interview techniques for job success.</p>
                </div>
            </router-link>
        </div>
        <h1 class="text-xl font-semibold my-3">Top Hiring Companies</h1>
        <div class="flex flex-row flex-wrap justify-center">
            <Company v-for="(item, index) in this.listCompany" :key="index"
                :imgUrl="item.userCompany.avatar_url"
                :title="item.userCompany.name"
                :description="item.profileCompany.description"
                :url="'/View-Company/' + item.profileCompany.id"
                :slot="item.jobRecruitments.length"
            ></Company>
        </div>
        <h1 class="text-xl font-semibold my-3">Available jobs based on your skills</h1>
        <div class="flex flex-row flex-wrap justify-center">
            <Job v-for="(item, index) in this.listJob " :key="index" :imgUrl="item.company.avatar_url"
                 :title="item.title" :companyName="item.company.name" :salary="item.salary" :url="'/Job-detail/'+item.id"></Job>
        </div>
    </div>
</template>

<style scoped>

</style>
