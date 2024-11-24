<template >
<div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Company Review</h3>
        <div class="flex flex-wrap gap-2">
            <div class="flex items-center w-full sm:w-1/2 md:w-1/2">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Filter by the role</span>
                    </div>
                    <select class="select select-bordered">
                        <option value="" disabled selected>Pick one</option>
                        <option value="User">User</option>
                        <option value="User">Contributor</option>
                        <option value="1">Employer</option>
                        <option value="All">All</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="mt-3"></div>
        <table class="table">
            <thead>
                <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Code Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <CompanyItemM v-for="(item, index) in filteredSubscribe" :key="index" @approved="approved" @reject="reject" :id="item.id" :status="item.status" :user="item.name" :email="item.email" :phone="item.phone_number" :codeCompany="item.get_company.codeCompany"></CompanyItemM>
            </tbody>
        </table>
    </div>
    <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="!loading">
            <span class="loading loading-dots loading-lg"></span>
    </div> 
</template>
<script>
import {HTTP} from "@/http-common.js";
import CompanyItemM from "@/components/listItems/Management/CompanyItemM.vue";
export default {
    name : "SubscribeAdmin",
    components: {
        CompanyItemM
    },
    data(){
        return {
            listSubscribe: [],
            filteredSubscribe: [],
            openId: null,
            selectedRole: "",
            loading: true,
        };
    },
    mounted(){
        this.getSubscribe();
    },
    methods: {
        getSubscribe(){
            HTTP.get("/api/getListSubscribe")
            .then(response => {
                this.listSubscribe = response.data.companies;
                this.filteredSubscribe = response.data.companies;
                console.log(this.listSubscribe);
            })
            .catch(e => {
                console.log(e);
            });
        },
        filterUsers(){
            if(this.selectedRole === "All"){
                this.filteredSubscribe = this.listSubscribe;
            }else{
                this.filteredSubscribe = this.listSubscribe.filter(user => user.role === this.selectedRole);
            }
        },
        async approved(id){
            this.loading = false;
            await HTTP.get(`/api/approvedSubscribe/${id}`)
                .then(response => {
                    this.getSubscribe();
                    this.loading=true;
                })
                .catch(e => {
                    console.log(e);
                });
        },
        async reject(id){
            this.loading = false;
          await HTTP.get(`/api/rejectSubscribe/${id}`)
            .then(response => {
                this.getSubscribe();
                this.loading=true;
            })
            .catch(e => {
                console.log(e);
            });
        },
    }
}
</script>
<style >
    
</style>