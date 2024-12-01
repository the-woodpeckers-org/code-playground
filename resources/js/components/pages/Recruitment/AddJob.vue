<template>
    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-10 rounded-2xl shadow-xl max-w-4xl mx-auto mt-10"
        v-if="!this.result">
        <button @click="goBack" class="btn-back mb-6 flex items-center space-x-2">
            <span class="material-icons"><i class="fa-solid fa-arrow-left"></i></span>
            <span>Back</span>
        </button>
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create Job Posting</h2>
        <form @submit.prevent="handleSubmit">
            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Title</label>
                <input v-model="jobForm.title" type="text" class="input-field" placeholder="Enter job title" required />
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Number of vacancies</label>
                <input v-model="jobForm.position_number" type="number" class="input-field" placeholder="Enter Number of vacancies" required
                onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" />
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Location</label>
                <input v-model="jobForm.location" type="text" class="input-field" placeholder="Job location" required />
            </div>
            <div class="mb-6">
                <label class="text-sm font-bold text-gray-700 mb-2 block">Skills <span
                        class="font-normal text-primary">*</span></label>
                <div class="border border-gray-200 shadow-sm rounded-lg p-6 bg-gray-50 mt-2">
                    <div class="flex flex-wrap gap-3 mb-4" id="skill-selected">
                        <div v-for="(skill, index) in selectedSkills" :key="index"
                            class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-lg shadow-sm space-x-2">
                            <span>{{ skill }}</span>
                            <button @click="removeSkill(skill)"
                                class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <button v-if="selectedSkills.length" @click="removeAll"
                            class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-150 ease-in-out shadow-md">
                            Clear All
                        </button>
                        <select
                            class="select w-full md:w-1/2 border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:ring-2 focus:ring-primary focus:outline-none bg-white text-gray-700"
                            @change="addSkill($event)" required>
                            <option disabled selected>Select a skill</option>
                            <option v-for="(skill, index) in availableSkills" :key="index" :value="skill">
                                {{ skill }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Negotiable</label>
                <input type="checkbox" class="checkbox checkbox-accent" v-model="jobForm.negotiable" />
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Salary</label>
                <input v-model="jobForm.salary" type="number" class="input-field" placeholder="Salary range"
                    :disabled="jobForm.negotiable" :required="!jobForm.negotiable"
                    onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" />
            </div>

            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Deadline</label>
                <input v-model="jobForm.deadline" type="date" class="input-field" required />
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Description</label>
                <div id="text-editor-3" class="input-editor p-4"></div>
            </div>
            <div class="flex justify-center space-x-6 mt-8">
                <button type="button" class="btn-secondary" @click="closeJobForm">Cancel</button>
                <button type="submit" class="btn-primary">Save</button>
            </div>
        </form>
    </div>
    
    <div v-else class="text-center">
        <div class="h-10">
        </div>
        <i class="fa-regular fa-bell text-9xl my-6"></i>
        <h1 class="text-4xl font-semibold my-6">We've received information you want to post a job !</h1>
        <p class="text-3xl my-6">Please wait for review!</p>
        <p class="text-xl my-6">Check the mail regularly, as we will send the results through it</p>
    </div>

    <dialog v-if="isMax" class="modal modal-open">
    <div class="modal-box text-center overflow-hidden">
      <h3 class="text-lg font-bold"></h3>
      <div class="w-full text-center text-xl text-green-600 animate-jump-in">
        <span>You have reached the maximum number of posts</span>
      </div>
      <div class="w-full text-center text-lg text-gray-700 mt-4">
        <span>If you want unlimited posts, consider upgrading your plan.</span>
      </div>
      <div class="mt-6">
        <router-link to="/UpgradePlan" class="btn btn-primary" >Upgrade Plan</router-link> 
      </div>
    </div>
  </dialog>
</template>

<script>
import { HTTP } from "@/http-common.js";
export default {
    name: "AddJob",
    data() {
        return {
            availableSkills: ['Java', 'Go', 'C', 'C#', 'C++', 'Rust', 'JavaScript', 'Python'],
            selectedSkills: [],
            jobForm: {
                title: "",
                location: "",
                skill: "",
                salary: 0,
                deadline: "",
                negotiable: true,
                rte_1: null,
            },
            result: null,
            isMax: false,
        };
    },
    mounted() {
        this.jobForm.rte_1 = new RichTextEditor('#text-editor-3');
        this.jobForm.rte_1.setHTMLCode("");
    },
    methods: {

        async handleSubmit() {
            const data = {
                job: {
                    title: this.jobForm.title,
                    location: this.jobForm.location,
                    skill: JSON.stringify(this.selectedSkills),
                    salary: this.jobForm.salary,
                    position_number: this.jobForm.position_number,
                    deadline: this.jobForm.deadline,
                    description: this.jobForm.rte_1.getHTMLCode(),
                    negotiable: this.jobForm.negotiable
                }
            };
            await HTTP.post('/api/createJob', data).then(response => {
                console.log(response.data);
                if (response.data.status === '200') {
                    this.result = response.data.message;
                    return;
                }
                if(response.data.status === '5900') {
                    this.isMax = true;
                    return;
                }
            }).catch(error => {
                console.error(error);
            });
        },
        goBack() {
            this.$router.back();
        },
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
        }
    }
};
</script>

<style scoped>
.btn-back {
    @apply text-blue-500 font-semibold hover:text-blue-600 flex items-center transition-colors duration-200;
}

.material-icons {
    font-size: 1.2rem;
}

.input-field {
    @apply w-full p-3 bg-white border border-gray-200 rounded-lg shadow-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition duration-200 ease-in-out;
}

.input-editor {
    @apply bg-white border border-gray-200 rounded-lg shadow-md focus:ring-2 focus:ring-blue-300 transition duration-200;
}

.btn-primary {
    @apply bg-gradient-to-r from-blue-400 to-blue-500 text-white font-semibold py-2 px-8 rounded-full hover:from-blue-500 hover:to-blue-600 shadow-lg transform hover:scale-105 transition duration-200 ease-in-out;
}

.btn-secondary {
    @apply bg-gray-200 text-gray-700 font-semibold py-2 px-8 rounded-full hover:bg-gray-300 shadow-md transform hover:scale-105 transition duration-200 ease-in-out;
}
</style>
