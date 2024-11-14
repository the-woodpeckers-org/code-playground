<template>
  <NavigatorRecuitment></NavigatorRecuitment>
  <div class="mt-6 bg-white shadow-lg rounded-lg container mx-auto p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <div class="flex flex-col items-center space-y-4">
        <img alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200"
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s"
          loading="lazy" />
        <input type="file" class="file-input file-input-bordered w-full max-w-xs" />
      </div>

      <div class="flex flex-col space-y-4">
        <label class="flex flex-col text-sm font-medium text-gray-700">
          Name
          <input type="text" class="input input-bordered mt-1 p-2 rounded-md" placeholder="Daisy" />
        </label>
        <label class="flex flex-col text-sm font-medium text-gray-700">
          Email
          <input type="email" class="input input-bordered mt-1 p-2 rounded-md" placeholder="daisy@site.com" />
        </label>
        <label class="flex flex-col text-sm font-medium text-gray-700">
          Phone
          <input type="tel" class="input input-bordered mt-1 p-2 rounded-md" placeholder="0123456789" />
        </label>
       
      </div>

      <div class="flex flex-col space-y-4">
      
        <LocationPicker></LocationPicker>
        <label class="flex flex-col text-sm font-medium text-gray-700">
          Address
          <input type="text" class="input input-bordered mt-1 p-2 rounded-md" placeholder="House number" />
        </label>
      </div>
    </div>

    <div class="mt-6">
  <label class="text-sm font-bold text-gray-700 mb-2 block">Skills <span class="font-normal text-primary">*</span></label>
  <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
    <!-- Selected Skills -->
    <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
      <div v-for="(skill, index) in selectedSkills" :key="index" class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
        <span>{{ skill }}</span>
        <button @click="removeSkill(skill)" class="text-blue-500 hover:text-blue-700 focus:outline-none">
          <i class="fa-solid fa-x"></i>
        </button>
      </div>
    </div>

    <div class="flex justify-between items-center">
      <button v-if="selectedSkills.length" @click="removeAll" class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-150 ease-in-out shadow-md">
        Clear All
      </button>
      <select class="select w-full md:w-1/2 border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:ring-2 focus:ring-primary focus:outline-none bg-white text-gray-700" @change="addSkill($event)">
        <option disabled selected>Select a skill</option>
        <option v-for="(skill, index) in availableSkills" :key="index" :value="skill">
          {{ skill }}
        </option>
      </select>
    </div>
  </div>
</div>

    <div class="mt-6">
      <label class="text-sm font-bold text-gray-700 mb-2 block">Genernal Infomartion <span class="font-normal text-primary">*</span></label>
      <textarea class="input input-bordered w-full h-24 p-4 rounded-md" placeholder="Education"></textarea>
    </div>

    <div class="mt-6">
      <label class="text-sm font-bold text-gray-700 mb-2 block">Description <span class="font-normal text-primary">*</span></label>
      <textarea class="input input-bordered w-full h-24 p-4 rounded-md" placeholder="Description"></textarea>
    </div>

    <div class="mt-6">
      <button class="btn btn-primary">Save</button>
</div>

  </div>
</template>

<script>
import NavigatorRecuitment from "@/components/navbar/NavigatorRecuitment.vue";
import LocationPicker from "@/components/locationPicker/LocationPicker.vue";
export default {
  name: 'RecuitmentManagement',
  components: { NavigatorRecuitment, LocationPicker },
  data() {
    return {
      availableSkills: ['Java', 'Go', 'C', 'C#', 'C++', 'Rust', 'JavaScript', 'Python'],
      selectedSkills: [],
    };
  },
  methods: {
    addSkill(event) {
      const skill = event.target.value;
      if (skill && !this.selectedSkills.includes(skill)) {
        this.selectedSkills.push(skill);
        this.availableSkills = this.availableSkills.filter(s => s !== skill);
      }
      event.target.value = "Select a skill";
      console.log(this.selectedSkills);
    },
    removeSkill(skill) {
      this.selectedSkills = this.selectedSkills.filter(s => s !== skill);
      if (!this.availableSkills.includes(skill)) {
        this.availableSkills.push(skill);
      }
    },
    removeAll() {
      this.availableSkills = [...this.availableSkills, ...this.selectedSkills];
      this.selectedSkills = [];
    },
  },
}
</script>

<style scoped>

.select {
  transition: all 0.2s ease-in-out;
}
</style>
