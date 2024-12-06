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
                <router-link v-if="!$root.auth || ($root.auth.role == Role.User || $root.auth.role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/contests">
                    Contests
                </router-link>
                <router-link v-if="!$root.auth || ($root.auth.role == Role.User || $root.auth.role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl hidden" to="/courses">
                    Courses
                </router-link>
                <router-link v-if="!$root.auth || ($root.auth.role == Role.User || $root.auth.role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl hidden" to="/challenges">
                    Challenges
                </router-link>
                <router-link v-if="!$root.auth || ($root.auth.role == Role.User || $root.auth.role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/problems">
                    Problems
                </router-link>
                <router-link v-if="!$root.auth || ($root.auth.role == Role.User || $root.auth.role == Role.Contributor)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/career">
                    Career
                </router-link>
                <router-link to="/Info-Recruitment" v-if="$root.auth && $root.auth.role == Role.Company"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl">
                    Recruitment Profile
                </router-link>
                <router-link
                    v-if="$root.auth && ($root.auth.role == Role.Contributor || $root.auth.role == Role.Company)"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/contributor">
                    Contributor
                </router-link>
                <router-link v-if="$root.auth && $root.auth.role == Role.Company && $root.auth.Order.length == 0"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/UpgradePlan">
                    Upgrade Plan
                </router-link>
                <router-link v-if="$root.auth && $root.auth.role == Role.Company && $root.auth.Order.length > 0"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl animate-pulse">
                    Premium
                </router-link>
                <router-link v-if="$root.auth && $root.auth.role == Role.Company"
                    class="py-2 px-3 hover:bg-gray-600 hover:text-white transition rounded-3xl" to="/order-history">
                    Order History
                </router-link>
            </div>
        </div>
        <div class="lg:hidden items-center">
            <button @click="OpenMenu" class="text-white focus:outline-none hover:bg-gray-600 transition rounded-3xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <div v-if="$root.auth" class="flex-none mx-8">
            <div class="dropdown dropdown-end mb-4">
                <div tabindex="0" role="button">
                    <span class="relative flex h-3 w-3">
                        <span v-if="unRead > 0"
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75">
                        </span>
                        <span class="relative inline-flex rounded-full h-3 w-3" :class="{ 'bg-sky-500': unRead > 0 }">
                            <i class="fa-regular fa-bell text-xl"></i>
                        </span>
                        <span class="mx-3 text-blue-600" v-if="unRead > 0">
                            {{ unRead }}
                        </span>
                    </span>
                </div>
                <div tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-72 p-2 shadow h-[400px]">
                    <h2 class="p-2 border-b text-md">Notifications</h2>
                    <div class="grid grid-cols-1 w-full h-min-10 overflow-y-scroll">
                        <Notification v-if="$root.auth" v-for="(item, index) in notifications" :key="index"
                            :data="item">
                        </Notification>
                        <p v-if="notifications.length === 0">You have no notifications!</p>
                    </div>
                </div>
            </div>
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
                        <router-link class="text-base" :to="'/profile/' + $root.auth.id" :key="$route.fullPath">Profile
                        </router-link>
                    </li>
                    <li v-if="$root.auth" onclick="confirm_logout_modal.showModal()">
                        <p class="text-base">Logout</p>
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
    <dialog v-if="isLoggedOut" id="logout_modal" class="modal modal-open">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-orange-500 animate-jump-in">
                <span>
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">You have logged out!</p>
        </div>
    </dialog>
    <dialog class="modal" ref="advertise_modal">
        <div class="modal-box w-11/12 p-0">
            <div class="absolute right-0 text-end hover:text-red-400 p-2" role="button" @click="closeAdvertise">
                <i class="fa-solid fa-x"></i>
            </div>
            <div class="flex justify-center">
                <router-link to="/UpgradePlan">
                    <img src="https://res.cloudinary.com/ddgnrqr3j/image/upload/v1732898177/b0yiiiemh70zwsxua4bf.png"
                        alt="Image" class="block max-w-full h-auto">
                </router-link>
            </div>
            <div class="">
                <label for="">Do not show again</label>
                <input type="checkbox" @click="handleDoNotShowAgain">
            </div>
        </div>
    </dialog>

</template>
<script setup>
import { Role } from "@/utils/roles.js";
import Notification from "@/components/notifications/Notification.vue";
</script>
<script>
import { HTTP } from "@/http-common.js";
export default {
    async mounted() {
        if (this.$root.auth) {
            await this.getNotifications();
            if (this.$root.auth.role === Role.Company && this.$root.auth.Order.length == 0) {
                this.checkAdvertiseStatus();
            }
        }
    },
    data() {
        return {
            isMenuOpen: false,
            isLoggedOut: false,
            notifications: [],
            unRead: 0,
            isRemind: false,
        }
    },
    methods: {
        logout() {
            localStorage.removeItem("accessToken");
            localStorage.removeItem("user");
            sessionStorage.removeItem("doNotShowAdvertise");
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
        async getNotifications() {
            let _this = this;
            await HTTP.get('/api/getNotification').then((response) => {
                this.notifications = response.data.notifications;
                this.notifications.forEach((item) => {
                    if (!item.is_read) {
                        this.unRead += 1;
                    }
                });
            }).catch((err) => {
            });
        },
        closeAdvertise() {
            this.$refs.advertise_modal.close();
        },
        handleDoNotShowAgain(event) {
            const isChecked = event.target.checked;
            if (isChecked) {
                sessionStorage.setItem("doNotShowAdvertise", "true");
            } else {
                sessionStorage.removeItem("doNotShowAdvertise");
            }
        },
        checkAdvertiseStatus() {
             const doNotShowAdvertise = sessionStorage.getItem("doNotShowAdvertise");
                if (doNotShowAdvertise === "true") {
                    this.closeAdvertise();
                } else {
                    this.$refs.advertise_modal.showModal();
                }
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
