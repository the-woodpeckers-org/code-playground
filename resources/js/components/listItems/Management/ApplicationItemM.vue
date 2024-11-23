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
                <li @click="$emit('reject', id)" class="px-4 py-2 hover:bg-red-100 cursor-pointer">reject</li>
                <li @click="$emit('approved', id)" class="px-4 py-2 hover:bg-green-100 cursor-pointer">approved</li>
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
                        <input v-model="detailJob.title" type="text" class="input-field" placeholder="Enter job title"
                            required />
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Location</label>
                        <input v-model="detailJob.location" type="text" class="input-field" placeholder="Job location"
                            required />
                    </div>
                    <div class="mb-6">
                        <label class="text-sm font-bold text-gray-700 mb-2 block">Skills <span
                                class="font-normal text-primary">*</span></label>
                        <!-- <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                            <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                                <div v-for="(skill, index) in selectedSkills" :key="index"
                                    class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                                    <span>{{ skill }}</span>
                                    <button @click="removeSkill(skill)"
                                        class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                            </div>           
                        </div> -->
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Negotiable</label>
                        <input type="checkbox" class="checkbox checkbox-accent" :checked="detailJob.negotiable"  v-on:click="setNegotiable"/>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Salary</label>
                        <input v-model="detailJob.salary" type="number" class="input-field" placeholder="Salary range"
                            :disabled="detailJob.negotiable" :required="!detailJob.negotiable"
                            onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" />
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Deadline</label>
                        <input v-model="detailJob.deadline" type="date" class="input-field" required />
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Description</label>
                        <div id="text-editor-3" class="input-editor p-4"></div>
                    </div>
                    <div class="flex justify-center space-x-6 mt-8">
                        <button type="button" class="btn-secondary" @click="closeJobForm">Cancel</button>
                        <button type="submit" class="btn-primary">Save</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <div class="flex gap-2">
                        <button class="btn ">Close</button>
                        <button class="btn btn-primary" @click="SaveProfile">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
</template>

<script>
export default {
    data() {
        return {
            showOptions: false,
        };
    },
    name: "ApplicationItemM",
    props: {
        id: String,
        detailJob: {}
    },
    data() {
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
        showDetailModal() {
            this.$refs.showDetail.showModal();
        }, closeProfile() {
            this.$refs.showDetail.close()       
         },
    },
};
</script>

<style></style>
