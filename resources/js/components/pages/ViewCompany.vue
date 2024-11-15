<script>
import { HTTP } from "@/http-common.js";
import CardJob from "@/components/listItems/CardJob.vue";
export default {
    name: "ViewCompany",
    components: {
        CardJob,
    },
    data() {
        return {
            profileCompany: {},
            jobRecruitments: [],
            userCompany: {},
            skills: [],
            address: [],
        }
    },
    async mounted() {
        console.log(this.$route.params.id);
        await this.getCompany();
    },
    methods: {
        async getCompany() {
            let _this = this;
            await HTTP.get(`/api/getProfileCompany/${this.$route.params.id}`)
                .then(response => {
                    _this.profileCompany = response.data.data.profileCompany;
                    _this.userCompany = response.data.data.userCompany;
                    _this.jobRecruitments = response.data.data.jobRecruitments;
                    _this.skills = JSON.parse(_this.profileCompany.skill.replace(/'/g, '"'));
                    _this.address =JSON.parse(_this.profileCompany.address.replace(/'/g, '"'));
                    console.log(_this.skills);
                })
                .catch(e => {
                    console.log(e);
                });
        },
    },
}
</script>

<template>
    <div class="grid grid-cols-3 gap-6">
        <div class="relative col-span-2">
            <div id="company-header-section" class="pt-6">
                <div class="relative"><img alt="HEINEKEN Vietnam" loading="lazy" width="832" height="250"
                        decoding="async" data-nimg="1" class="h-[250px] w-full max-w-full rounded bg-white object-cover"
                        style="color: transparent;"
                        srcset="https://salt.topdev.vn/tu4EGpNODfjK75d0IMcdJBwUu2xFMZcGZpeCqBkX-x4/fit/1080/1000/ce/1/aHR0cHM6Ly9hc3NldHMudG9wZGV2LnZuL2ltYWdlcy8yMDIzLzA3LzI1L1RvcERldi0wNWMzODFhMDg2ODhlMTczNTQ5YWRlZWYzMmIxM2IyMS0xNjkwMjUwNzY3LmpwZw 1x, https://salt.topdev.vn/b32n0RDzJinX8I99VfcNDcrKrnl4TC5Y4tPniNBl1Xo/fit/1920/1000/ce/1/aHR0cHM6Ly9hc3NldHMudG9wZGV2LnZuL2ltYWdlcy8yMDIzLzA3LzI1L1RvcERldi0wNWMzODFhMDg2ODhlMTczNTQ5YWRlZWYzMmIxM2IyMS0xNjkwMjUwNzY3LmpwZw 2x"
                        src="https://salt.topdev.vn/b32n0RDzJinX8I99VfcNDcrKrnl4TC5Y4tPniNBl1Xo/fit/1920/1000/ce/1/aHR0cHM6Ly9hc3NldHMudG9wZGV2LnZuL2ltYWdlcy8yMDIzLzA3LzI1L1RvcERldi0wNWMzODFhMDg2ODhlMTczNTQ5YWRlZWYzMmIxM2IyMS0xNjkwMjUwNzY3LmpwZw">
                    <div>
                        <div id="common-information"
                            class="w-full absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-24 px-8">
                            <div class="flex gap-4 rounded bg-white p-4">
                                <div><img alt="HEINEKEN Vietnam" loading="lazy" width="160" height="112"
                                        decoding="async" data-nimg="1" class="h-28 w-40 rounded-xl object-contain p-2"
                                        style="color: transparent;"
                                        srcset="https://salt.topdev.vn/YxHsQOf4D4Q3JJ4kNLf9mNwNYB1Xw722KaH1yBUP6Ug/fit/256/1000/ce/1/aHR0cHM6Ly9hc3NldHMudG9wZGV2LnZuL2ltYWdlcy8yMDIzLzA3LzI1L1RvcERldi1Mb2dvLUhOSy0tLVZOLS0tVnktSG8tVGh1eS0xNjkwMjUwNzY2LnBuZw 1x, https://salt.topdev.vn/Ru6dFW-fIBb_E1E7iYOlIs_JFcAHZuPA8s0qQ4rOIWM/fit/384/1000/ce/1/aHR0cHM6Ly9hc3NldHMudG9wZGV2LnZuL2ltYWdlcy8yMDIzLzA3LzI1L1RvcERldi1Mb2dvLUhOSy0tLVZOLS0tVnktSG8tVGh1eS0xNjkwMjUwNzY2LnBuZw 2x"
                                        src="https://salt.topdev.vn/Ru6dFW-fIBb_E1E7iYOlIs_JFcAHZuPA8s0qQ4rOIWM/fit/384/1000/ce/1/aHR0cHM6Ly9hc3NldHMudG9wZGV2LnZuL2ltYWdlcy8yMDIzLzA3LzI1L1RvcERldi1Mb2dvLUhOSy0tLVZOLS0tVnktSG8tVGh1eS0xNjkwMjUwNzY2LnBuZw">
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-lg font-bold">{{ this.userCompany.name }}</h1>
                                    <p class="mt-1 text-lg">{{ this.userCompany.name }}</p>
                                    <div class="mt-2 flex flex-1 items-center gap-2 text-gray-400"><span
                                            class="text-xl"><svg stroke="currentColor" fill="none" stroke-width="1.5"
                                                viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776">
                                                </path>
                                            </svg></span><button type="button"
                                            class="font-semibold underline transition-all hover:text-primary">{{
                                                this.jobRecruitments.length }} recruitment position</button></div>
                                    <div class="mt-4 flex gap-4">
                                        <div class="flex-1"><button id="" type="button"
                                                class="inline-flex items-center justify-center gap-1 border border-solid text-sm transition-all disabled:cursor-not-allowed lg:gap-3 lg:text-base border-primary bg-primary text-white hover:border-primary-400 hover:bg-primary-400 disabled:border-gray-200 disabled:bg-gray-200 disabled:text-gray-100 undefined h-9 rounded px-4 font-semibold lg:h-12 lg:px-6 w-full"
                                                form=""><span
                                                    class="flex items-center justify-center text-lg lg:text-2xl h-5 w-5"><svg
                                                        stroke="currentColor" fill="none" stroke-width="1.5"
                                                        viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z">
                                                        </path>
                                                    </svg></span><span class="">Follow</span></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 w-full bg-gray-100 pb-2 pt-4 lg:top-[5.25rem] invisible opacity-0">
                <div class="flex items-start gap-6 rounded bg-white p-4">
                    <div class="flex-1 text-lg">
                        <p class="font-bold">{{ this.userCompany.name }}</p>
                        <p class="mt-1 line-clamp-1">{{ this.userCompany.name }} - Brewing a Better Vietnam</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="flex h-6 w-6 items-center justify-center"><button type="button"
                                class="text-2xl"><svg stroke="currentColor" fill="none" stroke-width="1.5"
                                    viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z">
                                    </path>
                                </svg></button></div><button type="button"
                            class="flex h-6 w-6 items-center justify-center text-2xl"><svg stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em"
                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                                    clip-rule="evenodd"></path>
                            </svg></button>
                    </div>
                </div>
            </div>
            <div id="tabMnf" role="tablist" class="tabs tabs-bordered grid grid-cols-2 bg-white w-full h-min-[500px]">
                <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Description" />
                <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                    <div v-html="profileCompany?.description"></div>
                </div>

                <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Recruitment Position"
                    checked="checked" />

                <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                    <div class="grid grid-cols-1 gap-4 overflow-x-auto" style="height: 500px;">
                        <CardJob v-for="job in jobRecruitments" :key="job.id" :title="job.title" :skill="job.skill" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="py-6">
                <div class="rounded bg-white">
                    <div
                        class="border-b border-t border-solid border-gray-200 bg-gray-100 px-4 py-2 lg:border-none lg:bg-white lg:py-4">
                        <h2 class="text-base font-bold lg:text-lg">General Information</h2>
                    </div>
                    <hr class="hidden lg:block">
                    <div class="p-4">
                        <div v-html="profileCompany?.general_information"></div>
                        <div class="mt-4">
                            <h3 class="font-bold">Skill</h3>
                            <ul class="mt-1 flex flex-wrap">

                                <li class="mt-2">
                                    <a class="mr-2 inline-block" v-for="(item, index) in this.skills" :key="index"><span
                                            class="whitespace-nowrap rounded border border-solid font-normal transition-all inline-flex items-center justify-center border-blue-light text-blue-dark bg-blue-light hover:border-blue-dark h-[1.625rem] px-2 text-xs md:h-7 md:px-2 md:text-sm">
                                            {{item}}</span></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="rounded bg-white">
                        <div class="p-4">
                            <h2 class="text-base font-bold lg:text-lg">Contact</h2>
                        </div>
                        <hr>
                        <div class="p-4 pt-0">
                            <div class="mt-4">
                                <h3 class="font-bold">Website</h3><a
                                    class="mt-2 inline-block break-all text-blue-dark hover:underline" target="_blank"
                                    href="http://heineken-vietnam.com.vn/">http://heineken-vietnam.com.vn/</a>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-bold">Address</h3>
                                <ul class="mt-2">
                                    <li>
                                        <div class="rounded border border-solid border-white p-2 transition-all">
                                            <div class="flex items-start gap-2"><span class="inline-block text-2xl"><svg
                                                        stroke="currentColor" fill="none" stroke-width="2"
                                                        viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg></span>
                                                    <a v-if="this.profileCompany.address">{{ this.address[3] + "," || " " }} {{ this.address[2]+ "," || " " }} {{ this.address[1]  || " "}} <span v-if="this.address[0]">{{", "+this.address[0] }}</span></a> 
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
