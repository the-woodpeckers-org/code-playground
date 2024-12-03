<template>
    <div class="border rounded-md shadow-sm hover:bg-gray-100 transition duration-200 hover:cursor-pointer"
        @click="viewDetailNotification">
        <h2 class="font-bold text-md text-gray-800">{{ data.type }}</h2>
        <p class="text-gray-600 text-ellipsis line-clamp-1">{{ data.message }}</p>
        <p class="text-sm text-gray-500">ID: {{ data.fid }}</p>
        <p v-if="!data.is_read" class="text-sm font-semibold text-green-600">New</p>
    </div>
    <dialog ref="viewDetail" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Notification</h3>
            <p class="py-4">
                <span class="font-semibold">Type:</span> {{ data.type }}
                <span class="font-semibold">Message:</span> {{ data.message }}
                <span class="font-semibold">Form: </span> {{ data.fid }}
            </p>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>
<script>
import {HTTP} from "@/http-common.js";
export default {
    name: "Notification",
    props: {
        data: {}
    },
    methods: {
        async viewDetailNotification() {
            this.$refs.viewDetail.showModal();
            await HTTP.post('/api/isReadNotification',{notification_id: this.data.id}).then(response => {
                console.log(response.data);
                data.is_read = true;
            });
        }
    },
    updated() {
        console.log(this.data);
    }
};
</script>

<style scoped></style>
