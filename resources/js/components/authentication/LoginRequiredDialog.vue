<script>
export default {
    name: "LoginRequiredDialog",
    props: {
        title: {
            type: String,
            default: 'Login required'
        },
        message: {
            type: String,
            default: 'Click login below to login, or to register if you don\'t have an account.'
        }
    }
}
</script>

<template>
    <dialog v-if="!$root.auth" id="require_logged_in_modal" class="modal modal-open">
        <div class="modal-box">
            <h3 class="text-lg font-bold">{{ title }}</h3>
            <p class="py-4">{{ message }}</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <router-link type="button" class="btn btn-md bg-amber-300 hover:bg-amber-600 mx-1" to="/login">Login now
                    </router-link>
                    <button type="button" class="btn btn-md mx-1" @click="this.$router.go(-1)">Back</button>
                </form>
            </div>
        </div>
    </dialog>
</template>

<style scoped>

</style>
