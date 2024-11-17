<template>
    <div class="mt-9 grid grid-cols-1 md:grid md:grid-cols-1 lg:flex">
        <div class="mt-3 md:mt-3 lg:m-0 w-full">
            <div class="flex flex-col w-full justify-between">

                <div>
                    <div class="m-3 flex flex-1 justify-between w-full">
                        <label for="" class="text-sm md:text-md lg:text-2xl  font-bold">Information</label>
                        <p></p>
                        <label for=""
                            class="items-center py-1 pl-3 pr-2 mb-3 text-xs font-normal border border-blue-500 rounded-full bg-blue-50">50%</label>
                    </div>
                    <div class="relative hidden gap-8 rounded bg-white py-6 pl-6 pr-4 md:flex">
                        <div class="flex-none">
                            <div class="h-40 w-40 rounded-full bg-gray-500">
                                <img alt="Avatar" loading="lazy" width="160" height="160" decoding="async" data-nimg="1"
                                    class="h-40 w-40 rounded-full" style="color: transparent"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s" />

                            </div>
                        </div>
                        <div class="flex-auto overflow-hidden">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-1.5">
                                    <h4 class="overflow-hidden text-2xl font-bold text-black" v-if="User"> {{
                                        this.User.name }}
                                    </h4>
                                    <span
                                        class="ml-2 rounded-full bg-blue-50 px-3 py-[2px] text-sm font-bold text-blue-500">50%</span>
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            
        </div>
    </div>
</template>
<script>
import { HTTP } from '@/http-common.js'
export default {
    name: "view-user-applied",
    data() {
        return {
            User: {},
            Profile: {},
            address: {},
            selectedSkills: [],
            skills: [],
            address: [],
            cv: {},
        }
    },
    mounted() {
        this.getUser();
    },
    methods: {
        getUser() {
            HTTP.get(`/api/getUserCVToView/${this.$route.params.id}`)
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
 
                    this.cv = response.data.cv;
                })
                .catch(error => {
                    console.log(error);
                });
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