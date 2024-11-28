<script>
import Multiselect from 'vue-multiselect';

export default {
    name: "CreateContest",
    components: {
        Multiselect
    },
    data: () => {
        return {
            // Component attributes
            isCreating: false,
            isEditing: false,
            editingId: -1,
            rte: null,
            editor: null,
            // Contest attributes
            title: '',
            description: '',
            start_date: '28/11/2024 05:00 AM',
            end_date: '28/11/2024 05:00 AM',
            tags: '',
            imgUrl: '',
            // Contest problems
            problems: [
                {}
            ],
            // Contest status
        }
    },
    mounted() {

    },
    methods: {
        // refs calling
        showCreate() {
            this.resetData();
            this.isEditing = false;
            this.isCreating = true;
        },
        // refs calling
        showEdit(id) {
            this.resetData();
            this.isCreating = false;
            this.isEditing = true;
            this.editingId = id;
            this.getContestData();
        },
        closeCreate() {
            this.isCreating = false;
        },
        closeEdit() {
            this.isEditing = false;
            this.editingId = -1;
        },
        getContestData() {

        },
        createContest() {

        },
        updateContest() {

        },
        resetData() {
            this.title = '';
            this.description = '';
            this.start_date = '28-11-2024';
            this.end_date = '28-11-2024';
            this.tags = '';
            this.imgUrl = '';
            this.problems = [
                {}
            ];
        }
    }
}
</script>

<template>
    <dialog v-if="isCreating" class="modal" :class="{'modal-open': isCreating}">
        <div class="modal-box w-11/12 max-w-7xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new contest</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input v-model="title" class="rounded-lg border border-gray-400 h-10 w-full px-3">
                </div>
                <div>
                    <label>Tags</label>
                    <Multiselect v-model="tags"
                                 :options="['Hackathon', 'Speed', 'Cyanide', 'Aspire', 'HiTec', 'CodeForce']"
                                 :multiple="true" class="h-8 w-full"></Multiselect>
                </div>
                <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="description"
                              class="rounded-lg border border-gray-400 w-full h-40 px-3"></textarea>
                </div>
                <div>
                    <label>Start date</label>
                    <input v-model="start_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                    <label class="mt-3">End date</label>
                    <input v-model="end_date" type="datetime-local"
                           class="rounded-lg border border-gray-400 h-8 w-full">
                </div>
                <div class="col-span-full">
                    <div class="divider"></div>
                    <p class="font-semibold text-lg">Problems</p>
                </div>
                <div class="col-span-full">

                </div>
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="closeCreate()">
                        Create
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeCreate()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <dialog v-if="isEditing" class="modal" :class="{'modal-open': isEditing}">
        <div class="modal-box w-11/12 max-w-7xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new contest</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <label>Title</label>
                    <input v-model="title" class="rounded-lg border border-gray-400 h-10 w-full px-3">
                </div>
                <div>
                    <label>Tags</label>
                    <Multiselect v-model="tags" :options="['Hackathon', 'Speed', 'Holy fuck']" :multiple="true"
                                 class="h-8 w-full"></Multiselect>
                </div>
                <div class="col-span-full">
                    <label>Description</label>
                    <textarea v-model="description"
                              class="rounded-lg border border-gray-400 w-full h-40 px-3"></textarea>
                </div>
                <div>
                    <label>Start date</label>
                    <input type="datetime-local" class="rounded-lg border border-gray-400 h-8 w-full">
                    <label class="mt-3">End date</label>
                    <input type="datetime-local" class="rounded-lg border border-gray-400 h-8 w-full">
                </div>
            </div>
            <div class="w-full modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="closeEdit()">
                        Create
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg" @click="closeEdit()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </dialog>
</template>

<style scoped>

</style>
