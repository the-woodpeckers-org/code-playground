<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue'
import JobApplied from '@/components/listItems/JobApplied.vue'
import {HTTP} from '@/http-common.js'
export default {

    components: {
        NavigatorCV,JobApplied
    },
    
    data: function () {
        return {
            jobs: Array
        }
    },
    methods: {
       async getJobsApplied() {
          await  HTTP.get('/api/getJobsApplied')
                .then(response => {
                    console.log(response.data.applications);    
                    this.jobs = response.data.data;
                })
                .catch(e => {
                    console.log(e)
                })
        },
    },
    async mounted() {
      await this.getJobsApplied();
    }
}
</script>
<template lang="">
    <div>
        <NavigatorCV></NavigatorCV>
        <div class="mt-6 border-b"></div>
    <div class="container h-4 mt-6">
        <h4 class ="text-sm md:text-md lg:text-xl text-primary">Jobs Applied</h4>
    </div>
    <div class="mt-10 sm:mt-20 md:mt-20 lg:clear-both"></div>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Applied at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <JobApplied v-for="job in jobs" :key="job.id" :title="job.title" :company="job.user.name" :location="job.location" :applied_at="job.created_at"></JobApplied>
            </tbody>
        </table>
    </div>
</div>
</template>
<style lang="">
    
</style>