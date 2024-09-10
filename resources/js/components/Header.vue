<script>
export default {
    methods: {
        logout() {
            let _this = this
            axios.get('/api/logout')
                .then(function (response) {
                    _this.$root.auth = null
                })
                .catch(function (error) {

                })
        }
    }
}
</script>

<template>
    <dialog class="modal" id="confirm_logout_modal">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want to log out?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="logout">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>
    <div class="navbar bg-amber-200">
        <div class="flex-1">
            <router-link class="btn btn-ghost text-xl" to="/problems">Live Code Editor</router-link>
        </div>
        <div class="flex-none gap-2">
            <div class="form-control">
                <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto"/>
            </div>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img v-if="$root.auth !== null"
                             alt="Avatar"
                             src="https://phunuvietnam.mediacdn.vn/thumb_w/700/179072216278405120/2021/12/3/amee202101-16385417919281354781258-316-0-941-1000-crop-16385418365003362492.jpg"/>
                        <img v-if="$root.auth === null" alt="Avatar"
                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcazeHuAcZDzv4_61fPLT-S00XnaKXch2YWQ&s">
                    </div>
                </div>
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li v-if="$root.auth !== null"><a class="text-base">Profile</a></li>
                    <li v-if="$root.auth !== null"><a class="text-base">Settings</a></li>
                    <li v-if="$root.auth !== null"><a class="text-base" onclick="confirm_logout_modal.showModal()">Logout</a></li>
                    <li v-if="$root.auth === null">
                        <router-link class="text-base" to="/login">Login</router-link>
                    </li>
                    <li v-if="$root.auth === null">
                        <router-link class="text-base" to="/register">Register</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
