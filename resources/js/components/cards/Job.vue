<script>
export default {
    name: "Job",
    props: {
        title: {
            default: 'N/A'
        },
        imgUrl: {
            default: 'N/A'
        },
        companyName: {
            default: 'N/A'
        },
        url: {
            default: 'N/A'
        },
        date: {
            type: Object,
            default: new Date().toDateString()
        },
        salary:{
            type: String,
            default: 'N/A'       
        }
    }
}
</script>

<template>
    <router-link :to="`${url}`">
        <div class="border rounded-xl h-52 w-auto my-2 mx-3 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition">
            <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
            <h1 class="text-xl font-semibold">{{ title }}</h1>
            <p class="font-semibold">{{ companyName }}</p>
            <p class="font-semibold text-green-400">{{ salary === 0 ? 'Negotiable' : salary + ' $' }}</p>
            <p class="font-semibold">Available until: {{ date }}</p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
