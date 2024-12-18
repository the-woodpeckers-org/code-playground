<script>
import {HTTP} from "@/http-common.js";
import BaseCard from "@/components/cards/BaseCard.vue";
export default {
    name: "Posts",
    components: {BaseCard},
    data: () => {
        return {
            currentPage: 1,
            posts: [],
            links: []
        }
    },
    mounted() {
        this.getPosts(1);
    },
    methods: {
        getPosts(index) {
            let _this = this;
            HTTP.get('api/posts?page=' + index)
                .then((response) => {
                    _this.posts = response.data.data;
                    console.log(_this.posts);
                    _this.links = response.data.links;
                    _this.currentPage = response.data.current_page;
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        toPost(slug) {
            this.$router.push('/post/' + slug);
        }
    }
}
</script>

<template>
    <div class="w-full bg-white shadow-xl rounded-lg p-6 min-h-96">
        <div style="min-height: 520px">
            <h1 class="text-xl font-semibold">Latest news</h1>
            <BaseCard v-for="post in posts"
                      class="cursor-pointer"
                      :title="post.title"
                      :author="post.author"
                      :imgUrl="post.thumbnail"
                      @click="toPost(post.slug)"></BaseCard>
        </div>
        <div class="flex">
            <div class="join mx-auto my-3">
                <button v-for="link in links" :disabled="!link.url" class="join-item btn"
                        :class="{ 'btn-active' : link.label == currentPage}" @click="getPosts(link.label)"><span
                    v-html="link.label"></span></button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
