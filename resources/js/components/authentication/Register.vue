<script>
export default {
    name: "Register",
    data: function () {
        return {
            input_firstName: String,
            input_lastName: String,
            input_gender: String,
            input_address: String,
            input_phoneNumber: String,
            input_email: String,
            input_password: String,
            input_confirm_password: String,
            input_agree_terms: Boolean,
        }
    },
    methods: {
        register() {
            let _this = this
            if (_this.input_agree_terms === true) {
                axios.post('/api/register', {
                    _token: document.querySelector('meta[name="csrf-token"]').content,
                    name: _this.input_firstName + ' ' + _this.input_lastName,
                    email: _this.input_email,
                    password: _this.input_password,
                    confirm_password: _this.input_confirm_password
                }).then(function (response) {
                    console.log(response)
                }).catch(function (error) {
                    console.log(error)
                })
            }
        }
    },
    created() {
        this.input_password = this.input_confirm_password = this.input_email = this.input_address =
            this.input_firstName = this.input_lastName = this.input_phoneNumber = ''
        this.input_agree_terms = this.must_agree = false
    }
}
</script>

<template>
    <form v-if="!$root.auth">
        <div class="w-full my-3 grid grid-cols-6">
            <span class="col-span-1"></span>
            <div class="col-span-4">
                <label class="font-bold my-auto">Email</label>
                <input v-model="input_email" type="email" class="border rounded p-1 w-full my-auto mb-2"
                       placeholder="example@email.com">
                <label class="font-bold my-auto">First name</label>
                <input v-model="input_firstName" type="text" class="border rounded p-1 w-full my-auto mb-2"
                       placeholder="John">
                <label class="font-bold my-auto">Last name</label>
                <input v-model="input_lastName" type="text" class="border rounded p-1 w-full my-auto mb-2"
                       placeholder="Doe">
                <label class="font-bold my-auto">Phone number</label>
                <input v-model="input_phoneNumber" type="tel" class="border rounded p-1 w-full my-auto mb-2"
                       placeholder="+8412345678">
                <label class="font-bold my-auto">Address</label>
                <input v-model="input_address" type="text" class="border rounded p-1 w-full my-auto mb-2"
                       placeholder="36 La Xuan Oai st., Thu Duc City, HCM City">
                <label class="font-bold my-auto">Gender</label>
                <div class="mb-2">
                    <input v-model="input_gender" id="male-gender" type="radio" name="gender" value="male"
                           class="border rounded p-1 me-3 my-auto" checked>
                    <label for="male-gender">Male</label>
                    <br>
                    <input v-model="input_gender" id="female-gender" type="radio" name="gender" value="female"
                           class="border rounded p-1 me-3 my-auto">
                    <label for="female-gender">Female</label>
                    <br>
                    <input v-model="input_gender" id="none-gender" type="radio" name="gender" value="none"
                           class="border rounded p-1 me-3 my-auto">
                    <label for="female-gender">Prefer not to say</label>
                    <br>
                </div>
                <label class="font-bold my-auto">Password</label>
                <input v-model="input_password" type="password" class="border rounded p-1 w-full my-auto mb-2">
                <label class="font-bold my-auto">Confirm password</label>
                <input v-model="input_confirm_password" type="password" class="border rounded p-1 w-full my-auto mb-2">
                <div :class="{'tooltip tooltip-open tooltip-bottom tooltip-warning': !input_agree_terms, 'inline-block relative': input_agree_terms}" data-tip="You must agree with our terms and conditions!">
                    <input v-model="input_agree_terms" class="p-1 me-3" type="checkbox" @input="onChangeAgreedCheckBox($event)">
                    <label class="my-auto">I agree to our terms and conditions</label>
                </div>

                <br>
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">Receive our newest information</label>
                <br>
                <div class="text-center my-3">
                    <button type="button" class="rounded bg-amber-300 hover:bg-amber-600 p-2" :class="{'btn-disabled bg-gray-300 text-gray-200': !input_agree_terms}" @click="register">Sign
                        Up
                    </button>
                </div>
            </div>
            <span class="col-span-1"></span>
        </div>
    </form>
</template>

<style scoped>

</style>
