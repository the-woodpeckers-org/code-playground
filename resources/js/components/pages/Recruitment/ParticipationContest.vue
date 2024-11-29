<template>
    <div>
        <router-link :to="'/Contest-managent'">
            <button class="underline text-gray-500 mb-5 text-md text-xl">Back to management</button>
        </router-link>
        <div>
            <h1 class="text-2xl font-semibold text-center mb-3 text-black">{{ contest.title }}</h1>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4" >
                <div class="w-full lg:col-span-8 bg-base-100" style="min-height: 300px;">
                    <h2 class="font-semibold text-md text-xl p-3">List of contest participants</h2>
                    <div class="overflow-x-auto">
                        <div v-if="!isContestEnded">
                            <h2 class="text-xl p-4">Contest is going on</h2>
                            <table class="table border">
                                <thead class="bg-gray-500 text-gray-50 text-md lg:text-lg">
                                    <th class="py-2 px-2">User name</th>
                                    <th class="py-2 px-2">Finished problems</th>
                                    <th class="py-2 px-2">Profile CV</th>
                                    <th class="py-2 px-2">Participated at</th>
                                </thead>
                                <tbody>
                                    <Participant v-for="(item, index) in participants" :key="index" :participant="item"
                                        @click="viewProfile"></Participant>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <h2 class="text-xl p-4">The contest ended with the following result:
                            </h2>
                            <table class="table border">
                                <thead class="bg-gray-500 text-gray-50 text-md lg:text-lg">
                                    <th class="py-2 px-2">User name</th>
                                    <th class="py-2 px-2">Finished problems</th>
                                    <th class="py-2 px-2">Profile CV</th>
                                    <th class="py-2 px-2">Finished at</th>
                                </thead>
                                <tbody>
                                    <Participant v-for="(item, index) in participants" :key="index" :participant="item"
                                        @click="viewProfile"></Participant>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:col-span-4 bg-base-100">
                    <h2 class="p-3 font-semibold text-md text-xl font-mono">Profile user</h2>
                    <div v-if="isClicked"> 
                        <Profile :participant="this.participant.user"></Profile>
                    </div>
                    <div v-else
                        class="lg:mt-5 border rounded-lg md:rounded lg:animate-bounce bg-blue-300 p-3 font-mono font-semibold">
                        <- Select a row to view profile user </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import { HTTP } from "@/http-common.js";
import Participant from "@/components/listItems/Management/Participant.vue";
import Profile from "@/components/sideDialogs/Profile.vue";
export default {
    name: "ParticipationContest",
    components: { Participant, Profile },
    data() {
        return {
            participants: [],
            isClicked: false,
            isContestEnded: false,
            contest :{},
            participant: {},
        };
    },
    methods: {
        async fetchData() {
            try {
                const id = this.$route.params.id;
                const response = await HTTP.get(`/api/getParticipantsContestU/${id}`);
                console.log(response.data);
                this.contest = response.data.contest;
                this.participants = response.data.participation.data;
                if (this.participants.length > 0) {
                    this.isContestEnded = this.participants[0].contest?.isEnded;
                    this.participants = [...this.participants.sort(this.isContestEnded ? this.sortByFinished : this.sortByParticipatedAt)];
                }
            } catch (error) {
                console.error("Error fetching participants:", error);
            }
        },
        sortByFinished(a, b) {
            if (b.finishedProblems !== a.finishedProblems) {
                return b.finishedProblems - a.finishedProblems;
            }
            const dateA = new Date(a.finished_at);
            const dateB = new Date(b.finished_at);
            return dateA - dateB;
        },
        sortByParticipatedAt(a, b) {
            return new Date(a.started_at) - new Date(b.started_at);
        },
        viewProfile(participant) {
            this.isClicked = true;
            this.participant = participant;
            console.log(participant.user);
        },
    },
    async mounted() {
        await this.fetchData();
    },
};
</script>

<style scoped></style>