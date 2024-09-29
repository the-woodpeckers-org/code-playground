<script>
export default {
    name: "Countdown",
    props: {
        days: {
            default: 12
        },
        hours: {
            default: 12
        },
        minutes: {
            default: 12
        },
        seconds: {
            default: 12
        },
    },
    data: function () {
        return {
            countDays: this.days,
            countHours: this.hours,
            countMinutes: this.minutes,
            countSeconds: this.seconds
        }
    },
    watch: {
        countSeconds: {
            handler(value) {
                setTimeout(() => {
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
                }, 1000)
            },
            immediate: true
        }
    }
}
</script>

<template>
<span class="countdown font-mono text-2xl">
    <span :style="'--value:' + countDays + ';'"></span>d:
    <span :style="'--value:' + countHours + ';'"></span>h:
    <span :style="'--value:' + countMinutes + ';'"></span>m:
    <span :style="'--value:' + countSeconds + ';'"></span>s
</span>
</template>

<style scoped>

</style>
