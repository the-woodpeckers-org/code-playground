<template>
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Problems Management</h3>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Problem Title</th>
                        <th class="px-4 py-2 text-left">Difficulty</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Detail</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <ProblemItemM v-for="(item, index) in problems" :key="index" :problem="item"
                        @change_request="change_request" @reject="reject" @approved="approved" />
                </tbody>
            </table>
        </div>

        <div class="join mt-4">
            <button v-for="page in Array.from({ length: pagination.last_page }, (_, index) => index + 1)" :key="page"
                v-bind:class="['join-item', 'btn', { 'btn-active': page === pagination.current_page }]"
                @click="changePage(page)">
                {{ page }}
            </button>
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
import { HTTP } from "@/http-common.js";
import ProblemItemM from "@/components/listItems/Management/ProblemItemM.vue";

export default {
    name: "ProblemsM",
    components: {
        ProblemItemM,
    },
    data() {
        return {
            problems: [],
            pagination: {
                current_page: 1,
                last_page: 1,
            },
            isSendRequest: false,
            isLoading: false,
        };
    },
    async mounted() {
        await this.fetchData();
    },
    methods: {
        async fetchData(page = 1) {
            try {
                const response = await HTTP.get('/api/getListSubscribeProblem', {
                    params: { page: page }
                });
                this.problems = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching problems:", error);
            }
        },
        changePage(page) {
            if (page !== this.pagination.current_page) {
                this.pagination.current_page = page;
                this.fetchData(page);
            }
        },
        async change_request(problem_id, change_required) {
            this.isLoading = true;
            await HTTP.post('/api/ChangeRequestProblem', {
                problem_id: problem_id,
                change_required: change_required,
            }).then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.fetchData(this.pagination.current_page);
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            }).catch(error => {
                console.error("Error sending request:", error);
            });
        },
        async reject(id) {
            this.isLoading = true;
            await HTTP.post('/api/RejectProblem', {
                problem_id: id,
            }).then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.fetchData(this.pagination.current_page);
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            }).catch(error => {
                console.error("Error rejecting problem:", error);
            });
        },
        async approved(id) {
            this.isLoading = true;
            await HTTP.post('/api/ApprovedProblem', {
                problem_id: id,
            }).then(response => {
                this.isLoading = false;
                this.isSendRequest = true;
                this.fetchData(this.pagination.current_page);
                setTimeout(() => {
                    window.location.reload();
                    this.isSendRequest = false;
                }, 2000);
            }).catch(error => {
                console.error("Error approving problem:", error);
            });
        }
    }
};
</script>
<style scoped></style>
