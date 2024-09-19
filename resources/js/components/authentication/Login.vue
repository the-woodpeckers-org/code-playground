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
        <div class="w-full my-3 grid grid-cols-6">
            <span class="col-span-2"></span>
            <div class="col-span-2">
                <label class="font-bold my-auto">Email</label>
                <input v-model="input_email" type="email" class="border rounded p-1 w-full my-auto mb-2"
                       placeholder="example@email.com">
                <label class="font-bold my-auto">Password</label>
                <input v-model="input_password" type="password" class="border rounded p-1 w-full my-auto mb-2">
                <div v-if="login_failed || error_email || error_password" class="alert alert-warning">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h1 class="text-base" v-if="error_email">{{ error_email }}</h1>
                        <h1 class="text-base" v-if="error_password">{{ error_password }}</h1>
                        <h1 class="text-base" v-if="login_failed">Incorrect email or password!</h1>
                    </div>
                </div>
                <p><span><router-link class="text-cyan-700 font-semibold"
                                      to="/reset-password">I forgot my password!</router-link></span></p>
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">Keep me logged in</label>
                <div class="text-center w-full my-3">
                    <button type="button" class="rounded bg-amber-300 hover:bg-amber-600 p-2" @click="login">Login
                    </button>
                </div>

                <p>Don't have an account? <span><router-link class="text-blue-400 font-bold"
                                                             to="/register">Sign up now!</router-link></span></p>
            </div>
            <span class="col-span-2"></span>
        </div>
    </form>
</template>

<style scoped>

</style>
