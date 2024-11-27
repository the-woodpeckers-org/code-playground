<script>
import Multiselect from 'vue-multiselect';
import {HTTP} from "@/http-common.js";
import Toast from "@/components/messages/Toast.vue";

export default {
    components: {
        Toast,
        Multiselect
    },
    name: "EditProblem",
    data: () => {
        return {
            isShowed: false,
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
            testcases: [],
            id: '',
            title: '',
            description: '',
            difficulty: '',
            rte: null,
            editor: null,
            isLoading: true,
            isUpdated: false
        }
    },
    mounted() {
        this.currentCategories = [];
        this.getCategories();
        setTimeout(() => {
            this.rte = new RichTextEditor("#text-editor-et");
            this.rte.setHTMLCode("");
            this.editor = ace.edit('editor-et');
            this.editor.setTheme('ace/theme/monokai');
            this.editor.session.setMode('ace/mode/c_cpp');
        }, 500);
    },
    methods: {
        addLanguageTag(newTag) {
            const tag = {
                name: newTag,
            };
            this.currentLanguages.push(tag);
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
        getCategories() {
            let _this = this;
            HTTP.get('api/categories')
                .then((response) => {
                    _this.categories = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getProblem(id) {
            document.getElementById('edit-modal-box').scrollTop = 0;
            this.isUpdated = false;
            this.isShowed = true;
            this.isLoading = true;
            let _this = this;
            this.testcases = [];
            HTTP.get('api/problem/get?id=' + id)
                .then((response) => {
                    console.log(response);
                    _this.currentLanguages = response.data.languages.map((item) => {
                        _this.addLanguageTag(item.name);
                        return item.name;
                    });
                    _this.id = response.data.id;
                    _this.currentCategories = response.data.categories;
                    _this.title = response.data.title;
                    _this.description = response.data.description;
                    _this.rte.setHTMLCode(_this.description);
                    _this.difficulty = response.data.difficulty;
                    response.data.testcases.forEach((item) => {
                        _this.testcases.push({
                            cid: (Math.random() + 1).toString(36).substring(7),
                            id: item.id,
                            stdin: item.stdin,
                            expected_output: item.expected_output
                        })
                    });
                    this.isLoading = false;
                })
                .catch((err) => {
                    console.log(err);
                });

        },
        updateProblem() {
            let _this = this;
            const data = {
                title: _this.title,
                difficulty: _this.difficulty,
                description: _this.rte.getHTMLCode(),
                categories: this.currentCategories,
                languages: this.currentLanguages,
                testcases: this.testcases
            };
            console.log(data);
            HTTP.put('api/problem/?id=' + _this.id, data)
                .then((response) => {
                    this.isShowed = false;
                    this.isUpdated = true;
                    this.$emit('toggle-fetch');
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
        <div id="edit-modal-box" class="modal-box w-11/12 max-w-5xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Edit problem</h3>
            <form>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label>Title</label>
                        <input v-if="!isLoading" v-model="title" class="rounded-lg border border-gray-400 h-8 w-full">
                        <div v-if="isLoading" class="rounded-lg border border-gray-400 h-8 w-full skeleton"></div>
                    </div>
                    <div>
                        <label>Difficulty</label>
                        <select v-if="!isLoading" v-model="difficulty" class="rounded-lg border border-gray-400 h-8 w-full">
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Hard">Hard</option>
                        </select>
                        <div v-if="isLoading" class="rounded-lg border border-gray-400 h-8 w-full skeleton"></div>
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
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="updateProblem">Update</button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeModal">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <Toast v-if="isUpdated" :toastData="{type: 'success', message: 'Update problem successfully'}"></Toast>
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
