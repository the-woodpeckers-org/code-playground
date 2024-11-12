<script>
import { format } from 'date-fns';
import { HTTP } from "@/http-common.js";
import CvShowPDF from '@/components/pages/CvShowPDF.vue';
export default {
    name: 'CvItem',
    components: {
        CvShowPDF
    },
    props: {
        updated: String,
        id: Number,
        title: String,
        isPrimary: Boolean,
        companies: Array,
    },
    emits: ['delete'],
    data() {
        return {
            isDeleteModalVisible: false, // Trạng thái hiển thị modal xác nhận xóa
            isloadCV:false,
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
        },
        async showDetail() {
            const url = this.$router.resolve({ name: 'cv-show', params: { id: this.id } }).href;
            window.open(url, '_blank');
        },
        async downloadCV() {
            const url = this.$router.resolve({ name: 'cv-show', params: { id: this.id } }).href;
            const newWindow = window.open(url, '_blank');
                console.log("Dang vao cai moi");
            // Đảm bảo rằng newWindow không null
            if (newWindow) {
                if (newWindow.document.readyState === 'complete') {
                    setTimeout(() => {
                        newWindow.close();
                    }, 1500);
                    this.isloadCV = true;
                }
            }
            setTimeout(() => {
                const pdfBlobUrltemp = localStorage.getItem('pdfBlobUrl');
                console.log('PDF Blob URL 2222: ' + this.title , pdfBlobUrltemp);
                if(this.isloadCV)
                {
                    this.base64ToPDF(pdfBlobUrltemp, this.title + '.pdf');
                }
            },1500);

        },
        base64ToPDF(base64Data, fileName) {
            // Tạo Blob từ dữ liệu base64
            const byteCharacters = atob(base64Data);
            const byteNumbers = new Uint8Array(byteCharacters.length);

            // Chuyển đổi từng ký tự thành byte
            for (let i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            // Tạo đối tượng Blob từ byte array
            const blob = new Blob([byteNumbers], { type: 'application/pdf' });
            // Tạo URL cho blob
            const blobUrl = URL.createObjectURL(blob);
            // Tạo liên kết để tải xuống PDF
            const link = document.createElement('a');
            link.href = blobUrl;
            link.download = fileName; // Tên tệp tải xuống
            document.body.appendChild(link); // Thêm liên kết vào DOM
            link.click(); // Tự động nhấp vào liên kết để tải xuống
            document.body.removeChild(link); // Xóa liên kết khỏi DOM
            URL.revokeObjectURL(blobUrl); // Giải phóng URL blob
            this.isloadCV = false;
        }

    },
}
</script>
<template>
    <div ref="content"></div>
    <tr class="text-pretty text-md md:text-sm lg:text-lg border-b border-gray-500">
        <td>{{ title }}</td>
        <td><p v-for="(item, index) in this.companies" :key="index">{{ item.job.title }}</p></td>
        <td>{{ formattedDate }}</td>

        <td>
            <div class="grid grid-cols-1 lg:grid-cols-4">
                <a @click="showDetail"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-regular fa-eye"></i>
                </a>

                <a @click="editCV"
                    class="text-sm md:text-xl lg:text-2xl hover:text-blue-600 hover:scale-110 transition duration-300">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <a @click="downloadCV"
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
            <p class="py-4 text-base">Are you sure you want delete this?</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm m-1 bg-amber-200 hover:bg-amber-500"
                        @click="deleteItem({ id })">Yes</button>
                    <button class="btn btn-sm m-1 border">No</button>
                </form>
            </div>
        </div>
    </dialog>
    <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="this.isloadCV">
                <span class="loading loading-dots loading-lg"></span>
            </div>
</template>
