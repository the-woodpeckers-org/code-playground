<script>
export default {
    name: "Footer"
}
</script>

<template>
    <footer class="bg-secondary mt-10">
        <div class="max-w-7xl mx-auto py-6 grid gap-x-10 lg:grid-cols-4 sm:grid-cols-1">
            <div class="mx-3">
                <div class="mb-1">
                    <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png"
                         class="h-12 inline mx-1">
                    <img
                        src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726073233/OIG3.8-Photoroom_we02zq.png"
                        class="h-12 inline mx-1">
                    <img src="https://fit.huit.edu.vn/app_web/kcntt/images/icons/logo-huit-xanh.png"
                         class="h-12 my-1 lg:mx-auto lg:block sm:inline sm:mx-1">
                </div>
                <h1 class="text-base">CodePlayground is a competitive programming platform developed by The Woodpeckers
                    Team. The project is open source and also the team's graduation project.</h1>
                <div class="text-3xl my-2">
                    <a href="https://github.com/the-woodpeckers-org" target="_blank"><i class="fa-brands fa-github mx-2"></i></a>
                    <a href="#"><i class="fa-brands fa-square-x-twitter mx-2 text-gray-900"></i></a>
                    <a href="#"><i class="fa-brands fa-square-facebook mx-2 text-blue-600"></i></a>
                    <a href="#"><i class="fa-brands fa-square-instagram mx-2 text-pink-600"></i></a>
                    <a href="#"></a>
                </div>
            </div>
            <div class="mx-3 mb-3 font-semibold">
                <h1 class="text-blue-800 mb-4 border-b border-gray-400">Features</h1>
                <span><a href="#"><p>Studying</p></a></span>
                <span><a href="#"><p>Practice</p></a></span>
                <span><a href="#"><p>Competition</p></a></span>
                <span><a href="#"><p>Challenges</p></a></span>
                <span><a href="#"><p>Rating</p></a></span>
                <span><a href="#"><p>Discussion</p></a></span>
                <span><a href="#"><p>Ranking</p></a></span>
                <span><a href="#"><p>Contribute</p></a></span>
                <span><a href="#"><p>Career</p></a></span>
            </div>
            <div class="mx-3 mb-3 font-semibold">
                <h1 class="text-blue-800 mb-4 border-b border-gray-400">Information</h1>
                <span><router-link to="/about-us"><p>About The Woodpeckers</p></router-link></span>
                <span><a href="#"><p>Terms and Conditions</p></a></span>
            </div>
            <div class="mx-3 mb-3 font-semibold">
                <h1 class="text-blue-800 mb-4 border-b border-gray-400">Support</h1>
                <span><a href="#"><p>Feedback</p></a></span>
                <span><a href="#"><p>Contact us</p></a></span>
            </div>
            <h1 class="text-center col-span-full font-semibold">Provided by CodePlayground© 2024. <span><img
                src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726073233/OIG3.8-Photoroom_we02zq.png"
                class="h-7 inline"></span>The
                Woodpeckers Team.</h1>
        </div>
    </footer>
</template>

<style scoped>

</style>
