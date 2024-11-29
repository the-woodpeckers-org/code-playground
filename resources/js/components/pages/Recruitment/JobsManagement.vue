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
        <CardJobM
          v-for="(item, index) in filteredSuggestions"
          :key="item.id"
          :title="item.title"
          :salary="item.salary"
          :id="item.id"
          :link="`/Detail-Job/${item.id}`"
          @delete-item="deleteJob(item.id)"
          :negotiable="item.negotiable"
          :imgUrl="user.avatar_url"
          :status = "item.status"
          :date="item.deadline"
        />
        <div
          @click="addJob"
          class="border rounded-xl h-52 w-auto m-3 my-2 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition cursor-pointer flex justify-center items-center"
        >
          <i class="fas fa-plus text-6xl text-gray-600"></i>
        </div>
      </div>
    </div>
  </div>

   <dialog v-if="isSendRequest" id="login_modal" class="modal modal-open">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span>
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">Send request successfully!</p>
        </div>
    </dialog>
    <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="isLoading">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span class="loading loading-spinner loading-lg">
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { getAuth } from "@/utils/authLocalStorage.js";
</script>

<script>
import { HTTP } from "@/http-common.js";
import CardJobM from "@/components/cards/JobM.vue";
import { RouterView, RouterLink, useRouter, useRoute } from "vue-router";
import NavigatorRecruitment from "@/components/navbar/NavigatorRecruitment.vue";
export default {
  name: "JobsManagement",
  components: { NavigatorRecruitment, CardJobM },
  data() {
    return {
      router: useRouter(),
      jobList: [],
      isJobFormOpen: false,
      formMode: "add",
      user: getAuth(),
      searchQuery: "",
      filteredSuggestions: [],
      isLoading:false,
      isSendRequest:false
    };
  },
  async mounted() {
    await this.fetchData();
  },
  methods: {
    addJob() {
      this.router.push({ name: "add-job" });
    },
    async fetchData() {
      await HTTP.get("/api/getJobsU").then((response) => {
        this.jobList = response.data.data;
        this.filteredSuggestions = this.jobList;
        console.log(this.jobList);
      });
    },
    deleteJob(id) {
      this.jobList = this.jobList.filter((cv) => cv.id !== id);
      this.updateSuggestions();
    },
    updateSuggestions() {
      if (!this.searchQuery) {
        this.filteredSuggestions = this.jobList;
      } else {
        const query = this.searchQuery.toLowerCase();
        this.filteredSuggestions = this.jobList.filter((item) =>
          item.title.toLowerCase().includes(query)
        );
      }
    },
  },
};
</script>

<style></style>
