<template>
    <div class="bg-gray-100 min-h-screen p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Statistics</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-semibold mb-4">Monthly Revenue</h2>
                <canvas ref="revenueChart" width="400" height="200"></canvas>
            </div>


            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-semibold mb-4">Number of users</h2>
                <canvas ref="userChart" width="400" height="200"></canvas>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-semibold mb-4">Overview</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-gray-500">Total Renevue</div>
                        <div class="text-2xl font-bold text-blue-600">{{ totalRevenue }}tr</div>
                    </div>
                    <div class="text-center">
                        <div class="text-gray-500">Grow rate</div>
                        <div class="text-2xl font-bold text-purple-600">{{ growthRate }}%</div>
                    </div>

                    <div class="m-5"></div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-gray-500">Users</div>
                        <div class="text-2xl font-bold text-green-600">{{ totalUsers }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-gray-500">Contributors</div>
                        <div class="text-2xl font-bold text-green-600">{{ totalContributors }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-gray-500">Comapnies</div>
                        <div class="text-2xl font-bold text-green-600">{{ totalCompanies }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { HTTP } from "@/http-common.js";
import Chart from 'chart.js/auto'

export default {
    data() {
        return {
            totalRevenue: 0,
            totalUsers: 0,
            totalContributors: 0,
            totalCompanies: 0,
            growthRate: 0,
            revenueData: [],
            userData: [],
            sourceData: []
        }
    },
    mounted() {
        this.fetchStatistics()
    },
    methods: {
        async fetchStatistics() {
            try {
                const response = await HTTP.get('/api/statistics')
                const data = response.data
                this.growthRate = data.growth_rate
                this.totalRevenue = data.total_revenue
                this.totalUsers = data.total_users
                this.revenueData = data.revenue_data
                this.userData = data.user_data
                this.totalContributors = data.total_contributors;
                this.totalCompanies = data.total_companies;
                this.renderCharts()
            } catch (error) {
                console.error('Lỗi tải thống kê:', error)
            }
        },
        renderCharts() {

            new Chart(this.$refs.revenueChart, {
                type: 'line',
                data: {
                    labels: this.revenueData.map(item => `Month ${item.month}`),
                    datasets: [{
                        label: 'Turnover',
                        data: this.revenueData.map(item => item.revenue),
                        borderColor: 'blue',
                        tension: 0.1
                    }]
                }
            })

            new Chart(this.$refs.userChart, {
                type: 'bar',
                data: {
                    labels: this.userData.map(item => `Month ${item.month}`),
                    datasets: [{
                        label: 'Users',
                        data: this.userData.map(item => item.users),
                        backgroundColor: 'green'
                    }]
                }
            })
        }
    }
}
</script>