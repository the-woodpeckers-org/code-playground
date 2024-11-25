<script>
import Multiselect from 'vue-multiselect';
import {HTTP} from "@/http-common.js";

export default {
    components: {
        Multiselect
    },
    name: "CreateProblem",
    data: () => {
        return {
            currentCategories: [],
            categories: [],
            currentLanguages: [],
            languages: [
                'C',
                'C++',
                'Python',
                'PHP',
                'JavaScript',
            ],
            testcases: [
                {
                    cid: '0000000',
                    stdin: '',
                    expected_output: ''
                }
            ],
            title: '',
            description: '',
            richText: null,
        }
    },
    mounted() {
        this.richText = new RichTextEditor("#text-editor-ce");
        let editor = ace.edit('editor');
        editor.setTheme('ace/theme/monokai');
        editor.session.setMode('ace/mode/c_cpp');
        this.currentCategories = [];
        this.getCategories();
    },
    methods: {
        addLanguageTag(newTag) {
            const tag = {
                name: newTag,
            };
            this.currentLanguages.push(tag);
            this.languages.push(tag);
        },
        addCategoryTag(newTag) {
            const tag = {
                name: newTag,
            };
            this.currentCategories.push(tag);
            this.categories.push(tag);
        },
        addTestcase() {
            this.testcases.push({
                cid: (Math.random() + 1).toString(36).substring(7),
                stdin: '',
                expected_output: ''
            });
            console.log(this.testcases);
        },
        removeTestcase(cid) {
            console.log(this.testcases);
            this.testcases = this.testcases.filter((item) => {
                return item.cid != cid;
            });
        },
        async getCategories() {
            let _this = this;
            this.categories = [];
            await HTTP.get('api/categories')
                .then((response) => {
                    _this.categories = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async createProblem() {
            this.isCreatedSomeRecord = false;
            let _this = this;
            const data = {
                title: _this.title,
                difficulty: _this.difficulty,
                description: _this.richText.getHTMLCode(),
                categories: this.currentCategories,
                languages: this.currentLanguages,
                testcases: this.testcases
            }
            await HTTP.post('api/problem/create', data)
                .then((response) => {
                    rte.setHTMLCode("");
                    let editor = ace.edit('editor');
                    editor.setTheme('ace/theme/monokai');
                    editor.session.setMode('ace/mode/c_cpp');
                    this.getCategories();
                    this.currentCategories = [];
                    this.currentLanguages = [];
                    this.languages = [
                        'C',
                        'C++',
                        'Python',
                        'PHP',
                        'JavaScript',
                    ];
                    this.testcases = [];
                    this.title = '';
                    this.difficulty = '';
                    this.isCreatedSomeRecord = true;
                })
                .catch((err) => {

                });
        }
    }
}
</script>

<template>
    <div class="text-end">
        <button onclick="my_modal.showModal()" class="bg-blue-300 px-3 py-1 m-1 hover:bg-blue-500 rounded-lg">Create new
            problem
        </button>
    </div>
    <dialog id="my_modal" class="modal">
        <div class="modal-box w-11/12 max-w-5xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new problem</h3>
            <form>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label>Title</label>
                        <input v-model="title" class="rounded-lg border border-gray-400 h-8 w-full">
                    </div>
                    <div>
                        <label>Difficulty</label>
                        <select v-model="difficulty" class="rounded-lg border border-gray-400 h-8 w-full">
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Hard">Hard</option>
                        </select>
                    </div>
                    <div>
                        <label>Programming Languages</label>
                        <Multiselect v-model="currentLanguages" :options="languages" :tagglable="true"
                                     :multiple="true" @tag="addLanguageTag" class="w-full h-20"></Multiselect>
                    </div>
                    <div>
                        <label>Categories</label>
                        <Multiselect track-by="id" v-model="currentCategories" :options="categories" label="name"
                                     :tagglable="true"
                                     :multiple="true" @tag="addCategoryTag" class="w-full h-20"></Multiselect>
                    </div>
                    <div class="col-span-full">
                        <label>Description</label>
                        <div id="text-editor-ce"></div>
                    </div>
                    <div class="col-span-full mb-6">
                        <label>Testing Code</label>
                        <br>
                        <div class="h-96 bg-base-300 py-3">
                            <label for="language">Select language: </label>
                            <select id="language" name="language"
                                    class="bg-gray-200 rounded-xl border-2 border-gray-400 ms-3">
                                <option v-for="language in languages" :value="language"> {{ language }}</option>
                            </select>
                            <div id="editor" style="width: 100%; height: 100%" class="text-base mt-3">

                            </div>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label>Testcases</label>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                            <div v-for="(testcase, index) in testcases" class="bg-base-200 p-3 rounded-lg h-52 lobster">
                                <div class="h-5 text-end">
                                    <button v-if="testcases.length > 1" type="button"
                                            class="text-white bg-red-500 rounded-full px-1.5"
                                            @click="removeTestcase(testcase.cid)"><i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                                <br>
                                <label>Input (stdin format) <span class="font-bold">[NOT TESTED]</span></label>
                                <input v-model="testcases[index].stdin"
                                       class="rounded-lg border border-gray-400 h-8 w-full">
                                <label>Expected output <span class="font-bold">[NOT TESTED]</span></label>
                                <input v-model="testcases[index].expected_output"
                                       class="rounded-lg border border-gray-400 h-8 w-full">
                                <div class="text-end">
                                    <button class="bg-blue-300 px-3 py-1 m-1 hover:bg-blue-500 rounded-lg">Test with
                                        code
                                    </button>
                                </div>
                            </div>
                            <div class="bg-base-200 p-3 rounded-lg flex hover:bg-base-300 h-52 cursor-pointer"
                                 @click="addTestcase">
                                <div class="mx-auto my-auto">
                                    <i class="fa-solid fa-plus text-5xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="createProblem">
                        Create
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg">Cancel</button>
                </form>
            </div>
        </div>
    </dialog>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

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
