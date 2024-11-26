<script>
import {HTTP} from "@/http-common.js";
import Toast from "@/components/messages/Toast.vue";

export default {
    name: "Register",
    components: {Toast},
    data: function () {
        return {
            input_firstName: '',
            input_lastName: '',
            input_gender: 'male',
            input_address: '',
            input_birthday: '',
            input_phoneNumber: '',
            input_email: '',
            input_password: '',
            input_confirm_password: '',
            errors: {

            },
            input_agree_terms: false,
            isRegistered: false,
            input_companyCode: null,
            input_companyName: null,
            input_companyAddress: null,
            statusResult: null,
        }
    },
    methods: {
        getAuth() {
            return getAuth
        },
        onErrors() {

        },
        register() {
            let _this = this
            if (_this.input_agree_terms === true) {
                axios.post('/api/register', {
                    _token: document.querySelector('meta[name="csrf-token"]').content,
                    name: _this.input_firstName + ' ' + _this.input_lastName,
                    gender: _this.input_gender,
                    birthday: _this.input_birthday,
                    phone_number: _this.input_phoneNumber,
                    email: _this.input_email,
                    address: _this.input_address,
                    password: _this.input_password,
                    confirm_password: _this.input_confirm_password
                }).then(function (response) {
                    _this.isRegistered = true;
                    setTimeout(() => {
                        _this.$router.push('/login');
                    }, 2000);
                }).catch(function (error) {
                    _this.errors = error.response.data.errors;
                })
            }
        },
        async registerCompany() {
            let _this = this
            if (_this.input_confirm_password !== _this.input_password) {
                alert('Password and confirm password must be the same');
                return;
            }
            if (_this.input_agree_terms === true) {
                await HTTP.post('/api/registerCompany', {
                    _token: document.querySelector('meta[name="csrf-token"]').content,
                    company_name: _this.input_companyName,
                    email: _this.input_email,
                    phone_number: _this.input_phoneNumber,
                    company_address: _this.input_companyAddress,
                    password: _this.input_password,
                    confirm_password: _this.input_confirm_password,
                    company_code: _this.input_companyCode,
                }).then(function (response) {
                    console.log(response);
                    _this.statusResult = response.data.status;
                    if (_this.statusResult === '200') {
                        alert('Register successfully');
                    } else {
                        alert('Register failed');
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            }
        }
    },
    created() {
        this.input_password = this.input_confirm_password = this.input_email = this.input_address =
            this.input_firstName = this.input_lastName = this.input_phoneNumber = ''
        this.input_agree_terms = false
    }
}
</script>
<script setup>
import {getAuth} from "@/utils/authLocalStorage.js";
</script>
<template>
    <div role="tablist" class="tabs tabs-bordered grid grid-cols-2 bg-white" v-if="!this.statusResult">
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Candidates"/>
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
            <form v-if="!getAuth()">
                <div class="w-full my-3 grid grid-cols-6">
                    <span class="col-span-1"></span>
                    <div class="col-span-4">
                        <label class="font-bold my-auto">Email</label>
                        <input v-model="input_email" type="email" class="border rounded p-1 w-full my-auto mb-2"
                               placeholder="example@email.com">
                        <p v-if="errors.email" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.email[0] }}</p>
                        <label class="font-bold my-auto">First name</label>
                        <input v-model="input_firstName" type="text" class="border rounded p-1 w-full my-auto mb-2"
                               placeholder="John">
                        <label class="font-bold my-auto">Last name</label>
                        <input v-model="input_lastName" type="text" class="border rounded p-1 w-full my-auto mb-2"
                               placeholder="Doe">
                        <p v-if="errors.name" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.name[0] }}</p>
                        <label class="font-bold my-auto">Phone number</label>
                        <input v-model="input_phoneNumber" type="tel" class="border rounded p-1 w-full my-auto mb-2"
                               placeholder="+8412345678">
                        <p v-if="errors.phone_number" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.phone_number[0] }}</p>
                        <label class="font-bold my-auto">Address</label>
                        <input v-model="input_address" type="text" class="border rounded p-1 w-full my-auto mb-2"
                               placeholder="36 La Xuan Oai st., Thu Duc City, HCM City">
                        <p v-if="errors.address" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.address[0] }}</p>
                        <label class="font-bold my-auto">Birthday</label>
                        <input v-model="input_birthday" type="date" class="border rounded p-1 w-full my-auto mb-2">
                        <p v-if="errors.birthday" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.birthday[0] }}</p>
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
                        <p v-if="errors.password" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.password[0] }}</p>
                        <label class="font-bold my-auto">Confirm password</label>
                        <input v-model="input_confirm_password" type="password" class="border rounded p-1 w-full my-auto mb-2">
                        <p v-if="errors.confirm_password" class="py-2 px-1 bg-red-500 rounded-lg text-white"><i class="fa-solid fa-triangle-exclamation"></i> {{ errors.confirm_password[0] }}</p>
                        <div
                            :class="{ 'tooltip tooltip-open tooltip-bottom tooltip-warning': !input_agree_terms, 'inline-block relative': input_agree_terms }"
                            data-tip="You must agree with our terms and conditions!">
                            <input v-model="input_agree_terms" class="p-1 me-3" type="checkbox">
                            <label class="my-auto">I agree to our terms and conditions</label>
                        </div>

                        <br>
                        <input class="p-1 me-3" type="checkbox">
                        <label class="my-auto">Receive our newest information</label>
                        <br>
                        <div class="text-center my-3">
                            <button type="button" class="rounded bg-amber-300 hover:bg-amber-600 p-2"
                                    :class="{ 'btn-disabled bg-gray-300 text-gray-200': !input_agree_terms }"
                                    @click="register">
                                Sign
                                Up
                            </button>
                        </div>
                    </div>
                    <span class="col-span-1"></span>
                </div>
            </form>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Employer" checked="checked"/>
        <div role="tabpanel"
             class="tab-content bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 border border-gray-300 rounded-lg p-8 shadow-lg">

            <form v-if="!$root.auth">
                <div class="space-y-6">
                    <div>
                        <label class="block font-semibold text-gray-800 mb-2">Email</label>
                        <input v-model="input_email" type="email"
                               class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none"
                               placeholder="example@email.com">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-800 mb-2">Phone Number</label>
                        <input v-model="input_phoneNumber" type="tel"
                               class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none"
                               placeholder="+8412345678">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-800 mb-2">Password</label>
                        <input v-model="input_password" type="password"
                               class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-800 mb-2">Confirm Password</label>
                        <input v-model="input_confirm_password" type="password"
                               class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-purple-700 mb-4">Company Information</h3>
                        <div>
                            <label class="block font-semibold text-gray-800 mb-2">Company Code</label>
                            <input v-model="input_companyCode" type="text"
                                   class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none"
                                   placeholder="123456">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-800 mb-2">Company Name</label>
                            <input v-model="input_companyName" type="text"
                                   class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none"
                                   placeholder="ABC Company">
                        </div>

                        <div>
                            <label class="block font-semibold text-gray-800 mb-2">Company Address</label>
                            <input v-model="input_companyAddress" type="text"
                                   class="border border-purple-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-purple-400 focus:outline-none"
                                   placeholder="36 La Xuan Oai st., Thu Duc City, HCM City">
                        </div>

                        <div class="mt-2">
                            <div
                                :class="{ ' tooltip tooltip-open tooltip-bottom tooltip-warning': !input_agree_terms, 'inline-block relative': input_agree_terms }"
                                data-tip="You must agree with our terms and conditions!">
                                <input v-model="input_agree_terms" class="p-1 me-3" type="checkbox">
                                <label class="my-auto">I agree to our terms and conditions</label>
                            </div>

                            <br>
                            <input class="p-1 me-3" type="checkbox">
                            <label class="my-auto">Receive our newest information</label>
                            <br>
                        </div>
                    </div>

                    <div class="text-center mt-8">
                        <button type="button"
                                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg px-6 py-3 transition duration-200 ease-in-out shadow-md"
                                :class="{ 'opacity-50 cursor-not-allowed': !input_agree_terms }"
                                @click="registerCompany"
                                :disabled="!input_agree_terms">
                            Sign Up
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div v-else>
        <div class="text-center pb-3">
            <span><i class="fa-regular fa-envelope text-4xl"></i></span>
            <h2 class="text-2xl font-semibold">We have received your company information and we will conduct a
                review</h2>
            <h2 class="text-2xl font-semibold">Check your email regularly</h2>
        </div>
    </div>
    <dialog v-if="isRegistered" id="register_modal" class="modal modal-open">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Congratulation!</h3>
            <p class="py-4">You have successfully registered! You will be redirect to login panel soon...</p>
        </div>
    </dialog>
</template>

<style scoped></style>
