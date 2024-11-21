<template>

    <button @click="goBack" class="btn-back mb-6 flex items-center space-x-2">
        <span class="material-icons"><i class="fa-solid fa-arrow-left"></i></span>
        <span>Back</span>
    </button>

    <div role="tablist" class="tabs tabs-boxed grid grid-cols-2 bg-white w-[80%] h-min-[500px] m-auto">
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="CV Applied" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box">
            <div class="overflow-x-auto" v-if="this.applications.length > 0">
                <table class="table h-auto">
                    <thead>
                        <tr>
                            <th>Time applied</th>
                            <th>Name</th>
                            <th>Link cv</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <CvItemApplied v-for="(item, index) in this.applications" :key="index"
                            :id_user="item.cv.user.id" :name="item.cv.user.name" :time="item.created_at"
                            :linkCV="`/cv/show/${item.cv.id}`" @refuseCV="refuseCV" :status="item.status" :id_cv="item.cv.id" @approveCV="approveCV"></CvItemApplied>
                    </tbody>
                </table>
            </div>
            <div v-else>No applications yet</div>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Edit job" checked="checked" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-3 rounded-2xl shadow-xl m-3">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Job Posting</h2>
                <form @submit.prevent="handleSubmit">
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Title</label>
                        <input v-model="jobForm.title" type="text" class="input-field" placeholder="Enter job title"
                            required />
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-600 font-semibold mb-2">Location</label>
                        <input v-model="jobForm.location" type="text" class="input-field" placeholder="Job location"
                            required />
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
                        <input type="checkbox" class="checkbox checkbox-accent" :checked="jobForm.negotiable"  v-on:click="setNegotiable"/>
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
        </div>

    </div>


</template>

<script>
import { HTTP } from "@/http-common.js";
import CvItemApplied from "@/components/listItems/CvItemApplied.vue";
export default {
    name: "DetailJob",
    components: {
        CvItemApplied,
    },
    data() {
        return {
            applications: [],
            availableSkills: ['Java', 'Go', 'C', 'C#', 'C++', 'Rust', 'JavaScript', 'Python'],
            selectedSkills: [],
            jobForm: {
                title: "",
                location: "",
                skill: "",
                salary: "",
                negotiable: Boolean,
                deadline: "",
                rte_1: null,
            },
        };
    },
    async mounted() {
        await this.fetchDataAboutJob();
        this.jobForm.rte_1 = new RichTextEditor('#text-editor-3');
        this.jobForm.rte_1.setHTMLCode(this.jobForm.description);
        await this.fetchDataListCV();
        console.log(this.jobForm);
    },
    methods: {
        async handleSubmit() {
            await this.updateJob();
        },
        goBack() {
            this.$router.back();
        },
        setNegotiable() {
            this.jobForm.negotiable = !this.jobForm.negotiable;
            this.jobForm.salary = this.jobForm.negotiable ? 0 : "";
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
        },
        async fetchDataAboutJob() {
            await HTTP.get(`/api/getDetailJob/${this.$route.params.id}`).then(response => {
                //   /  console.log(response.data);
                this.jobForm = response.data.data;
                this.selectedSkills = JSON.parse(this.jobForm.skill);
                this.availableSkills = this.availableSkills.filter(skill => !this.selectedSkills.includes(skill));
            }).catch(error => {
                console.error(error);
            });
        },
        async updateJob() {
            const data = {
                job: {
                    title: this.jobForm.title,
                    location: this.jobForm.location,
                    skill: JSON.stringify(this.selectedSkills),
                    negotiable: this.jobForm.negotiable,
                    salary: this.jobForm.salary,
                    deadline: this.jobForm.deadline,
                    description: this.jobForm.rte_1.getHTMLCode(),
                    id: this.$route.params.id

                }
            };

            await HTTP.post('/api/updateJob', data).then(response => {
                console.log(response.data);
                alert("Job updated successfully");
                this.goBack();
            }).catch(error => {
                console.error(error);
            });
        },
        async fetchDataListCV() {
            await HTTP.get(`/api/getCVsApplied/${this.$route.params.id}`).then(response => {
                this.applications = response.data.applications;
                console.log("cv",response.data);
            }).catch(error => {
                console.error(error);
            });
        },
       async refuseCV(id) {
            await HTTP.post('/api/refuseCV',{job_id: this.jobForm.id , cv_id: id})
            .then(response => {
                console.log(response.data);
                alert("CV refused successfully");
                this.fetchDataListCV();
            }).catch(error => {
                console.error(error);
            });
            // alert("Refuse CV "+ id);
        },
        async approveCV(id) {
            await HTTP.post('/api/approvedCV',{job_id: this.jobForm.id , cv_id: id})
            .then(response => {
                console.log(response.data);
                alert("CV approved successfully");
                this.fetchDataListCV();
            }).catch(error => {
                console.error(error);
            });
        },
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
