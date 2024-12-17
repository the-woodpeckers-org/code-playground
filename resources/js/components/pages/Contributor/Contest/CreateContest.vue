<script>
import Multiselect from 'vue-multiselect';
import testcase from "@/components/listItems/Testcase.vue";
import {HTTP} from "@/http-common.js";
import Toast from "@/components/messages/Toast.vue";

export default {
    name: "CreateContest",
    components: {
        Toast,
        Multiselect
    },
    data: () => {
        return {
            // Component attributes
            isCreating: false,
            isEditing: false,
            isCreated: false,
            isEdited: false,
            editingId: -1,
            rte: null,
            editor: null,
            // Contest attributes
            title: '',
            description: '',
            start_date: '28/11/2024 05:00 AM',
            end_date: '28/11/2024 05:00 AM',
            tags: [],
            imgUrl: '',
            errors: {},
            problems_errors: [],
            // Contest problems
            problems: [
                {
                    id: '000000',
                    title: '',
                    description: '',
                    difficulty: 'Easy',
                    languages: [],
                    testcases: [
                        {
                            id: '000000',
                            stdin: '',
                            expected_result: '',
                        },
                    ],
                }
            ],
            // Contest status
            editStatus: 0,
        }
    },
    mounted() {

    },
    methods: {
        testcase() {
            return testcase
        },
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
            this.getContestData(id);
        },
        closeCreate() {
            this.isCreating = false;
        },
        closeEdit() {
            this.isEditing = false;
            this.editingId = -1;
        },
        getContestData(id) {
            let _this = this;
            _this.editingId = id;
            HTTP.get('api/contributor/contest/single?id=' + id)
                .then((response) => {
                    _this.title = response.data.title;
                    _this.description = response.data.description;
                    _this.start_date = response.data.start_date;
                    _this.end_date = response.data.end_date;
                    _this.problems = response.data.problems;
                    _this.editStatus = _this.checkValidDate(_this.start_date, _this.end_date);
                    for (let i = 0; i < response.data.problems.length; ++i) {
                        let array = [];
                        for (let j = 0; j < response.data.problems[i].languages.length; ++j) {
                            array.push(response.data.problems[i].languages[j].name);
                            _this.problems[i].languages = array;
                        }
                    }
                    _this.tags = response.data.tags.split(',');
                })
                .catch((err) => {
                });
        },
        checkValidDate(start, end) {
            let currDate = new Date();
            if (new Date(end) <= currDate) {
                return 1;
            }
            else if (new Date(start) <= currDate) {
                return 2;
            }
            return 0;
        },
        createContest() {
            let _this = this;

            const data = {
                title: this.title,
                description: this.description,
                imgUrl: '',
                start_date: this.start_date,
                end_date: this.end_date,
                tags: this.tags,
                problems: this.problems
            }
            HTTP.post('api/contest', data)
                .then((response) => {
                    _this.isCreated = true;
                    _this.closeCreate();
                    _this.resetData();
                    this.$emit('toggle-fetch');
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                    if (this.checkValidDate(this.start_date, this.end_date) !== 0) {
                        this.errors.end_date.push('Start date nor end date must in the future!')
                        return;
                    }
                });
        },
        updateContest() {
            let _this = this;
            const data = {
                id: this.editingId,
                title: this.title,
                description: this.description,
                imgUrl: '',
                start_date: this.start_date,
                end_date: this.end_date,
                tags: this.tags,
                problems: this.problems
            };
            HTTP.put('api/contest', data)
                .then((res) => {
                    _this.isUpdated = true;
                    _this.closeEdit();
                    _this.resetData();
                    this.$emit('toggle-fetch');
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                    if (this.checkValidDate(this.start_date, this.end_date) !== 0) {
                        this.errors.end_date.push('Start date nor end date must in the future!');
                        return;
                    }
                });
        },
        resetData() {
            this.title = '';
            this.description = '';
            this.start_date = '28-11-2024';
            this.end_date = '28-11-2024';
            this.tags = [];
            this.imgUrl = '';
            this.problems = [
                {
                    title: '',
                    description: '',
                    difficulty: 'Easy',
                    languages: [],
                    testcases: [
                        {
                            id: '000000',
                            stdin: '',
                            expected_output: '',
                        },
                    ],
                }
            ];
            this.editStatus = '';
            this.errors = {};
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
        },
        addTestcase(id) {
            this.problems[id].testcases.push({
                id: Math.random().toString(7),
                stdin: '',
                expected_output: ''
            });
        },
        removeTestcase(id, testcaseId) {
            this.problems[id].testcases = this.problems[id].testcases.filter((item) => {
                return item.id !== testcaseId;
            })
        },

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
                    <div v-if="errors && errors.title"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.title"> {{ err }} </p>
                    </div>
                </div>
                <div>
                    <label>Tags</label>
                    <Multiselect v-model="tags"
                                 :options="['Hackathon', 'Speed', 'Cyanide', 'Aspire', 'HiTec', 'CodeForce']"
                                 :multiple="true" class="h-8 w-full"></Multiselect>
                    <div v-if="errors && errors.tags" class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.tags"> {{ err }} </p>
                    </div>
                </div>
                <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="description"
                              class="rounded-lg border border-gray-400 w-full h-40 px-3"></textarea>
                    <div v-if="errors && errors.description"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.description"> {{ err }} </p>
                    </div>
                </div>
                <div>
                    <label>Start date</label>
                    <input v-model="start_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <div v-if="errors && errors.start_date"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.start_date"> {{ err }} </p>
                    </div>
                    <label class="mt-3">End date</label>
                    <input v-model="end_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <div v-if="errors && errors.end_date"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.end_date"> {{ err }} </p>
                    </div>
                </div>
                <div class="col-span-full">
                    <div class="divider"></div>
                    <p class="font-semibold text-lg">Problems</p>
                    <p>Maximum problems: {{ problems.length }}/5</p>
                </div>
                <div class="col-span-full flex flex-col gap-3 relative ">
                    <div v-for="(problem, index) in problems"
                         class="w-full min-h-20 border border-gray-400 rounded-xl collapse lobster">
                        <input type="checkbox">
                        <div class="collapse-title text-xl font-medium">Problem</div>
                        <div class="collapse-content">
                            <div>
                                <label>Title</label>
                                <input v-model="problem.title"
                                       class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                <label>Difficulty</label>
                                <select v-model="problem.difficulty"
                                        class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                                <label>Languages</label>
                                <Multiselect v-model="problem.languages"
                                             :options="['C', 'C++', 'Python', 'PHP', 'JavaScript']" :multiple="true"
                                             class="h-8 w-full"></Multiselect>
                                <label>Description</label>
                                <textarea v-model="problem.description"
                                          class="w-full border h-40 rounded-lg border-gray-400 px-3"></textarea>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border border-gray-300 rounded-lg p-1 h-32 relative lobster"
                                         v-for="testcase in problem.testcases">
                                        <label>stdin</label>
                                        <input v-model="testcase.stdin"
                                               class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <label>expected_output</label>
                                        <input v-model="testcase.expected_output"
                                               class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <p v-if="problem.testcases.length > 1"
                                           class="absolute bg-red-400 px-1.5 rounded-full top-1 end-1 text-white hover:bg-red-600 cursor-pointer"
                                           @click="removeTestcase(index, testcase.id)">X</p>
                                    </div>
                                    <div @click="addTestcase(index)"
                                         class="border border-gray-300 rounded-lg p-1 h-32 hover:bg-base-300 flex cursor-pointer">
                                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button v-if="problems.length > 1"
                                class="absolute top-1 end-1 bg-red-500 rounded-xl px-1.5 text-white z-10 hover:bg-red-700"
                                @click="removeProblem(problem.id)">X
                        </button>
                    </div>
                    <div v-if="problems.length < 5"
                         @click="problems.push({id: Math.random().toString(7), title: '', description: '', difficulty: '', languages: [], testcases: [ { id: Math.random().toString(7), stdin: '', expected_output: ''}], existed: false})"
                         class="w-full h-20 border border-gray-400 rounded-xl hover:bg-base-300 transition cursor-pointer flex">
                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                    </div>
                </div>
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="createContest()">
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
            <h3 class="text-lg font-bold">Update contest</h3>
            <p v-if="editStatus !== 0" class="p-2 bg-yellow-300 rounded-md border my-3"><span v-if="editStatus === 1">You cannot update this contest because it's a ongoing contest!</span>
                <span v-if="editStatus === 2">You cannot update this contest because it's a ended contest!</span></p>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input v-model="title" class="rounded-lg border border-gray-400 h-10 w-full px-3">
                    <div v-if="errors && errors.title"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.title"> {{ err }} </p>
                    </div>
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
                    <div v-if="errors && errors.description"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.description"> {{ err }} </p>
                    </div>
                </div>
                <div>
                    <label>Start date</label>
                    <input v-model="start_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <div v-if="errors && errors.start_date"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.start_date"> {{ err }} </p>
                    </div>
                    <label class="mt-3">End date</label>
                    <input v-model="end_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <div v-if="errors && errors.end_date"
                         class="bg-red-500 rounded-md border py-1 px-2 my-1 text-base-200 lobster">
                        <p v-for="err in errors.end_date"> {{ err }} </p>
                    </div>
                </div>
                <div class="col-span-full">
                    <div class="divider"></div>
                    <p class="font-semibold text-lg">Problems</p>
                    <p>Maximum problems: {{ problems.length }}/5</p>
                </div>
                <div class="col-span-full flex flex-col gap-3 relative ">
                    <div v-for="(problem, index) in problems"
                         class="w-full min-h-20 border border-gray-400 rounded-xl collapse lobster">
                        <input type="checkbox">
                        <div class="collapse-title text-xl font-medium">Problem</div>
                        <div class="collapse-content">
                            <div class="flex gap-x-2">
                                <input @change="checkBoxChange(problem.id, 'cb1')" :id="problem.id + 'cb1'"
                                       type="checkbox" class="checkbox">
                                <label>Choose existed problem</label>
                            </div>
                            <div class="flex gap-x-2 mt-2">
                                <input @change="checkBoxChange(problem.id, 'cb2')" :id="problem.id + 'cb2'"
                                       type="checkbox" class="checkbox" checked>
                                <label>Create new problem</label>
                            </div>
                            <div>
                                <label>Title</label>
                                <input v-model="problem.title"
                                       class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                <label>Difficulty</label>
                                <select v-model="problem.difficulty"
                                        class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                                <label>Languages</label>
                                <Multiselect v-model="problem.languages"
                                             :options="['C', 'C++', 'Python', 'PHP', 'JavaScript']" :multiple="true"
                                             class="h-8 w-full"></Multiselect>
                                <label>Description</label>
                                <textarea v-model="problem.description"
                                          class="w-full border h-40 rounded-lg border-gray-400 px-3"></textarea>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border border-gray-300 rounded-lg p-1 h-32 relative lobster"
                                         v-for="testcase in problem.testcases">
                                        <label>stdin</label>
                                        <input v-model="testcase.stdin"
                                               class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <label>expected_result</label>
                                        <input v-model="testcase.expected_output"
                                               class="w-full border h-8 rounded-lg border-gray-400 px-3">
                                        <p v-if="problem.testcases.length > 1"
                                           class="absolute bg-red-400 px-1.5 rounded-full top-1 end-1 text-white hover:bg-red-600 cursor-pointer"
                                           @click="removeTestcase(index, testcase.id)">X</p>
                                    </div>
                                    <div @click="addTestcase(index)"
                                         class="border border-gray-300 rounded-lg p-1 h-32 hover:bg-base-300 flex cursor-pointer">
                                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button v-if="problems.length > 1"
                                class="absolute top-1 end-1 bg-red-500 rounded-xl px-1.5 text-white z-10 hover:bg-red-700"
                                @click="removeProblem(problem.id)">X
                        </button>
                    </div>
                    <div v-if="problems.length < 5"
                         @click="problems.push({id: Math.random().toString(7), title: '', description: '', difficulty: '', languages: [], testcases: [ { id: Math.random().toString(7), stdin: '', expected_output: ''}], existed: false})"
                         class="w-full h-20 border border-gray-400 rounded-xl hover:bg-base-300 transition cursor-pointer flex">
                        <span class="text-5xl m-auto"><i class="fa-solid fa-plus"></i></span>
                    </div>
                </div>
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button v-if="editStatus === 0" class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="updateContest()">
                        Update
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeEdit()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <Toast v-if="isCreated" :toastData="{ type: 'success', message: 'Create contest successfully!'}"></Toast>
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
