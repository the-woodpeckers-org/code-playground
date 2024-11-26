<template>
    <div>
        <h1 class="text-2xl font-bold border-b">Job IT</h1>
        <h1 class="text-xl font-semibold my-3">Search for job...</h1>
        <div class="w-full">
            <Search :allItems="this.listJob" :@selected="selected"></Search>
        </div>
        <div role="tablist" class="tabs tabs-lifted tabs-lg mt-3" v-if="this.$route.params.keyword">
            <input type="radio" name="tab" role="tab" class="tab" aria-label="Job" checked="checked"/>
            <div role="tabpanel" class="tab-content p-10">
                <h2 class="font-semibold text-sm md:text-xl lg:text-xl">Result keyword
                    search: {{ this.keyword }}</h2>
                <h2 class="font-semibold text-sm md:text-md lg:text-xl">Number of jobs: {{ this.listFilterJob.length }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <Job v-for="(item, index)  in this.listFilterJob" :key="index" :imgUrl="item.company.avatar_url"
                        :title="item.title" :companyName="item.company.name" :salary="item.salary"
                        :url="'/Job-detail/' + item.id">
                    </Job>
                </div>
            </div>

            <input type="radio" name="tab" role="tab" class="tab" aria-label="Company" />
            <div role="tabpanel" class="tab-content p-10">
                <h2 class="font-semibold text-sm md:text-md lg:text-xl">Number of companies recruitment: {{ this.listFilterCompany.length }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <Company v-for="(item, index) in this.listFilterCompany" :key="index"
                        :imgUrl="item.userCompany.avatar_url" :title="item.userCompany.name"
                        :description="item.profileCompany.description" :url="'/View-Company/' + item.profileCompany.id"
                        :slot="item.jobRecruitments.length"></Company>
                </div>
            </div>
        </div>

        <div v-else>
            <h1 class="text-xl font-semibold my-3">Available jobs</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <Job v-for="(item, index)  in this.listFilterJob" :key="index" :imgUrl="item.company.avatar_url"
                        :title="item.title" :companyName="item.company.name" :salary="item.salary"
                        :url="'/Job-detail/' + item.id">
                    </Job>
                </div> 
                <h1 class="text-xl font-semibold my-3">Top Hiring Companies</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <Company v-for="(item, index) in this.listFilterCompany" :key="index"
                        :imgUrl="item.userCompany.avatar_url" :title="item.userCompany.name"
                        :description="item.profileCompany.description" :url="'/View-Company/' + item.profileCompany.id"
                        :slot="item.jobRecruitments.length"></Company>
                </div>
        </div>
    </div>
</template>
<script>
import { HTTP } from "@/http-common.js";
import Job from "@/components/cards/Job.vue";
import Company from "@/components/cards/Company.vue";
import Search from "@/components/search/Search.vue";
export default {
    name: "JobIT",
    components: { Search, Job, Company },
    data() {
        return {
            searchQuery: "",
            allItems: [],
            filteredSuggestions: [],
            listCompany: [],
            listJob: [],
            keyword: null,
            listFilterCompany: [],
            listFilterJob: []
        };
    },
    async mounted() {
        await this.fetchData();
        this.filterCompanyByKeyword();
    },
    methods: {
        async fetchData() {
            await HTTP.get('/api/listCompanyHiring')
                .then(response => {
                    this.listCompany = response.data.companies;
                    this.listJob = response.data.jobs;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        filterCompanyByKeyword() {
            const urlSegments = window.location.href.split('/');
            const lastSegment = urlSegments[urlSegments.length - 1];
            this.keyword = lastSegment === 'job-it' ? null : decodeURIComponent(lastSegment);
            console.log("keyword: ", this.keyword);
            this.keyword = this.keyword.toLowerCase();
            if (this.keyword) {
                this.listFilterJob = this.listJob.filter(item =>
                    item.title.toLowerCase().includes(this.keyword)
                    || item.location.toLowerCase().includes(this.keyword)
                    || item.salary.toString().includes(this.keyword)
                    || JSON.parse(item.skill.replace(/'/g, '"')).some((skill) => skill.toLowerCase().includes(this.keyword))
                );
                console.log("company:", this.listCompany);
                console.log("job: ", this.listFilterJob);
                this.listFilterCompany = this.listCompany.filter(company =>
                    this.listFilterJob.some(job => job.company.id === company.userCompany.id)
                );
                console.log("After filter:", this.listFilterCompany);
            }
            else {
                this.listFilterJob = this.listJob;
                this.listFilterCompany = this.listCompany;
            }
        },
        // selected(item) {
        //     const encodedKeyword = encodeURIComponent(this.searchQuery);
        //     this.$router.push({ name: 'job-it', params: { keyword: encodedKeyword } });
        // }
    },
    watch: {
    '$route.params.keyword': {
        handler(newKeyword) {
        this.keyword = newKeyword;
        this.filterCompanyByKeyword();
        },
        immediate: true
    }
    }
}
</script>
<style></style>