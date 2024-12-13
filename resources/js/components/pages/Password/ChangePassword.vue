<script>
import {HTTP} from "@/http-common.js";

export default {
    name: "ChangePassword",
    data: () => {
        return {
            password: '',
            new_password: '',
            confirm_password: '',
            errors: { }
        }
    },
    methods: {
        changePassword() {
            const data = {
                email: this.$root.auth.email,
                password: this.password,
                new_password: this.new_password,
                confirm_password: this.confirm_password
            };
            HTTP.post('api/change-password', data)
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                    console.log(err);
                })
        }
    }
}
</script>

<template>
    <div class="w-full pt-16">
        <div
            class="border w-full lg:w-7/12 xl:w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
            <form class="flex flex-col">
                <label>Your current password</label>
                <input v-model="password" type="password" class="w-full border rounded-md h-8">
                <div class="divider"></div>
                <label>New password</label>
                <input v-model="new_password" type="password" class="w-full border rounded-md h-8">
                <div v-if="errors?.new_password" v-for="msg in errors.new_password"> {{ msg }} </div>
                <label>Confirm new password</label>
                <input v-model="confirm_password" type="password" class="w-full border rounded-md h-8">
                <div v-if="errors?.confirm_password" v-for="msg in errors.confirm_password"> {{ msg }} </div>
                <button type="button"
                        class="text-center font-semibold border rounded-md bg-blue-500 mx-auto my-6 p-1 text-white hover:bg-blue-600 transition w-52"
                        @click="changePassword">
                    Change your password
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>
input {
    padding-left: 3px;
    padding-right: 3px;
}
</style>
