<template>
<div>
    <NavigatorRecruitment></NavigatorRecruitment>
    <div class="container bg-base-100 p-3">
      <div class="container">
        <label class="input input-bordered flex items-center gap-2">
          <input
            type="text"
            class="grow"
            placeholder="Search"
            v-model="searchQuery"
            @input="updateSuggestions"
          />
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            class="h-4 w-4 opacity-70"
          >
            <path
              fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd"
            />
          </svg>
        </label>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-4">
        <CardSkeleton v-if="!loading" v-for="i in 4"></CardSkeleton>
                <ContestM v-if="loading" v-for="contest in this.contests"
                         :p_Days="contest.remainingTime.days"
                         :p_Hours="contest.remainingTime.hours"
                         :p_Minutes="contest.remainingTime.minutes"
                         :p_Seconds="contest.remainingTime.seconds"
                         :contestId="contest.id"
                         :title="contest.title"
                         :imgUrl="contest.imgUrl"
            ></ContestM>
      </div>
    </div>
  </div>
</template>
<script>
import CardSkeleton from "@/components/loading/CardSkeleton.vue";
import NavigatorRecruitment from "@/components/navbar/NavigatorRecruitment.vue";
import {HTTP} from "@/http-common.js";
import ContestM from "@/components/cards/ContestM.vue";
export default {
    name: "ContestManagement",
    components: {
        NavigatorRecruitment, ContestM,CardSkeleton
    },
    data: function () {
        return {
            problems: [],
            contests: [],
            loading: false
        }
    },
    methods: {
         async fetchContests()
         {
            await HTTP.get(`/api/getContestsU`).then((response) => {
                console.log('dm',response.data.contests.data);
                this.contests = response.data.contests.data;
            }); 
            this.loading = true
         }
    },
   async mounted() {
     await this.fetchContests();
    }
}
</script>
<style>
    
</style>