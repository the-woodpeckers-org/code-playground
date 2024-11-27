<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td class="px-4 py-2">{{ problem.title }}</td>
        <td class="px-4 py-2">{{ problem.difficulty }}</td>
        <td class="px-4 py-2">{{ problem.created_by.name }}</td>
        <td class="px-4 py-2 text-center "> <a @click="showDetailModal"
                class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                <i class="fa-regular fa-eye"></i>
            </a></td>
        <td class="px-4 py-2">{{ problem.status }}</td>
        <td class="px-4 py-2" @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
    </tr>
    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li v-if="problem.status !== 'rejected'" @click="$emit('reject', id)"
                    class="px-4 py-2 hover:bg-red-100 cursor-pointer">Rejected</li>
                <li v-if="problem.status !== 'active'" @click="$emit('Active', id)"
                    class="px-4 py-2 hover:bg-green-100 cursor-pointer">Approved</li>
                <li @click="request_change_ShowModal" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Request
                    change</li>
            </ul>
        </td>
    </tr>
    <dialog ref="showDetail" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <div class="flex flex-col-reverse">
                <div
                    class="flex items-start justify-between rounded-t dark:border-gray-600 border-b p-5 rounded-tl-xl md:rounded">
                    <h3 id=":r9:" class="text-xl font-medium text-gray-900 dark:text-white">
                        <p class="font-bold text-black">{{ problem.created_by.name }}</p>
                        <p class="text-base font-normal text-gray-400"> {{ problem.title }} </p>
                    </h3>
                </div>
                <div class="flex justify-end p-0">
                    <button class="btn rounded-full bg-blue-200 text-white hover:bg-red-100 hover:text-black"
                        @click="closeDetail">X</button>
                </div>
            </div>
            <div class="p-6 flex-1 overflow-auto">
                <form id="basic-information-form">
                    <div class="space-y-6">
                        <h2 class="text-sm font-bold uppercase text-gray-400 md:text-md lg:text-2xl">Problem</h2>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Title</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="problem.title">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Difficulty</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="problem.difficulty">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Description</label>
                            <div class="relative w-full">
                                <div class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    v-html="problem?.description"></div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="text-sm font-bold text-gray-700 mb-2 block">Programming Languages<span
                                    class="font-normal text-primary">*</span></label>
                            <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                                <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                    <div v-for="(skill, index) in this.problem.languages" :key="index"
                                        class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                        <span>{{ skill.name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Categories
                            </label>
                            <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                                <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                    <div v-for="(skill, index) in this.problem.categories" :key="index"
                                        class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                        <span>{{ skill.name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Testcases</label>
                            <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                                    <div v-for="(testcase, index) in this.problem.testcases"
                                        class="bg-base-200 p-3 rounded-lg h-52 lobster">
                                        <br>
                                        <label>Input (stdin format) <span class="font-bold">[NOT TESTED]</span></label>
                                        <input v-model="this.problem.testcases[index].stdin"
                                            class="rounded-lg border border-gray-400 h-8 w-full" readonly>
                                        <label>Expected output <span class="font-bold">[NOT TESTED]</span></label>
                                        <input v-model="this.problem.testcases[index].expected_output"
                                            class="rounded-lg border border-gray-400 h-8 w-full" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6" v-if="this.openRequest">
                            <label class="block text-gray-600 font-semibold mb-2">Request Change</label>
                            <textarea class="relative w-full p-2 border" v-model="this.problem.change_required"></textarea>
                        </div>
                        <div class="flex justify-center space-x-6 mt-8 ">
                            <button type="button" class="btn btn-secondary" @click="closeDetail">Cancel</button>
                            <button type="button" class="btn btn-primary" @click="openRequest=true" v-if="!openRequest">Request</button>
                            <button v-if="openRequest" type="button" class="btn btn-primary" @click="sendRequest">Send Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
</template>

<script>
export default {
    emits: ['reject', 'Active', 'change_request'],
    name: "CompanyItemM",
    props: {
        problem: {},
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

        },
        showConfirmApprove() {

        },
        sendRequest()
        {
            this.$emit('change_request', this.problem.id, this.problem.change_required);
            this.closeDetail();
        },
        request_change_ShowModal() {
            this.$refs.showDetail.showModal();
            this.openRequest = true;
        }
    },
    created() {
      
    }
}
</script>
<style></style>