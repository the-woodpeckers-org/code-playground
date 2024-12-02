<template >

    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Contests Management</h3>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Problem Title</th>
                        <th class="px-4 py-2 text-left">Number Problem</th>
                        <th class="px-4 py-2 text-left">Start Time</th>
                        <th class="px-4 py-2 text-left">End Time</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Detail</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <ContestItemM v-for="contest in contests" :key="contest.id" :contest="contest" @change_request="change_request" @approved="approved" @reject="reject"/>
                </tbody>
            </table>
        </div>

        <div class="join mt-4">
            <!-- <button v-for="page in Array.from({ length: pagination.last_page }, (_, index) => index + 1)" :key="page"
                v-bind:class="['join-item', 'btn', { 'btn-active': page === pagination.current_page }]"
                @click="changePage(page)">
                {{ page }}
            </button> -->
        </div>

    </div>
    <dialog v-if="isSendRequest" id="" class="modal modal-open">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span>
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">Action Successfully!</p>
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
import ContestItemM from "@/components/listItems/Management/ContestItemM.vue";

export default {
    name: "ContestsM",
    components: {
        ContestItemM
    },
    data() {
        return {
            contests: [],
            pagination: {},
            isSendRequest: false,
            isLoading: false,
        };
    },
    async mounted() {
        await this.fetchContests();
    },
    methods: {
        async fetchContests() {
           await HTTP.get(`/api/getListSubscribeContest`).then((response) => {
                this.contests = response.data.contests;
                this.pagination = response.data;
                console.log(response.data);
            });
        },
       async approved(id) {
            this.isLoading = true;
            await HTTP.post('/api/approvedContest',{contest_id : id}).then((response) => {
                this.isLoanding = false;
                this.isSendRequest=true;
                this.fetchContests();
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            });
        },
        async reject(id)
        {
            this.isLoading = true;
            await HTTP.post('/api/rejectContest',{contest_id : id}).then((response) => {
                this.isLoanding = false;
                this.isSendRequest=true;
                this.fetchContests();
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            });
        },
        async change_request(contest_id, change_required) {
            this.isLoading = true;
             await HTTP.post('/api/changeRequiredContest', {
                 contest_id: contest_id,
                 change_required: change_required,
             }).then(response => {
                 this.isLoading = false;
                 this.isSendRequest = true;
                 this.fetchContests();
                setTimeout(() => {
                     window.location.reload();
                     this.isendRequest = false;
                 }, 2000);
         });
        },
    },
}
</script>
<style >
    
</style>