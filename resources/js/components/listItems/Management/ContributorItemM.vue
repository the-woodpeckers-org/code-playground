<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>{{ user }}</td>
        <td>{{ email }}</td>
        <td>{{ phone }}</td>
        <td>{{ status }}</td>
        <td @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
    </tr>
    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li @click="$emit('reject', id)" class="px-4 py-2 hover:bg-red-100 cursor-pointer">reject</li>
                <li @click="$emit('approved', id)" class="px-4 py-2 hover:bg-green-100 cursor-pointer">approved</li>
            </ul>
        </td>
    </tr>
</template>

<script>
export default {
    data() {
        return {
            showOptions: false,
        };
    },
    name: "ContributorItemM",
    props: {
        id: String,
        user: String,
        email: String,
        phone: String,
        status:String,
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
    },
};
</script>

<style></style>
