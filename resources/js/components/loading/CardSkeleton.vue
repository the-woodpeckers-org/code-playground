<script>
export default {
    name: "CardSkeleton"
}
</script>

<template>
    <router-link class="card bg-base-100 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition" to="#">
        <figure class="h-40 skeleton">
        </figure>
        <div class="card-body">
            <h2 class="card-title w-full skeleton h-8"></h2>
            <p class="text-center w-full skeleton h-6">
            </p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
