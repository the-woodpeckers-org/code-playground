<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
import LocationPicker from '@/components/locationPicker/LocationPicker.vue';
import { HTTP } from "@/http-common.js";
import ContentCV from '@/components/cvs/ContentCV.vue';
import {
    RouterView,
    RouterLink
} from 'vue-router';
import { add, isFirstDayOfMonth } from 'date-fns';
export default {
    data() {
        return {
            User: getAuth(),
            Profile: {},
            selectedSkills: [],
            socials: [],
            isLoading: false,
            availableSkills: ['Java', 'Go', 'C', 'C#', 'C++', 'Rust', 'JavaScript', 'Python'],
            imagePreview: null,
            isMissingInfo: [],
            address: {
                province: null,
                district: null,
                ward: null,
                name: null
            },
            cv: {},
            rate: 0,

        };
    },
    components: { NavigatorCV, LocationPicker, ContentCV },
    methods: {
        showProfile() {
            profile_modal.showModal();
        }, addSkill(event) {
            const skill = event.target.value;
            if (skill && !this.selectedSkills.includes(skill)) {
                this.selectedSkills.push(skill);
                this.availableSkills = this.availableSkills.filter(s => s !== skill);
            }
            event.target.value = "Select a skill";
            console.log(this.selectedSkills);
        },
        removeSkill(skill) {
            this.selectedSkills = this.selectedSkills.filter(s => s !== skill);
            if (!this.availableSkills.includes(skill)) {
                this.availableSkills.push(skill);
            }
        },
        removeAll() {
            this.availableSkills = [...this.availableSkills, ...this.selectedSkills];
            this.selectedSkills = [];
        },
        closeProfile() {
            profile_modal.close();
        },
        async onLoad() {
            try {
                const response = await HTTP.get('/api/getProfileCV');
                if (response.data.user == null) {
                    this.User = this.getAuth();
                }
                if(response.data.cv){
                    this.cv = response.data.cv;
                }
                this.User = response.data.user;
                //     console.log(response.data.user);
                if (this.User.address != null) {
                    this.User.address = JSON.parse(this.User.address.replace(/'/g, '"'));
                    this.address.province = this.User.address[0];
                    this.address.district = this.User.address[1];
                    this.address.ward = this.User.address[2];
                    this.address.name = this.User.address[3];
                    this.imagePreview = this.User.avatar_url;
                }
                this.Profile = response.data.profile;
                if (this.Profile === "null") {
                    //   this.Profile={};
                }
                else {
                    //set profile
                    if (this.Profile.skill != null && this.Profile.social != null) {
                        const arrayOfSkills = JSON.parse(this.Profile.skill.replace(/'/g, '"'));
                        this.selectedSkills = arrayOfSkills;
                        this.availableSkills = this.availableSkills.filter(skill => !this.selectedSkills.includes(skill));
                        const arrayOfSocials = JSON.parse(this.Profile.social.replace(/'/g, '"'));
                        this.socials = arrayOfSocials.map(social => social.trim());
                    }
                }
                this.isLoading = true;
            } catch (error) {
                console.error("Failed to load profile:", error);
            }
        },
        onFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.imagePreview = URL.createObjectURL(file);
            }
        },
        SaveProfile() {
            const data = {
                user: {
                    id: this.User.id,
                    birthday: this.User.birthday,
                    gender: this.User.gender,
                    address: [this.address.province, this.address.district, this.address.ward, this.address.name]
                },
                profile: {
                    job_position: this.Profile.job_position,
                    experience: this.Profile.experience,
                    social: JSON.stringify(this.socials),
                    skill: JSON.stringify(this.selectedSkills)
                }
            };
            HTTP.post('/api/updateProfileCV', data)
                .then(response => {
                    this.isUpdateProfile = true;
                    setTimeout(() => {
                        window.location.reload();
                        this.isUpdateProfile = false;
                    }, 2000);
                    //        console.log(response.data);
                    this.rateCalculate();
                })
                .catch(error => {
                    console.error("Failed to save profile:", error);
                    alert("Save failed");
                });
        },
        handleAddressUpdated(address) {
            this.address.district = address.district;
            this.address.province = address.province;
            this.address.ward = address.ward;
        },
        rateCalculate() {
            const fields = [
                { key: "name", weight: 10, label: "Name", source: this.User },
                { key: "birthday", weight: 10, label: "Birthday", source: this.User },
                { key: "address", weight: 10, label: "Address", source: this.User },
                { key: "phone_number", weight: 10, label: "Phone number", source: this.User },
                { key: "email", weight: 5, label: "Email", source: this.User },
                { key: "email_verified_at", weight: 5, label: "Email verified", source: this.User },
                { key: "imagePreview", weight: 10, label: "Avatar", source: this },
                { key: "selectedSkills", weight: 10, label: "Skills", source: this },
                { key: "socials", weight: 10, label: "Socials", source: this },
                { key: "job_position", weight: 10, label: "Job position", source: this.Profile },
                { key: "experience", weight: 10, label: "Number of experience", source: this.Profile },
            ];

            let rate = 0;
            this.isMissingInfo = [];

            fields.forEach(({ key, weight, label, source }) => {
                if (Array.isArray(source[key]) ? source[key].length : source[key]) {
                    rate += weight;
                } else {
                    this.isMissingInfo.push({ label, weight });
                }
            });
            this.rate = rate;
        }
    },
    async mounted() {
        await this.onLoad();
        this.rateCalculate();
    },

}
</script>
<template>
    <dialog id="profile_modal" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <div class="flex flex-col-reverse">
                <div
                    class="flex items-start justify-between rounded-t dark:border-gray-600 border-b p-5 rounded-tl-xl md:rounded">
                    <h3 id=":r9:" class="text-xl font-medium text-gray-900 dark:text-white">
                        <p class="font-bold text-black">Personal information at a glance</p>
                        <p class="text-base font-normal text-gray-400">Fill in all the information to help you reach out
                            to the recruiter
                            use it with ease </p>
                    </h3>

                </div>
                <div class="flex justify-end p-0">
                    <button class="btn rounded-full bg-blue-200 text-white hover:bg-red-100 hover:text-black"
                        @click="closeProfile">X</button>
                </div>
            </div>
            <div class="p-6 flex-1 overflow-auto">
                <form id="basic-information-form">
                    <div class="space-y-6">
                        <h2 class="text-sm font-bold uppercase text-gray-400 md:text-md lg:text-2xl">Information</h2>
                        <div class="flex flex-wrap gap-3 md:gap-5">
                            <div class="w-full md:w-auto">
                                <div class="h-40 w-40 relative overflow-hidden rounded-full bg-gray-200">
                                    <img class="h-40 w-40 rounded-full"
                                        :src="this.User.avatar_url ? this.User.avatar_url : 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg'" />

                                </div>
                            </div>
                            <div class="grid grow grid-cols-2 gap-5">
                                <div class="form-group col-span-1"><label for="display_name"
                                        class="text-sm font-bold text-gray-500">Full name<span
                                            class="font-normal text-primary">*</span></label>
                                    <div class="relative">
                                        <div class="flex">
                                            <div class="relative w-full"><input
                                                    class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                    id="display_name" placeholder="Nguyễn Văn A"
                                                    value="PHAN NGOC BAO VINH" readonly></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-span-2 md:col-span-1"><label for="birthday"
                                        class="text-sm font-bold text-gray-500">Dob </label>
                                    <div class="relative w-full text-gray-700"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="DD/MM/YYYY" id="birthday" autocomplete="off"
                                            role="presentation" type="date" v-model="this.User.birthday"><button
                                            type="button"
                                            class="absolute right-0 h-full px-3 text-gray-400 focus:outline-none disabled:opacity-40 disabled:cursor-not-allowed"><svg
                                                class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            </svg></button>

                                    </div>
                                </div>
                                <div class="form-group col-span-2 md:col-span-1">
                                    <label for="gender" class="text-sm font-bold text-gray-500">Sex</label>
                                    <div class="grid grid-cols-3 justify-items-stretch overflow-hidden">
                                        <button type="button" class="h-[40px] rounded-bl rounded-tl border"
                                            :class="{ 'bg-blue-500 text-white': User.gender === 'Nam' }"
                                            @click="User.gender = 'Nam'">
                                            Male
                                        </button>
                                        <button type="button" class="h-[40px] border"
                                            :class="{ 'bg-blue-500 text-white': User.gender === 'Nữ' }"
                                            @click="User.gender = 'Nữ'">
                                            Female
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <h2 class="text-sm font-bold uppercase text-gray-400"></h2>
                        <div class="grid grid-cols-2 gap-3 md:gap-5">
                            <div class="form-group col-span-2 md:col-span-1"><label for="position"
                                    class="text-sm font-bold text-gray-500">Job a position<span
                                        class="font-normal text-primary">*</span></label>
                                <div class="relative">
                                    <div class="flex">
                                        <div class="relative w-full"><input
                                                class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                id="position" placeholder="Example: Back-end developer"
                                                v-model="this.Profile.job_position"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Year a experience<span
                                        class="font-normal text-primary">*</span></label>
                                <div class="relative">
                                    <div class="flex">
                                        <div class="relative w-full"><input
                                                class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                min="0" placeholder="Example: 2 years" type="number"
                                                v-model="this.Profile.experience"
                                                onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Email </label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            disabled="" v-model="this.User.email" readonly
                                            placeholder="Please setting email in the profile"></div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Contact <span
                                        class="font-normal text-primary"></span></label>
                                <div class="relative">
                                    <div class="flex">
                                        <div class="relative w-full"><input
                                                class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                placeholder="Please setting phone number in the profile"
                                                v-model="User.phone_number" readonly></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Address </label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="" v-model="address.name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">City/Province<span
                                        class="font-normal text-primary">*</span></label>
                                <LocationPicker v-if="User && User.address" :province="User.address[0] || null"
                                    :district="User.address[1] || null" :ward="User.address[2] || null"
                                    @address-updated="handleAddressUpdated" />
                                <LocationPicker v-else @address-updated="handleAddressUpdated" />
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Social </label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="https://www.linkedin.com/username" v-model="this.socials[0]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="hidden text-sm font-bold text-gray-500 md:block">&nbsp;</label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-700 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="https://github.com/username" v-model="this.socials[1]"></div>
                                </div>
                            </div>
                            <div class="form-group col-span-2"><label for=""
                                    class="text-sm font-bold text-gray-500">Skill<span
                                        class="font-normal text-primary">*</span></label>
                                <div class="relative w-full border rounded-md h-min p-3">
                                    <div class="grid grid-cols-6 gap-4">
                                        <div class="col-start-1 col-end-6">
                                            <div class="flex flex-wrap gap-2 w-2/3" id="skill-selected">
                                                <kbd v-for="(skill, index) in selectedSkills" :key="index" class="kbd">
                                                    {{ skill }}
                                                    <button type="button" @click="removeSkill(skill)" class="ml-2 text-red-500">
                                                        <i class="fa-solid fa-x"></i>
                                                    </button>
                                                </kbd>
                                            </div>
                                        </div>
                                        <div class="flex justify-end items-center gap-2">
                                            <button v-if="selectedSkills.length" @click="removeAll"
                                                class="flex items-center justify-center w-10 h-10 text-red-500">
                                                <i class="fa-solid fa-x"></i>
                                            </button>
                                            <p class="divider divider-horizontal divider-neutral h-auto"></p>
                                            <select class="select w-auto" @change="addSkill($event)">
                                                <option disabled selected>Select a skill</option>
                                                <option v-for="(skill, index) in availableSkills" :key="index"
                                                    :value="skill">
                                                    {{ skill }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <div class="flex gap-2">
                        <button class="btn ">Close</button>
                        <button class="btn btn-primary" @click="SaveProfile">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    <div>
        <NavigatorCV></NavigatorCV>
        <div class="mt-9 grid grid-cols-1 md:grid md:grid-cols-1 lg:flex">
            <div class="w-full lg:w-1/3 min-h-96 mr-9 rounded-xl">
                <div class="flex flex-col">
                    <div class=" bg-base-100">
                        <div class=" shadow w-full rounded-t-full ">
                            <div class="stat md:p-0 lg:p-3">
                                <div class="stat-figure text-secondary ">
                                    <div class="avatar">
                                        <div class="w-16 md:w-20 lg:w-20 rounded-full h-auto">
                                            <img
                                                :src="this.User.avatar_url ? this.User.avatar_url : 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg'" />

                                        </div>
                                    </div>
                                </div>
                                <div class="stat-value sm:text-sm md:text-lg lg:text-2xl">{{ this.rate }}%</div>
                                <div class="stat-title sm:text-base md:text-md lg:text-md">{{ this.User.name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 bg-base-100" v-if="this.isMissingInfo.length">
                        <label class="text-balance text-sm lg:text-md">You are missing the following
                            information:</label>
                        <ul class="grid grid-1 ml-2 border-none">
                            <span class="bg-primary rounded-full w-max mt-2 text-white animate-bounce"
                                v-for="(item, index) in this.isMissingInfo" :key="index"><a class="p-2">{{ item.label }}
                                    +{{ item.weight }}</a></span>
                        </ul>
                    </div>
                    <div class="mt-3 p-3 bg-base-100" v-else>
                        <label for="">You have completed enough personal information, which will help employers find
                            you</label>
                    </div>
                    <div class="mt-3 p-3 bg-gradient-to-tr from-cyan-300 to-purple-300">
                        <span class="text-sm md:text-md lg:text-md">🧑🏻‍💻 Activate the working state</span>
                        <div class="p-3 m-2 bg-white text-wrap">
                            <p>Enable the <b>"Looking for a job"</b> status and allow employers to search your profile.
                            </p>
                        </div>
                        <router-link to="/Job-manager"
                            class="underline text-base m-3 rotate-on-hover rotate-icon-on-hover "><b><i
                                    class="fa-solid fa-gear text-base"></i> Settings</b></router-link>
                    </div>
                </div>
            </div>
            <div class="mt-3 md:mt-3 lg:m-0 w-full">
                <div class="flex flex-col w-full justify-between">

                    <div>
                        <div class="m-3 flex flex-1 justify-between w-full">
                            <label for="" class="text-sm md:text-md lg:text-2xl  font-bold">Information</label>

                        </div>
                        <div class="relative hidden gap-8 rounded bg-white py-6 pl-6 pr-4 md:flex">
                            <div class="flex-none">
                                <div class="h-40 w-40 rounded-full bg-gray-500">
                                    <img alt="Avatar" loading="lazy" width="160" height="160" decoding="async"
                                        data-nimg="1" class="h-40 w-40 rounded-full" style="color: transparent"
                                        :src="this.User.avatar_url ? this.User.avatar_url : 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg'" />


                                </div>
                            </div>
                            <div class="flex-auto overflow-hidden">
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="overflow-hidden text-2xl font-bold text-black" v-if="User"> {{
                                            this.User.name }}
                                        </h4>
                                        <span
                                            class="ml-2 rounded-full bg-blue-50 px-3 py-[2px] text-sm font-bold text-blue-500">{{
                                                this.rate }}%</span>
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
                                                this.address.district + "," || " " }} {{ this.address.ward || " " }}
                                                <span v-if="this.address.name">{{ ", " + this.address.name
                                                    }}</span></span>
                                            <span v-else> Add address</span>

                                        </div>
                                        <div class="mt-1 flex">
                                            <div class="flex">
                                                <a class="underline">{{ User.email || 'Thêm mail' }}</a>
                                            </div>
                                            <div class="w-[30px] text-center">-</div>
                                            <div>{{ this.User.phone_number }}</div>
                                            <div class="w-[30px] text-center">-</div>
                                            <div><span class="whitespace-nowrap text-gray-700">{{ this.User.birthday ||
                                                "Add DOB" }}</span></div>
                                        </div>
                                        <div class="mt-1 flex gap-4"><span class="text-gray-700"
                                                v-for="(item, index) in this.selectedSkills" :key="index">{{ item
                                                    || "Add Skill" }} <span
                                                    v-if="index < this.selectedSkills.length - 1">,</span></span></div>
                                        <div class="mt-1 flex flex-col gap-4">
                                            <a v-for="(item, index) in socials" :key="index"
                                                class="text-gray-700 underline" :href="item" target="_blank"
                                                rel="noopener noreferrer">
                                                {{ item }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute right-4 flex flex-none"><button class="flex h-auto w-auto items-center"
                                    type="button"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                        </path>
                                    </svg>
                                    <span @click="showProfile"
                                        class="px-4 py-2 text-sm font-semibold text-neutral-900">Edit
                                        profile</span></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!this.cv">
            <div class="bg-base-100 w-full text-center mt-6 p-6 rounded-lg shadow-md">
                <p class="text-2xl text-sky-800 font-semibold mb-3">
                    Go create a CV and set it as your primary CV
                </p>
                <router-link :to="'/Mycv'"
                    class="btn bg-sky-800 text-white px-4 py-2 rounded-full hover:bg-sky-700 transition-all duration-300">
                    Create CV Now
                </router-link>
            </div>
        </div>
        <ContentCV v-else></ContentCV>
    </div>

    <dialog v-if="isUpdateProfile" id="" class="modal modal-open">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span>
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">Update successfully!</p>
        </div>
    </dialog>
</template>
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
<script setup>
import { getAuth } from "@/utils/authLocalStorage.js";
</script>
