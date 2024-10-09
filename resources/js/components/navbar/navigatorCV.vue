<script>
export default {
    name: 'NavigatorCV',
}
</script>

<template>
    <div class="navbar bg-gradient-to-tr from-cyan-300 to-purple-300 grid grid-cols-1 lg:flex lg:justify-between">
        <p class="relative inline-block group">
            <router-link href="/" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">Profile CV</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
        <p class="relative inline-block group">
            <router-link href="#" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">Job Management</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
        <p class="relative inline-block group">
            <router-link href="#" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">My CV</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
        <p class="relative inline-block group">
            <router-link href="#" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">Mail Management</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
        <p class="relative inline-block group">
            <router-link href="#" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">Jobs Applied</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
        <p class="relative inline-block group">
            <router-link href="#" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">Jobs Followed</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
        <p class="relative inline-block group">
            <router-link href="#" class="text-stone-700 text-sm md:text-lg lg:text-xl font-semibold lg:hover:text-2xl">Personality Test</router-link>
            <span
                class="absolute left-0 bottom-0 h-[2px] bg-gray-900 w-0 transition-all duration-300 lg:group-hover:w-full"></span>
        </p>
    </div>
</template>
