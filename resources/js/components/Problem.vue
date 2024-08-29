<template>
    <a class="w-full" href="#">
        <div class="grid grid-cols-5 border-gray-600 rounded-xl">
            <div>{{ problem.status }}</div>
            <div>{{ problem.title }}</div>
            <div>{{ problem.difficulty }}</div>
            <div>{{ problem.acceptance_rate }}</div>
            <div> Type </div>
        </div>
    </a>
</template>

<script setup>
const props = defineProps({
    problem: {
        type: Object
    }
})
</script>
