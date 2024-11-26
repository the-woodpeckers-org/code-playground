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
    <div class="navbar bg-secondary" id="header_nav">
        <div class="flex-1 gap-10">
            <router-link class="text-xl" to="/">
                <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png"
                    class="h-12">
            </router-link>
            <div class="hidden lg:flex space-x-4">
                <router-link v-if="!getAuth() || (getAuth().role == Role.User || getAuth().role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/explore">
                    Explore
                </router-link>
                <router-link v-if="!getAuth() || (getAuth().role == Role.User || getAuth().role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/contests">
                    Contests
                </router-link>
                <router-link v-if="!getAuth() || (getAuth().role == Role.User || getAuth().role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl hidden" to="/courses">
                    Courses
                </router-link>
                <router-link v-if="!getAuth() || (getAuth().role == Role.User || getAuth().role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl hidden" to="/challenges">
                    Challenges
                </router-link>
                <router-link v-if="!getAuth() || (getAuth().role == Role.User || getAuth().role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/problems">
                    Problems
                </router-link>
                <router-link v-if="!getAuth() || (getAuth().role == Role.User || getAuth().role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/career">
                    Career
                </router-link>
                <router-link to="/Info-Recruitment" v-if="getAuth() && getAuth().role == Role.Company"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl">
                     Recruitment Profile
                </router-link>
                <router-link v-if="getAuth() && (getAuth().role == Role.Contributor || getAuth().role == Role.Company)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/contributor">
                    Contributor
                </router-link>
            </div>
        </div>
        <div class="lg:hidden items-center">
            <button @click="OpenMenu" class="text-white focus:outline-none hover:bg-gray-600 transition rounded-3xl">
                <!-- đổi cái hình khác -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <div class="flex-none gap-2">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img v-if="$root.auth" alt="Avatar" :src="$root.auth.avatar_url" loading="lazy" />
                        <img v-if="!$root.auth" alt="Avatar"
                            src="https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                            loading="lazy">
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li v-if="$root.auth">
                        <router-link class="text-base" to="/profile">Profile</router-link>
                    </li>
                    <li v-if="$root.auth">
                        <router-link class="text-base hidden" to="/settings">Settings</router-link>
                    </li>
                    <li v-if="$root.auth"><a class="text-base" onclick="confirm_logout_modal.showModal()">Logout</a>
                    </li>
                    <li v-if="!$root.auth">
                        <router-link class="text-base" to="/login">Login</router-link>
                    </li>
                    <li v-if="!$root.auth">
                        <router-link class="text-base" to="/register">Register</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div v-if="isMenuOpen" class="lg:hidden menu">
        <router-link class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/explore">
            Explore
        </router-link>
        <router-link class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/contests">
            Contests
        </router-link>
        <router-link class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/courses">
            Courses
        </router-link>
        <router-link class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/challenges">
            Challenges
        </router-link>
        <router-link class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/problems">
            Problems
        </router-link>
        <router-link class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/career">
            Career
        </router-link>
        <router-link to="/Info-Recruitment"
            class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">
        </router-link>
        <router-link to="/Info-Recruitment" class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl">
            Info Recruitment Profile
        </router-link>
    </div>
    <dialog v-if="isLoggedOut" id="register_modal" class="modal modal-open">
        <div class="modal-box">
            <h3 class="text-lg font-bold"></h3>
            <p class="py-4">You have logged out!</p>
        </div>
    </dialog>
</template>
<script setup>
import { getAuth } from "@/utils/authLocalStorage.js";
import { Role } from "@/utils/roles.js";
</script>
<script>
import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    data: function () {
        return {
            isMenuOpen: false,
            auth: getAuth(),
            isLoggedOut: false,
        }
    },
    methods: {
        logout() {
            localStorage.removeItem("accessToken");
            localStorage.removeItem("user");
            this.$root.auth = null;
            this.isLoggedOut = true;
            setTimeout(() => {
                this.isLoggedOut = false;
                window.location.reload();
            }, 2000);
        },
        OpenMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },

    },

}

</script>
<style scoped>
.router-link-active {
    font-weight: 600;
    color: rgb(51, 165, 227);
}
</style>
