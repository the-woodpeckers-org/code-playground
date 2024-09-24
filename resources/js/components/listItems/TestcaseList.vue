<script>
import Testcase from "@/components/Testcase.vue";

export default {
    name: "TestcaseList",
    components: {Testcase},
    props: {
        data: {
            type: Array
        }
    }
}
</script>

<template>
<Testcase v-for="(item, index) in data" :data="item" :index="index + 1">
</Testcase>
</template>

<style scoped>

</style>
