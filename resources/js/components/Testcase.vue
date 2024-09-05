<template>
<div class="w-full border-b mt-3" :id="index">
    <div class="font-bold">
        Testcase #{{index}}
    </div>
    <div class="">
        Input: <span :id="'input-' + index">{{stdin}}</span>
    </div>
    <div class="">
        Expected output: <span :id="'expected-output-' + index">{{result}}</span>
    </div>
    <div class="hidden" :id="'box-actual-input-' + index">
        Actual Output: <span :id="'actual-input-' + index" class="font-bold"></span>
    </div>
    <div class="hidden" :id="'box-status-' + index">
        Status: <span :id="'status-' + index" class="font-bold"></span>
    </div>
</div>
</template>

<script>
export default {
    name: "Testcase",
    props: {
        id: String,
        stdin: String,
        result: String,
        actual: String,
        index: Number,
        run: Boolean
    }
}
</script>
