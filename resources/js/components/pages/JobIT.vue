<template>
    <div>
        <h1 class="text-2xl font-bold border-b">Job IT</h1>
        <h1 class="text-xl font-semibold my-3">Search for job...</h1>
        <div class="w-full">
            <Search :allItems="this.listJob"></Search>
        </div>

        <div role="tablist" class="tabs tabs-lifted tabs-lg mt-3">
            <input type="radio" name="tab" role="tab" class="tab" aria-label="All" checked="checked" />
            <div role="tabpanel" class="tab-content p-10">

            </div>

            <input type="radio" name="tab" role="tab" class="tab" aria-label="Job" />
            <div role="tabpanel" class="tab-content p-10">
                <h2 v-if="this.$route.params.keyword" class="font-semibold text-sm md:text-md lg:text-xl">Result keyword
                    search: {{ this.keyword }}</h2>
                <h2 class="font-semibold text-sm">Number of jobs: {{ this.listFilterJob.length }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <Job v-for="job in this.listFilterJob" :key="job.id" :job="job">

                    </Job>
               </div>  
            </div>

            <input type="radio" name="tab" role="tab" class="tab" aria-label="Company" />
            <div role="tabpanel" class="tab-content p-10">
                <h2 class="font-semibold text-sm">Number of companies recruitment: {{ this.listCompany.length }}</h2>
            </div>
        </div>

    </div>
</template>
<script>
import { HTTP } from "@/http-common.js";
import Job from "@/components/cards/Job.vue";
import Search from "@/components/search/Search.vue";
import { fi } from "date-fns/locale";
export default {
    name: "JobIT",
    components: { Search,Job },
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
        const urlSegments = window.location.href.split('/');
        this.keyword = urlSegments[urlSegments.length - 1] === 'job-it' ? null : urlSegments.pop();
        this.filterCompanyByKeyword();
        console.log("after filter ", this.listFilterJob);
    },
    methods: {
        async fetchData() {
            await HTTP.get('/api/listCompanyHiring')
                .then(response => {
                    console.log("cong ty: ", response.data);
                    this.listCompany = response.data.companies;
                    this.listJob = response.data.jobs;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        filterCompanyByKeyword() {
            console.log("cai dmm:",this.keyword);
            if (this.keyword) {
                this.listFilterJob = this.listJob.filter(item =>
                    item.title.toLowerCase().includes(this.keyword)
                    || item.location.toLowerCase().includes(this.keyword)
                    || item.salary.toString().includes(this.keyword)
                    || JSON.parse(item.skill.replace(/'/g, '"')).some((skill) => skill.toLowerCase().includes(this.keyword))
                );
            }
            else {
                this.listFilterJob = this.listJob;
            }
        }
    }
}
</script>
<style></style>