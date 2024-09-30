<script>
export default {
    name: "TextEditor",
    props: {},
    mounted() {
        var rte = new RichTextEditor('#text-editor');
        rte.setHTMLCode("Điền vô đây em!");
    }
}
</script>

<template>
    <div>
        <div id="text-editor"></div>
    </div>
</template>

<style scoped>

</style>
