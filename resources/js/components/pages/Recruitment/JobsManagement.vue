<template>
    <div>
        <NavigatorRecuitment></NavigatorRecuitment>
        <div class="container bg-base-100 p-3">
            <div class="container">
                <label class="input input-bordered flex items-center gap-2">
                    <input type="text" class="grow" placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <CardJobM v-for="(item, index) in 5" :key="index"></CardJobM>
                <div
        @click="openJobForm"
        class="border rounded-xl h-52 w-auto my-2 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition cursor-pointer flex justify-center items-center"
      >
        <i class="fas fa-plus text-6xl text-gray-600"></i>
      </div>
            </div>
        </div>

        <div v-if="isJobFormOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-semibold mb-4">{{ formMode === 'edit' ? 'Edit Job' : 'Add Job' }}</h2>
        <form @submit.prevent="saveJob">
          <!-- Form Fields -->
          <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input v-model="jobForm.title" type="text" class="input input-bordered w-full" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Location</label>
            <input v-model="jobForm.location" type="text" class="input input-bordered w-full" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Skills</label>
            <input v-model="jobForm.skill" type="text" class="input input-bordered w-full" placeholder="Comma-separated skills" />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Salary</label>
            <input v-model="jobForm.salary" type="number" class="input input-bordered w-full" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Deadline</label>
            <input v-model="jobForm.deadline" type="date" class="input input-bordered w-full" required />
          </div>
          <div class="flex justify-end space-x-4">
            <button type="button" class="btn btn-secondary" @click="closeJobForm">Cancel</button>
            <button type="submit" class="btn btn-primary">{{ formMode === 'edit' ? 'Update' : 'Add' }}</button>
          </div>
        </form>
      </div>
    </div>

    </div>
</template>
<script>
import CardJobM from "@/components/cards/JobM.vue";
import NavigatorRecuitment from "@/components/navbar/NavigatorRecuitment.vue";
export default {
    name: 'JobsManagement',
    components: { NavigatorRecuitment, CardJobM },
    methods: {
    openJobForm() {
      this.isJobFormOpen = true;
      this.formMode = "add";
      this.resetJobForm();
    },
    closeJobForm() {
      this.isJobFormOpen = false;
    },
    saveJob() {
      if (this.formMode === "add") {
        this.jobList.push({ ...this.jobForm, skill: this.jobForm.skill.split(",").map(s => s.trim()) });
      }
      this.closeJobForm();
    },
    resetJobForm() {
      this.jobForm = { title: "", location: "", skill: "", salary: "", deadline: "" };
    },
  },
};
</script>
<style></style>