<template>
    <div
        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-105 transform hover:bg-gradient-to-r hover:from-[#75b2e8] hover:to-[#b2d8f7]">
        <div class="px-6 py-4 border-b border-[#75b2e8] bg-[#e0f7ff]">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-[#5f7d8c] text-xl">Premium Upgrade</span>
                <span class="text-xl text-[#3d4c61] opacity-90 flex gap-2">
                    <span class="font-extrabold"> {{ data.Subscription.start_date }}</span>
                    <strong>to</strong>
                    <span class="font-extrabold"> {{ data.Subscription.end_date }}</span>
                </span>
            </div>
        </div>
        <div class="px-6 py-5">
            <div class="flex items-center justify-between">
                <span class="text-[#9c27b0] font-medium text-lg">Upgraded to Premium Plan</span>
                <span class="font-bold text-[#000000] text-2xl">{{ formatNumber(data.total) }} VNĐ</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Order",
    props: {
        data: Object
    },
    methods: {
        formatNumber(number) {
            return new Intl.NumberFormat('de-DE').format(number);
        }
    }
}
</script>

<style scoped>
/* Optional: Add custom styles if needed */
</style>