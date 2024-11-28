<template>
    <div>
        <router-link :to="'/Contest-managent'"> <button class="underline text-gray-500 mb-5 text-md text-xl">Back to
                management</button></router-link>
        <div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                <div class="w-full lg:col-span-8 bg-base-100" style="min-height: 300px;">
                    <h2 class="font-semibold text-md text-2xl p-3 ">List of contest participants</h2>
                    <div class="overflow-x-auto">
                        <table class="table border">
                            <thead class="bg-gray-500 text-gray-50 text-md lg:text-lg">
                                <th class="py-2 px-2">User name</th>
                                <th class="py-2 px-2">Finished problems</th>
                                <th class="py-2 px-2">Profile CV</th>
                                <th class="py-2 px-2">Participated at</th>
                            </thead>
                            <tbody>
                                <Participant v-for="(item, index) in this.participants" :key="index" :participant="item"
                                    @click="viewProfile"></Participant>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full lg:col-span-4 bg-base-100">
                    <h2 class="p-3 font-semibold text-md text-xl font-mono">Profile user</h2>
                    <div v-if="isClicked"> hehe</div>
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
export default {
    name: "ParticipationContest",
    components: { Participant },
    data() {
        return {
            participants: [],
            isClicked: false,
        }
    },
    methods: {
        async fetchData() {
            console.log(this.$route.params.id);
            let id = this.$route.params.id;
            await HTTP.get(`/api/getParticipantsContestU/${id}`).then((response) => {
                this.participants = response.data.data;
                console.log(this.participants);
            });
        },
        async viewProfile() {
            this.isClicked = true;
        }
    },
    async mounted() {
        await this.fetchData();

    }
}
</script>
<style></style>