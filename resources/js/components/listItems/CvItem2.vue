<script>
import { format } from 'date-fns';
import { HTTP } from "@/http-common.js";
export default {
    name: 'CvItem2',
    props: {
        updated: String,
        id: Number,
        title: String,
        isPrimary: Boolean,
        updatedAt: String,
    },
   computed:{
    formattedDate() {
            return format(new Date(this.updatedAt), 'dd/MM/yyyy');
        }
   }

}
</script>
<template lang="">
           <div class="p-4 bg-gray-100 info-resumes rounded-xl pr-9 w-full">
            <div class="flex flex-wrap items-center font-semibold name-resume">{{ this.title }}.pdf
                <div class="md:ml-2">
                </div>
             </div>
             <span class="text-xs text-gray-400">Updated at {{formattedDate}}</span>
        </div>
</template>
