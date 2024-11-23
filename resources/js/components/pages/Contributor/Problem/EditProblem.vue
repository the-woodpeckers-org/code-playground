<script>
import Multiselect from 'vue-multiselect';
import {HTTP} from "@/http-common.js";

export default {
    components: {
        Multiselect
    },
    name: "EditProblem",
    data: () => {
        return {
            isShowed: true,
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
                    id: '00000000',
                    stdin: '',
                    output: ''
                }
            ]
        }
    },
    mounted() {
        let rte = new RichTextEditor("#text-editor-et");
        rte.setHTMLCode("");
        let editor = ace.edit('editor-et');
        editor.setTheme('ace/theme/monokai');
        editor.session.setMode('ace/mode/c_cpp');
        this.currentCategories = [];
        this.getCategories();
    },
    methods: {
        addLanguageTag(newTag) {
            const tag = {
                name: newTag,
                code: newTag == 'C' ? '1' : newTag == 'C++' ? '2' : newTag == 'Python' ? '3' : newTag == 'PHP' ? '4' : '5'
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
                id: (Math.random() + 1).toString(36).substring(7),
                stdin: '',
                output: ''
            });
            console.log(this.testcases);
        },
        removeTestcase(id) {
            console.log(this.testcases);
            this.testcases = this.testcases.filter((item) => {
                return item.id != id;
            });
        },
        async getCategories() {
            let _this = this;
            await HTTP.get('api/categories')
                .then((response) => {
                    _this.categories = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async getProblem(id) {
            this.isShowed = true;
            await HTTP.get('api/problem/get?id=' + id)
                .then((response) => {
                    console.log(response);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        closeModal() {
            this.isShowed = false;
        }
    }
}
</script>

<template>
    <dialog id="edit_problem" class="modal" :class="{'modal-open' : this.isShowed }">
        <div class="modal-box w-11/12 max-w-5xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Edit problem</h3>
            <form>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label>Title</label>
                        <input class="rounded-lg border border-gray-400 h-8 w-full">
                    </div>
                    <div>
                        <label>Difficulty</label>
                        <select class="rounded-lg border border-gray-400 h-8 w-full">
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
                        <div id="text-editor-et">

                        </div>
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
                            <div id="editor-et" style="width: 100%; height: 100%" class="text-base mt-3">

                            </div>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label>Testcases</label>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                            <div v-for="testcase in testcases" class="bg-base-200 p-3 rounded-lg h-52 lobster">
                                <div class="h-5 text-end">
                                    <button v-if="testcases.length > 1" type="button"
                                            class="text-white bg-red-500 rounded-full px-1.5"
                                            @click="removeTestcase(testcase.id)"><i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                                <br>
                                <label>Input (stdin format) <span class="font-bold">[NOT TESTED]</span></label>
                                <input class="rounded-lg border border-gray-400 h-8 w-full">
                                <label>Expected output <span class="font-bold">[NOT TESTED]</span></label>
                                <input class="rounded-lg border border-gray-400 h-8 w-full">
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
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg">Update</button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeModal">Cancel</button>
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
