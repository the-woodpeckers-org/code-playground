<script>
export default {
    name: "Contest",
    props: {
        days: 12,
        hours: 12,
        minutes: 12,
        seconds: 12,
        imgUrl: String,
        title: String,
        url: String
    },
    data: function() {
        let _this = this
        return {
            countDays: _this.days,
            countHours: _this.hours,
            countMinutes: _this.minutes,
            countSeconds: _this.seconds
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
    <router-link class="card bg-base-200 shadow-xl my-1 text-sm hover:bg-gray-200 hover:scale-105 duration-300 transition" to="/">
        <figure class="h-40">
            <img :src="imgUrl"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{title}}</h2>
            <p class="text-center">
                <span class="text-center font-mono">end after</span>
                <br>
                <span class="countdown font-mono text-2xl">
                    <span :style="'--value:' + countDays + ';'"></span>d:
                    <span :style="'--value:' + countHours + ';'"></span>h:
                    <span :style="'--value:' + countMinutes + ';'"></span>m:
                    <span :style="'--value:' + countSeconds + ';'"></span>s
                </span>
            </p>
        </div>
    </router-link>
</template>

<style scoped>

</style>
