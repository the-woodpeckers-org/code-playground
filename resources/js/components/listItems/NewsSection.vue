<script>
import BaseCard from "@/components/cards/BaseCard.vue";
import {HTTP} from "@/http-common.js";

export default {
    name: "NewsSection",
    components: {BaseCard},
    data: () => {
        return {
            posts: []
        }
    },
    mounted() {
        let _this = this;
        HTTP.get('api/post/landing')
            .then((response) => {
                _this.posts = response.data;
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        toPost(slug) {
            this.$router.push('/post/' + slug);
        }
    }
}
</script>

<template>
    <div>
        <div style="min-height: 520px">
            <h1 class="text-xl font-semibold">Latest news</h1>
            <BaseCard v-for="post in posts"
                      class="cursor-pointer"
                      :title="post.title"
                      :author="post.author"
                      :imgUrl="post.thumbnail"
                      @click="toPost(post.slug)"></BaseCard>
        </div>

        <p class="text-center mt-2">
            <router-link to="/posts"
                         class="p-2 bg-primary hover:bg-cyan-700 transition text-white rounded-3xl">Read more
            </router-link>
        </p>
    </div>

</template>

<style scoped>

</style>
