<script>
import {HTTP} from "@/http-common.js";
import CreateContest from "@/components/pages/Contributor/Contest/CreateContest.vue";
import {ref} from "vue";

const contestChild = ref("null");

export default {
    name: "ContestManager",
    components: {CreateContest},
    data: () => {
        return {
            currentPage: '1',
            contests: [],
            links: [],
            deletingTitle: '',
            isDeletedSomeRecord: false,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.getContests(1);
        },
        async getContests(index) {
            let _this = this;
            await HTTP.get('api/contributor/contest/?page=' + index)
                .then((response) => {
                    _this.contests = response.data.data;
                    _this.links = response.data.links;
                    _this.currentPage = response.data.current_page;
                })
                .catch((err) => {
                });
        },
        showEdit(id) {
            this.$refs.contestChild.showEdit(id);
        },
        showConfirmDelete() {

        },
        confirmDelete() {

        },
        confirmNo() {

        },
        showCreate() {
            this.$refs.contestChild.showCreate();
        }
    }
}
</script>

<template>
    <CreateContest ref="contestChild"></CreateContest>
    <div class="w-full">
        <p class="text-center font-bold text-2xl">Contest management</p>
        <p class="text-lg">Your contests on The CodePlayground</p>
        <div class="w-full text-end">
            <button @click="showCreate" class="bg-blue-300 px-3 py-1 m-1 hover:bg-blue-500 rounded-lg">New contest</button>
        </div>
        <div class="w-full">
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-xl">
            <table class="table table-lg">
                <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Total participants</th>
                    <th>Actions</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover" v-for="contest in contests">
                    <th></th>
                    <td>{{ contest.title }}</td>
                    <td>{{ contest.start_date }}</td>
                    <td>{{ contest.end_date }}</td>
                    <td>{{ contest.participantCount }}</td>
                    <td>
                        <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="showEdit(contest.id)">Edit</button>
                        <button class="bg-red-300 px-3 py-1 mx-1 hover:bg-red-500 rounded-lg"
                                @click="showConfirmDelete(contest.id, contest.title)">Delete
                        </button>
                    </td>
                    <td>{{ contest.status }}</td>
                </tr>
                </tbody>
            </table>
            <div class="flex">
                <div class="join mx-auto my-3">
                    <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                            :class="{ 'btn-active' : link.label == currentPage}" @click="getContests(link.label)"><span
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
