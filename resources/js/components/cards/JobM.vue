<script>
import {HTTP} from '@/http-common.js'
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
        }
    },
    methods:{
      async deleteItem(){
            
          await HTTP.get(`/api/deleteJob/${this.id}`).then((response) => {
              console.log(response);
            });
            this.$emit('delete-item');
        }
    }
}
</script>

<template>
        <div
            class="border rounded-xl h-fit w-auto my-2 mx-3 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition">
            <div class="flex">
                <div >
                <router-link :to="this.link" >
                 <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
                    <h1 class="text-xl font-semibold" >{{ title }}</h1>
                    <p class="font-semibold">{{ salary }} $</p>
                    <p class="font-semibold">Available until: {{ date }}</p>
                    </router-link>                  
                </div>
                <div class="flex flex-row gap-2 ">
                    <i class="fa-solid fa-delete-left text-md md:text-xl lg:text-2xl  hover:text-red-500" onclick="confirm_delete_modal.showModal()"></i>
                </div>
            </div>
        </div>
     <dialog class="modal" id="confirm_delete_modal">
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

<style scoped></style>
