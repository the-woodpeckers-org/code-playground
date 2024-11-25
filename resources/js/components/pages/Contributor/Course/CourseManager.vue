<script>
export default {
    name: "CourseManager",
    data: () => {
        return {
            courses: []
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {

        }
    }
}
</script>

<template>
    <div class="w-full">
        <p class="text-center font-bold text-2xl">Course management</p>
        <p class="text-lg">Your contests on The CodePlayground</p>
        <div class="w-full">
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-xl">
            <table class="table table-lg">
                <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Total participation</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover" v-for="course in courses">
                    <th></th>
                    <td>{{ course.title }}</td>
                    <td>{{ course }}</td>
                    <td></td>
                    <td>
                        <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="showEdit(problem.id)">Edit</button>
                        <button class="bg-red-300 px-3 py-1 mx-1 hover:bg-red-500 rounded-lg"
                                @click="showConfirmDelete(problem.id, problem.title)">Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex">
                <div class="join mx-auto my-3">
                    <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                            :class="{ 'btn-active' : link.label == currentPage}" @click="getProblems(link.label)"><span
                        v-html="link.label"></span></button>
                </div>
            </div>
        </div>
    </div>
    <dialog id="modal_delete" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Warning!</h3>
            <p class="pt-4 pb-2">Are you sure you want to delete this problem?</p>
            <p class="pt-2 pb-4"> {{ deletingTitle }}</p>
            <div class="w-full text-end">
                <button class="px-3 py-1 bg-blue-300 hover:bg-blue-500 rounded-lg mx-1" @click="confirmDelete">Yes
                </button>
                <button class="px-3 py-1 bg-yellow-300 hover:bg-yellow-500 rounded-lg mx-1" @click="confirmNo">No
                </button>
            </div>
        </div>
    </dialog>
    <Toast v-if="isDeletedSomeRecord" :toastData="{type: 'success', message: 'Delete problem successfully'}"></Toast>
</template>

<style scoped>

</style>
