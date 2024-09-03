<template>
<div class="w-full border-b mt-3">
    <div class="font-bold">
        Testcase #{{index}}
    </div>
    <div class="">
        Input: <span>{{ckey}}</span>
    </div>
    <div class="">
        Expected output: <span>{{result}}</span>
    </div>
    <div class="">
        Actual Output: <span>{{actual}}</span>
    </div>
    <div>
        Status: <span>PASSED</span>
    </div>
</div>
</template>

<script>
export default {
    name: "Testcase",
    props: {
        ckey: String,
        id: String,
        stdin: String,
        result: String,
        actual: String,
        index: Number
    }
}
</script>
