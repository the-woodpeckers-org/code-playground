<template>
    <div>
        <router-link :to="'/Contest-managent'"> <button class="underline text-gray-500 mb-5 text-md text-xl">Back to management</button></router-link>
        <div>
            <h2 class="font-semibold text-md text-2xl">List of contest participants</h2>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                <div class="col-span-8 bg-base-100" style="min-height: 300px;">
                    <div class="overflow-x-auto">
                        <table class="table border">
                            <thead class="bg-gray-500 text-gray-50 text-md">
                                <th class="py-2 px-2">User name</th>
                                <th class="py-2 px-2">Finished problems</th>
                                <th class="py-2 px-2">Profile CV</th>
                                <th class="py-2 px-2">Participated at</th>
                            </thead>
                            <tbody>
                                <!-- <Paritipant ></Paritipant> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-span-4 bg-base-100 " style="min-height: 300px;">

                </div>
            </div>

        </div>
    </div>
</template>
<script>
import {HTTP} from "@/http-common.js";
import Paritipant from "@/components/listItems/Management/Participant.vue";
export default {
    name: "ParticipationContest",
    components: { Paritipant },
    methods:{
        async fetchData(){
            console.log(this.$route.params.id);
            let id = this.$route.params.id;
                await HTTP.get(`/api/getParticipantsU/${id}`).then((response) => {
                    // this.participants = response.data.data;
                    console.log(response.data.data);
                });
        }
    },
    async mounted(){
        await this.fetchData();
  
     }
}
</script>
<style></style>