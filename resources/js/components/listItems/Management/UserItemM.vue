<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>{{ user }}</td>
        <td>{{ email }}</td>
        <td>{{ phone }}</td>
        <td>{{ role }}</td>
        <td @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
    </tr>
    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li @click="$emit('remove', id)" class="px-4 py-2 hover:bg-red-100 cursor-pointer">Remove</li>
                <li @click="$emit('edit', id)" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Edit</li>
            </ul>
        </td>
    </tr>
</template>

<script>
export default {
    emits: ['remove', 'edit'],
    data() {
        return {
            showOptions: false,
        };
    },
    name: "UserItemM",
    props: {
        id: String,
        user: String,
        email: String,
        phone: String,
        role: String,
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
    },
};
</script>

<style></style>
