<script>
export default {
    name: "Login",
    data: function () {
        return {
            input_email: String,
            input_password: String,
            error_email: String,
            error_password: String,
            login_failed: Boolean
        }
    },
    methods: {
        login() {
            let _this = this
            axios.post('/api/login', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                email: _this.input_email,
                password: _this.input_password
            }).then(function (response) {
                _this.$root.auth = response.data.user
                _this.$router.go(-1)
            }).catch(function (error) {
                console.log(error)
                if (error.response.data.errors) {
                    _this.error_email = error.response.data.errors.email ? error.response.data.errors.email[0] : null
                    _this.error_password = error.response.data.errors.password ? error.response.data.errors.password[0] : null
                } else {
                    _this.error_email = _this.error_password = null
                }
                if (_this.error_email === null && _this.error_password === null) {
                    _this.login_failed = true
                }
            })
        }
    },
    created() {
        let _this = this
        this.input_password = this.input_email = ''
        this.login_failed = false
        this.error_email = this.error_password = null
    }
}
</script>

<template>
    <form v-if="!$root.auth">
        <div class="w-full my-3">
            <div class="border w-4/12 rounded-xl p-6 mx-auto">
                <div class="my-auto">
                    <label class="font-bold">Email</label>
                    <input v-model="input_email" type="email" class="border rounded p-1 w-full my-2 mb-2"
                           placeholder="example@email.com">
                    <label class="font-bold">Password</label>
                    <input v-model="input_password" type="password" class="border rounded p-1 w-full my-2 mb-2">
                    <div v-if="login_failed || error_email || error_password" class="alert alert-warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>
                            <h1 class="text-base" v-if="error_email">{{ error_email }}</h1>
                            <h1 class="text-base" v-if="error_password">{{ error_password }}</h1>
                            <h1 class="text-base" v-if="login_failed">Incorrect email or password!</h1>
                        </div>
                    </div>
                    <p class="my-2"><span><router-link class="link text-cyan-600 font-semibold"
                                          to="/reset-password">I forgot my password!</router-link></span></p>
                    <input class="p-1 me-3" type="checkbox">
                    <label class="my-auto">Keep me logged in</label>
                    <div class="text-center w-full my-3">
                        <button type="button" class="rounded bg-amber-300 hover:bg-amber-600 p-2 border-amber-500 border transition" @click="login">Login</button>
                    </div>

                    <p class="my-2 py-2">Don't have an account? <span><router-link class="text-blue-400 font-bold"
                                                                 to="/register">Sign up now!</router-link></span></p>
                    <p class="border-t my-2 py-2 text-center">Or login with</p>
                    <div class="w-full">
                        <p class="text-center text-4xl">
                            <router-link><i class="fa-brands fa-github hover:scale-125 transition mx-2"></i></router-link>
                            <router-link><i class="fa-brands fa-google hover:scale-125 transition mx-2"></i></router-link>
                            <router-link><i class="fa-brands fa-facebook hover:scale-125 transition mx-2"></i></router-link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
