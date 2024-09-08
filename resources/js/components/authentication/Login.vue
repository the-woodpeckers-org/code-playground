<script>
export default {
    name: "Login",
    data: function() {
        return {
            input_email: String,
            input_password: String,
            required_email: Boolean,
            required_password: Boolean,
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
                if (response.data.succeed === true) {
                    _this.$router.go(-1)
                }
                else {
                    console.log(response)
                    _this.required_email = response.data.errors.emailRequired
                    _this.required_password = response.data.errors.passwordRequired
                    if (response.data.errors.emailRequired === false && response.data.errors.passwordRequired === false) {
                        _this.login_failed = true
                    } else {
                        _this.login_failed = false
                    }
                }
            }).catch(function (error) {
                console.log(error)
            })
        }
    },
    created() {
        let _this = this
        this.input_password = this.input_email = ''
        this.required_email = this.required_password = this.login_failed = false
    }
}
</script>

<template>
    <form v-if="!$root.auth">
        <div class="w-full my-3 grid grid-cols-6">
            <span class="col-span-2"></span>
            <div class="col-span-2">
                <label class="font-bold my-auto">Email</label>
                <input v-model="input_email" type="email" class="border rounded p-1 w-full my-auto mb-2" placeholder="example@email.com">
                <p v-if="required_email" class="text-red-600">Email is required!</p>
                <label class="font-bold my-auto">Password</label>
                <input v-model="input_password" type="password" class="border rounded p-1 w-full my-auto mb-2">
                <p v-if="required_password" class="text-red-600">Password is required!</p>
                <p v-if="login_failed" class="text-red-600">Incorrect email or password!</p>
                <p><span><router-link class="text-cyan-700 font-semibold" to="/reset-password">I forgot my password!</router-link></span></p>
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">Keep me logged in</label>
                <div class="text-center w-full my-3">
                    <button type="button" class="rounded bg-amber-300 hover:bg-amber-600 p-2" @click="login">Login</button>
                </div>

                <p>Don't have an account? <span><router-link class="text-blue-400 font-bold" to="/register">Sign up now!</router-link></span></p>
            </div>
            <span class="col-span-2"></span>
        </div>
    </form>
</template>

<style scoped>

</style>
