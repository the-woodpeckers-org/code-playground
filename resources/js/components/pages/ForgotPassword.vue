<script>
import {HTTP} from "@/http-common.js";

export default {
    name: "ForgotPassword",
    data: () => {
        return {
            input_email: String,
            isSucceed: Boolean,
            errorMessage: String,
            isSendingEmail: false,
        }
    },
    mounted() {
        this.isSucceed = false;
        this.input_email = "";
        this.errorMessage = "";
    },
    methods: {
        async sendRequest() {
            this.isSendingEmail = true;
            await HTTP.post('api/forgot-password',
                {
                    email: this.input_email
                })
                .then((response) => {
                    if (response.data.passwordResetToken) {
                        this.isSucceed = true;
                        this.isSendingEmail = false;
                    }
                })
                .catch((error) => {
                    this.errorMessage = error.message;
                });
        },
    }
}
</script>

<template>
    <dialog id="error_modal" class="modal" :class="{'modal-open': this.errorMessage !== ''}">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Error</h3>
            <p class="py-4">We cannot find your email!</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn" @click="this.errorMessage = ''">Ok</button>
                </form>
            </div>
        </div>
    </dialog>
    <dialog id="success_modal" class="modal" :class="{'modal-open': this.isSucceed}">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Success!</h3>
            <p class="py-4">A new email has been sent to you. Please check your email to confirm!</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn" @click="this.isSucceed = false">Ok</button>
                </form>
            </div>
        </div>
    </dialog>
    <form v-if="!$root.auth">
        <div class="w-full pt-16">
            <div class="border w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
                <h1 class="font-semibold mb-3">Please enter your account email</h1>
                <label class="font-bold">Email</label>
                <input v-model="input_email" type="email" class="border rounded p-1 w-full my-2 mb-2"
                       placeholder="example@email.com">
                <div class="text-center w-full my-3">
                    <button type="button"
                            class="rounded bg-amber-300 hover:bg-amber-600 p-2 border-amber-500 border transition w-40"
                            @click="sendRequest"
                            :disabled="isSendingEmail">
                        <span v-if="!isSendingEmail">Reset password</span>
                        <span v-if="isSendingEmail" class="loading loading-dots loading-xs"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
