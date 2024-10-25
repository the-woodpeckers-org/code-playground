<script>
export default {
    name: 'CvItem',
    props: {
        updated: String,
        id: Number,
        title: String,
        isPrimary: Boolean,
    }
}
</script>

<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>{{ title }}</td>
        <td>{{ isPrimary }}</td>
        <td>{{ updated }}</td>
        <td>
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <button :id="`view-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-regular fa-eye"></i>
                </button>
                <button :id="`edit-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
                <button :id="`download-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </button>
                <button :id="`delete-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </td>
    </tr>
</template>
