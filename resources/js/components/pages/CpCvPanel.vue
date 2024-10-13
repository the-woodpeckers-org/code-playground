<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';

export default {
    components: { NavigatorCV }
}
</script>
<template>
    <div>
        <NavigatorCV></NavigatorCV>
        <div class="mt-9 grid grid-cols-1 md:grid md:grid-cols-1 lg:flex">
            <div class="w-full lg:w-1/3 min-h-96 bg-base-100 mr-9 rounded-xl">
                <div class="shadow w-full rounded-t-full">
                    <div class="stat md:p-0 lg:p-3">
                        <div class="stat-figure text-secondary ">
                            <div class="avatar">
                                <div class="w-16 md:w-20 lg:w-20 rounded-full h-auto">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s" />
                                </div>
                            </div>
                        </div>
                        <div class="stat-value sm:text-sm md:text-lg lg:text-2xl">10%</div>
                        <div class="stat-title sm:text-base md:text-md lg:text-md">Phan Ngọc Bảo Vinh</div>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="text-balance text-sm lg:text-md">You are missing the following information:</label>
                    <ul class="grid grid-1 ml-2">
                        <span class="bg-primary rounded-full w-max hover:bg-base-300 mt-2 text-white"><a
                                class="p-2">SomeThing!</a> </span>
                        <span class="bg-primary rounded-full w-max hover:bg-base-300 mt-2 text-white"><a
                                class="p-2">SomeThing!</a> </span>
                        <span class="bg-primary rounded-full w-max hover:bg-base-300 mt-2 text-white"><a
                                class="p-2">SomeThing!</a> </span>
                        <span class="bg-primary rounded-full w-max hover:bg-base-300 mt-2 text-white"><a
                                class="p-2">SomeThing!</a> </span>
                    </ul>
                </div>
            </div>
            <div class="mt-3 md:mt-3 lg:m-0 w-full">
                <div class="flex flex-1">
                    <div class="w-full bg-base-100">
                        <span class="font-semibold text-sm sm:text-md md:text-xl lg:text-2xl">CodePlayground CV</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="">

</style>