<template>
    <a class="w-full" :href="'/problem/' + problem.id">
        <div class="grid grid-cols-5 mx-3 my-1 p-1 border-gray-300 border rounded-md h-9 bg-sky-100">
            <div class="ms-3 text-green-700 truncate ..."><i class="fa-regular fa-hourglass"></i></div>
            <div class="truncate ...">{{ problem.title }}</div>
            <div class="truncate ...">{{ problem.difficulty }}</div>
            <div class="truncate ...">{{ problem.acceptance_rate }}</div>
            <div class="truncate ...">Type</div>
        </div>
    </a>
</template>


<script>

export default {
    name: "Problem",
    props: {
        problem: {
            Type: Object
        }
    }
}
</script>
