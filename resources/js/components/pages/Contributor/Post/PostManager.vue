<script>
import CreatePost from "@/components/pages/Contributor/Post/CreatePost.vue";
import {HTTP} from "@/http-common.js";
import moment from "moment";

export default {
    name: "PostManager",
    components: {CreatePost},
    data: () => {
        return {
            posts: [],
            links: [],
            currentPage: 1,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.getPosts(1);
        },
        getPosts(index) {
            let _this = this;
            HTTP.get('api/contributor/post?page=' + index)
                .then((response) => {
                    _this.posts = response.data.data;
                    _this.links = response.data.links;
                })
                .catch((err) => {

                })
        },
        showEdit(id) {

        },
        showConfirmDelete(id, title) {

        },
        getDate(value) {
            return moment(value).format('MM/DD/YYYY hh:mm');
        }
    }
}
</script>

<template>
    <div class="w-full">
        <p class="text-center font-bold text-2xl">Post management</p>
        <p class="text-lg">Your posts on The CodePlayground</p>
        <CreatePost @toggle-fetch="fetchData"></CreatePost>
        <div class="overflow-x-auto bg-base-100 rounded-xl">
            <table class="table table-lg">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover" v-for="post in posts">
                    <th></th>
                    <td>{{ post.title }}</td>
                    <td>{{ getDate(post.created_at) }}</td>
                    <td class="inline-flex">
                        <button class="bg-yellow-300 px-3 py-1 mx-1 hover:bg-yellow-500 rounded-lg">Go&nbsp;to</button>
                        <button class="bg-blue-300 px-3 py-1 mx-1 hover:bg-blue-500 rounded-lg" @click="showEdit(post.id)">Edit</button>
                        <button class="bg-red-300 px-3 py-1 mx-1 hover:bg-red-500 rounded-lg"
                                @click="showConfirmDelete(post.id, post.title)">Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex">
                <div class="join mx-auto my-3">
                    <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                            :class="{ 'btn-active' : link.label == currentPage}" @click="getPosts(link.label)"><span
                        v-html="link.label"></span></button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
