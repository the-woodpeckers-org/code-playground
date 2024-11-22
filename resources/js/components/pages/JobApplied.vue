<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue'
import JobAppliedItem from '@/components/listItems/JobAppliedItem.vue'
import { HTTP } from '@/http-common.js'
export default {

    components: {
        NavigatorCV, JobAppliedItem
    },

    data: function () {
        return {
            data: Array
        }
    },
    methods: {
        async getJobsApplied() {
            await HTTP.get('/api/getCV_Applied')
                .then(response => {
                    this.data = response.data.data;
                    console.log(response.data);
                    console.log("job ne",this.data);
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
        <table class="table w-full">
            <thead>
                <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Applied at</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <JobAppliedItem v-for="job in data" :key="job.job.user.id" :title="job.job.title" :company="job.job.user.name" :location="job.job.location" :applied_at="job.created_at" :status="job.status" :url="job.job.id"></JobAppliedItem>
            </tbody>
        </table>
    </div>
</div>
</template>
<style lang="">

</style>