<template >
        <LoginRequiredDialog></LoginRequiredDialog>
        <authAdminDialog></authAdminDialog>
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Contributor Review</h3>
        <div class="flex flex-wrap gap-2">
            <div class="flex items-center w-full sm:w-1/2 md:w-1/2">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Filter by the role</span>
                    </div>
                    <select class="select select-bordered">
                        <option value="" disabled selected>Pick one</option>
                        <option value="User">Contributor</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="overflow-x-auto">

        <table class="table">
            <thead>
                <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <ContributorItemM v-for="(item, index) in filteredSubscribe" :key="index" @approved="approved" @reject="reject" :id="item.id" :status="item.status" :user="item.name" :email="item.email" :phone="item.phone_number"></ContributorItemM>
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
import {HTTP} from "@/http-common.js";
import ContributorItemM from "@/components/listItems/Management/ContributorItemM.vue";
import { set } from "date-fns";
export default {
    name : "SubscribeContributor",
    components: {
        ContributorItemM
    },
    data() {
        return {
            subscribe: [],
            filteredSubscribe: [],
            isSendRequest: false,
            isLoading: false,

        };
    },
    methods:{
        async getSubscribe(){
           await HTTP.get('/api/getListSubscribe').then(response => {
                
                this.subscribe = response.data.contributors;
                this.filteredSubscribe = this.subscribe;
                console.log(this.subscribe);
            });
        },
        async approved(id){
            this.isLoading = true;
            await HTTP.get(`/api/approvedSubscribe/${id}`)
                .then(response => {
                    this.isLoading = false;
                    this.isSendRequest = true;
                    this.getSubscribe();
                    setTimeout(() => {
                        this.isSendRequest = false;
                        window.location.reload();
                    }, 1000);
                })
                .catch(e => {
                    console.log(e);
                });
        },
        async reject(id){
            this.isLoading = true;
          await HTTP.get(`/api/rejectSubscribe/${id}`)
            .then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.getSubscribe();
                setTimeout(() => {
                    this.isSendRequest = false;
                    window.location.reload();
                }, 1000);
            })
            .catch(e => {
                console.log(e);
            });
        },
    },
    async mounted(){
        await this.getSubscribe();
    }
}
</script>
<style >
    
</style>