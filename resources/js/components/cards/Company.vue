<script>
export default {
    name: "Company",
    props: {
        title: 'N/A',
        description: 'N/A',
        imgUrl: 'N/A',
        url: 'N/A',
        slot: Number
    }
}
</script>

<template>
    <router-link :to="url">
        <div class="border rounded-xl h-52 w-96 my-2 mx-3 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition">
            <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
            <h1 class="text-xl font-semibold">{{ title }}</h1>
            <p class="text-ellipsis line-clamp-1" v-html="description"></p>
            <p class="font-semibold">Is hiring: <span class="text-red-600">{{ slot }}</span> positions</p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
