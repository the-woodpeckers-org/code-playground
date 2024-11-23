<template>
    <NavigatorRecruitment></NavigatorRecruitment>
    <div class="mt-6 bg-white shadow-lg rounded-lg container mx-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="flex flex-col items-center space-y-4">
                <img alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200"
                    :src="userCompany.avatar_url"
                    loading="lazy" />
                <input type="file" class="file-input file-input-bordered w-full max-w-xs" />
            </div>

            <div class="flex flex-col space-y-4">
                <label class="flex flex-col text-sm font-medium text-gray-700">
                    Name
                    <input type="text" class="input input-bordered mt-1 p-2 rounded-md" placeholder="Company name"
                        v-model="userCompany.name" />
                </label>
                <label class="flex flex-col text-sm font-medium text-gray-700">
                   Code company
                    <input type="number" class="input input-bordered mt-1 p-2 rounded-md" placeholder="Company code"
                        v-model="profileCompany.codeCompany" />
                </label>
                <label class="flex flex-col text-sm font-medium text-gray-700">
                    Email
                    <input type="email" class="input input-bordered mt-1 p-2 rounded-md" placeholder="Email address"
                        v-model="profileCompany.email" />
                </label>
                <label class="flex flex-col text-sm font-medium text-gray-700">
                    Phone
                    <input type="tel" class="input input-bordered mt-1 p-2 rounded-md" placeholder="The phone numberee"
                        v-model="profileCompany.phone">
                </label>

            </div>

            <div class="flex flex-col space-y-4">

                <LocationPicker v-if="profileCompany && profileCompany.address" :province="_address[0]"
                    :district="_address[1] " :ward="_address[2] "
                    @address-updated="handleAddressUpdated" />
                <LocationPicker v-else @address-updated="handleAddressUpdated" />

                <label class="flex flex-col text-sm font-medium text-gray-700">
                    Address
                    <input type="text" class="input input-bordered mt-1 p-2 rounded-md" placeholder="House number"
                        v-model="_address[3]" />
                </label>
            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-bold text-gray-700 mb-2 block">Skills <span
                    class="font-normal text-primary">*</span></label>
            <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                <!-- Selected Skills -->
                <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                    <div v-for="(skill, index) in selectedSkills" :key="index"
                        class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                        <span>{{ skill }}</span>
                        <button @click="removeSkill(skill)"
                            class="text-blue-500 hover:text-blue-700 focus:outline-none">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button v-if="selectedSkills.length" @click="removeAll"
                        class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-150 ease-in-out shadow-md">
                        Clear All
                    </button>
                    <select
                        class="select w-full md:w-1/2 border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:ring-2 focus:ring-primary focus:outline-none bg-white text-gray-700"
                        @change="addSkill($event)">
                        <option disabled selected>Select a skill</option>
                        <option v-for="(skill, index) in availableSkills" :key="index" :value="skill">
                            {{ skill }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-bold text-gray-700 mb-2 block">General Information <span
                    class="font-normal text-primary">*</span></label>
            <div id="text-editor-1">
                {{ profileCompany.general_information }}

            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-bold text-gray-700 mb-2 block">Description <span
                    class="font-normal text-primary">*</span></label>
            <div id="text-editor-2">
                {{ profileCompany.description }}
            </div>
        </div>

        <div class="mt-6">
            <div class="flex flex-1 gap-4">
                <button class="btn btn-secondary">Back</button>
                <button class="btn btn-primary" @click="updateProfile">Save</button>
            </div>
        </div>

    </div>
    <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="!_loading">
        <span class="loading loading-dots loading-lg"></span>
    </div>
</template>

<script>
import NavigatorRecruitment from "@/components/navbar/NavigatorRecruitment.vue";
import LocationPicker from "@/components/locationPicker/LocationPicker.vue";
import { HTTP } from "@/http-common.js";
export default {
    name: 'RecuitmentManagement',
    components: { NavigatorRecruitment, LocationPicker },
    data() {
        return {
            availableSkills: ['Java', 'Go', 'C', 'C#', 'C++', 'Rust', 'JavaScript', 'Python'],
            selectedSkills: [],
            profileCompany: {},
            jobRecruitments: [],
            userCompany: {},
            _address: [],
            _skill: [],
            _loading: false,
            rte_1: null,
            rte_2: null,
        };
    },
    async mounted() {
        await this.fetchData();
        this.rte_1 = new RichTextEditor('#text-editor-1');
        this.rte_2 = new RichTextEditor('#text-editor-2');
        this.rte_1.setHTMLCode(this.profileCompany.general_information);
        this.rte_2.setHTMLCode(this.profileCompany.description);
        this._loading = true;
    },
    methods: {
        addSkill(event) {
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
        handleAddressUpdated(address) {
            this._address[0] = address.district;
            this._address[1] = address.province;
            this._address[2] = address.ward;
        },
        async fetchData() {
            let _this = this;
            await HTTP.get('/api/getProfileCompanyByUserId').then(response => {
                console.log(response.data);
                _this.profileCompany = response.data.data.profileCompany;
                _this.userCompany = response.data.data.userCompany;
                _this.jobRecruitments = response.data.data.jobRecruitments;
                _this._address = JSON.parse(_this.profileCompany.address.replace(/'/g, '"'));
                _this._skill = JSON.parse(_this.profileCompany.skill.replace(/'/g, '"'));
                _this.selectedSkills = _this._skill;
                _this.availableSkills = _this.availableSkills.filter(skill => !_this.selectedSkills.includes(skill));
            }).catch(error => {
                console.log(error);
            });
        },

        async updateProfile() {
            const data = {
                profileCompany: {
                    ...this.profileCompany,
                    address: JSON.stringify(this._address),
                    skill: JSON.stringify(this.selectedSkills),
                    general_information: this.rte_1.getHTMLCode(),
                    description: this.rte_2.getHTMLCode(),
                }
            };
            console.log(data);
            await HTTP.post('/api/updateProfileCompany',data)
            .then(response => {
                console.log(response.data);
                alert("Save successfully");
            }).catch(error => {
                console.log(error);
            });
        }
    },
}
</script>

<style scoped>
.select {
    transition: all 0.2s ease-in-out;
}
</style>
