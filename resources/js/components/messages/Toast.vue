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
        }, 5000)
    }
}
</script>

<template>
    <div class="fixed bottom-5 end-5 lobster" :class="{'hidden': isHidden}">
        <div class="alert" :class="{'alert-success':  toastData.type === 'success'}">
            <p class="font-semibold text-base-200">{{ toastData.message }}!</p>
        </div>
    </div>
</template>

<style scoped>
@keyframes fade {
    0% {
        opacity: 0;
    }
    10% {
        opacity: 1
    }
    25% {
        opacity: 1;
    }
    50% {
        opacity: 1;
    }
    95% {
        opacity: 1;
    }
    100% {
        display: none;
        opacity: 0;
    }
}

.lobster {
    animation-name: fade;
    animation-duration: 5000ms;
    animation-fill-mode: forwards;
}
</style>
