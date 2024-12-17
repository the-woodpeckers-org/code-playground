<script>
export default {
    name: "Posts",
    data: () => {
        return {
            posts: [],
        }
    },
    methods: {
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
    </div>
</template>

<style scoped>

</style>
