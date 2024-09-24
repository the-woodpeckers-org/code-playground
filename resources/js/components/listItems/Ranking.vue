<script>
export default {
    name: "Ranking"
}
</script>

<template>
    <div>
        <div style="min-height: 520px">
            <h1 class="text-xl font-semibold">Top 10 last week!</h1>
            <div class="overflow-x-auto text-lg">
                <table class="table table-sm border-gray-600">
                    <thead>
                    <tr class="text-sm">
                        <th></th>
                        <th>User</th>
                        <th>Problem solved</th>
                        <th>Acceptance</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in 10" class="">
                        <td>
                            <div class="flex items-center gap-3">
                                <img class="h-7 w-7 rounded-full"
                                     src="https://upload.wikimedia.org/wikipedia/en/e/e9/Where%27s_My_Perry_icon.jpg">
                            </div>

                        </td>
                        <td>sample</td>
                        <td>419</td>
                        <td>99.1%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p class="text-center mt-2">
            <router-link to=""
                         class="p-2 bg-primary hover:bg-cyan-700 transition text-white rounded-3xl">See the full list
            </router-link>
        </p>
    </div>
</template>

<style scoped>

</style>
