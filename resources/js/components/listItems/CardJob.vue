<script>
export default {
    name: "CardJob",
    props: {
        title: {
            type: String,
            required: true
        },
        skill: {
            type: String,
            required: true
        },

    },

}
</script>

<template>
    <div>
        <div class="card card-side bg-base-100 shadow-xl w-full p-3 h-auto">
            <figure  class="">
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp" alt="Movie" style="width: 150px; height: auto;" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">{{ this.title }}</h2>
                <p>Click the button to watch on Jetflix app.</p>
                <p>skill: {{ this.skill }}</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">View</button>
                </div>
            </div>
        </div>
    </div>
</template>