<template>
    <a class="w-full" href="#">
        <div class="grid grid-cols-5 mx-3 my-1 p-1 border-gray-300 border rounded-md h-9 bg-sky-100">
            <div>STATUS</div>
            <div>{{ problem.title }}</div>
            <div>{{ problem.difficulty }}</div>
            <div>{{ problem.acceptance_rate }}</div>
            <div>Type</div>
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
