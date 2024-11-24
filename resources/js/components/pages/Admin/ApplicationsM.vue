<template>
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Applcations Management</h3>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Company name</th>
                        <th>Title</th>
                        <th>Detail</th>
                        <th>Status</th>
                    </tr>
                </thead>
                   <tbody>
                            <ApplicationItemM v-for="(item, index) in this.applications" :key="index" @reject="reject" @approved="approved" @request_changed_required="request_changed_required" :id="item.id" :company_name="item.user.name" :title="item.title" :status="item.status" :detailJob="item"></ApplicationItemM>
                   </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import {HTTP} from "@/http-common.js";
import ApplicationItemM from "@/components/listItems/Management/ApplicationItemM.vue";
export default {
    name: "ApplicationsM",
    components: {
        ApplicationItemM,
    },
    data() {
        return {
            applications: [],
        };
    },
  async mounted() {
       await this.getApplications();
    },
    methods: {
        async getApplications() {
            await HTTP.get('/api/getListSubscribeJobRecruitment').then(response => {
                console.log(response.data.data);
                this.applications = response.data.data;
            }).catch(error => {
                console.log(error);
            });
        },
      async request_changed_required(id,request_change)
        {
          console.log(id,request_change);
          await HTTP.post('/api/send-request-change-job',{id:id,request_change:request_change}).then(response => {
                console.log(response.data);
                this.getApplications();
            }).catch(error => {
                console.log(error);
            });
        },
        async reject(id)
        {
          await HTTP.get(`/api/rejectJob/${id}`).then(response => {
                console.log(response.data);
                this.getApplications();
            }).catch(error => {
                console.log(error);
            });
        },
        async approved(id)
        {
          await HTTP.get(`/api/approvedJob/${id}`).then(response => {
                console.log(response.data);
                this.getApplications();
            }).catch(error => {
                console.log(error);
            });
        }
    },

}
</script>
<style></style>