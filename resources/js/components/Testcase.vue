<template>
<div class="w-full border-b mt-3" :id="index">
    <div class="font-bold">
        Testcase #{{index}}
    </div>
    <div class="">
        Input: <span :id="'input-' + index">{{data.stdin}}</span>
    </div>
    <div class="">
        Expected output: <span :id="'expected-output-' + index">{{data.expected_output}}</span>
    </div>
    <div :id="'box-actual-output-' + index" v-if="data.actual_output">
        Actual Output: <span :id="'actual-output-' + index" class="font-bold">{{data.actual_output}}</span>
    </div>
    <div v-if="data.execution_time">
        Execution time: <span>{{data.execution_time}} ms</span>
    </div>
    <div :id="'box-status-' + index" v-if="data.is_passed !== undefined">
        Status: <span v-if="data.is_passed === true" :id="'status-' + index" class="font-bold text-green-600">Passed</span>
        <span v-if="data.is_passed === false" :id="'status-' + index" class="font-bold text-red-600">Failed</span>
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
