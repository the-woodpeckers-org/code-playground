<script>
import {HTTP} from "@/http-common.js";
import CreateProblem from "@/components/pages/Contributor/Problem/CreateProblem.vue";
import Toast from "@/components/messages/Toast.vue";
import EditProblem from "@/components/pages/Contributor/Problem/EditProblem.vue";
import {ref} from "vue";

const editProblemRef = ref(null);

export default {
    name: "ProblemManager",
    components: {EditProblem, Toast, CreateProblem},
    data: () => {
        return {
            editingProblemId: null,
            currentPage: '1',
            problems: [],
            links: [],
            deletingTitle: '',
            deletingId: '',
            isDeletedSomeRecord: false,
            isEditedSomeRecord: false,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.problems = [];
            this.links = [];
            this.getProblems(1);
        },
        async getProblems(index) {
            let _this = this;
            await HTTP.get('api/contributor/problems?page=' + index)
                .then((response) => {
                    _this.problems = response.data.data;
                    _this.links = response.data.links;
                    _this.currentPage = response.data.current_page;
                    console.log(response);
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        showConfirmDelete(deletingId, deletingTitle) {
            this.isDeletedSomeRecord = false;
            this.deletingId = deletingId;
            this.deletingTitle = deletingTitle;
            document.getElementById("modal_delete").classList.add('modal-open')
        },
        confirmNo() {
            this.deletingId = this.deletingTitle = '';
            document.getElementById("modal_delete").classList.remove('modal-open')
        },
        async confirmDelete() {
            let _this = this;
            await HTTP.delete('api/problem/?id=' + this.deletingId)
                .then((response) => {
                    this.isDeletedSomeRecord = true;
                    this.fetchData();
                    this.confirmNo();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        showEdit(id) {
            this.$refs.editProblemRef.getProblem(id);
        }
    }
}
</script>

<template>
    <div class="w-full">
        <p class="text-center font-bold text-2xl">Problem management</p>
        <p class="text-lg">Your problems on The CodePlayground</p>
        <div class="w-full">
            <CreateProblem></CreateProblem>
            <EditProblem ref="editProblemRef"></EditProblem>
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-xl">
            <table class="table table-lg">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Difficulty</th>
                    <th>Acceptance Rate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover" v-for="problem in problems">
                    <th></th>
                    <td>{{ problem.title }}</td>
                    <td>{{ problem.difficulty }}</td>
                    <td>{{ problem.acceptance_rate }}</td>
                    <td>
                        <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="showEdit(problem.id)">Edit</button>
                        <button class="bg-red-300 px-3 py-1 mx-1 hover:bg-red-500 rounded-lg"
                                @click="showConfirmDelete(problem.id, problem.title)">Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex">
                <div class="join mx-auto my-3">
                    <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                            :class="{ 'btn-active' : link.label == currentPage}" @click="getProblems(link.label)"><span
                        v-html="link.label"></span></button>
                </div>
            </div>
        </div>
    </div>
    <dialog id="modal_delete" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Warning!</h3>
            <p class="pt-4 pb-2">Are you sure you want to delete this problem?</p>
            <p class="pt-2 pb-4"> {{ deletingTitle }}</p>
            <div class="w-full text-end">
                <button class="px-3 py-1 bg-blue-300 hover:bg-blue-500 rounded-lg mx-1" @click="confirmDelete">Yes
                </button>
                <button class="px-3 py-1 bg-yellow-300 hover:bg-yellow-500 rounded-lg mx-1" @click="confirmNo">No
                </button>
            </div>
        </div>
    </dialog>
    <Toast v-if="isDeletedSomeRecord" :toastData="{type: 'success', message: 'Delete problem successfully'}"></Toast>
</template>

<style scoped>

</style>
