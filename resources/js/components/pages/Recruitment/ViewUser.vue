<template>
    <router-link :to="'/Contest-managent'"> <button class="underline text-gray-500 mb-5 text-md text-xl">Back to
            management</button></router-link>
    <div v-if="this.isBlock">
        <div class="text-center">
            <div class="h-10">
            </div>
            <i class="fa-regular fa-face-sad-cry text-9xl my-6"></i>
            <h1 class="text-4xl font-semibold my-6">The current user is hiding information!</h1>
            <h1 class="text-3xl my-6">You can view CV</h1>
        </div>
    </div>
    <div v-else class="mt-9 grid grid-cols-1 md:grid md:grid-cols-1 lg:flex">
        <div class="mt-3 md:mt-3 lg:m-0 w-full">
            <div class="flex flex-col w-full justify-between">
                <div>
                    <div class="m-3 flex flex-1 justify-between w-full">
                        <label for="" class="text-sm md:text-md lg:text-2xl font-bold">Information</label>
                        <p></p>

                    </div>
                    <div class="relative hidden gap-8 rounded bg-white py-6 pl-6 pr-4 md:flex">
                        <div class="flex-none">
                            <div class="h-40 w-40 rounded-full bg-gray-500">
                                <img alt="Avatar" loading="lazy" width="160" height="160" decoding="async" data-nimg="1"
                                    class="h-40 w-40 rounded-full" style="color: transparent"
                                    :src="this.User.avatar_url" />
                            </div>
                        </div>


                        <div class="flex-auto overflow-hidden">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-1.5">
                                    <h4 class="overflow-hidden text-2xl font-bold text-black" v-if="User"> {{
                                        this.User.name }}
                                    </h4>
                                </div>
                                <div class="flex">
                                    <div class="flex items-center"><span
                                            class="overflow-hidden text-xl font-bold text-neutral-600">{{
                                                this.Profile.job_position || 'Add job position' }}</span>
                                        <div class="w-[30px] items-center justify-center text-center">-</div>
                                    </div>
                                    <div class="flex-none text-xl text-gray-500">Number a experience: {{
                                        this.Profile.experience || '0' }}</div>
                                </div>
                                <div class="mt-4 text-lg text-gray-600">
                                    <div class="flex w-100 truncate">
                                        <span v-if="this.User.address">{{ this.address.province + "," || " " }} {{
                                            this.address.district + "," || " " }} {{ this.address.ward || " " }} <span
                                                v-if="this.address.name">{{ ", " + this.address.name }}</span></span>
                                        <span v-else> Add address</span>

                                    </div>
                                    <div class="mt-1 flex">
                                        <div class="flex">
                                            <a class="underline">{{ User.email || 'No email yet' }}</a>
                                        </div>
                                        <div class="w-[30px] text-center">-</div>
                                        <div>{{ this.User.phone_number }}</div>
                                        <div class="w-[30px] text-center">-</div>
                                        <div><span class="whitespace-nowrap text-gray-700">{{ this.User.birthday ||
                                            " " }}</span></div>
                                    </div>
                                    <div class="mt-1 flex gap-4"><span class="text-gray-700"
                                            v-for="(item, index) in this.selectedSkills" :key="index">{{ item
                                                || "Add Skill" }} <span
                                                v-if="index < this.selectedSkills.length - 1">,</span></span></div>
                                    <div class="mt-1 flex flex-col gap-4">
                                        <a v-for="(item, index) in socials" :key="index" class="text-gray-700 underline"
                                            :href="item" target="_blank" rel="noopener noreferrer">
                                            {{ item }}
                                        </a>
                                    </div>
                                    <div class="mt-1 flex gap-4">
                                        <div v-if="this.User.is_active">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-3"
                                                @click="contact">Contact</button>
                                        </div>
                                        <div v-else>
                                            <span class="text-red-500 font-bold"><strong
                                                    class="text-xl font-bold text-black">{{ this.User.name }} </strong>
                                                are not ready to enter the job market</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ContentCV></ContentCV>
</template>
<script>
import { HTTP } from '@/http-common.js'
import ContentCV from '@/components/cvs/ContentCV.vue'
export default {
    name: "view-user-applied",
    components: {
        ContentCV
    },
    data() {
        return {
            User: {},
            Profile: {},
            address: {},
            selectedSkills: [],
            skills: [],
            address: [],
            isBlock: false,
        }
    },
    async mounted() {
        await this.getUser();
        if (this.isBlock === false) {
            await this.addViewHistory();
        }
    },
    methods: {
        async getUser() {
            await HTTP.get(`/api/getUserCVToView/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data);
                    this.User = response.data.user;
                    this.Profile = response.data.profile;
                    if (this.User.address != null) {
                        this.User.address = JSON.parse(this.User.address.replace(/'/g, '"'));
                        this.address.province = this.User.address[0];
                        this.address.district = this.User.address[1];
                        this.address.ward = this.User.address[2];
                        this.address.name = this.User.address[3];
                    }
                    const arrayOfSkills = JSON.parse(this.Profile.skill.replace(/'/g, '"'));
                    this.selectedSkills = arrayOfSkills;
                    if (response.data.hidden != null) {
                        this.isBlock = true;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async addViewHistory() {
            await HTTP.post(`/api/addViewHistory`, { profile_user_id: this.Profile.id })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        contact() {
            alert('Contact');
        }
    }

}
</script>

<style scoped>
@keyframes rotate {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

.rotate-icon-on-hover:hover i {
    animation: rotate 0.5s ease-in-out;
}
</style>