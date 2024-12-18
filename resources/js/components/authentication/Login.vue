<script setup>
import { Role } from "@/utils/roles.js";
</script>
<script>
import {HTTP} from "@/http-common.js";
import {getAuth, setAccessToken, setAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "Login",
    data: function () {
        return {
            input_email: String,
            input_password: String,
            error_email: String,
            error_password: String,
            login_failed: Boolean,
            auth: getAuth(),
            isLoggingIn: false,
            isLoggedIn: false,
            isPending: false,
            isDeactive: false
        }
    },
    mounted() {
        let input = document.getElementById("ipassword");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("loginBtn").click();
            }
        });
    },
    methods: {
        login() {
            let _this = this
            this.isLoggingIn = true;
            HTTP.post('/api/login', {
                email: _this.input_email,
                password: _this.input_password
            }).then(function (response) {
                setAccessToken(response.data.token);
                setAuth(response.data.user);
                _this.$root.auth = getAuth();
                console.log(localStorage.getItem('accessToken'))
                _this.isLoggedIn = true;
                setTimeout(() => {
                    if(_this.$root.auth.role == Role.Admin) {
                        _this.$router.push('/admin');
                    } else {
                        _this.$router.push('/');
                        window.location.reload();
                    }
                    _this.isLoggingIn = false;
                }, 2000);
            }).catch(function (error) {
                if(error.response.data.message==="Your account is pending approval.")
                {
                    _this.isPending = true;
                    setTimeout(() => {
                        _this.isPending = false;
                        window.location.reload();
                    }, 3000);
                    return;
                }
                if(error.response.data.message==="Your account is deactive.")
                {
                    _this.isDeactive = true;
                    setTimeout(() => {
                        _this.isDeactive = false;
                        window.location.reload();
                    }, 3000);
                    return;
                }
                if (error.response.data.errors) {
                    _this.error_email = error.response.data.errors.email ? error.response.data.errors.email[0] : null
                    _this.error_password = error.response.data.errors.password ? error.response.data.errors.password[0] : null
                } else {
                    _this.error_email = _this.error_password = null
                }
                if (_this.error_email === null && _this.error_password === null) {
                    _this.login_failed = true
                }
                _this.isLoggingIn = false;
            })
        }
    },
    created() {
        this.input_password = this.input_email = ''
        this.login_failed = false
        this.error_email = this.error_password = null
    }
}
</script>

<template>
    <form v-if="!auth">
        <div class="w-full">
            <div class="border w-full lg:w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
                <label class="font-bold">Email</label>
                <input v-model="input_email" type="email" class="border rounded p-1 w-full my-2 mb-2"
                       placeholder="example@email.com">
                <label class="font-bold">Password</label>
                <input id="ipassword" v-model="input_password" type="password" class="border rounded p-1 w-full my-2 mb-2">
                <div v-if="login_failed || error_email || error_password" class="alert alert-warning">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h1 class="text-base" v-if="error_email">{{ error_email }}</h1>
                        <h1 class="text-base" v-if="error_password">{{ error_password }}</h1>
                        <h1 class="text-base" v-if="login_failed">Incorrect email or password!</h1>
                    </div>
                </div>
                <p class="my-2"><span><router-link class="link text-cyan-600 font-semibold"
                                                   to="/forgot-password">I forgot my password!</router-link></span></p>
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">Keep me logged in</label>
                <div class="text-center w-full my-3">
                    <button id="loginBtn"
                            type="button"
                            class="rounded bg-amber-300 hover:bg-amber-600 p-2 border-amber-500 border transition w-32"
                            @click="login">
                        <span v-if="!isLoggingIn">Login</span>
                        <span v-if="isLoggingIn" class="loading loading-dots loading-xs"></span>
                    </button>
                </div>

                <p class="my-2 py-2">Don't have an account? <span><router-link class="text-blue-400 font-bold"
                                                                               to="/register">Sign up now!</router-link></span>
                </p>
            </div>
        </div>
    </form>
    <dialog v-if="isLoggedIn" id="login_modal" class="modal modal-open">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span>
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">Login successfully!</p>
        </div>
    </dialog>


    <dialog v-if="isPending" id="login_modal" class="modal modal-open">
    <div class="modal-box text-center overflow-hidden bg-white shadow-lg rounded-lg">
        <div class="flex justify-center items-center my-4">
            <div class="w-16 h-16 flex justify-center items-center bg-green-100 rounded-full">
                <i class="fa-solid fa-hourglass-half text-green-500 text-3xl"></i>
            </div>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Account Pending Approval</h3>
        <p class="py-4 font-medium text-gray-600">
            Your account is currently under review. Please check back later!
        </p>
        <button @click="isPending = false"
            class="mt-4 px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-300">
            OK
        </button>
    </div>
</dialog>


<dialog v-if="isDeactive" id="deactivate_modal" class="modal modal-open">
    <div class="modal-box text-center overflow-hidden bg-white shadow-lg rounded-lg">
        <div class="flex justify-center items-center my-4">
            <div class="w-16 h-16 flex justify-center items-center bg-red-100 rounded-full">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-3xl"></i>
            </div>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Account Deactivation</h3>
        <p class="py-4 font-medium text-gray-600">
            Your account has been deactivated. Please contact support or try again later.
        </p>
        <button @click="isDeactive = false"
            class="mt-4 px-6 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:ring-4 focus:ring-red-300">
            OK
        </button>
    </div>
</dialog>

</template>

<style scoped>

</style>
