<script>
export default {
    name: "JobM",
    props: {
        title: {
            default: 'N/A'
        },
        description: {
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
    <router-link :to="url">
        <div class="border rounded-xl h-52 w-auto my-2 mx-3 p-3 bg-base-100 hover:scale-105 hover:bg-base-200 transition">
            <div class="flex">
                <div>
                    <img class="w-20 h-20 object-center object-contain" :src="imgUrl" loading="lazy">
                    <h1 class="text-xl font-semibold">{{ title }}</h1>
                    <p class="font-semibold">{{ companyName }}</p>
                    <p>{{ description }}</p>
                    <p class="font-semibold">Available until: {{ date }}</p>
                </div>
                <div>
                    <i class="fa-solid fa-circle-info text-md md:text-xl lg:text-2xl"></i>

                </div>
            </div>
        </div>
    </router-link>
</template>

<style scoped>

</style>
