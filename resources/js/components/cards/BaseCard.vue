<script>
export default {
    name: "BaseCard",
    props: {
        title: 'N/A',
        author: 'N/A',
        imgUrl: 'N/A'
    }
}
</script>

<template>
    <router-link to="#">
        <div
            class="flex gap-3 bg-base-100 border border-gray-300 rounded-xl overflow-hidden items-center justify-start my-2 hover:scale-105 hover:bg-base-200 transition">
            <div class="relative w-32 h-32 flex-shrink-0">
                <img class="absolute left-0 top-0 w-full h-full object-cover object-center transition duration-50"
                     loading="lazy" :src="imgUrl">
            </div>
            <div class="w-full">
                <p class="text-lg font-semibold">{{ title }}</p>
                <p class="text-end pe-3">- <span v-html="author"></span></p>
            </div>
        </div>
    </router-link>
</template>

<style scoped>

</style>
