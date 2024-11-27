<script>
import {HTTP} from "@/http-common.js";
import {getAuth, setAuth} from "@/utils/authLocalStorage.js";
import {Chart, registerables} from "chart.js";
import Toast from "@/components/messages/Toast.vue";

export default {
    components: {Toast},
    data() {
        return {
            selectedFile: null,
            fileUpload: null,
            auth: getAuth(),
            languageStatLabels: Array,
            languageStatAttempts: Array,
            categoryStatLabels: Array,
            categoryStatAttempts: Array,
            // user information form input
            nameInput: "",
            emailInput: "",
            addressInput: "",
            phoneInput: "",
            genderInput: "",
            birthdayInput: "",
            isEmailVerified: false,
            isUpdated: false,
            recentProblems: [],
            currentProblemsIndex: 1,
            recentProblemsLinks: [],
            recentParticipation: [],
            currentParticipationIndex: 1,
            recentParticipationLinks: [],
            avatar_url: "",
        };
    },
    mounted() {
        this.getUserStatsData();
        this.getUserInformation();
        this.getRecentAttempts(1);
        this.getRecentParticipation(1);
    },
    beforeRouteUpdate() {
        window.location.href = '/profile/' + this.$root.auth.id;
    },
    methods: {
        async getUserStatsData() {
            let _this = this;
            let languageStatLabels = [];
            let languageStatAttempts = [];
            let categoryStatLabels = [];
            let categoryStatAttempts = [];
            if (this.isAuthenticatedUser())
            await HTTP.get('api/get-stats')
                .then((response) => {
                    languageStatLabels = response.data.language_stats.map((item) => {
                        return item.name;
                    });
                    languageStatAttempts = response.data.language_stats.map((item) => {
                        return item.attempt_count;
                    });
                    categoryStatLabels = response.data.category_stats.map((item) => {
                        return item.name;
                    });
                    categoryStatAttempts = response.data.category_stats.map((item) => {
                        return item.attempt_count;
                    });
                    _this.chartConfig(languageStatLabels, languageStatAttempts, categoryStatLabels, categoryStatAttempts);
                })
                .catch((err) => {

                });
            else {
                await HTTP.get('api/get-stats-by-id?id=' + _this.$route.params.id)
                    .then((response) => {
                        languageStatLabels = response.data.language_stats.map((item) => {
                            return item.name;
                        });
                        languageStatAttempts = response.data.language_stats.map((item) => {
                            return item.attempt_count;
                        });
                        categoryStatLabels = response.data.category_stats.map((item) => {
                            return item.name;
                        });
                        categoryStatAttempts = response.data.category_stats.map((item) => {
                            return item.attempt_count;
                        });
                        _this.chartConfig(languageStatLabels, languageStatAttempts, categoryStatLabels, categoryStatAttempts);
                    })
                    .catch((err) => {
                    });
            }
        },
        chartConfig(langLabels, langAttempts, categoryLabels, categoryAttempts) {
            const ctx1 = document.getElementById('languageStatsChart');
            const ctx2 = document.getElementById('categoryStatsChart');
            Chart.register(...registerables);

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        label: 'Problem Solved',
                        borderWidth: 2,
                        borderRadius: Number.MAX_VALUE,
                        borderSkipped: false,
                        backgroundColor: 'rgb(100,255,126)',
                        borderColor: 'rgb(56,255,49)',
                        data: categoryAttempts,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },

                    },
                    indexAxis: 'y'
                },
                scaleStepWidth: 1
            });
            new Chart(ctx2, {
                type: 'radar',
                data: {
                    labels: langLabels,
                    datasets: [{
                        label: 'Problem Solved',
                        borderWidth: 2,
                        borderRadius: Number.MAX_VALUE,
                        borderSkipped: false,
                        backgroundColor: 'rgb(119,198,255)',
                        borderColor: 'rgb(72,175,255)',
                        data: langAttempts,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    },
                },
            });
        },
        handleFileChange(event) {
            const maxAllowedSize = 5 * 1024 * 1024;
            if (event.target.files[0].size > maxAllowedSize) {
                return;
            } else {
                this.selectedFile = event.target.files[0];
            }
        },
        async uploadImage() {
            let _this = this;
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            try {
                await HTTP.post('/api/avatar-upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                }).then((response) => {

                });
                await HTTP.get('/api/auth/get')
                    .then((response) => {
                        setAuth(response.data);
                        _this.$root.auth = getAuth();
                    })
                    .catch((error) => {
                    });
            } catch (error) {
                console.error('Error uploading:', error);
            }
        },
        save() {
            if (this.selectedFile) {
                this.uploadImage();
            } else {
                console.error('No file selected');
            }
        },
        async getUserInformation() {
            if (this.isAuthenticatedUser()) {
                await HTTP.get('api/auth/get')
                    .then((response) => {
                        this.nameInput = response.data.name;
                        this.emailInput = response.data.email;
                        this.addressInput = response.data.address;
                        this.phoneInput = response.data.phone_number;
                        this.genderInput = response.data.gender;
                        this.birthdayInput = response.data.birthday;
                        this.avatar_url = response.data.avatar_url;
                        if (response.data.email_verified_at) {
                            this.isEmailVerified = true;
                        }
                    })
                    .catch((err) => {

                    });
            } else {
                await HTTP.get('api/user/guard?id=' + this.$route.params.id)
                    .then((response) => {
                        console.log(response);
                        this.nameInput = response.data.name;
                        this.avatar_url = response.data.avatar_url;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }


        },
        async updateInformation() {
            let _this = this;
            this.isUpdated = false;
            await HTTP.patch('api/user', {
                name: _this.nameInput,
                address: _this.addressInput,
                phone_number: _this.phoneInput,
                gender: _this.genderInput,
                birthday: _this.birthdayInput
            })
                .then((response) => {
                    this.isUpdated = true;
                })
                .catch((err) => {

                });
        },
        async getRecentAttempts(index) {
            let _this = this;
            _this.currentProblemsIndex = index;
            if (_this.isAuthenticatedUser()) {
                await HTTP.get('api/problem/recently?page=' + index)
                    .then((response) => {
                        _this.recentProblems = response.data.data;
                        _this.recentProblemsLinks = response.data.links;
                    })
                    .catch((err) => {
                    });
            } else {
                await HTTP.get('api/user/problem/recently?user_id=' + _this.$route.params.id + '&page=' + index)
                    .then((response) => {
                        _this.recentProblems = response.data.data;
                        _this.recentProblemsLinks = response.data.links;
                    })
                    .catch((err) => {
                    });
            }
        },
        async getRecentParticipation(index) {
            let _this = this;
            _this.currentParticipationIndex = index;
            if (_this.isAuthenticatedUser()) {
                await HTTP.get('api/participation/recently?page=' + index)
                    .then((response) => {
                        _this.recentParticipation = response.data.data;
                        _this.recentParticipationLinks = response.data.links;
                    })
                    .catch((err) => {
                    });
            } else {
                await HTTP.get('api/user/participation/recently?user_id=' + _this.$route.params.id + '&page=' + index)
                    .then((response) => {
                        _this.recentParticipation = response.data.data;
                        _this.recentParticipationLinks = response.data.links;
                    })
                    .catch((err) => {
                    });
            }
        },
        isAuthenticatedUser() {
            return this.$root.auth.id == this.$route.params.id;
        }
    },
};
</script>


