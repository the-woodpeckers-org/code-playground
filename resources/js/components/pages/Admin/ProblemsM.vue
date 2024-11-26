<template>
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Problems Management</h3>
        <div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Problem Title</th>
                        <th class="px-4 py-2 text-left">Difficulty</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Detail</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <ProblemItemM v-for="(item, index) in problems" :key="index" :problem="item" />
                </tbody>
            </table>
        </div>

        <div class="join mt-4">
            <button v-for="page in Array.from({ length: pagination.last_page }, (_, index) => index + 1)" :key="page"
                v-bind:class="['join-item', 'btn', { 'btn-active': page === pagination.current_page }]"
                @click="changePage(page)">
                {{ page }}
            </button>
        </div>

    </div>
</template>

<script>
import { HTTP } from "@/http-common.js";
import ProblemItemM from "@/components/listItems/Management/ProblemItemM.vue";

export default {
    name: "ProblemsM",
    components: {
        ProblemItemM,
    },
    data() {
        return {
            problems: [],
            pagination: {
                current_page: 1,
                last_page: 1,
            },
        };
    },
    async mounted() {
        await this.fetchData();
    },
    methods: {
        async fetchData(page = 1) {
            try {
                const response = await HTTP.get('/api/getListSubscribeProblem', {
                    params: { page: page }
                });
                this.problems = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching problems:", error);
            }
        },
        changePage(page) {
            if (page !== this.pagination.current_page) {
                this.pagination.current_page = page;
                this.fetchData(page);
            }
        }
    }
};
</script>
<style scoped></style>
