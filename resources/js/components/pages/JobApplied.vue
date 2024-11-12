<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue'
export default {

    components: {
        NavigatorCV
    }

}
</script>
<template lang="">
    <div>
        <NavigatorCV></NavigatorCV>
        <div class="mt-6 border-b"></div>
    <div class="container h-4 mt-6">
        <h4 class ="text-sm md:text-md lg:text-xl text-primary">Jobs Applied</h4>
    </div>
    <div class="mt-20 sm:mt-20 md:mt-20 lg:clear-both"></div>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Applied at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Software Engineer</td>
                    <td>Google</td>
                    <td>California</td>
                    <td>2021-10-10</td>
                    <td>
                        <button class="btn btn-neutral m-2">View</button>
                        <button class="btn btn-primary m-2">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>
<style lang="">
    
</style>