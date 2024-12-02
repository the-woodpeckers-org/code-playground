<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td class="px-4 py-2">{{ contest.title }}</td>
        <td class="px-4 py-2">{{ contest.problems.length }}</td>
        <td class="px-4 py-2">{{ contest.start_date }}</td>
        <td class="px-4 py-2">{{ contest.end_date }}</td>
        <td class="px-4 py-2">{{ contest.created_by.name }}</td>
        <td class="px-4 py-2 text-center "> <a @click="showDetailModal"
                class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                <i class="fa-regular fa-eye"></i>
            </a></td>
        <td class="px-4 py-2">{{ contest.status }}</td>
        <td class="px-4 py-2" @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
    </tr>
    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li v-if="contest.status !== 'rejected'" @click="showConfirmReject"
                    class="px-4 py-2 hover:bg-red-100 cursor-pointer">Rejected</li>
                <li v-if="contest.status !== 'active' || contest.status !== 'approved'" @click="showConfirmApprove"
                    class="px-4 py-2 hover:bg-green-100 cursor-pointer">Approved</li>
                <li @click="request_change_ShowModal" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Request
                    change</li>
            </ul>
        </td>
    </tr>

    <dialog class="modal" ref="confirm_status_approved_modal">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want approved it?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500"
                        @click="$emit('approved', this.contest.id)">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>

    <dialog class="modal" ref="confirm_status_reject_modal">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want reject it?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500"
                        @click="$emit('reject', this.contest.id)">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>


    <dialog ref="showDetail" class="modal">
        <div class="modal-box w-11/12 max-w-7xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Detail CONTEST</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input :value="this.contest.title" readonly
                        class="rounded-lg border border-gray-400 h-10 w-full px-3">
                </div>
                <div>
                    <label>Tags</label>
                    <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                        <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                            <div v-for="(item, index) in this.contest.tags" :key="index"
                                class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                <span>{{ item }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="this.contest.description"
                        class="rounded-lg border border-gray-400 w-full h-20 px-3" readonly></textarea>
                </div>
                <div>
                    <label>Start date</label>
                    <input readonly v-model="this.contest.start_date" type="datetime-local"
                        class="rounded-lg border border-gray-400 h-8 w-full">
                    <label class="mt-3">End date</label>
                    <input readonly v-model="this.contest.end_date" type="datetime-local"
                        class="rounded-lg border border-gray-400 h-8 w-full">
                </div>
                <div class="col-span-full">
                    <div class="divider"></div>
                    <p class="font-semibold text-lg">Problems</p>
                    <p>Maximum problems: {{ this.contest.problems.length }}/5</p>
                </div>
                <div class="col-span-full flex flex-col gap-3 relative ">
                    <div v-for="(problem, index) in this.contest.problems"
                        class="w-full min-h-20 border border-gray-400 rounded-xl collapse lobster">
                        <input readonly type="checkbox">
                        <div class="collapse-title text-xl font-medium"> Problem {{ index + 1 }}
                        </div>
                        <div class="collapse-content">
                            <div>
                                <label>Title</label>
                                <input readonly v-model="problem.title"
                                    class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                <label>Difficulty</label>
                                <input readonly v-model="problem.difficulty"
                                    class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                <label>Languages</label>
                                <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                    <div v-for="(item, index) in problem.languages" :key="index"
                                        class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                        <span>{{ item.name }}</span>
                                    </div>
                                </div>

                                <label>Description</label>
                                <textarea readonly v-model="problem.description"
                                    class="w-full border h-40 rounded-lg border-gray-400 px-3"></textarea>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border border-gray-300 rounded-lg p-1 h-32 relative lobster"
                                        v-for="testcase in problem.testcases">
                                        <label>stdin</label>
                                        <input readonly v-model="testcase.stdin"
                                            class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <label>expected_result</label>
                                        <input readonly v-model="testcase.expected_output"
                                            class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mb-6" v-if="this.openRequest">
                <label class="block text-gray-600 font-semibold mb-2">Request Change</label>
                <textarea class="relative w-full p-2 border" v-model="this.contest.change_required"></textarea>
            </div>
            <div class="flex justify-center space-x-6 mt-8 ">
                <button type="button" class="btn btn-secondary" @click="closeDetail">Cancel</button>
                <button type="button" class="btn btn-primary" @click="openRequest = true"
                    v-if="!openRequest">Request</button>
                <button v-if="openRequest" type="button" class="btn btn-primary" @click="sendRequest">Send
                    Request</button>
            </div>
        </div>
    </dialog>

</template>
<script>
import Multiselect from 'vue-multiselect';
export default {
    emits: ['reject', 'approved', 'change_request'],
    name: "ContestIemM",
    components: {
        Multiselect
    },
    props: {
        contest: {},
    },
    data() {
        return {
            showOptions: false,
            openRequest: false,
        };
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
        showDetailModal() {
            this.$refs.showDetail.showModal();
        },
        closeDetail() {
            this.$refs.showDetail.close();
            this.openRequest = false;
        },
        showConfirmReject() {
            this.$refs.confirm_status_reject_modal.showModal();
        },
        showConfirmApprove() {
            this.$refs.confirm_status_approved_modal.showModal();
        },
        sendRequest() {
            this.$emit('change_request', this.contest.id, this.contest.change_required);
            this.closeDetail();
        },
        request_change_ShowModal() {
            this.$refs.showDetail.showModal();
            this.openRequest = true;
        }
    },
    created() {
        console.log(this.contest);
    }
}
</script>
<style></style>