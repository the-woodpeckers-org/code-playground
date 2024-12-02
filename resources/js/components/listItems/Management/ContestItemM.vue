<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td class="px-4 py-2">{{ contest.title }}</td>
        <td class="px-4 py-2">{{ contest.problems.length}}</td>
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
                <li v-if="contest.status !== 'active' || contest.status!=='approved'" @click="showConfirmApprove"
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
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="$emit('approved', this.contest.id)">Yes</button>
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
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="$emit('reject', this.contest.id)">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>


    <dialog ref="showDetail" class="modal">
        <div class="modal-box w-11/12 max-w-7xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new contest</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input v-model="this.contest.title" class="rounded-lg border border-gray-400 h-10 w-full px-3">
                </div>
                <div>
                    <label>Tags</label>
                    <Multiselect v-model="this.contest.tags"
                                 :options="['Hackathon', 'Speed', 'Cyanide', 'Aspire', 'HiTec', 'CodeForce']"
                                 :multiple="true" class="h-8 w-full"></Multiselect>
                </div>
                <!-- <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="this.contest.problem.description"
                              class="rounded-lg border border-gray-400 w-full h-40 px-3"></textarea>
                </div>
                <div>
                    <label>Start date</label>
                    <input v-model="start_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <label class="mt-3">End date</label>
                    <input v-model="end_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                </div>
                <div class="col-span-full">
                    <div class="divider"></div>
                    <p class="font-semibold text-lg">Problems</p>
                    <p>Maximum problems: {{problems.length}}/5</p>
                </div>
                <div class="col-span-full flex flex-col gap-3 relative ">
                    <div v-for="(problem, index) in problems" class="w-full min-h-20 border border-gray-400 rounded-xl collapse lobster">
                        <input type="checkbox">
                        <div class="collapse-title text-xl font-medium">Problem</div>
                        <div class="collapse-content">
                            <div class="flex gap-x-2">
                                <input @change="checkBoxChange(problem.id, 'cb1')" :id="problem.id + 'cb1'" type="checkbox" class="checkbox">
                                <label>Choose existed problem</label>
                            </div>
                            <div class="flex gap-x-2 mt-2">
                                <input @change="checkBoxChange(problem.id, 'cb2')" :id="problem.id + 'cb2'" type="checkbox" class="checkbox" checked>
                                <label>Create new problem</label>
                            </div>
                            <div>
                                <label>Title</label>
                                <input v-model="problem.title" class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                <label>Difficulty</label>
                                <select v-model="problem.difficulty" class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                                <label>Languages</label>
                                <Multiselect v-model="problem.languages" :options="['C', 'C++', 'Python', 'PHP', 'JavaScript']" :multiple="true"
                                             class="h-8 w-full"></Multiselect>
                                <label>Description</label>
                                <textarea v-model="problem.description" class="w-full border h-40 rounded-lg border-gray-400 px-3"></textarea>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border border-gray-300 rounded-lg p-1 h-32 relative lobster" v-for="testcase in problem.testcases">
                                        <label>stdin</label>
                                        <input v-model="testcase.stdin" class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <label>expected_result</label>
                                        <input v-model="testcase.expected_output" class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <p v-if="problem.testcases.length > 1" class="absolute bg-red-400 px-1.5 rounded-full top-1 end-1 text-white hover:bg-red-600 cursor-pointer" @click="removeTestcase(index, testcase.id)">X</p>
                                    </div>
                                    <div @click="addTestcase(index)" class="border border-gray-300 rounded-lg p-1 h-32 hover:bg-base-300 flex cursor-pointer">
                                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button v-if="problems.length > 1" class="absolute top-1 end-1 bg-red-500 rounded-xl px-1.5 text-white z-10 hover:bg-red-700" @click="removeProblem(problem.id)">X</button>
                    </div>
                    <div v-if="problems.length < 5" @click="problems.push({id: Math.random().toString(7), title: '', description: '', difficulty: '', languages: [], testcases: [ { id: Math.random().toString(7), stdin: '', expected_output: ''}], existed: false})"
                         class="w-full h-20 border border-gray-400 rounded-xl hover:bg-base-300 transition cursor-pointer flex">
                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                    </div> -->
                <!-- </div> -->
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="updateContest()">
                        Create
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeEdit()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    
</template>

<script>
export default {
    emits: ['reject', 'approved', 'change_request'],
    name: "ContestIemM",
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
        sendRequest()
        {
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