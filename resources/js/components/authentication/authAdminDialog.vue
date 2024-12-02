<template >
    <div>
        <dialog v-if="this.getAuth().role != Role.Admin" id="require_logged_in_modal" class="modal modal-open">
            <div class="modal-box">
                <h3 class="text-lg font-bold">{{ title }}</h3>
                <p class="py-4">{{ message }}</p>
                <div class="modal-action">
                    <form method="dialog">
                        <button type="button" class="btn btn-md mx-1" @click="this.$router.go(-1)">Back</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
</template>
<script setup>
import { Role } from "@/utils/roles.js";
</script>
<script>
import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    
    name: "authAdminDialog",
    methods: {
        getAuth() {
            return getAuth();
        }
    },
    props: {
        title: {
            type: String,
            default: 'Warning'
        },
        message: {
            type: String,
            default: 'You are not allowed to access here'
        }
}
}
</script>
<style >
    
</style>