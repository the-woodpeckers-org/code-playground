<template>
    <div class="mt-[1px] bg-gray-100 pb-10 last:pb-0 md:mt-0 md:py-6 md:pb-6" onscroll="handleOnScroll()">
        <div class=" flex flex-wrap items-start gap-6 px-0 md:flex-nowrap md:px-4">
            <div class=" flex w-full flex-col gap-4 md:w-[67.62%]">
                <div class="flex items-start gap-6 rounded bg-white p-4">
                    <div class="flex w-[21%] flex-initial items-center justify-center bg-white"><a
                            class="flex min-h-[112px] items-center justify-center" title="DevOps Engineer"><img
                                alt="TopDev" loading="lazy" width="160" height="112" decoding="async" data-nimg="1"
                                class="h-full max-h-[112px] w-[160px] bg-white object-contain"
                                style="color: transparent; " :src="userCompany.avatar_url"></a>
                    </div>
                    <div class="w-3/4 flex flex-initial flex-col">
                        <h1 class="text-2xl font-bold text-black text-ellipsis line-clamp-2 ">{{ job.title }}</h1>
                        <p class="my-1 line-clamp-1 text-base font-bold text-gray-500">{{ job.location }}</p>
                        <div class="my-2 max-w-[540px] text-base text-gray-500">
                            <div class="mb-2 flex last:mb-0">
                                <i class="fa-solid fa-language text-md lg:text-xl mr-3"></i>
                                <div class="w-11/12">
                                    <span v-for="(item, index) in skills" :key="index">
                                        <strong>{{ item }}</strong><span v-if="index < skills.length - 1">,</span>&nbsp;
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="mb-2 max-w-[540px] text-base text-gray-500">
                            <div class="flex last:mb-0">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                    aria-hidden="true" class="mr-2 flex h-6 w-6 items-center text-gray-300" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="flex w-11/12 items-center text-base text-gray-500">{{ job.deadline }}</div>
                            </div>
                        </div>
                        <div class="flex max-w-[540px] items-center">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                aria-hidden="true" class="mr-2 h-6 w-6 text-gray-300" height="1em" width="1em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-primary" v-if="job.negotiable">Negotiable</p>
                            <p class="text-primary" v-else>{{ job.salary }}</p>
                        </div>
                    </div>

                </div>
                <div id="tabMnf" role="tablist" class="tabs tabs-bordered grid grid-cols-2 bg-white">
                    <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Description" />
                    <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                        <div v-html="this.job.description"></div>
                    </div>

                    <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="About company"
                        checked="checked" />
                    <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                        <div v-html="this.profileCompany.description"></div>
                    </div>
                </div>

            </div>
            <div v-if="job.isEnded" class="flex w-full flex-wrap grap-4 md:w-[32.38%]">
                <div
                    class=" w-full rounded border-primary bg-primary font-semibold text-white hover:border-primary-400 hover:bg-primary-400 disabled:border-gray-200 disabled:bg-gray-200 disabled:text-gray-100 lg:h-14 h-14">
                    <h2 class="flex justify-center p-3">This job is ended. See you next time!</h2>  
                </div>
            </div>
            <div v-else class="flex w-full flex-wrap gap-4 md:w-[32.38%]" id="tabMnf2" v-if="!isApplied">
                <button id="applyCV"
                    class="w-full rounded border-primary bg-primary font-semibold text-white hover:border-primary-400 hover:bg-primary-400 disabled:border-gray-200 disabled:bg-gray-200 disabled:text-gray-100 lg:h-14 h-14"
                    data-gtm-vis-first-on-screen8747084_30="642" data-gtm-vis-recent-on-screen8747084_30="409592"
                    data-gtm-vis-total-visible-time8747084_30="100" data-gtm-vis-has-fired8747084_30="1"
                    onclick="applyShow.showModal()">Apply
                    now
                </button>
                <button id="createTopdevCV" type="button"
                    class="inline-flex items-center justify-center gap-1 border border-solid text-sm transition-all disabled:cursor-not-allowed lg:gap-3 lg:text-base border-primary bg-transparent text-primary hover:bg-primary-100 dark:border-white dark:text-white h-9 rounded px-4 font-semibold lg:h-14 lg:px-8 w-full"
                    @click="createCV"><span>Create CV to apply</span></button>
                <section class="w-full bg-white">
                    <h2 class="p-4 text-lg font-bold text-gray-500">General information</h2>
                    <div class="flex flex-col self-stretch border-t border-gray-200 p-4">
                        <div class="flex flex-wrap">
                            <div v-html="this.profileCompany.general_information"></div>
                        </div>

                    </div>
                </section>
            </div>
            <div class="flex w-full flex-wrap gap-4 md:w-[32.38%]" id="tabMnf2" v-else>
                <button id="applyCV"
                    class="w-full rounded border-primary bg-primary font-semibold text-white hover:border-primary-400 hover:bg-primary-400 disabled:border-gray-200 disabled:bg-gray-200 disabled:text-gray-100 lg:h-14 h-14"
                    data-gtm-vis-first-on-screen8747084_30="642" data-gtm-vis-recent-on-screen8747084_30="409592"
                    data-gtm-vis-total-visible-time8747084_30="100" data-gtm-vis-has-fired8747084_30="1">You was applied
                </button>
                <button id="createTopdevCV" type="button"
                    class="inline-flex items-center justify-center gap-1 border border-solid text-sm transition-all disabled:cursor-not-allowed lg:gap-3 lg:text-base border-primary bg-transparent text-primary hover:bg-primary-100 dark:border-white dark:text-white h-9 rounded px-4 font-semibold lg:h-14 lg:px-8 w-full hover:bg-red-500 hover:text-white"
                    form="" onclick="ConfirmCancelApply.showModal()"><span class="">Cancel applied</span></button>
                <section class="w-full bg-white">
                    <h2 class="p-4 text-lg font-bold text-gray-500">General information</h2>
                    <div class="flex flex-col self-stretch border-t border-gray-200 p-4">
                        <div class="flex flex-wrap">
                            <div v-html="this.profileCompany.general_information"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
    <dialog class="modal" id="applyShow">
        <div class="w-[75%] md:max-w-screen-md lg:max-w-screen-lg bg-base-100 p-3 rounded">
            <h3 class="text-lg font-semibold">Notifications</h3>
            <p class="py-4 text-base">You are applying at the position: {{ this.job.location }}</p>
            <form @submit.prevent="ApplyCV">
                <div class="lg:flex lg:flex-col">

                    <div class="grid sm:grid-cols-1 md:grid lg:grid-cols-6 gap-4">
                        <div class="col-span-1">
                            <h2 class="font-semibold">Information</h2>
                        </div>
                        <div class="col-span-5 sm:grid sm:grid-cols-1 lg:flex lg:flex-col">
                            <div class="lg:flex lg:flex-row lg:gap-5">
                                <div class="flex flex-col">
                                    <label for="applicantName">Name</label>
                                    <input type="text" class="border border-gray-300 rounded p-2 w-full"
                                        :value="auth.name" readonly>
                                </div>
                                <div class="flex flex-col">
                                    <label for="phone">Phone Number </label>
                                    <input type="text" class="border border-gray-300 rounded p-2 w-full"
                                        :value="auth.phone_number" readonly>
                                </div>
                                <div class="flex flex-col">
                                    <label for="email">Email</label>
                                    <input type="text" class="border border-gray-300 rounded p-2 w-full"
                                        :value="auth.email" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <h2 class="font-semibold">Choose CV</h2>
                        </div>
                        <div class="col-span-5">
                            <select name="cv" class="border border-gray-300 rounded p-2 w-full">
                                <option value="">Choose CV</option>
                                <option v-for="(item, index) in listCvs" :key="index" :value="item.id">{{ item.title }}
                                </option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <h2 class="font-semibold">Letter</h2>
                        </div>
                        <div class="col-span-5">
                            <textarea name="coverLetter" rows="5" class="border border-gray-300 rounded p-2 w-full"
                                required v-model="letter"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" class="px-4 py-2 bg-red-500 text-white rounded"
                        onclick="document.getElementById('applyShow').close()">Close
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
                </div>
            </form>
        </div>
    </dialog>
    <dialog class="modal" id="ConfirmCancelApply">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure to cancel your application?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="cancelApply">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>

