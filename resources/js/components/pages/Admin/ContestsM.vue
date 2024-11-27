<template >
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">Contests Management</h3>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Problem Title</th>
                        <th class="px-4 py-2 text-left">Number Problem</th>
                        <th class="px-4 py-2 text-left">Start Time</th>
                        <th class="px-4 py-2 text-left">End Time</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Detail</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <ContestItemM v-for="contest in contests" :key="contest.id" :contest="contest" />
                </tbody>
            </table>
        </div>

        <div class="join mt-4">
            <!-- <button v-for="page in Array.from({ length: pagination.last_page }, (_, index) => index + 1)" :key="page"
                v-bind:class="['join-item', 'btn', { 'btn-active': page === pagination.current_page }]"
                @click="changePage(page)">
                {{ page }}
            </button> -->
        </div>

    </div>
</template>
<script>
import {HTTP} from "@/http-common.js";
import ContestItemM from "@/components/listItems/Management/ContestItemM.vue";
export default {
    name: "ContestsM",
    components: {
        ContestItemM,
    },
    data() {
        return {
            contests: [],
            pagination: {},
        };
    },
    async mounted() {
        await this.fetchContests();
    },
    methods: {
        async fetchContests() {
           await HTTP.get(`/api/getListSubscribeContest`).then((response) => {
                this.contests = response.data.contests;
                this.pagination = response.data;
                console.log(response.data);
            });
        },
    },
}
</script>
<style >
    
</style>