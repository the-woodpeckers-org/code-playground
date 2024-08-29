<template>
    <div class="w-full mt-2">
        <Problem v-for="problem in this.problems" :problem="problem"></Problem>
    </div>
</template>

<script>
import Problem from "@/components/Problem.vue";

export default {
    name: "ProblemList",
    components: {Problem},
    data: function () {
        return {
            problems: Array,
            loading: false
        }
    },
    async created() {
        let _this = this
        await axios.get('/getProblems')
            .then(function (response) {
                _this.problems = response.data.data
                console.log(_this.problems)
            })
            .catch(function (error) {
                alert(error)
            })}
    }
</script>
