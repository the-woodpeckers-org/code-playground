<template>
    <div
        class="border rounded-xl h-fit w-auto my-2 mx-3 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition relative">
        
        <!-- Pending Overlay -->
        <div v-if="status === 'Pending'" class="absolute inset-0 bg-gray-700 bg-opacity-55 text-green-300 text-2xl font-extrabold flex items-center justify-center">
                    {{ status }}
        </div>

        <div v-if="status === 'Rejected'" class="absolute inset-0 bg-gray-700 bg-opacity-55 text-red-600 text-2xl font-extrabold flex items-center justify-center">
                    {{ status }}
        </div>

        <div class="flex">
            <div>
                <router-link :to="this.link">
                    <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
                    <h1 class="text-xl font-semibold">{{ title }}</h1>
                    <p v-if="negotiable" class="font-semibold">Negotiable $</p>
                    <p v-else class="font-semibold">{{ salary }} $</p>
                    <p class="font-semibold">Available until: {{ date }}</p>
                </router-link>                  
            </div>
            <div class="flex flex-row gap-2 z-50">
                <i class="fa-solid fa-delete-left text-md md:text-xl lg:text-2xl hover:text-red-500" @click="confirm_delete_modal"></i>
            </div>
        </div>
    </div>
    
    <dialog class="modal" ref="confirm_delete_modal">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want to delete it?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="deleteItem">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>
</template>

<script>
import { HTTP } from '@/http-common.js'
import { id } from 'date-fns/locale';

export default {
    name: "JobM",
    emits: ['delete-item'],
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
        id:{
            type: Number,
            default: 0
        },
        status:{
            type: String,
            default: 'N/A'
        }
    },
    methods: {
        async deleteItem() {
            await HTTP.get(`/api/deleteJob/${this.id}`).then((response) => {
                console.log(response);
            });
            this.$emit('delete-item');
        },
        confirm_delete_modal() {
            this.$refs.confirm_delete_modal.showModal();
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
    background-color: rgba(107, 114, 128, 0.5); /* Tailwind’s gray-500 with reduced opacity */
}
.bg-opacity-50 {
    opacity: 0.5;
}
.flex {
    display: flex;
}
.items-center {
    align-items: center;
}
.justify-center {
    justify-content: center;
}
</style>
