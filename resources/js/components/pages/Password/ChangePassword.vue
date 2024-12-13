<script>
import {HTTP} from "@/http-common.js";

export default {
    name: "ChangePassword",
    data: () => {
        return {
            password: '',
            new_password: '',
            confirm_new_password: ''
        }
    },
    methods: {
        changePassword() {
            const data = {};
            HTTP.post('api/change-password', data)
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
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
                <input type="password" class="w-full border rounded-md h-8">
                <div class="divider"></div>
                <label>New password</label>
                <input type="password" class="w-full border rounded-md h-8">
                <label>Confirm new password</label>
                <input type="password" class="w-full border rounded-md h-8">
                <button type="button"
                        class="text-center font-semibold border rounded-md bg-blue-500 mx-auto my-6 p-1 text-white hover:bg-blue-600 transition w-52">
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
