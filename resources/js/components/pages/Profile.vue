<script>
import {HTTP} from "@/http-common.js";

export default {
    data() {
        return {
            selectedFile: null,
            fileUpload: null,
        };
    },
    methods: {
        handleFileChange(event) {
            const maxAllowedSize = 5 * 1024 * 1024;
            if (event.target.files[0].size > maxAllowedSize) {
                return;
            } else {
                this.selectedFile = event.target.files[0];
            }
        },

        async uploadImage() {
            let _this = this;
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            try {
                const response = await HTTP.post('/api/avatar-upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                await HTTP.get('/api/auth/get')
                    .then((response) => {
                        _this.$root.auth = response.data;
                    })
                    .catch((error) => {
                        localStorage.clear();
                    });
            } catch (error) {
                console.error('Error uploading:', error);
            }
        },
        save() {
            if (this.selectedFile) {
                this.uploadImage();
            } else {
                console.error('No file selected');
            }
        },
    },
};
</script>


<template>
    <form class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md space-y-4" @submit.prevent="save">
        <div class="flex justify-center">
            <img :src="this.$root.auth.avatar_url"
                 alt="Profile Picture" class="w-32 h-32 rounded-full border-2 border-gray-300">
        </div>
        <div class="text-center">
            <input accept="image/png, image/gif, image/jpeg" type="file" id="fileInput" @change="handleFileChange"
                   class="
          file:mr-4 file:py-2 file:px-4
          file:rounded-full file:border-0
          file:text-sm file:font-semibold
          file:bg-violet-50 file:text-violet-700
          hover:file:bg-violet-100">
        </div>
        <div class="text-center">
            <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Save
            </button>

        </div>
    </form>
    <div class="justify-center">
        <p>link anh: </p>
        <a class="text-sm" :href="this.fileUpload">{{ this.fileUpload }} </a>
    </div>

</template>
