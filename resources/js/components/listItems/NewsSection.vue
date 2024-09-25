<script>
import BaseCard from "@/components/cards/BaseCard.vue";

export default {
    name: "NewsSection",
    components: {BaseCard}
}
</script>

<template>
    <div>
        <div style="min-height: 520px">
            <h1 class="text-xl font-semibold">Latest news</h1>
            <BaseCard
                :title="'Trường ĐH Công Thương tổ chức cuộc thi nghiên cứu khoa học cấp trường năm học 2024 - 2025'"
                :author="'Hoang Nguyen'"
                :imgUrl="'https://huit.edu.vn/images/tin-tuc-hoat-dong/khoa-cong-nghe-hoa-hoc-hufi-to-chuc-thanh-cong-cuoc-thi-sinh-vien-nghien-cuu-khoa-hoc-nam-hoc-2022-2023-1.jpg'"></BaseCard>
            <BaseCard :title="'Tính năng mới trong bản cập nhật lớn 1.2 của CodePlayground '"
                      :author="'CodePlayground Team &#9989;'"
                      :imgUrl="'https://img.freepik.com/premium-vector/red-new-update-banner-modern-style-web-design-vector-stock-illustration_100456-2480.jpg'"></BaseCard>
            <BaseCard :title="'Sự kiện CodePlaygroundApex sẽ được chính thức tổ chức vào ngày 30/10/2024'"
                      :author="'Le Anh'"
                      :imgUrl="'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShwSuKl_udHm61upvdNgPUDYgzLTVZchc-fg&s'"></BaseCard>
        </div>

        <p class="text-center mt-2">
            <router-link to=""
                         class="p-2 bg-primary hover:bg-cyan-700 transition text-white rounded-3xl">Read more
            </router-link>
        </p>
    </div>

</template>

<style scoped>

</style>
