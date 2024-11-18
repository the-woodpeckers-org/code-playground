<script>
import {HTTP} from "@/http-common.js";
import {getAuth, setAuth} from "@/utils/authLocalStorage.js";
import {Chart, registerables} from "chart.js";

export default {
    data() {
        return {
            selectedFile: null,
            fileUpload: null,
            auth: getAuth(),
            languageStatLabels: Array,
            languageStatAttempts: Array,
            categoryStatLabels: Array,
            categoryStatAttempts: Array,
        };
    },
    mounted() {
        this.getUserStatsData();
    },
    methods: {
        async getUserStatsData() {
            let _this = this;
            let languageStatLabels = [];
            let languageStatAttempts = [];
            let categoryStatLabels = [];
            let categoryStatAttempts = [];

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
                    console.log(err);
                });
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
                        backgroundColor: 'rgb(255,100,100)',
                        borderColor: 'rgb(255,49,49)',
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
                        location.reload();
                    })
                    .catch((error) => {
                        localStorage.clear();
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
    },
};
</script>


<template>
    <form class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md space-y-4" @submit.prevent="save">
        <div class="flex justify-center">
            <img :src="auth.avatar_url"
                 alt="Profile Picture" class="w-32 h-32 rounded-full border-2 border-gray-300">
        </div>
        <div class="text-center">
            <input accept="image/png, image/gif, image/jpeg" type="file" id="fileInput" @change="handleFileChange"
                   class="
          file:mr-4 file:py-2 file:px-4
          file:rounded-full file:border-0
          file:text-sm file:font-semibold
          file:bg-violet-50 file:text-violet-700
          hover:file:bg-violet-100">
        </div>
        <div class="text-center">
            <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Save
            </button>

        </div>
    </form>
    <div class="w-full grid grid-cols-2 gap-x-3">
        <div class="border-y h-96 flex">
            <canvas id="languageStatsChart" class="mx-auto">

            </canvas>
        </div>
        <div class="border-y h-96 flex">
            <canvas id="categoryStatsChart" class="mx-auto">

            </canvas>
        </div>
    </div>
</template>
