<template>
    <div
        class="border rounded-xl h-fit w-auto p-3 m-5 bg-base-100 hover:scale-105 hover:bg-base-200 transition relative">
        <!-- Pending Overlay -->
        <div v-if="status === 'pending'" @click="edit"
            class="absolute inset-0 bg-gray-700 bg-opacity-55 text-green-300 text-2xl font-extrabold flex items-center justify-center">
            {{ status }}
        </div>

        <div v-if="status === 'rejected'" @click="edit"
            class="absolute inset-0 bg-gray-700 bg-opacity-55 text-red-600 text-2xl font-extrabold flex items-center justify-center">
            {{ status }}
        </div>

        <div class="flex h-[160px] w-full">
            <div class="w-full">
                <router-link :to="this.link">
                    <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
                    <h1 class="text-md font-semibold text-ellipsis line-clamp-2">{{ title }}</h1>
                    <p v-if="negotiable" class="font-semibold">Negotiable $</p>
                    <p v-else class="font-semibold">{{ salary }} $</p>
                    <p class="font-semibold">Available until: {{ date }}</p>
                </router-link>
            </div>
            <div class="flex flex-row gap-2 z-50">
                <i class="fa-solid fa-delete-left text-md md:text-xl lg:text-2xl hover:text-red-500"
                    @click="confirm_delete_modal"></i>
            </div>
        </div>
    </div>

    <dialog class="modal" ref="confirm_delete_modal">
        <div
            class="modal-box bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500 mr-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Warning</h3>
            </div>

            <p class="text-base text-gray-600 dark:text-gray-300 mb-4">
                Are you sure you want to delete it?
            </p>

            <div
                class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-3 mb-4">
                <p class="text-base text-yellow-700 dark:text-yellow-300 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    If you delete some problems or recruitment applications, they will also be deleted
                </p>
            </div>
            <div v-if="showAuthen2" class="">
                <label class="text-base text-gray-600 dark:text-gray-300 font-semibold mb-2">Please enter name job to confirm</label>
                    <input type="text" v-model="nameAuthen2" placeholder="ABC" class="w-full p-2 border border-gray-300 rounded-md mb-4">
            </div>
            <div class="modal-action flex justify-end space-x-2">
                    <button @click="showAuthen2=true" v-if="!showAuthen2"
                        class="btn btn-sm px-4 bg-red-500 text-white hover:bg-red-600 transition-colors duration-300 rounded-md">
                        Yes
                    </button>
                    <button @click="deleteItem" v-if="showAuthen2"    :disabled="nameAuthen2 !== title" 
                        class="btn btn-sm px-4 bg-red-500 text-white hover:bg-red-600 transition-colors duration-300 rounded-md">
                        Confirm
                        </button>   
                    <button @click="closeModal"
                        class="btn btn-sm px-4 bg-gray-200 text-gray-800 hover:bg-gray-300 transition-colors duration-300 rounded-md">
                        No
                    </button>
            </div>
     
        </div>
    </dialog>
    <Toast v-if="isDelete" :toastData="{ type: 'success', message: 'Delete successfully!' }"></Toast>
</template>

<script>
import { HTTP } from '@/http-common.js'
import { id } from 'date-fns/locale';
import Toast from '@/components/messages/Toast.vue'
export default {
    name: "JobM",
    emits: ['delete-item'],
    data() {
        return {
            showAuthen2: false,
            nameAuthen2: "",
            isDelete: false
        }
    },
    components: {
        Toast
    },
    props: {
        title: {
            default: 'N/A'
        },
        imgUrl: {
            default: 'N/A'
        },
        date: {
            type: Object,
            default: new Date().toDateString()
        },
        negotiable: {
            type: Boolean,
            default: true
        },
        salary: {
            type: String,
            default: 'N/A'
        },
        link: {
            type: String,
            default: 'N/A'
        },
        id: {
            type: Number,
            default: 0
        },
        status: {
            type: String,
            default: 'N/A'
        },
        change_required: {
            type: String,
            default: 'N/A',
        }
    },
    methods: {
        async deleteItem() {
            await HTTP.get(`/api/deleteJob/${this.id}`).then((response) => {
                this.isDelete = true;
                setTimeout(() => {
                    this.isDelete = false;
                }, 2000);
            });
            this.$emit('delete-item');
        },
        confirm_delete_modal() {
            this.$refs.confirm_delete_modal.showModal();
        },
        edit() {
            this.$router.push({ name: 'detail-job', params: { id: this.id } });
        },
        closeModal()
        {
            this.$refs.confirm_delete_modal.close();
        }
    }
}
</script>

<style scoped>
/* Ensure the overlay is positioned correctly and styled */
.relative {
    position: relative;
}

.absolute {
    position: absolute;
}

.inset-0 {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.bg-gray-500 {
    background-color: rgba(107, 114, 128, 0.5);
    /* Tailwind’s gray-500 with reduced opacity */
}

.bg-opacity-50 {
    opacity: 0.5;
}

.items-center {
    align-items: center;
}

.justify-center {
    justify-content: center;
}
</style>
