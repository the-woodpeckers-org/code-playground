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
    <dialog class="modal" ref="confirmDialog">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want delete it?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500"
                    @click="$emit('remove', id)" >Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>

    <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <button @click="showModalConfirm" class="btn px-4 py-2 hover:bg-red-100 cursor-pointer">Remove</button>
            </ul>
        </td>
    </tr>

</template>

<script>
export default {
    emits: ['remove'],
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
        showModalConfirm() {
            this.$refs.confirmDialog.showModal();
        },
    },
};
</script>

<style></style>
