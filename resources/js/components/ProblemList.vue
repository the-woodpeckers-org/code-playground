<template>
<div class="w-full mt-2">
    <Problem v-for="problem in problems" :data="problem"></Problem>
</div>
</template>

<script setup>
    import Problem from "@/components/Problem.vue";

    const props = defineProps({
        problems: {
            type: Array
        }
    })
</script>
