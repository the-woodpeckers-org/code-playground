<template>
    <LoginRequiredDialog></LoginRequiredDialog>
    <authAdminDialog></authAdminDialog>
    <div class="flex">
        <div class="w-[400px] h-full bg-gray-200 text-white" v-show="showSide" style="min-width:300px">
            <div class="h-[50px] bg-gray-900 flex justify-start  items-center ">
                <div class="px-[20px]">
                    <h3 class="font-bold text-xl">Admin Dashboard</h3>
                </div>
            </div>
            <div class="h-[calc(100vh-50px)] bg-gray-800 py-[20px] min-w-min">
                <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px]">
                    <div class=" flex flex-col justify-between space-y-[10px]">
                        <router-link to="/admin/statistics"
                            class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                            <i class="fa-solid fa-chart-simple text-xl mr-3"></i><span>Statistics</span>
                        </router-link>
                        <router-link to="/admin/user"
                            class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                            <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px] fill-current" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            User
                        </router-link>
                        <div>
                            <button @click="toggleSubscribeDropdown"
                                class="inline-flex items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md hover:bg-gray-300 hover:text-gray-800 transition duration-400 ease-in-out">
                                <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px] fill-current" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Subscribe
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div v-show="showSubscribeDropdown" class="ml-6 space-y-2">
                                <router-link to="/admin/subscribe/company"
                                    class="inline-flex items-center py-[5px] px-[10px] w-full text-sm font-medium rounded-md hover:bg-gray-300 hover:text-gray-800 transition duration-300 ease-in-out">
                                    Company
                                </router-link>
                                <router-link to="/admin/subscribe/contributor"
                                    class="inline-flex items-center py-[5px] px-[10px] w-full text-sm font-medium rounded-md hover:bg-gray-300 hover:text-gray-800 transition duration-300 ease-in-out">
                                    Contributor
                                </router-link>
                            </div>
                        </div>
                        <router-link to="/admin/contests"
                            class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                            <i class="fa-solid fa-trophy text-xl mr-3"></i><span>Contests</span>
                        </router-link>
                        <router-link to="/admin/applications"
                            class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                            <i class="fa-solid fa-bag-shopping text-xl mr-3"></i><span>Applications</span>
                        </router-link>
                        <router-link to="/admin/problems"
                            class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                            <i class="fa-solid fa-book text-xl mr-3"></i><span>Problems</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-full bg-gray-400">
            <div class="h-[50px] bg-gray-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b ">
                <!-- Hambuger menu -->
                <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" w-[25px] h-[25px]">
                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
                </div>
                <!-- Search bar -->

                <div class="w-[calc(100%-30px)] flex">
                    <div class="w-[calc(100%-200px)] flex justify-center ">
                      
                    </div>
                    <!-- User login -->
                    <div class="w-[200px] ">
                        <div class="flex items-center justify-start space-x-4" @click="toggleDrop">
                            <img v-if="$root.auth" src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726073233/OIG3.8-Photoroom_we02zq.png" class="w-10 h-10 rounded-full border-2 border-gray-50"
                                alt="">
                            <div class="font-semibold dark:text-white text-left">
                                <div v-if="$root.auth">{{ $root.auth.name }}</div>
                                <div v-if="$root.auth" class="text-xs text-gray-500 dark:text-gray-400">{{
                                    $root.auth.role }}</div>
                            </div>
                        </div>
                        <!-- Drop down -->
                        <div v-show="showDropDown"
                            class="absolute right-[10px] z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1 text-left" role="none">
                                <form method="POST" action="#" role="none">
                                    <button type="button" class="text-gray-700 block w-full px-4 py-2 text-left text-sm"
                                        role="menuitem" tabindex="-1" id="menu-item-3" @click="logout">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" bg-gray-50 " style="min-height: 680px">
                <div class="border border-gray-300 rounded-md ">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <!-- Main  -->
    </div>
</template>
<script>
import { getAuth } from "@/utils/authLocalStorage.js";
import LoginRequiredDialog from "@/components/authentication/LoginRequiredDialog.vue";
import authAdminDialog from "@/components/authentication/authAdminDialog.vue";

export default {
    components: {
        LoginRequiredDialog,authAdminDialog
    },
    data() {
        return {
            showDropDown: false,
            showSide: true,
            auth: getAuth(),
            showSubscribeDropdown: false,
        }
    },
    methods: {
        toggleSideBar() {
            this.showSide = !this.showSide

        },
        toggleDrop() {
            this.showDropDown = !this.showDropDown

        },
        toggleSubscribeDropdown() {
            this.showSubscribeDropdown = !this.showSubscribeDropdown;
        },
        logout() {
            localStorage.removeItem("accessToken");
            localStorage.removeItem("user");
            this.$root.auth = null;
            this.isLoggedOut = true;
            setTimeout(() => {
                this.isLoggedOut = false;
                window.location.reload();
            }, 2000);
        }
    }

}
</script>
<style scoped>
.router-link-active {
    color: red;
}
</style>