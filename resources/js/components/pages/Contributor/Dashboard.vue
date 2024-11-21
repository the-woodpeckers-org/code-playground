<script>
export default {
    name: "Dashboard"
}
</script>
<script setup>
import {getAuth} from "@/utils/authLocalStorage.js";
import ProblemManager from "@/components/pages/Contributor/Problem/ProblemManager.vue";
import ContestManager from "@/components/pages/Contributor/Contest/ContestManager.vue";
import CourseManager from "@/components/pages/Contributor/Course/CourseManager.vue";
import PostManager from "@/components/pages/Contributor/Post/PostManager.vue";
</script>
<template>
    <div class="w-full">
        <p class="font-semibold text-2xl my-3">Hello, {{ getAuth().name }} &#128513</p>
        <div role="tablist" class="tabs tabs-lifted tabs-lg">
            <input type="radio" name="tab" role="tab" class="tab" aria-label="Problems" checked="checked"/>
            <div role="tabpanel" class="tab-content p-10">
                <ProblemManager></ProblemManager>
            </div>

            <input type="radio" name="tab" role="tab" class="tab" aria-label="Contests"/>
            <div role="tabpanel" class="tab-content p-10">
                <ContestManager></ContestManager>
            </div>

            <input type="radio" name="tab" role="tab" class="tab" aria-label="Courses"/>
            <div role="tabpanel" class="tab-content p-10">
                <CourseManager></CourseManager>
            </div>

            <input type="radio" name="tab" role="tab" class="tab" aria-label="Posts"/>
            <div role="tabpanel" class="tab-content p-10">
                <PostManager></PostManager>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
