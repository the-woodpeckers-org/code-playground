<script>
import moment from "moment/moment.js";
import {HTTP} from "@/http-common.js";

export default {
    name: "ContestRanking",
    data: () => {
        return {
            participation: {},
            contest: {},
            attempts: [],
            finished_at: '',
            total_problems: 0,
            participationList: [],
        }
    },
    mounted() {
        this.onload();
    },
    methods: {
        onload() {
            let _this = this;
            HTTP.get('api/contest/result?contest_id=' + this.$route.params.id)
                .then((response) => {
                    console.log(response);
                    _this.participation = response.data.participation;
                    _this.contest = response.data.participation.contest;
                    _this.attempts = response.data.attempts;
                    _this.finished_at = moment(response.data.finished_at).format('DD-MM-yyyy hh:mm:ss')
                    _this.total_problems = response.data.participation.problems.length;
                    _this.setCode(0);
                })
                .catch((err) => {

                });
            HTTP.get('api/contest/result?contest_id=' + this.$route.params.id)
                .then((response) => {
                    console.log(response);
                    _this.participationList = response.data.participation;
                })
                .catch((err) => {

                });
        }
    }
}
</script>

<template>
    <div class="w-full">
        <div class="bg-base-200 p-3 shadow-xl rounded-lg">
            <p class="text-xl font-semibold">User ranking of {{ contest.title }}</p>
            <p>Start date: {{ contest.start_date }}</p>
            <p>End date: {{ contest.end_date }}</p>
            <div class="divider"></div>
            <p class="text-lg font-semibold">Your result</p>
            <p>You have finished at: <span class="font-semibold">{{ finished_at }}</span></p>
            <p>Problems solved: <span class="font-semibold">{{
                    participation.finished_problems + '/' + total_problems
                }}</span></p>
            <div class="divider"></div>
            <div class="overflow-x-auto bg-base-100 rounded-xl">
                <table class="table">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>User</th>
                        <th>Problem solved</th>
                        <th>Finished Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover" v-for="post in posts">
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <div class="flex">
                    <div class="join mx-auto my-3">
                        <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                                :class="{ 'btn-active' : link.label == currentPage}" @click="getPosts(link.label)"><span
                            v-html="link.label"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
