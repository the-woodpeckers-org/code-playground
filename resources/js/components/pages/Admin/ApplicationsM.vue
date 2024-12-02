<template>

    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Applcations Management</h3>
        <div class="overflow-x-auto">
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
                    <ApplicationItemM v-for="(item, index) in this.applications" :key="index" @reject="reject"
                        @approved="approved" @request_changed_required="request_changed_required" :id="item.id"
                        :company_name="item.user.name" :title="item.title" :status="item.status" :detailJob="item">
                    </ApplicationItemM>
                </tbody>
            </table>
        </div>
    </div>
    <dialog v-if="isSendRequest" id="login_modal" class="modal modal-open">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span>
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">Send request successfully!</p>
        </div>
    </dialog>
    <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="isLoading">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span class="loading loading-spinner loading-lg">
                </span>
            </div>
        </div>
    </div>
</template>
<script>
import { HTTP } from "@/http-common.js";
import ApplicationItemM from "@/components/listItems/Management/ApplicationItemM.vue";


export default {
    name: "ApplicationsM",
    components: {
        ApplicationItemM,
    },

    data() {
        return {
            applications: [],
            isSendRequest: false,
            isLoading: false,
        };
    },
    async mounted() {
        await this.getApplications();
    },
    methods: {
        async getApplications() {
            await HTTP.get('/api/getListSubscribeJobRecruitment').then(response => {
                this.applications = response.data.data;
                console.log(this.applications);
            }).catch(error => {
                console.log(error);
            });
        },
        async request_changed_required(id, request_change) {
            this.isLoading = true;
            await HTTP.post('/api/send-request-change-job', { id: id, request_change: request_change }).then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.getApplications();
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            }).catch(error => {
                console.log(error);
            });
        },
        async reject(id) {
            this.isLoading = true;
            await HTTP.get(`/api/rejectJob/${id}`).then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.getApplications();
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            }).catch(error => {
                console.log(error);
            });
        },
        async approved(id) {
            this.isLoading = true;
            await HTTP.get(`/api/approvedJob/${id}`).then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.getApplications();
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            }).catch(error => {
                console.log(error);
            });
        }
    },

}
</script>
<style></style>