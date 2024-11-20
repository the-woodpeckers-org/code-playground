<script>
export default {
    name: "Toast",
    props: {
        toastData: Object
    },
    data: () => {
        return {
            isHidden: false
        }
    },
    mounted() {
        setTimeout(() => {
            this.isHidden = true;
        }, 4000)
    }
}
</script>

<template>
    <div class="fixed bottom-5 end-5" :class="{'hidden': isHidden}">
        <div class="alert" :class="{'alert-success':  toastData.type === 'success'}">
            <p class="font-semibold text-base-200">{{ toastData.message }}!</p>
        </div>
    </div>
</template>

<style scoped>

</style>
