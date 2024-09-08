<script>
export default {
    name: "Login"
}
</script>

<template>
    <form>
        <div class="w-full my-3 grid grid-cols-6">
            <span class="col-span-2"></span>
            <div class="col-span-2">
                <label class="font-bold my-auto">Email</label>
                <input type="email" class="border rounded p-1 w-full my-auto mb-2" placeholder="example@email.com">
                <label class="font-bold my-auto">Password</label>
                <input type="password" class="border rounded p-1 w-full my-auto mb-2">
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">Keep me logged in</label>
                <div class="text-center w-full my-3">
                    <button class="rounded bg-amber-300 hover:bg-amber-600 p-2">Login</button>
                </div>
                <p>Don't have an account? <span><router-link class="text-blue-400 font-bold" to="/register">Sign up now!</router-link></span></p>
            </div>
            <span class="col-span-2"></span>
        </div>
    </form>
</template>

<style scoped>

</style>
