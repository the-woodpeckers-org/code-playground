<script>
import {HTTP} from "@/http-common.js";

export default {
    name: "ResetPassword",
    data: () => {
        return {
            password: String,
            confirm_password: String,
            isValid: Boolean,
            isSucceed: Boolean
        }
    },
    mounted() {
        this.password = this.confirm_password = "";
        this.isValid = false;
        this.isSucceed = false;
        this.checkIfValidToken();
    },
    methods: {
        async checkIfValidToken() {
            await HTTP.get('api/verify-reset-token',
                {
                    params: {
                        'token': this.$route.params.resetToken
                    }
                })
                .then((response) => {
                    this.isValid = true;
                })
                .catch((error) => {

                })
        },
        async sendRequest() {
            await HTTP.post('api/reset-password',
                {
                    'password': this.password,
                    'confirm_password': this.confirm_password,
                    'token': this.$route.params.resetToken
                })
                .then((response) => {
                    this.isSucceed = true;
                })
                .catch((error) => {

                })
        },
        redirect() {
            this.$router.go('/');
        }
    }
}
</script>

<template>
    <dialog id="success_modal" class="modal" :class="{'modal-open': this.isSucceed}">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Reset password successfully!</h3>
            <p class="py-4">You have reset your password successfully!</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn" @click="redirect">Ok</button>
                </form>
            </div>
        </div>
    </dialog>
    <form v-if="!$root.auth && isValid">
        <div class="w-full pt-16">
            <div class="border w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
                <h1 class="font-semibold mb-3">Please enter your new password</h1>
                <label class="font-bold">New password</label>
                <input v-model="password" type="password" class="border rounded p-1 w-full my-2 mb-2">
                <label class="font-bold">Confirm new password</label>
                <input v-model="confirm_password" type="password" class="border rounded p-1 w-full my-2 mb-2">
                <div class="text-center w-full my-3">
                    <button type="button"
                            class="rounded bg-amber-300 hover:bg-amber-600 p-2 border-amber-500 border transition"
                            @click="sendRequest">Reset password
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="w-full pt-16" v-if="!isValid">
        <div class="border w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
            <h1 class="font-semibold mb-3">This link is expired or invalid!</h1>
        </div>
    </div>
</template>

<style scoped>

</style>
