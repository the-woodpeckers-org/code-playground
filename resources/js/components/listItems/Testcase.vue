<template>
<div class="w-full border-b mt-3" :id="index">
    <div class="font-bold">
        Testcase #{{index}}
    </div>
    <div class="">
        Input: <span>{{data.stdin}}</span>
    </div>
    <div class="">
        Expected output: <span>{{data.expected_output}}</span>
    </div>
    <div :id="'box-actual-output-' + index" v-if="data.actual_output">
        Actual Output: <span class="font-bold">{{data.actual_output}}</span>
    </div>
    <div v-if="data.execution_time">
        Execution time: <span>{{data.execution_time}} ms</span>
    </div>
    <div v-if="data.is_passed !== undefined">
        Status: <span v-if="data.is_passed === true" class="font-bold text-green-600">Passed</span>
        <span v-if="data.is_passed === false" class="font-bold text-red-600">Failed</span>
    </div>

</div>
</template>

<script>
export default {
    name: "Testcase",
    props: {
        id: String,
        index: String,
        data: {
            type: Object
        }
    }
}
</script>
