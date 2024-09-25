<script>
export default {
    name: "Course",
    props: {
        title: 'N/A',
        imgUrl: 'N/A',
        description: 'N/A'
    }
}
</script>

<template>
    <router-link class="card bg-base-100 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition" to="">
        <figure class="h-40">
            <img
                :src="imgUrl" loading="lazy"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ title }}</h2>
            <p>{{ description }}</p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
