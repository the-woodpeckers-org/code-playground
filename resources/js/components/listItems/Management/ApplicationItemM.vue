<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>{{ detailJob.user.name }}</td>
        <td>{{ detailJob.title }}</td>
        <td> <a @click="showDetailModal"
                class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                <i class="fa-regular fa-eye"></i>
            </a></td>
        <td>{{ detailJob.status }}</td>
        <td @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
    </tr>
    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li @click="showModalConfirmStatusReject" class="px-4 py-2 hover:bg-red-100 cursor-pointer">Reject</li>
                <li @click="showModalConfirmStatusApproved" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Approved</li>
                <li @click="request_change_ShowModal" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Request
                    change</li>
            </ul>
        </td>
    </tr>

    <dialog ref="showDetail" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <div class="flex flex-col-reverse">
                <div
                    class="flex items-start justify-between rounded-t dark:border-gray-600 border-b p-5 rounded-tl-xl md:rounded">
                    <h3 id=":r9:" class="text-xl font-medium text-gray-900 dark:text-white">
                        <p class="font-bold text-black">{{ detailJob.user.name }}</p>
                        <p class="text-base font-normal text-gray-400"> {{ detailJob.title }} </p>
                    </h3>
                </div>
                <div class="flex justify-end p-0">
                    <button class="btn rounded-full bg-blue-200 text-white hover:bg-red-100 hover:text-black"
                        @click="closeProfile">X</button>
                </div>
            </div>
            <div class="p-6 flex-1 overflow-auto">
                <form id="basic-information-form">
                    <div class="space-y-6">
                        <h2 class="text-sm font-bold uppercase text-gray-400 md:text-md lg:text-2xl">Information</h2>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Title</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.title"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Description</label>
                            <div class="relative w-full">
                                <div class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-html="detailJob?.description">
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="text-sm font-bold text-gray-700 mb-2 block">Skills <span
                                    class="font-normal text-primary">*</span></label>
                            <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                                <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                    <div v-for="(skill, index) in this.selectedSkills" :key="index"
                                        class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                        <span>{{ skill }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Location</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.location"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Deadline</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.deadline"></div>
                        </div>
                        <div v-if="detailJob.negotiable" class="mb-6">
                            <div class="mb-6">
                                <label class="block text-gray-600 font-semibold mb-2">Negotiable</label>
                                 <input type="checkbox" class="checkbox checkbox-accent" :checked="detailJob.negotiable" disabled/>
                            </div>
                        </div>
                        <div class="mb-6" v-else>
                            <label class="block text-gray-600 font-semibold mb-2">Salary</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.salary"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Skill</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.skill"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Email</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.user.email"></div>
                        </div>
                        <div class="flex justify-center space-x-6 mt-8 ">
                            <button type="button" class="btn btn-secondary" @click="closeProfile">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dialog>


    <dialog ref="requestChangeModal" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <div class="flex flex-col-reverse">
                <div
                    class="flex items-start justify-between rounded-t dark:border-gray-600 border-b p-5 rounded-tl-xl md:rounded">
                    <h3 id=":r9:" class="text-xl font-medium text-gray-900 dark:text-white">
                        <p class="font-bold text-black">{{ detailJob.user.name }}</p>
                        <p class="text-base font-normal text-gray-400"> {{ detailJob.title }} </p>
                    </h3>
                </div>
                <div class="flex justify-end p-0">
                    <button class="btn rounded-full bg-blue-200 text-white hover:bg-red-100 hover:text-black"
                        @click="closeProfile">X</button>
                </div>
            </div>
            <div class="p-6 flex-1 overflow-auto">
                <form id="basic-information-form">
                    <div class="space-y-6">
                        <h2 class="text-sm font-bold uppercase text-gray-400 md:text-md lg:text-2xl">Information</h2>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Title</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.title"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Description</label>
                            <div class="relative w-full">
                                <div class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-html="detailJob?.description">
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="text-sm font-bold text-gray-700 mb-2 block">Skills <span
                                    class="font-normal text-primary">*</span></label>
                            <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                                <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                    <div v-for="(skill, index) in this.selectedSkills" :key="index"
                                        class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                        <span>{{ skill }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Location</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.location"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Deadline</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.deadline"></div>
                        </div>
                        <div v-if="detailJob.negotiable" class="mb-6">
                            <div class="mb-6">
                                <label class="block text-gray-600 font-semibold mb-2">Negotiable</label>
                                 <input type="checkbox" class="checkbox checkbox-accent" :checked="detailJob.negotiable" disabled />
                            </div>
                        </div>
                        <div class="mb-6" v-else>
                            <label class="block text-gray-600 font-semibold mb-2">Salary</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.salary"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Skill</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.skill"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Email</label>
                            <div class="relative w-full"><input
                                    class="block w-full border disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-500 text-black focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                    disabled="" v-model="detailJob.user.email"></div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-600 font-semibold mb-2">Request Change</label>
                            <textarea class="relative w-full block border" v-model="detailJob.change_required"></textarea>
                        </div>
                        <div class="flex justify-center space-x-6 mt-8 ">
                            <button type="button" class="btn btn-secondary" @click="closeProfile">Cancel</button>
                            <button type="button" class="btn btn-primary" @click="SendRequest">Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <dialog class="modal" ref="confirm_status_approved_modal">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want approved it?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="$emit('approved', id)">Yes</button>
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
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="$emit('reject', id)">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>

</template>

<script>
export default {
    emits: ['reject', 'approved','request_changed_required'],
    data() {
        return {
            showOptions: false,
            selectedSkills: [],
            request_change: null
        };
    },
    name: "ApplicationItemM",
    props: {
        id: String,
        detailJob: {}
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
        showDetailModal() {
            this.$refs.showDetail.showModal();
        }, closeProfile() {
            this.$refs.showDetail.close();
            this.$refs.requestChangeModal.close();
        },
        SendRequest() {
            this.$emit('request_changed_required', this.id, this.detailJob.change_required);
            this.$refs.requestChangeModal.close();
        },
        request_change_ShowModal() {
            this.$refs.requestChangeModal.showModal();
        },
        showModalConfirmStatusReject() {
            this.$refs.confirm_status_reject_modal.showModal();
        },
        showModalConfirmStatusApproved() {
            this.$refs.confirm_status_approved_modal.showModal();
        },
    },
    created() {
        const arrayOfSkills = JSON.parse(this.detailJob.skill.replace(/'/g, '"'));
        this.selectedSkills = arrayOfSkills;
        console.log(this.selectedSkills);
    },
};
</script>

<style></style>
