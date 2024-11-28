<template>
    <div class="p-2">
        <div class="flex justify-center">
            <img :src="this.participant.avatar_url" alt="Profile Picture"
                class="w-24 h-24 rounded-full border-2 border-gray-300">
        </div>
        <h2 class="flex justify-center mt-3">{{ this.participant.name }}</h2>
        <p class="col-span-full font-semibold text-lg border-b my-2">Statistics</p>
        <p class="my-2">Problems solved by topics</p>
        <div class="flex">
            <canvas class="mx-auto" id="languageStatsChart"></canvas>
        </div>
        <div class="w-full border-b"></div>
            <p class="my-2">Problems solved by topics</p>
            <div class="flex">
                <canvas class="mx-auto" id="categoryStatsChart"></canvas>
            </div>
    </div>
</template>
<script>
export default {
    name: "Profile",
    props: {
        participant: {},
    },

}
</script>
<style></style>