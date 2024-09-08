<template>
    <div class="w-full mt-2">

    </div>
    <div class="w-full mt-2">
        <form id="formCode" method="post" action="/compile">
            <div class="grid grid-cols-12">
                <div class="col-span-6 me-1 border-e-2">
                    <p class="text-2xl font-bold border-b-2"> {{ title }}</p>
                    <p class="text-base"> {{ description }}</p>
                </div>
                <div class="col-span-6 mx-1">
                    <label for="language">Select language: </label>
                    <select id="language" name="language" class="bg-gray-200 rounded-xl border-2 border-gray-400 ms-3">
                        <option value="cpp">C++</option>
                        <option value="c">C</option>
                        <option value="python">Python</option>
                        <option value="php">PHP</option>
                        <option value="javascript">JavaScript</option>
                    </select>
                    <div class="h-96">
                        <div id="editor" style="width: 100%; height: 100%" class="text-base mt-3">

                        </div>
                    </div>
                    <div class="mt-3 w-full">
                        <button type="button" class="rounded-xl bg-amber-300 py-1 border-gray-500 border px-2 hover:bg-amber-600"
                                @click="compile">RUN
                        </button>
                        <button id="submit-btn" type="button" class="rounded-xl bg-green-500 py-1 border-green-300 border px-2 ms-1 hover:bg-green-600 disabled:bg-gray-300 disabled:border-gray-400 disabled:text-gray-400" disabled>
                                SUBMIT
                        </button>
                    </div>
                    <div class="mt-3 w-full">
                        Testcases passed: <span id="testcases-passed" class="font-bold">{{ passedTestcases }}/{{ testcases.length }}</span>
                    </div>
                    <div class="mt-3 w-full h-80 overflow-auto">
                        <TestcaseList v-if="!run" :data="testcases"></TestcaseList>
                        <TestcaseList v-if="run" :data="runData"></TestcaseList>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="w-full mt-2 h-12">

    </div>
</template>

<script>
import Testcase from "@/components/Testcase.vue";
import TestcaseList from "@/components/TestcaseList.vue";

export default {
    name: "Panel",
    components: {TestcaseList, Testcase},
    data: function() {
        return {
            passedTestcases: String,
            description: String,
            title: String,
            testcases: Array,
            runData: Array,
            loading: false,
            run: false,
        }
    },
    methods: {
        compile() {
            let _this = this
            let editor = ace.edit('editor')
            axios.post('/compile', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                language: document.getElementById('language').value
            }).then(function (response) {
                console.log(response.data)
                _this.run = true
                _this.runData = response.data.output
                _this.passedTestcases = response.data.passedTestcases
                if (response.data.succeed == false) {
                    alert('Lỗi!')
                } else {
                    if (_this.passedTestcases === _this.testcases.length) {
                        document.getElementById('submit-btn').disabled = false
                    } else {
                        document.getElementById('submit-btn').disabled = true
                    }
                }
            }).catch(function (error) {
                console.log(error)
                alert(error)
            })
        },
        onload() {
            let _this = this
            _this.passedTestcases = 0
            let editor = ace.edit('editor')
            editor.setTheme('ace/theme/monokai')
            editor.session.setMode('ace/mode/c_cpp')
            axios.get('/api/getProblem/' + _this.$route.params.id)
                .then(function (response) {
                    _this.description = response.data.description
                    _this.title = response.data.title
                    _this.testcases = response.data.testcases
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
