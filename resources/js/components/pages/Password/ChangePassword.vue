<script>
export default {
    name: "ChangePassword"
}
</script>

<template>
    <div class="w-full pt-16">
        <div class="border w-4/12 rounded-xl p-6 bg-gradient-to-tl from-cyan-100 to-purple-100 mx-auto">
            <form>
                <label>Your current password</label>
                <input type="password" class="w-full border rounded-md h-8" required>
                <div class="divider"></div>
                <label>New password</label>
                <input type="password" class="w-full border rounded-md h-8" required>
                <label>Confirm new password</label>
                <input type="password" class="w-full border rounded-md h-8" required>
                <button class="text-center font-semibold border rounded-xl">Change your password</button>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
