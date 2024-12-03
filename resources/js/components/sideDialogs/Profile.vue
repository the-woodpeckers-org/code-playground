<template>
    <div class="p-2">
        <div class="flex justify-center">
            <img :src="this.participant.avatar_url" alt="Profile Picture"
                 class="w-24 h-24 rounded-full border-2 border-gray-300">
        </div>
        <h2 class="flex justify-center mt-3">{{ this.participant.name }}</h2>
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
    </div>
</template>
<script>
import {Chart, registerables} from "chart.js";
import {HTTP} from "@/http-common.js";
import participant from "@/components/listItems/Management/Participant.vue";

export default {
    name: "Profile",
    props: {
        participant: {},
    },
    data: () => {
        return {
            languageStatLabels: [],
            languageStatAttempts: [],
            categoryStatLabels: [],
            categoryStatAttempts: [],
        }
    },
    mounted() {
        console.log(this.participant);
        this.getUserStatsData();
        this.chartConfig();
    },
    updated() {
        console.log(this.participant);
        this.getUserStatsData();
        this.chartConfig();
    },
    methods: {
        async getUserStatsData() {
            let _this = this;
            let languageStatLabels = [];
            let languageStatAttempts = [];
            let categoryStatLabels = [];
            let categoryStatAttempts = [];
            await HTTP.get('api/get-stats-by-id?id=' + _this.participant.id)
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

        },
        chartConfig(langLabels, langAttempts, categoryLabels, categoryAttempts) {
            if (this.categoriesChart != null) {
                this.categoriesChart.destroy();
            }
            if (this.languagesChart != null) {
                this.languagesChart.destroy();
            }
            const ctx1 = document.getElementById('languageStatsChart');
            const ctx2 = document.getElementById('categoryStatsChart');
            Chart.register(...registerables);
            this.categoriesChart = new Chart(ctx1, {
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
            this.languagesChart = new Chart(ctx2, {
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
    }
}
</script>
<style></style>
