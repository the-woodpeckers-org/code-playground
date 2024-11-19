<script>
import {HTTP} from "@/http-common.js";
import {getAuth, renewAuth} from "@/utils/authLocalStorage.js";
import PINBox from "@/components/authentication/PINBox.vue";

export default {
    name: "UserEmailVerification",
    components: {PINBox},
    data: () => {
        return {
            currentEmail: "",
            remaining: 0,
            isVerifyRequestSent: false,
            isSent: false,
            isLoading: false,
            auth: getAuth(),
            code: "",
        }
    },
    methods: {
        async sendVerificationEmail() {
            if (!this.isVerifyRequestSent) {
                this.isLoading = true;
                await HTTP.post('api/auth/send-verification-email')
                    .then((response) => {
                        this.isVerifyRequestSent = true;
                        this.isLoading = false;
                        this.isSent = true;
                        this.remaining = 10;
                        renewAuth();
                        this.countDown();
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        async verifyEmail() {
            let _this = this;
            await HTTP.patch('api/auth/verify-email', {
                token: _this.code
            })
                .then((response) => {
                    console.log(response);
                    renewAuth();
                    _this.$router.go(-1);
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        sendCode(code) {
            this.code = code;
            console.log(this.code);
        },
        async countDown() {
            if (this.remaining > 0) {
                setTimeout(() => {
                    this.remaining--;
                    this.countDown();
                }, 1000);
            } else {
                this.isVerifyRequestSent = false;
            }
        }
    },
    mounted() {
        let _this = this;
        HTTP.get('api/auth/get')
            .then((response) => {
                _this.currentEmail = response.data.email;
            })
            .catch((err) => {

            });
    }
}
</script>

<template>
    <div v-if="auth && !auth.email_verified_at" class="w-full pt-16">
        <div class="border w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
            <p>Click the below button and we will send you an mail to verify your current email!</p>
            <p class="mt-3">Your current email: <span class="font-semibold">{{ currentEmail }}</span></p>
            <div class="text-center mt-3">
                <p v-if="this.isSent" class="text-start p-1 bg-green-300 rounded-xl"><i class="fa-solid fa-check"></i>
                    An verification mail has been sent to your email address. Please check your email. If you don't see
                    it, please click the button below again!</p>
                <button @click="sendVerificationEmail()" :disabled="this.isVerifyRequestSent || this.isLoading"
                        class="text-center w-32 rounded-lg font-semibold p-2 shadow-xl text-base-300 mt-3 whitespace-nowrap"
                        :class="{'bg-blue-500 hover:bg-blue-700 transition': !this.isVerifyRequestSent && !this.isLoading, 'bg-gray-400': this.isVerifyRequestSent || this.isLoading}">
                    <span v-if="!this.isVerifyRequestSent && !this.isLoading">Send email</span>
                    <span v-if="this.isVerifyRequestSent"> {{ this.remaining }} </span>
                    <span v-if="this.isLoading" class="loading loading-dots loading-xs"></span>
                </button>
            </div>
            <div class="text-center" v-if="this.isSent">
                <PINBox @sendCode="sendCode($event)" :config="{size: 5}"></PINBox>
                <button @click="verifyEmail()"
                        class="text-center w-32 rounded-lg font-semibold p-2 shadow-xl text-base-300 mt-3 whitespace-nowrap bg-blue-500 hover:bg-blue-700 transition">
                    Verify
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
