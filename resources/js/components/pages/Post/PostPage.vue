<script>
import {HTTP} from "@/http-common.js";
import moment from "moment/moment.js";

export default {
    name: "PostPage",
    data: () => {
        return {
            post: {}
        }
    },
    mounted() {
        let slug = this.$route.params.slug;
        HTTP.get('api/post/slug?slug=' + slug)
            .then((response) => {
                this.post = response.data;
            })
            .catch((err) => {

            });
    },
    methods: {
        getDate(value) {
            return moment(value).format('MM/DD/YYYY hh:mm');
        }
    }
}
</script>

<template>
    <div class="w-full bg-white shadow-xl rounded-lg p-6">
        <p class="text-3xl font-semibold">
            {{post.title}}
        </p>
        <p class="italic text-gray-400">Author: {{ post.author}}</p>
        <p class="italic text-gray-400">Posted at: {{ getDate(post.created_at) }}</p>
        <p class="rte my-6">
            <span v-html="post.body"></span>
        </p>
    </div>
</template>

<style scoped>

</style>
