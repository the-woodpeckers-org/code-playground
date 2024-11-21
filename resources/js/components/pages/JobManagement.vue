<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
import CvItem2 from '@/components/listItems/CvItem2.vue';
import { HTTP } from "@/http-common.js";
import SearchDynamic from '@/components/search/SearchDynamic.vue';
export default {
    components: {
        NavigatorCV, CvItem2, SearchDynamic
    },
    data() {
        return {
            User: {},
            Profile: {},
            isLoading: false,
            listItemcvs: Array,
            settingSelectedCv: null,
            settingActivce: null,
            list_company_hidden: [],
            CompanyHidden: {},
            remove_id: null,
            list_company_view_history:[],
        };
    },
    async mounted() {
        await this.getListCompanyView();
        await this.getUser();
        await this.getCvU();
    },
    methods: {
        async getUser() {
            let _this = this
            await
                HTTP.get('/api/getProfileCV')
                    .then(response => {
                        _this.User = response.data.user;
                        _this.Profile = response.data.profile;
                        _this.list_company_hidden = response.data.hiddenCompanies;
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
        },
        async getCvU() {
            let _this = this
            await
                HTTP.get('/api/cvsU')
                    .then(response => {
                        _this.listItemcvs = response.data.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            _this.isLoading = true;
        },
        async setPrimaryCV(id) {
            let _this = this
            const cv_id = _this.id;
            await
                HTTP.post(`/api/setPrimaryCv`, { cv_id: id })
                    .then(response => {
                    })
                    .catch(error => {
                        console.error(error);
                    });
        },
        async setActive() {
            let _this = this;
            await HTTP.post('/api/setActiveProfile')
                .then(response => {
                })
                .catch(error => {
                    console.error(error);
                });

        },
        async getListCompanyView()
        {
            let _this = this
            await
                HTTP.get('/api/getListCompanyView')
                    .then(response => {
                        _this.list_company_view_history = response.data.data;
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
        },
        handleSearchSelected(suggestion) {
            this.CompanyHidden = suggestion;
            this.$refs.confirmHiddenCompany.showModal();
        },
        async confirmHideCompany() {

            await HTTP.post('/api/addHiddenCompany', { profile_user_id: this.Profile.id, profile_company_id: this.CompanyHidden.get_company.id })
                .then(response => {
                    alert('Hidden company successfully');
                    this.getUser();
                })
                .catch(error => {
                    console.error(error);
                });
            this.closeModal();

        },
        closeModal() {
            this.$refs.confirmHiddenCompany.close();
            this.clearSearchInput();
        },
        clearSearchInput() {
            this.$refs.searchDynamic.clearSearch();
        },
        showModalRemoveHidden(id) {
        this.remove_id =id;
        this.$refs.show_confirm_delete_hidden.showModal();
    },
    async confirmRemoveHidden() {
        await HTTP.post('/api/removeHiddenCompany', { profile_user_id: this.Profile.id, profile_company_id: this.remove_id })
            .then(response => {
                alert('Remove hidden company successfully');
                this.getUser();
            })
            .catch(error => {
                console.error(error);
            });
    }
    },
   
    
}
</script>
<template>
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
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s" />
                                        </div>
                                    </div>
                                </div>
                                <div class="stat-value sm:text-sm md:text-lg lg:text-xl">Hello
                                </div>
                                <span class="sm:text-md md:text-md lg:text-lg">{{ this.User.name }}</span>
                                <div class="stat-title sm:text-base md:text-md lg:text-md">Percent</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 bg-base-100 h-fit">
                        <label class="text-sm md:text-md lg:text-lg">🧑🏻‍💻The working state:</label>
                        <div class="m-2 text-center">
                            <input type="checkbox" class="toggle toggle-md toggle-info" :checked="this.User.is_active"
                                v-on:click="setActive" />
                        </div>
                        <label for="">Help you find the bussiness </label>
                    </div>

                </div>
            </div>
            <div class="mt-3 md:mt-3 lg:m-0 w-full">
                <div class="flex flex-col w-full justify-between">
                    <div class="m-3 flex flex-1 justify-between w-full">
                        <div class="bg-base-100 w-full">
                            <div class="flex flex-wrap items-center justify-between gap-4 rounded bg-white p-4">
                                <h5 class="text-base font-bold lg:text-xl">Want to hide your profile from some
                                    employers?</h5>
                                <a class="inline-flex h-8 items-center justify-center rounded-sm bg-gray-200 px-4 text-sm font-semibold text-gray-600 transition-all hover:bg-gray-300"
                                    href="#hide">Now</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="m-3 p-4 bg-base-100">
                            <h4 class="font-semibold capitalize text-neutral-950 md:text-2xl">Select your main CV to
                                display to potential Employers.</h4>
                            <p class="text-sm font-normal text-neutral-500 md:text-base">Please choose the most complete
                                CV to provide full information to the Employer</p>
                            <div class="gap-4 mt-4 md:p-4">
                                <span class="block pb-2 font-bold border-b text-neutral-900">Your list CV:</span>
                                <div class="pt-4">
                                    <div class="flex flex-col gap-2">
                                        <div v-for="(index, idx) in listItemcvs" :key="index.id"
                                            class="flex items-center gap-2">
                                            <input type="radio" :id="'radio-' + index.id" name="settingSelectedCv"
                                                :value="index.id"
                                                class="dots-resume mx-2 inline-block h-4 w-4 rounded-full border border-gray-300"
                                                v-model="settingSelectedCv" :checked="index.isPrimary"
                                                v-on:click="this.setPrimaryCV(index.id)" />
                                            <CvItem2 :title="index.title" :id="index.id" :updatedAt="index.updated_at"
                                                :isPrimary="index.isPrimary">
                                            </CvItem2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 mt-4 bg-white rounded scroll-mt-28" id="hide">
                        <h3 class="text-2xl font-semibold text-black capitalize">Hide my profile from recruiters</h3>
                        <div class="mt-4">
                            <div class="p-4 bg-gray-100">
                                <label for="compnay_name" class="block mb-1 font-bold text-gray-500">Enter the company
                                    name</label>
                                <SearchDynamic ref="searchDynamic" @selected="handleSearchSelected"> </SearchDynamic>
                                <ul v-if="this.list_company_hidden.length" class="flex flex-wrap gap-2 mt-2">
                                    <li class="flex items-center px-2 py-1 text-sm text-gray-600 bg-gray-200 rounded"
                                        v-for="(item, index) in list_company_hidden" :key="index"
                                        @click="showModalRemoveHidden(item.id)">
                                        {{ item.user.name }}<svg stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24" aria-hidden="true"
                                            class="w-5 h-5 ml-1 cursor-pointer hover:text-primary" height="1em"
                                            width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                                clip-rule="evenodd"></path>
                                        </svg></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 rounded bg-white">
                        <div class="border-b border-solid border-gray-200 p-4">
                            <h4 class="text-2xl font-semibold">The employer has viewed the profile</h4>
                        </div>
                        <div v-if="list_company_view_history.length">
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div v-for="(item, index) in list_company_view_history" :key="index"
                                        class="bg-gray-100 p-4 rounded">
                                        <div class="flex items-center gap-2">
                                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                                <img :src="item.profile_company.user.avatar_url" alt="avatar" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h5 class="text-lg font-semibold">{{ item.profile_company.user.name}}</h5>
                                                <p class="text-sm text-gray-500">Number view: {{ item.view_count }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div v-else class="p-4 text-center"><img alt="Not found employers" loading="lazy" width="453"
                                height="450" decoding="async" data-nimg="1"
                                class="mx-auto h-auto max-w-[9rem] object-contain" style="color: transparent;"
                                srcset="https://c.topdevvn.com/v4/_next/static/media/not-found.9042aac4.webp 1x, https://c.topdevvn.com/v4/_next/static/media/not-found.9042aac4.webp 2x"
                                src="https://c.topdevvn.com/v4/_next/static/media/not-found.9042aac4.webp">
                            <div class="p-4 text-gray-500">
                                <h5 class="mt-4 text-xl font-bold">No recruiters have viewed your profile yet.</h5>
                                <p class="mt-2">To attract more employers, <a title="Hoàn thành TopDev CV"
                                        href="/users/profile"
                                        class="font-weight cursor-pointer font-bold text-primary underline">Hoàn thành
                                        TopDev CV</a> hoặc <a title="Tạo CV" href="/tao-cv-online"
                                        class="font-weight cursor-pointer font-bold text-primary underline">Tạo CV</a>,
                                    sau đó bật chế độ <span title="Đang tìm việc"
                                        class="cursor-pointer font-semibold text-primary underline">Đang tìm
                                        việc</span>.</p>
                            </div>
                        </div>
                      

                    </div>
                </div>
            </div>
        </div>

        <dialog class="modal" ref="confirmHiddenCompany">
            <div class="modal-box bg-base-100">
                <h3 class="text-lg font-semibold">Warning</h3>
                <p class="py-4 text-base">
                    Are you sure you want to hide the company <strong>{{ this.CompanyHidden.name }}</strong>?
                </p>
                <div class="modal-action">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500" @click="confirmHideCompany">
                        Yes
                    </button>
                    <button class="btn btn-sm m-1 border" @click="closeModal">
                        No
                    </button>
                </div>
            </div>
        </dialog>

        <dialog class="modal" ref="show_confirm_delete_hidden">
            <div class="modal-box bg-base-100">
                <h3 class="text-lg font-semibold">Warning</h3>
                <p class="py-4 text-base">
                    Are you sure you want to remove hide the company <strong>{{ this.CompanyHidden.name }}</strong>?
                </p>
                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500"
                            @click="confirmRemoveHidden">Yes</button>
                        <button class="btn btn-sm m-1 border">No</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
</template>
<style scoped>
.bg-primary {
    background-color: #3490dc;
}
</style>