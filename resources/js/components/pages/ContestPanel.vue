<script>
import CodePanel from "@/components/pages/CodePanel.vue";
import Countdown from "@/components/countdowns/Countdown.vue";
import BaseCountDown from "@/components/countdowns/BaseCountDown.vue";

export default {
    name: "ContestPanel",
    components: {BaseCountDown, Countdown, CodePanel},
    props: {
        title: {
            default: 'N/A'
        },
        problemIndex: {
            default: 0
        },
        totalProblem: {
            default: 0
        },
        timeRemaining: {
            default: 60
        }
    }
}
</script>

<template>
<div>
    <div>
        <p> {{ title }}</p>
        <p>Problem {{problemIndex}} / {{totalProblem}}</p>
        <p>Time remaining: <BaseCountDown></BaseCountDown></p>
    </div>
    <CodePanel :contestId="this.$route.params.c_id"></CodePanel>
</div>
</template>

<style scoped>

</style>
