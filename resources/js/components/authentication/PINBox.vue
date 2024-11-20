<script>
export default {
    name: "PINBox",
    props: {
        config: Object
    },
    methods: {
        sendCode() {
            let code = '';
            for (let i = 0; i < this.inputArray.length; ++i) {
                code += this.inputArray[i];
            }
            this.$emit('sendCode', code);
        }
    },
    data: () => {
        return {
            inputArray: Array
        }
    },
    mounted() {
        this.inputArray = Array(5).fill('');
    }
}
</script>

<template>
<div class="w-full flex flex-row flex-wrap justify-center my-6">
    <p class="w-full text-center font-semibold mb-3">
        Enter your code below
    </p>
    <input @change="sendCode" v-model="inputArray[i]" v-for="i in config.size" maxlength="1" class="mx-1 h-12 w-12 rounded-lg border border-gray-400 text-center font-semibold text-xl">
</div>
</template>

<style scoped>

</style>
