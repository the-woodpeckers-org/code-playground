<template>
    <div class="w-full mt-2">
        <ProblemSkeleton v-if="!loading" v-for="index in 16" :key="index"></ProblemSkeleton>
        <Problem v-if="loading" v-for="problem in this.problems" :problem="problem"></Problem>
    </div>
</template>

<script>
import Problem from "@/components/Problem.vue";
import CenteredSpinner from "@/components/loading/CenteredSpinner.vue";
import ProblemSkeleton from "@/components/loading/ProblemSkeleton.vue";

export default {
    name: "ProblemList",
    components: {ProblemSkeleton, CenteredSpinner, Problem},
    data: function () {
        return {
            problems: Array,
            loading: false
        }
    },
    async created() {
        let _this = this
        setTimeout(async () => {
            await axios.get('/getProblems')
                .then(function (response) {
                    _this.problems = response.data.data
                    _this.loading = true
                    console.log(_this.problems)
                })
                .catch(function (error) {
                    alert(error)
                })
        }, 1500)

    }
}
</script>
