<script>
import Testcase from "@/components/listItems/Testcase.vue";
import TestcaseList from "@/components/listItems/TestcaseList.vue";
import LoginRequiredDialog from "@/components/authentication/LoginRequiredDialog.vue";
import {HTTP} from "@/http-common.js";
import problem from "@/components/listItems/Problem.vue";

export default {
    name: "ContestCodePanel",
    components: {LoginRequiredDialog, TestcaseList, Testcase},
    props: {
        contestId: {
            default: null
        },
        entryTestId: {
            default: null
        },
        challengeId: {
            default: null
        },
        courseId: {
            default: null
        },
        problemId: {
            default: null
        },
        participationId: {
            default: null
        }
    },
    data: function () {
        return {
            passedTestcases: String,
            description: String,
            title: String,
            categories: [],
            languages: [],
            testcases: Array,
            runData: Array,
            loading: false,
            run: false,
            passedDate: String,
            isPassed: false,
            isSubmitted: false,
            isCompiling: false,
            isSubmitting: false,
            isCompileError: false,
        }
    },
    methods: {
        problem() {
            return problem
        },
        async compile() {
            let _this = this
            let editor = ace.edit('editor-' + _this.problemId)
            _this.isCompiling = true
            _this.isCompileError = false
            HTTP.post('/api/compile', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                language: document.getElementById('language-' + _this.problemId).value,
                problem_id: _this.problemId
            }).then(function (response) {
                _this.isCompiling = false;
                if (response.data.succeed == false) {
                    _this.isCompileError = true
                    document.getElementById('error-msg-' + _this.problemId).innerText = response.data.output;
                } else {
                    _this.run = true
                    _this.runData = response.data.output
                    _this.passedTestcases = response.data.passedTestcases
                    if (_this.passedTestcases === _this.testcases.length) {
                        document.getElementById('submit-btn-' + _this.problemId).disabled = false
                    } else {
                        document.getElementById('submit-btn-' + _this.problemId).disabled = true
                    }
                }
            }).catch(function (error) {
                _this.isCompiling = false
            })
        },
        async submit() {
            let _this = this
            let editor = ace.edit('editor-' + _this.problemId)
            _this.isSubmitting = true
            HTTP.post('/api/submit/participation', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                problem_id: _this.problemId,
                participation_id: _this.participationId
            }).then(function (response) {
                console.log('huhu');
                _this.isSubmitted = true;
                _this.isSubmitting = false;
                _this.$emit('problem-passed', true);
            }).catch(function (error) {
                _this.isSubmitting = false
            })

        },
        async onload() {
            let _this = this
            _this.passedTestcases = 0
            let editor = ace.edit('editor' + '-' + this.problemId)
            editor.setTheme('ace/theme/monokai')
            editor.session.setMode('ace/mode/c_cpp')
            HTTP.get('/api/participate/problem?id=' + _this.problemId + '&participation_id=' + _this.participationId)
                .then(function (response) {
                    console.log(response)
                    _this.description = response.data.description;
                    _this.title = response.data.title;
                    _this.testcases = response.data.testcases;
                    _this.languages = response.data.languages;
                    _this.categories = response.data.categories;
                    _this.loading = true
                    if (response.data.passed_at) {
                        _this.isPassed = true;
                        _this.passedDate = response.data.passed_at;
                        _this.$emit('problem-passed', true);
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
    <dialog id="problem_solved_modal" class="modal" :class="{ 'modal-open' : isSubmitted}">
        <div class="modal-box">
            <h3 class="text-lg font-bold"></h3>
            <p class="py-4">Problem submitted</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm w-16 bg-amber-400 hover:bg-amber-600 transition" @click="this.isSubmitted = false">Ok
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <div class="w-full mt-2">

    </div>
    <div class="w-full mt-2">
        <form :id="'formCode' + '-' + problemId" method="post" action="/compile">
            <div class="grid grid-cols-12">
                <div class="col-span-6 me-1 border-e-2">
                    <p class="text-2xl font-bold border-b-2 mx-1" v-if="loading"> {{ title }}</p>
                    <div class="w-full flex flex-row flex-wrap my-1">
                        <div class="border bg-base-200 border-gray-400 px-1 mx-1 mt-1" v-for="category in categories">
                            {{ category.name }}
                        </div>
                    </div>
                    <p class="text-base mx-1" v-if="loading"> {{ description }}</p>
                    <div class="text-2xl font-bold border-b-2 mx-1" v-if="!loading">
                        <div class="skeleton h-8 my-1 w-full"></div>
                    </div>
                    <div class="text-base mx-1" v-if="!loading">
                        <div v-for="val in 30" class="skeleton h-4 mt-1 w-full"></div>
                    </div>
                </div>
                <div class="col-span-6 mx-1">
                    <label for="language">Select language: </label>
                    <select :id="'language-' + problemId" name="language" class="bg-gray-200 rounded-xl border-2 border-gray-400 ms-3">
                        <option v-for="language in languages" :value="language.id"> {{ language.name }}</option>
                    </select>
                    <div class="h-96">
                        <div :id="'editor' + '-' + problemId" style="width: 100%; height: 100%" class="text-base mt-3">

                        </div>
                    </div>
                    <div class="mt-3 w-full">
                        <button type="button"
                                class="rounded-xl bg-amber-300 py-1 border-gray-500 border border-amber-500 px-2 hover:bg-amber-600 w-20 h-10"
                                @click="compile">
                            <span v-if="!isCompiling">RUN</span>
                            <span v-if="isCompiling" class="loading loading-dots loading-xs"></span>
                        </button>
                        <button :id="'submit-btn-' + problemId" type="button"
                                class="rounded-xl bg-green-500 py-1 border-green-300 border px-2 ms-1 hover:bg-green-600 w-20 h-10 disabled:bg-gray-300 disabled:border-gray-400 disabled:text-gray-400"
                                disabled
                                @click="submit">
                            <span v-if="!isSubmitting">SUBMIT</span>
                            <span v-if="isSubmitting" class="loading loading-dots loading-xs"></span>
                        </button>
                        <div class="mt-3 transition" :class="{ 'hidden' : !isCompileError }">
                            <div class="alert alert-error">
                                <span :id="'error-msg-' + problemId">x</span>
                            </div>
                        </div>
                        <div class="mt-3" v-if="isPassed && contestId === null">
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
                            <div v-for="val in 3" class="skeleton h-28 my-1 w-full"></div>
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
