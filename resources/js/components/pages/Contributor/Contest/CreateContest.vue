<script>
import Multiselect from 'vue-multiselect';

export default {
    name: "CreateContest",
    components: {
        Multiselect
    },
    data: () => {
        return {
            // Component attributes
            isCreating: false,
            isEditing: false,
            editingId: -1,
            rte: null,
            editor: null,
            // Contest attributes
            title: '',
            description: '',
            start_date: '28/11/2024 05:00 AM',
            end_date: '28/11/2024 05:00 AM',
            tags: '',
            imgUrl: '',
            // Contest problems
            problems: [
                {
                    id: '000000',
                    existed: false
                }
            ],
            // Contest status
        }
    },
    mounted() {

    },
    methods: {
        // refs calling
        showCreate() {
            this.resetData();
            this.isEditing = false;
            this.isCreating = true;
        },
        // refs calling
        showEdit(id) {
            this.resetData();
            this.isCreating = false;
            this.isEditing = true;
            this.editingId = id;
            this.getContestData();
        },
        closeCreate() {
            this.isCreating = false;
        },
        closeEdit() {
            this.isEditing = false;
            this.editingId = -1;
        },
        getContestData() {

        },
        createContest() {

        },
        updateContest() {

        },
        resetData() {
            this.title = '';
            this.description = '';
            this.start_date = '28-11-2024';
            this.end_date = '28-11-2024';
            this.tags = '';
            this.imgUrl = '';
            this.problems = [
                {}
            ];
        },
        removeProblem(id) {
            this.problems = this.problems.filter(item => {
                return item.id !== id;
            });
        },
        checkBoxChange(id, cb) {
            if (cb === 'cb1')
                document.getElementById(id + 'cb2').checked = !document.getElementById(id + 'cb1').checked;
            if (cb === 'cb2')
                document.getElementById(id + 'cb1').checked = !document.getElementById(id + 'cb2').checked;
            this.problems[this.problems.findIndex(obj => obj.id == id)].existed = document.getElementById(id + 'cb1').checked ? true : false;
            console.log(this.problems[this.problems.findIndex(obj => obj.id == id)]);
        }
    }
}
</script>

<template>
    <dialog v-if="isCreating" class="modal" :class="{'modal-open': isCreating}">
        <div class="modal-box w-11/12 max-w-7xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new contest</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input v-model="title" class="rounded-lg border border-gray-400 h-10 w-full px-3">
                </div>
                <div>
                    <label>Tags</label>
                    <Multiselect v-model="tags"
                                 :options="['Hackathon', 'Speed', 'Cyanide', 'Aspire', 'HiTec', 'CodeForce']"
                                 :multiple="true" class="h-8 w-full"></Multiselect>
                </div>
                <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="description"
                              class="rounded-lg border border-gray-400 w-full h-40 px-3"></textarea>
                </div>
                <div>
                    <label>Start date</label>
                    <input v-model="start_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <label class="mt-3">End date</label>
                    <input v-model="end_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                </div>
                <div class="col-span-full">
                    <div class="divider"></div>
                    <p class="font-semibold text-lg">Problems</p>
                    <p>Maximum problems: {{problems.length}}/5</p>
                </div>
                <div class="col-span-full flex flex-col gap-3 relative ">
                    <div v-for="problem in problems" class="w-full min-h-20 border border-gray-400 rounded-xl collapse lobster">
                        <input type="checkbox">
                        <div class="collapse-title text-xl font-medium">Problem</div>
                        <div class="collapse-content">
                            <div class="flex gap-x-2">
                                <input @change="checkBoxChange(problem.id, 'cb1')" :id="problem.id + 'cb1'" type="checkbox" class="checkbox">
                                <label>Choose existed problem</label>
                            </div>
                            <div class="flex gap-x-2 mt-2">
                                <input @change="checkBoxChange(problem.id, 'cb2')" :id="problem.id + 'cb2'" type="checkbox" class="checkbox" checked>
                                <label>Create new problem</label>
                            </div>
                        </div>
                        <button v-if="problems.length > 1" class="absolute top-1 end-1 bg-red-500 rounded-xl px-1.5 text-white z-10 hover:bg-red-700" @click="removeProblem(problem.id)">X</button>
                    </div>
                    <div v-if="problems.length < 5" @click="problems.push({id: Math.random()})"
                         class="w-full h-20 border border-gray-400 rounded-xl hover:bg-base-300 transition cursor-pointer flex">
                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                    </div>
                </div>
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="closeCreate()">
                        Create
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeCreate()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <dialog v-if="isEditing" class="modal" :class="{'modal-open': isEditing}">
        <div class="modal-box w-11/12 max-w-7xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new contest</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input v-model="title" class="rounded-lg border border-gray-400 h-10 w-full px-3">
                </div>
                <div>
                    <label>Tags</label>
                    <Multiselect v-model="tags" :options="['Hackathon', 'Speed', 'Holy fuck']" :multiple="true"
                                 class="h-8 w-full"></Multiselect>
                </div>
                <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="description"
                              class="rounded-lg border border-gray-400 w-full h-40 px-3"></textarea>
                </div>
                <div>
                    <label>Start date</label>
                    <input type="datetime-local" class="rounded-lg border border-gray-400 h-8 w-full">
                    <label class="mt-3">End date</label>
                    <input type="datetime-local" class="rounded-lg border border-gray-400 h-8 w-full">
                </div>
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="closeEdit()">
                        Create
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeEdit()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
</template>

<style scoped>
@keyframes fade {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1
    }
}

.lobster {
    animation-name: fade;
    animation-duration: 500ms;
    animation-fill-mode: forwards;
}
</style>
