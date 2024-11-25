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
                    class="border rounded-xl h-40 w-96 my-2 mx-3 p-3 bg-gradient-to-tr from-pink-300 to-green-300 bg-size-200 transition-all hover:bg-pos-100 bg-pos-0 transition-all hover:scale-105 duration-300">
                    <i class="fa-solid fa-wand-magic-sparkles text-3xl text-orange-500 border bg-base-200 p-1 rounded-xl shadow-xl"></i>
                    <h1 class="text-xl font-semibold">Specialize your CV</h1>
                    <p>Making your CV to be the special & unique Developer CV!</p>
                </div>
            </router-link>
            <router-link to="">
                <div
                    class="border rounded-xl h-40 w-96 my-2 mx-3 p-3 bg-gradient-to-tr from-purple-300 to-amber-300 bg-size-200 transition-all hover:bg-pos-100 bg-pos-0 transition-all hover:scale-105 duration-300">
                    <i class="fa-solid fa-face-smile text-3xl text-orange-500 border bg-base-200 p-1 rounded-xl shadow-xl"></i>
                    <h1 class="text-xl font-semibold">Test your personalities</h1>
                    <p>Explore suitable jobs through your personalities!</p>
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
            <Job :imgUrl="'https://maychufpt.com.vn/wp-content/uploads/2022/05/hosting-fpt.png'"
                 :title="'Project Manager'" :companyName="'FPT Software'" :description="'Up to 3500$'" :url="'/Job-detail/1'"></Job>
            <Job :imgUrl="'https://ircdn.vingroup.net/storage/Public/VinHMS%20Logo.png'"
                 :title="'Senior Angular Developer'" :companyName="'VinHMS'" :description="'Up to 3000$'" :url="'/Job-detail/1'"></Job>
            <Job :imgUrl="'https://baan.vn/wp-content/uploads/2023/07/RICONS-01-1.png'"
                 :title="'QA/QC'" :companyName="'Ricons Construction'" :description="'Up to 6000$'" :url="'/Job-detail/1'"></Job>
            <Job :imgUrl="'https://www.techsoup.org/SiteCollectionImages/Product/prod-adobe-logo.png'"
                 :title="'Junior Front-end Developer'" :companyName="'Adobe Vietnam'" :description="'Up to 1500$'" :url="'/Job-detail/1'"></Job>
            <Job :imgUrl="'https://play-lh.googleusercontent.com/XEReFv_aetLFZq2VCYEUF6cMeHLwJ3eM_WMcjucGKwdKPm8ob1_ghAdltlMwnHMEsQk'"
                 :title="'PHP Developer'" :companyName="'Báo điện tử VnExpress'" :description="'Up to 2000$'" :url="'#'"></Job>
            <Job :imgUrl="'https://cdn.tuoitre.vn/thumb_w/600/471584752817336320/2023/2/23/29229888323456029822604684420721366064172575n-16771238637691533081421.jpg'"
                 :title="'QA/QC'" :companyName="'Vietcombank'" :description="'Up to 3000$'" :url="'#'"></Job>
        </div>
    </div>
</template>

<style scoped>

</style>
