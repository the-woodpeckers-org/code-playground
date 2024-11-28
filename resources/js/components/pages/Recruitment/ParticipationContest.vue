<template>
    <div>
        <router-link :to="'/Contest-managent'"> <button class="underline text-gray-500 mb-5 text-md text-xl">Back to management</button></router-link>
        <div>
            <h2 class="font-semibold text-md text-2xl">List of contest participants</h2>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                <div class="col-span-8 bg-base-100 " style="min-height: 300px;">

                </div>
                <div class="col-span-4 bg-base-100 " style="min-height: 300px;">

                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    name: "ParticipationContest",
}
</script>
<style></style>