<template>
    <div class="grid grid-cols-1 xl:grid-cols-3">
        <div class="border-r p-2">
            <p class="col-span-full font-semibold text-lg border-b my-2">Statistics</p>
            <p class="my-2">Problems solved by topics</p>
            <div class="flex">
                <canvas class="mx-auto" id="languageStatsChart"></canvas>
            </div>
            <div class="w-full border-b"></div>
            <p class="my-2">Problems solved by topics</p>
            <div class="flex">
                <canvas class="mx-auto" id="categoryStatsChart"></canvas>
            </div>
            <p>Streak</p>
        </div>
        <div class="border-r p-2">
            <p class="col-span-full font-semibold text-lg border-b my-2">Activities</p>
            <p class="my-2">Contests <span v-if="isAuthenticatedUser()">you</span><span v-if="!isAuthenticatedUser()">{{ nameInput }}</span> have participated recently</p>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Finished at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="participation in recentParticipation">
                        <td>{{ participation.contest?.title }}</td>
                        <td>{{ participation.finished_at }}</td>
                        <td>
                            <button class="bg-orange-400 rounded-lg px-3 hover:bg-orange-600 transition"
                                    @click="this.$router.push('/contest/' + participation.contest?.id + '/result')">Result
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="flex">
                    <div class="join mx-auto my-3">
                        <button v-for="link in recentParticipationLinks" :disabled="!link.url"
                                class="join-item btn text-xs"
                                :class="{ 'btn-active' : link.label == currentParticipationIndex}"
                                @click="getRecentParticipation(link.label)"><span
                            v-html="link.label"></span></button>
                    </div>
                </div>
            </div>
            <p class="my-2">Problems <span v-if="isAuthenticatedUser()">you</span><span v-if="!isAuthenticatedUser()">{{ nameInput }}</span> have solved recently</p>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Passed at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="attempt in recentProblems">
                        <td>{{ attempt.problem?.title }}</td>
                        <td>{{ attempt.passed_at }}</td>
                        <td>
                            <button class="bg-orange-400 rounded-lg px-3 hover:bg-orange-600 transition"
                                    @click="this.$router.push('/problem/' + attempt.problem?.id)">Goto
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="flex">
                    <div class="join mx-auto my-3">
                        <button v-for="link in recentProblemsLinks" :disabled="!link.url" class="join-item btn text-xs"
                                :class="{ 'btn-active' : link.label == currentProblemsIndex}"
                                @click="getRecentAttempts(link.label)"><span
                            v-html="link.label"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-2">
            <p class="col-span-full font-semibold text-lg border-b my-2">Information</p>
            <form class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md space-y-4 h-64" @submit.prevent="save">
                <div class="flex justify-center">
                    <img :src="avatar_url"
                         alt="Profile Picture" class="w-24 h-24 rounded-full border-2 border-gray-300">
                </div>
                <div v-if="isAuthenticatedUser()" class="text-center">
                    <input accept="image/png, image/gif, image/jpeg" type="file" id="fileInput"
                           @change="handleFileChange"
                           class="
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-violet-50 file:text-violet-700
                                  hover:file:bg-violet-100">
                </div>
                <div v-if="isAuthenticatedUser()" class="text-center">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Update avatar
                    </button>
                </div>
            </form>
            <div class="max-w-sm mx-auto mt-2 bg-white p-6 rounded-lg shadow-md space-y-4">
                <div>
                    <label>Name</label>
                    <input v-model="nameInput" class="w-full h-8 border border-gray-500 rounded-lg bg-base-100" :disabled="!isAuthenticatedUser()" :readonly="!isAuthenticatedUser()">
                    <template>

                    </template>
                    <div v-if="isAuthenticatedUser()">
                        <label>Email</label>
                        <input v-model="emailInput" class="w-full h-8 border border-gray-500 rounded-lg bg-base-300"
                               disabled>
                        <div v-if="!isEmailVerified" role="alert" class="rounded-lg bg-yellow-300 px-3 my-1">
                            <p><i class="fa-solid fa-triangle-exclamation"></i> Your email is not verified!
                                <router-link to="verify-email"
                                             class="link font-semibold">Verify
                                    your email here
                                </router-link>
                            </p>
                        </div>
                        <label>Address</label>
                        <input v-model="addressInput" class="w-full h-8 border border-gray-500 rounded-lg bg-base-100">
                        <label>Phone number</label>
                        <input v-model="phoneInput" class="w-full h-8 border border-gray-500 rounded-lg bg-base-100">
                        <label>Gender</label>
                        <select v-model="genderInput" class="w-full h-8 border border-gray-500 rounded-lg bg-base-100">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="None">None</option>
                        </select>
                        <label>Birthday</label>
                        <input v-model="birthdayInput" type="date"
                               class="w-full h-8 border border-gray-500 rounded-lg bg-base-100">
                        <label>Password</label>
                        <div class="text-center my-2">
                            <a href="#" class="link font-semibold">Change your password</a>
                        </div>
                    </div>

                </div>
                <div v-if="isAuthenticatedUser()" class="text-center">
                    <button type="submit" @click="updateInformation"
                            class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <Toast v-if="isUpdated" :toastData="{type: 'success', message: 'Update information successfully!'}"></Toast>
</template>
