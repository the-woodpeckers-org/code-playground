<script>
import Testcase from "@/components/listItems/Testcase.vue";
import TestcaseList from "@/components/listItems/TestcaseList.vue";
import LoginRequiredDialog from "@/components/authentication/LoginRequiredDialog.vue";
import {HTTP} from "@/http-common.js";
import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "CodePanel",
    components: {LoginRequiredDialog, TestcaseList, Testcase},
    data: function () {
        return {
            passedTestcases: String,
            description: String,
            title: String,
            categories: Array,
            testcases: Array,
            languages: Array,
            runData: Array,
            loading: false,
            run: false,
            passedDate: String,
            isPassed: false,
            isSubmitted: false,
            isCompiling: false,
            isSubmitting: false,
            isCompileError: false,
            isBelongsToContest: false
        }
    },
    methods: {
        async compile() {
            let _this = this
            let editor = ace.edit('editor')
            _this.isCompiling = true
            _this.isCompileError = false
            axios.post('/api/compile', {
                code: editor.getSession().getValue(),
                language: document.getElementById('language').value,
                problem_id: _this.$route.params.id
            }).then(function (response) {
                _this.isCompiling = false
                if (response.data.succeed == false) {
                    console.log(response)
                    _this.isCompileError = true
                    document.getElementById('error-msg').innerText = response.data.output;
                } else {
                    _this.run = true
                    _this.runData = response.data.output
                    _this.passedTestcases = response.data.passedTestcases
                    if (_this.passedTestcases === _this.testcases.length) {
                        document.getElementById('submit-btn').disabled = false
                    } else {
                        document.getElementById('submit-btn').disabled = true
                    }
                }
                console.log(response)
            }).catch(function (error) {
                console.log(error)
                _this.isCompiling = false
                alert(error)
            })
        },
        async submit() {
            let _this = this
            let editor = ace.edit('editor')
            _this.isSubmitting = true
            HTTP.post('/api/submit', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                problem_id: _this.$route.params.id,
                language_id: document.getElementById('language').value
            }).then(function (response) {
                _this.isSubmitted = true
                _this.isSubmitting = false
                console.log(response)
            }).catch(function (error) {
                _this.isSubmitting = false
                console.log(error)
            })
        },
        onload() {
            let _this = this
            let editor = ace.edit('editor')
            editor.setTheme('ace/theme/monokai')
            editor.session.setMode('ace/mode/c_cpp')
            _this.passedTestcases = 0

            let _url = '/api/problem/get?id=';
            if (getAuth()) {
                _url = '/api/problem/get/u?id=';
            }
            HTTP.get(_url + _this.$route.params.id)
                .then(function (response) {
                    console.log(response);
                    _this.description = response.data.description;
                    _this.title = response.data.title;
                    _this.testcases = response.data.testcases;
                    _this.languages = response.data.languages;
                    _this.categories = response.data.categories;
                    _this.loading = true;
                    if (response.data.passed_at) {
                        _this.isPassed = true
                        _this.passedDate = response.data.passed_at
                    }
                    if (response.data.contestId) {
                        _this.isBelongsToContest = true
                    }
                    if (response.data.code !== null) {
                        editor.setValue(response.data.code, 1)
                    }
                })
                .catch(function (error) {
                    alert(error)
                })
        }
    },
    mounted() {
        this.onload()
    }
}
</script>

<template>
    <LoginRequiredDialog></LoginRequiredDialog>
    <dialog id="problem_solved_modal" class="modal" :class="{ 'modal-open' : isSubmitted}">
        <div class="modal-box">
            <h3 class="text-lg font-bold"></h3>
            <p class="py-4"><span class="font-semibold">Congratulations! Problem solved!</span><br>Do you want to solve
                some other problems?</p>
            <div class="modal-action">
                <form method="dialog">
                    <router-link type="button" class="btn bg-amber-300 hover:bg-amber-600 btn-sm mx-1 w-16"
                                 to="/problems">Yes
                    </router-link>
                    <button class="btn btn-sm w-16 bg-gray-300 hover:bg-gray-400" @click="this.isSubmitted = false">No
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <div class="w-full mt-2">

    </div>
    <div class="w-full mt-2">
        <form id="formCode" method="post" action="/compile">
            <div class="grid grid-cols-12">
                <div class="col-span-6 me-1 border-e-2">
                    <p class="text-2xl font-bold mx-1" v-if="loading"> {{ title }}</p>
                    <div class="w-full flex flex-row flex-wrap my-1">
                        <div class="border bg-base-200 border-gray-400 px-1 mx-1 mt-1" v-for="category in categories">
                            {{ category.name }}
                        </div>
                    </div>
                    <div class="w-full border-b-2"></div>
                    <p class="rte text-base mx-1" v-if="loading"><span v-html="description"></span></p>
                    <div class="text-2xl font-bold border-b-2 mx-1" v-if="!loading">
                        <div class="skeleton h-8 my-1 w-full"></div>
                    </div>
                    <div class="text-base mx-1" v-if="!loading">
                        <div v-for="index in 30" class="skeleton h-4 mt-1 w-full"></div>
                    </div>
                </div>
                <div class="col-span-6 mx-1">
                    <label for="language">Select language: </label>
                    <select id="language" name="language" class="bg-gray-200 rounded-xl border-2 border-gray-400 ms-3">
                        <option v-for="language in languages" :value="language.id"> {{ language.name }}</option>
                    </select>
                    <div class="h-96">
                        <div id="editor" style="width: 100%; height: 100%" class="text-base mt-3">

                        </div>
                    </div>
                    <div class="mt-3 w-full">
                        <button type="button"
                                class="rounded-xl bg-amber-300 py-1 border-gray-500 border border-amber-500 px-2 hover:bg-amber-600 w-20 h-10"
                                @click="compile">
                            <span v-if="!isCompiling">RUN</span>
                            <span v-if="isCompiling" class="loading loading-dots loading-xs"></span>
                        </button>
                        <button id="submit-btn" type="button"
                                class="rounded-xl bg-green-500 py-1 border-green-300 border px-2 ms-1 hover:bg-green-600 w-20 h-10 disabled:bg-gray-300 disabled:border-gray-400 disabled:text-gray-400"
                                disabled
                                @click="submit">
                            <span v-if="!isSubmitting">SUBMIT</span>
                            <span v-if="isSubmitting" class="loading loading-dots loading-xs"></span>
                        </button>
                        <div class="mt-3 transition" :class="{ 'hidden' : !isCompileError }">
                            <div class="alert alert-error">
                                <span id="error-msg">x</span>
                            </div>
                        </div>
                        <div class="mt-3" v-if="isPassed && !isBelongsToContest">
                            <p class="font-semibold text-green-600">You have already solved this problem at
                                {{ this.passedDate }} &#128512;</p>
                        </div>
                    </div>
                    <div v-if="loading" class="mt-3 w-full">
                        Testcases passed: <span id="testcases-passed" class="font-bold">{{
                            passedTestcases
                        }}/{{ testcases.length }}</span>
                    </div>
                    <div v-if="!loading" class="mt-3 w-full">
                        <div class="skeleton w-80 h-8"></div>
                    </div>
                    <div class="mt-3 w-full h-80 overflow-auto">
                        <div v-if="!loading">
                            <div v-for="index in 3" class="skeleton h-28 my-1 w-full"></div>
                        </div>
                        <div v-if="loading">
                            <TestcaseList v-if="!run" :data="testcases"></TestcaseList>
                            <TestcaseList v-if="run" :data="runData"></TestcaseList>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="w-full mt-2 h-12">

    </div>
</template>
