<script>
export default {
    name: 'CvItem',
}
</script>

<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>1</td>
        <td>Cy Ganderton</td>
        <td>Quality Control Specialist</td>
        <td>
                <div class="grid grid-cols-1 lg:grid-cols-4">
                    <span class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300"> <i class="fa-regular fa-eye"></i></span>
                    <span class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300"> <i class="fa-regular fa-pen-to-square"></i></span>
                    <span class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300"> <i class="fa-solid fa-cloud-arrow-down"></i></span>
                    <span class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300"> <i class="fa-solid fa-trash"></i></span>
                </div>
        </td>
    </tr>
</template>