</template>
<script>
import { HTTP } from "@/http-common.js";
import { getAuth } from "@/utils/authLocalStorage.js";
import InterviewKit from "@/components/cards/InterviewKit.vue";

export default {
    components: {
        InterviewKit
    },
    data() {
        return {
            job: {},
            skills: [],
            profileCompany: {},
            auth: getAuth(),
            listCvs: {},
            letter: '',
            id_CV: '',
            isApplied: false,
            userCompany: {},

        }
    },
    name: "DetailJobs",
    async mounted() {
        this.setUp();
        await this.fetchData();
    },
    update() {
        this.setUp();
    },
    methods: {
        setUp() {
            let firstTop = 0;
            let element = document.getElementById("tabMnf");
            let rect = element.getBoundingClientRect();
            firstTop = rect.top;
            document.addEventListener("scroll", (event) => {
                if (window.scrollY >= firstTop && window.scrollY <= rect.top - 50) {
                    element.classList.add('lg:fixed');
                    element.classList.add('lg:top-0');
                    element.classList.add('lg:w-[58%]');
                    element.classList.add('lg:scroll-mt-28');
                } else {
                    element.classList.remove('lg:fixed');
                    element.classList.remove('lg:top-0');
                    element.classList.remove('lg:w-[58%]');
                }
            }
            );
        },
        async fetchData() {
            let _this = this;
            await HTTP.get(`/api/getDetailJob/${this.$route.params.id}`).then(response => {
                _this.job = response.data.data;
                _this.profileCompany = response.data.profileCompany;
                _this.skills = JSON.parse(this.job.skill.replace(/'/g, '"'))
                _this.userCompany = response.data.userCompany;
                console.log(response.data);
            }).catch(error => {
                console.log(error)
            });

            await HTTP.get('/api/cvsU').then(response => {
                _this.listCvs = response.data.data;
            }).catch(error => {
                console.log(error)
            });

            await HTTP.get(`/api/isApplied/${this.$route.params.id}`).then(response => {
                _this.isApplied = response.data.isApplied;
            }).catch(error => {
                console.log(error)
            });
        },
        async ApplyCV() {
            let _this = this;
            this.id_CV = document.querySelector('select[name="cv"]').value;
            const job = {
                job_id: this.$route.params.id,
                cv_id: this.id_CV,
                letter: this.letter
            }
            console.log(job);
            await HTTP.post('/api/applyCV', job).then(response => {
                console.log(response.data)
                HTTP.get(`/api/isApplied/${this.$route.params.id}`).then(response => {
                    console.log(response.data)
                    _this.isApplied = response.data.isApplied;
                    console.log(this.isApplied)
                }).catch(error => {
                    console.log(error)
                });
            }).catch(error => {
                console.log(error)
            });
            applyShow.close();
        },

        async cancelApply() {
            let _this = this;
            await HTTP.get(`/api/cancelApply/${this.$route.params.id}`).then(response => {
                console.log(response.data)
                HTTP.get(`/api/isApplied/${this.$route.params.id}`).then(response => {
                    console.log(response.data)
                    _this.isApplied = response.data.isApplied;
                    console.log(this.isApplied)
                }).catch(error => {
                    console.log(error)
                });
            }).catch(error => {
                console.log(error)
            });

        },
        createCV() {
            this.$router.push('/Mycv');
        }
    },


}
</script>
