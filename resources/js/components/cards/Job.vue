<script>
export default {
    name: "Job",
    props: {
        title: 'N/A',
        description: 'N/A',
        imgUrl: 'N/A',
        companyName: 'N/A',
        url: 'N/A',
    }
}
</script>

<template>
    <router-link :to="url">
        <div class="border rounded-xl h-52 w-96 my-2 mx-3 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition">
            <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
            <h1 class="text-xl font-semibold">{{ title }}</h1>
            <p class="font-semibold">{{ companyName }}</p>
            <p>{{ description }}</p>
            <p class="font-semibold">Available until: 10/10/2024</p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
