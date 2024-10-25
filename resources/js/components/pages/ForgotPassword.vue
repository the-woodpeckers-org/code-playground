<script>
export default {
    name: "ForgotPassword",
    
}
</script>

<template>
    <form v-if="!$root.auth">
        <div class="w-full pt-16">
            <div class="border w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
                <h1 class="font-semibold mb-3">Please enter your account email</h1>
                <label class="font-bold">Email</label>
                <input v-model="input_email" type="email" class="border rounded p-1 w-full my-2 mb-2"
                       placeholder="example@email.com">
                <div class="text-center w-full my-3">
                    <button type="button"
                            class="rounded bg-amber-300 hover:bg-amber-600 p-2 border-amber-500 border transition"
                            @click="login">Reset password
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
