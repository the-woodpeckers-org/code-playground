<template>
    <div class="grid grid-cols-4 my-0.5 p-1 border-gray-300 border rounded-md h-9 bg-base-100 font-semibold">
        <div class="ms-1 text-green-700">
            <div v-if="!auth">
                <div class="tooltip tooltip-right"
                     data-tip="Please login to see the status of this problem!">
                    <button><i v-if="!problem.passed_at" class="fa-solid fa-asterisk"></i></button>
                </div>
            </div>
            <div v-if="auth">
                <div class="tooltip tooltip-right"
                     data-tip="You haven't solved this problem yet!">
                    <button><i v-if="!problem.passed_at" class="fa-regular fa-hourglass"></i></button>
                </div>
                <div class="tooltip tooltip-right"
                     data-tip="You have solved this problem!">
                    <button><i v-if="problem.passed_at" class="fa-regular fa-circle-check"></i></button>
                </div>
            </div>

        </div>
        <div class="col-span-2 cursor-pointer truncate ..." @click="goTo">{{ problem.title }}</div>
        <div class="truncate ..."><span
            :class="{ 'text-green-600': problem.difficulty === 'Easy', 'text-yellow-600':problem.difficulty === 'Medium','text-red-600': problem.difficulty === 'Hard'}">{{
                problem.difficulty
            }}</span></div>
    </div>
</template>


<script>

import {getAuth} from "@/utils/authLocalStorage.js";

export default {
    name: "Problem",
    data: () => {
        return {
            auth: getAuth()
        }
    },
    props: {
        problem: {
            Type: Object
        }
    },
    methods: {
        goTo() {
            this.$router.push('/problem/' + this.problem.id)
        }
    }
}
</script>
