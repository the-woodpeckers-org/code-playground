<script>
export default {
    name: "Countdown",
    props: {
        days: {
            default: 0
        },
        hours: {
            default: 0
        },
        minutes: {
            default: 0
        },
        seconds: {
            default: 0
        },
    },
    data: function () {
        return {
            countDays: this.days,
            countHours: this.hours,
            countMinutes: this.minutes,
            countSeconds: this.seconds,
            isRunning: true,
        }
    },
    mounted() {

    },
    watch: {
        countSeconds: {
            handler(value) {
                setTimeout(() => {
                    if (this.isRunning) {
                        if (!(this.countDays === 0 && this.countHours === 0 && this.countMinutes === 0 && this.countSeconds === 0)) {
                            this.countSeconds--
                            if (this.countSeconds < 0) {
                                this.countMinutes--
                                this.countSeconds = 59
                            }
                            if (this.countMinutes < 0) {
                                this.countHours--
                                this.countMinutes = 59
                            }
                            if (this.countHours < 0) {
                                this.countDays--
                                this.countHours = 23
                            }
                        } else {
                            this.isRunning = false
                        }
                    }
                }, 1000)
            },
            immediate: true
        }
    }
}
</script>

<template>
<span v-if="isRunning" class="countdown font-mono text-xl">
    <span :style="'--value:' + countDays + ';'"></span>d:
    <span :style="'--value:' + countHours + ';'"></span>h:
    <span :style="'--value:' + countMinutes + ';'"></span>m:
    <span :style="'--value:' + countSeconds + ';'"></span>s
</span>
</template>

<style scoped>

</style>
