<script>
export default {
    name: "ProblemSkeleton"
}
</script>

<template>
    <a class="w-full" href="#">
        <div class="grid grid-cols-5 mx-3 my-1 p-1 border-gray-300 border rounded-md h-9">
            <div class="h-4 bg-gray-400 rounded-full mx-1 animate-pulse m-auto"></div>
            <div class="h-4 bg-gray-400 rounded-full mx-1 animate-pulse m-auto"></div>
            <div class="h-4 bg-gray-400 rounded-full mx-1 animate-pulse m-auto"></div>
            <div class="h-4 bg-gray-400 rounded-full mx-1 animate-pulse m-auto"></div>
            <div class="h-4 bg-gray-400 rounded-full mx-1 animate-pulse m-auto"></div>
            <span class="sr-only">Loading...</span>
        </div>
    </a>
    <div role="status" class="max-w-sm ">


    </div>
</template>

<style scoped>

</style>
