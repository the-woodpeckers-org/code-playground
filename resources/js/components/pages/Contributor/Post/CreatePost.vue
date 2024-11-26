<script>
import Multiselect from "vue-multiselect";
import slugify from "slugify";
import {HTTP} from "@/http-common.js";

export default {
    name: "CreatePost",
    components: {Multiselect},
    data: () => {
        return {
            isShowed: false,
            isCreated: false,
            title: '',
            slug: '',
            thumbnail: null,
            rte: null,
            isCreating: false,
            isLoadRte: false,
        }
    },
    mounted() {
        setTimeout(() => {
            this.rte = new RichTextEditor('#post-text-editor');
            this.rte.setHTMLCode("");
        }, 3000);
    },
    updated() {

    },
    methods: {
        handleFileChange(event) {
            const maxAllowedSize = 5 * 1024 * 1024;
            if (event.target.files[0].size > maxAllowedSize) {
                return;
            } else {
                const reader = new FileReader();
                this.thumbnail = event.target.files[0];
                reader.onloadend = () => {
                    document.getElementById('thumbnail').src = reader.result;
                };
                reader.readAsDataURL(this.thumbnail);
            }
        },
        createPost() {
            let _this = this;
            const formData = new FormData();
            this.isCreating = true;
            formData.append('title', this.title);
            formData.append('slug', this.slug);
            formData.append('body', this.rte.getHTMLCode());
            formData.append('thumbnail', this.thumbnail);
            HTTP.post('api/post', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then((response) => {
                    _this.isCreated = true;
                    _this.isShowed = false;
                    _this.$emit('toggle-fetch');
                    _this.isCreating = false;
                })
                .catch((err) => {
                    _this.isShowed = false;
                    _this.isCreating = false;
                })
        },
        generateSlug() {
            this.slug = slugify(this.title, {
                lower: true
            })
            console.log(this.slug);
        },

    }
}
</script>

<template>
    <div class="text-end">
        <button @click="this.isShowed = true; this.isCreated = false;"
                class="bg-blue-300 px-3 py-1 m-1 hover:bg-blue-500 rounded-lg">New
            post
        </button>
    </div>
    <dialog id="create-post-modal" class="modal" :class="{'modal-open' : isShowed}">
        <div class="modal-box w-11/12 max-w-5xl" style="min-height: 600px">
            <h3 class="text-lg font-bold">Create new post</h3>
            <form>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label>Title</label>
                        <input v-model="title" @input="generateSlug"
                               class="rounded-lg border border-gray-400 h-8 w-full">
                    </div>
                    <div>
                        <label>Slug</label>
                        <input v-model="slug" class="rounded-lg border border-gray-400 h-8 w-full bg-base-300" readonly>
                    </div>
                    <div>
                        <label>Thumbnail</label>
                        <div>
                            <img id="thumbnail"
                                 alt="Post Thumbnail" class="w-96 rounded-lg border-2 border-gray-300">
                        </div>
                        <div>
                            <input accept="image/png, image/gif, image/jpeg" type="file" id="fileInput"
                                   @change="handleFileChange"
                                   class=" file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label>Body</label>
                        <div id="post-text-editor" style="height: 520px">

                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg w-20" @click="createPost" :disabled="isCreating">
                        <span v-if="!isCreating">Create</span>
                        <span v-if="isCreating" class="loading loading-dots loading-xs"></span>
                    </button>
                    <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg w-20"
                            @click="this.isShowed = false;" :disabled="isCreating">
                        <span v-if="!isCreating">Cancel</span>
                        <span v-if="isCreating" class="loading loading-dots loading-xs"></span>
                    </button>
                </form>
            </div>
        </div>
    </dialog>
    <Toast v-if="isCreated" :toastData="{type: 'success', message: 'Create post successfully'}"></Toast>
</template>

<style scoped>

</style>
