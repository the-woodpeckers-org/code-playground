<script>
import ContestCodePanel from "@/components/pages/ContestCodePanel.vue";

export default {
    name: "ContestProblemTab",
    components: {ContestCodePanel},
    props: {
        name: {
            type: String,
            default: 'code-tabs'
        },
        tabName: {
            type: String,
            default: 'tabName'
        },
        index: {
            type: Number,
            default: 0
        },
        contestId: {
            type: String,
            default: '0'
        },
        problemId: {
            type: String,
            default: '0'
        }
    },
    data: function() {

    },
}
</script>

<template>
    <input v-if="index === 0" type="radio" :name="name" role="tab" class="tab font-semibold" :aria-label="tabName + ' ' + (index + 1)" checked/>
    <input v-if="index !== 0" type="radio" :name="name" role="tab" class="tab font-semibold" :aria-label="tabName + ' ' + (index + 1)"/>
    <div role="tabpanel" class="tab-content">
        <ContestCodePanel :contestId="contestId" :problemId="problemId"></ContestCodePanel>
    </div>
</template>

<style scoped>

</style>
