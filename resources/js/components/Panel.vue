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
                                @click="compute">RUN
                        </button>
                    </div>
                    <div class="mt-3 w-full h-80 overflow-auto">
                        <Testcase v-for="(testcase, index) in testcases" :stdin="testcase.stdin" :index="index + 1" :ckey="ckey">
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
            ckey: String
        }
    },
    methods: {
        compute() {
            let _this = this
            _this.ckey = Math.random().toString(36).slice(2, 7);
        },
        compile() {
            var editor = ace.edit('editor')
            axios.post('/compile', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                input: document.getElementById('input').value,
                language: document.getElementById('language').value
            }).then(function (response) {
                var output = document.getElementById('actual_output')
                output.value = response.data.output;

                var e_output = document.getElementById('e_output')
                var a_output = document.getElementById('actual_output')

                if (e_output.value.trim() !== a_output.value.trim()) {
                    a_output.classList.remove('text-red-600')
                    a_output.classList.remove('bg-red-200')
                    a_output.classList.remove('text-green-600')
                    a_output.classList.remove('bg-green-200')
                    a_output.classList.add('text-red-600')
                    a_output.classList.add('bg-red-200')
                } else {
                    a_output.classList.remove('text-red-600')
                    a_output.classList.remove('bg-red-200')
                    a_output.classList.remove('text-green-600')
                    a_output.classList.remove('bg-green-200')
                    a_output.classList.add('text-green-600')
                    a_output.classList.add('bg-green-200')
                }
            }).catch(function (error) {
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
                    _this.ckey = '3'
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
