<script>
import { format } from 'date-fns';
import { HTTP } from "@/http-common.js";
import {
    RouterView,
    RouterLink,
    useRouter,
    useRoute
} from 'vue-router';
export default {
    name: 'CvItem',
    props: {
        updated: String,
        id: Number,
        title: String,
        isPrimary: Boolean,
    },
    emits: ['delete'],
    data() {
        return {
            isDeleteModalVisible: false, // Trạng thái hiển thị modal xác nhận xóa
        };
    },
    computed: {
        formattedDate() {
            return format(new Date(this.updated), 'dd/MM/yyyy');
        }
    },
    methods: {
        showDeleteModal() {
            this.isDeleteModalVisible = true;
            this.$nextTick(() => {
                this.$refs.deleteModal.showModal();
            });
        },
        async deleteItem(id) {
            await HTTP.get(`/api/deleteCV/${this.id}`)
                .then(response => {
                    console.log(response.data.status);
                    this.$emit('delete', this.id);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        editCV() {
            this.$router.push({ name: 'cvbuilder', params: { id: this.id } });
        }
    },

}
</script>
<template>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>{{ title }}</td>
        <td>{{ isPrimary ? 'Ứng tuyển công ty hehe' : 'Chưa dùng được ứng tuyển vị trí nào' }}</td>
        <td>{{ formattedDate }}</td>

        <td>
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <a :id="`view-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-regular fa-eye"></i>
                </a>

                <a @click="editCV"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <a :id="`download-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </a>
                <a @click="showDeleteModal" :id="`delete-${id}`"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </td>
    </tr>
    <dialog ref="deleteModal" class="modal">
        <div class="modal-box bg-base-100">
            <h3 class="text-lg font-semibold">Warning</h3>
            <p class="py-4 text-base">Are you sure you want delete thss?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500"
                        @click="deleteItem({ id })">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>
</template>
