<script>
import {HTTP} from "@/http-common.js";

export default {
    name: "Ranking",
    data: () => {
        return {
            users: []
        }
    },
    mounted() {
        let _this = this;
        HTTP.get('api/user/weekly-ranking')
            .then((response) => {
                _this.users = response.data;
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {}
}
</script>

<template>
    <div>
        <div style="min-height: 520px">
            <h1 class="text-xl font-semibold">Top 10 last 7 days!</h1>
            <div class="overflow-x-auto text-lg">
                <table class="table table-sm border-gray-600">
                    <thead>
                    <tr class="text-sm">
                        <th></th>
                        <th>User</th>
                        <th>Problem solved</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <td>
                            <div class="flex items-center gap-3">
                                <img class="h-7 w-7 rounded-full object-cover"
                                     :src="user.avatar_url">
                            </div>

                        </td>
                        <td> {{ user.name }}</td>
                        <td> {{ user.attempts_count }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p class="text-center mt-2">
            <router-link to=""
                         class="p-2 bg-primary hover:bg-cyan-700 transition text-white rounded-3xl">See the full list
            </router-link>
        </p>
    </div>
</template>

<style scoped>

</style>
