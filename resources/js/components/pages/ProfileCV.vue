<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
import {
    RouterView,
    RouterLink
} from 'vue-router';
export default {
    components: { NavigatorCV }
}
</script>
<template>
    <div>
        <NavigatorCV></NavigatorCV>
        <div class="mt-9 grid grid-cols-1 md:grid md:grid-cols-1 lg:flex">
            <div class="w-full lg:w-1/3 min-h-96 mr-9 rounded-xl">
                <div class="flex flex-col">
                    <div class=" bg-base-100">
                        <div class=" shadow w-full rounded-t-full ">
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
                    </div>
                    <div class="mt-3 p-3  bg-base-100">
                        <label class="text-balance text-sm lg:text-md">You are missing the following
                            information:</label>
                        <ul class="grid grid-1 ml-2">
                            <span class="bg-primary rounded-full w-max mt-2 text-white"><a class="p-2">SomeThing!</a>
                            </span>
                            <span class="bg-primary rounded-full w-max mt-2 text-white"><a class="p-2">SomeThing!</a>
                            </span>
                            <span class="bg-primary rounded-full w-max mt-2 text-white"><a class="p-2">SomeThing!</a>
                            </span>
                            <span class="bg-primary rounded-full w-max mt-2 text-white"><a class="p-2">SomeThing!</a>
                            </span>
                        </ul>
                    </div>
                    <div class="mt-3 p-3 bg-gradient-to-tr from-cyan-300 to-purple-300">
                        <span class="text-sm md:text-md lg:text-md">🧑🏻‍💻 Activate the working state</span>
                        <div class="p-3 m-2 bg-white text-wrap">
                            <p>Enable the <b>"Looking for a job"</b> status and allow employers to search your profile.
                            </p>
                        </div>
                        <router-link to="/Job-manager"
                            class="underline text-base m-3 rotate-on-hover rotate-icon-on-hover "><b><i
                                    class="fa-solid fa-gear text-base"></i> Settings</b></router-link>
                    </div>
                </div>
            </div>
            <div class="mt-3 md:mt-3 lg:m-0 w-full">
                <div class="flex flex-col w-full justify-between">
                   
                    <div>
                        <div class="m-3 flex flex-1 justify-between w-full">
                            <label for="" class="text-sm md:text-md lg:text-base font-bold">Information</label>
                            <p></p>
                            <label for=""
                                class="items-center py-1 pl-3 pr-2 mb-3 text-xs font-normal border border-blue-500 rounded-full bg-blue-50">50%</label>
                        </div>
                        <div class="relative hidden gap-8 rounded bg-white py-6 pl-6 pr-4 md:flex">
                            <div class="flex-none">
                                <div class="h-40 w-40 rounded-full bg-gray-500">
                                    <img alt="Avatar" loading="lazy" width="160" height="160" decoding="async"
                                        data-nimg="1" class="h-40 w-40 rounded-full" style="color: transparent"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s" />

                                </div>
                            </div>
                            <div class="flex-auto overflow-hidden">
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="overflow-hidden text-2xl font-bold text-black"> PHAN NGOC BAO VINH
                                        </h4>
                                        <span
                                            class="ml-2 rounded-full bg-blue-50 px-3 py-[2px] text-sm font-bold text-blue-500">50%</span>
                                    </div>
                                    <div class="flex">
                                        <div class="flex items-center"><span
                                                class="overflow-hidden text-xl font-bold text-neutral-600">Software
                                                Developer</span>
                                            <div class="w-[30px] items-center justify-center text-center">-</div>
                                        </div>
                                        <div class="flex-none text-xl text-gray-500">1 Năm kinh nghiệm</div>
                                    </div>
                                    <div class="mt-4 text-lg text-gray-400">
                                        <div class="flex w-96 truncate">Hồ Chí Minh</div>
                                        <div class="mt-1 flex">
                                            <div class="flex"><a class="underline">pv198357@gmail.com</a></div>
                                            <div class="w-[30px] text-center">-</div>
                                            <div>0344052691</div>
                                            <div class="w-[30px] text-center">-</div>
                                            <div><span class="whitespace-nowrap text-gray-300">Thêm ngày tháng năm
                                                    sinh</span></div>
                                        </div>
                                        <div class="mt-1 flex  gap-4"><span class="text-gray-300">Thêm liên kết mạng xã
                                                hội</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute right-4 flex flex-none"><button class="flex h-auto w-auto items-center"
                                    type="button"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                        </path>
                                    </svg><span class="px-4 py-2 text-sm font-semibold text-neutral-900">Sửa hồ
                                        sơ</span></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@keyframes rotate {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

.rotate-icon-on-hover:hover i {
    animation: rotate 0.5s ease-in-out;
}
</style>