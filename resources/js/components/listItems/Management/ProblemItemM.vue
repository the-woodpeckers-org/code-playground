<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b m-auto border-gray-500">
        <td>{{ problem.title }}</td>
        <td>{{ problem.difficulty }}</td>
        <td>{{ problem.created_by.name }}</td>
        <td> <a @click="showDetailModal"
                class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                <i class="fa-regular fa-eye"></i>
            </a></td>
        <td>{{ problem.status }}</td>
        <td @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
    </tr>
    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li @click="$emit('reject', id)" class="px-4 py-2 hover:bg-red-100 cursor-pointer">reject</li>
                <li @click="$emit('approved', id)" class="px-4 py-2 hover:bg-green-100 cursor-pointer">approved</li>
                <li @click="request_change_ShowModal" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Request
                    change</li>
            </ul>
        </td>
    </tr>
</template>

<script>
export default {
    name: "CompanyItemM",
    props: {
        problem: {},
    },
    data() {
        return {
            showOptions: false,
        };
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
    },
}
</script>
<style></style>