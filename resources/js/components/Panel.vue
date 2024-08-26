<script>
export default {
    name: "Panel",
    methods: {
        compile() {
            var editor = ace.edit('editor')
            axios.post('/compile', {
                _token: document.querySelector('meta[name="csrf-token"]').content,
                code: editor.getSession().getValue(),
                input: document.getElementById('input').value,
                language: document.getElementById('language').value
            }).then(function (response) {
                var output = document.getElementById('output')
                output.value = response.data.output;
            }).catch(function (error) {
                alert('what the fuck')
            })
        },
        onload() {
            var editor = ace.edit('editor')
            editor.setTheme('ace/theme/monokai')
            editor.session.setMode('ace/mode/c_cpp')
        }
    },
    mounted() {
        this.onload()
    }
}
</script>

<template>
    <div class="w-full mt-2">

    </div>
    <div class="w-full mt-2">
        <form id="formCode" method="post" action="/compile">
            <div class="grid grid-cols-12">
                <div class="col-span-6 me-1 border-e-2">
                    <p class="text-2xl font-bold border-b-2">Example Problem</p>
                    <p class="text-base">Đừng làm anh lóng??!
                        Viết chương trình nhập vào 2 số a, b. In ra tổng của a và b.</p>
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
                            #include &ltiostream&gt
                        </div>
                    </div>
                    <div class="mt-3 w-full">
                        <button type="button" class="rounded-xl bg-amber-300 py-1 border-gray-600 border-2 px-2"
                                @click="compile">RUN
                        </button>
                    </div>
                    <p class="mt-3 w-full">Input</p>
                    <div class="h-20">
                        <textarea id="input" name="input" class="h-full w-full my-3 rounded border-gray-400 bg-gray-100">9 16</textarea>
                    </div>
                    <p class="mt-3 w-full">Output</p>
                    <div class="h-48">
                        <textarea id="output" class="h-full w-full my-3 rounded border-gray-400 bg-gray-100"
                                  readonly></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="w-full mt-2 h-12">

    </div>
</template>

<style scoped>

</style>
