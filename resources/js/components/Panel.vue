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
                        <button type="button" class="rounded-xl bg-amber-300 py-1 border-gray-600 border-2 px-2"
                                @click="compile">RUN
                        </button>
                    </div>
                    <div class="mt-3 w-full">
                        Testcases passed: <span id="testcases-passed" class="font-bold">0/{{ testcases.length }}</span>
                    </div>
                    <div class="mt-3 w-full h-80 overflow-auto">
                        <Testcase :key="index + 1" :ref="'testcase-' + (index + 1)" v-for="(testcase, index) in testcases" :stdin="testcase.stdin" :result="testcase.result" :index="index + 1" :run="run">
                        </Testcase>
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

export default {
    name: "Panel",
    components: {Testcase},
    props: {
        problem_id: String,
    },
    data: function() {
        return {
            description: String,
            title: String,
            testcases: Array,
            loading: false,
            run: false,
        }
    },
    methods: {
        compile() {
            let _this = this
            var editor = ace.edit('editor')
            axios.post('/compile', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                language: document.getElementById('language').value
            }).then(function (response) {
                _this.run = true
                if (response.data.succeed == false) {
                    alert('Lỗi!')
                } else {
                    let passedTestcases = 0
                    for (let i = 0; i < response.data.output.length; ++i) {
                        document.getElementById('box-actual-input-' + (i + 1)).classList.remove('hidden')
                        document.getElementById('box-status-' + (i + 1)).classList.remove('hidden')
                        let currExpected = document.getElementById('expected-output-' + (i + 1))
                        let item = document.getElementById('actual-input-' + (i + 1))
                        let status = document.getElementById('status-' + (i + 1))
                        item.innerHTML = response.data.output[i]
                        if (item.innerHTML == currExpected.innerHTML) {
                            ++passedTestcases
                            status.classList.remove('text-red-400')
                            status.classList.add('text-green-400')
                            status.innerHTML = 'Passed'
                        }
                        else {
                            status.classList.remove('text-green-400')
                            status.classList.add('text-red-400')
                            status.innerHTML = 'Failed'
                        }
                    }
                    let spanPassedTestcases = document.getElementById('testcases-passed')
                    spanPassedTestcases.innerHTML = passedTestcases + '/' + _this.testcases.length
                }
            }).catch(function (error) {
                console.log(error)
                alert(error)
            })
        },
        onload() {
            let _this = this
            var editor = ace.edit('editor')
            editor.setTheme('ace/theme/monokai')
            editor.session.setMode('ace/mode/c_cpp')
            axios.get('/getProblem/' + _this.problem_id)
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
