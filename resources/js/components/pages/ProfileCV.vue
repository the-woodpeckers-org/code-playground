<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
import LocationPicker from '@/components/locationPicker/LocationPicker.vue';
import {
    RouterView,
    RouterLink
} from 'vue-router';
export default {
    data() {
        return {
            selectedSkills: [],
            availableSkills: ['Java', 'Go', 'C', 'C#', 'C++', 'Rust', 'JavaScript', 'Python']
        };
    },
    components: { NavigatorCV ,LocationPicker},
    methods: {
        showProfile() {
            profile_modal.showModal();
        }, addSkill(event) {
            const skill = event.target.value;
            if (skill && !this.selectedSkills.includes(skill)) {
                this.selectedSkills.push(skill);
                this.availableSkills = this.availableSkills.filter(s => s !== skill);
            }
            event.target.value = "Select a skill";
            console.log(this.selectedSkills);
        },
        removeSkill(skill) {
            this.selectedSkills = this.selectedSkills.filter(s => s !== skill);
            if (!this.availableSkills.includes(skill)) {
                this.availableSkills.push(skill);
            }
        },
        removeAll() {
            this.availableSkills = [...this.availableSkills, ...this.selectedSkills];
            this.selectedSkills = [];
        },
        closeProfile() {
            profile_modal.close();
        }
    }
}
</script>
<template>
     
    <dialog id="profile_modal" class="modal">
     
        <div class="modal-box w-11/12 max-w-3xl">
            <div class="flex flex-col-reverse">
                <div
                class="flex items-start justify-between rounded-t dark:border-gray-600 border-b p-5 rounded-tl-xl md:rounded">
                <h3 id=":r9:" class="text-xl font-medium text-gray-900 dark:text-white">
                    <p class="font-bold text-black">Personal information at a glance</p>
                    <p class="text-base font-normal text-gray-400">Fill in all the information to help you reach out to the recruiter
                        use it with ease </p>
                    </h3>
                </div>
                <div class="flex justify-end p-0">
                    <button class="btn rounded-full bg-blue-200 text-white hover:bg-red-100 hover:text-black" @click="closeProfile">X</button>
                </div>
            </div>
            <div class="p-6 flex-1 overflow-auto">
                <form id="basic-information-form">
                    <div class="space-y-6">
                        <h2 class="text-sm font-bold uppercase text-gray-400">Information</h2>
                        <div class="flex flex-wrap gap-3 md:gap-5">
                            <div class="w-full md:w-auto">
                                <div class="h-40 w-40 relative overflow-hidden rounded-full bg-gray-200"><img
                                        alt="Avatar" loading="lazy" width="160" height="160" decoding="async"
                                        data-nimg="1" class="h-40 w-40 rounded-full"
                                        srcset="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s 1x, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s 2x"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfQ0zsJp_LivQNFTRlvtBSCiRSwlhV9uGLQ&s"
                                        style="color: transparent;"><label
                                        class="text-4xl absolute bottom-0 flex w-full cursor-pointer justify-center py-2 text-white backdrop-blur"><input
                                            class="hidden" type="file"><svg stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em"
                                            width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 9a3.75 3.75 0 100 7.5A3.75 3.75 0 0012 9z"></path>
                                            <path fill-rule="evenodd"
                                                d="M9.344 3.071a49.52 49.52 0 015.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 01-3 3h-15a3 3 0 01-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 001.11-.71l.822-1.315a2.942 2.942 0 012.332-1.39zM6.75 12.75a5.25 5.25 0 1110.5 0 5.25 5.25 0 01-10.5 0zm12-1.5a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                                clip-rule="evenodd"></path>
                                        </svg></label></div>
                            </div>
                            <div class="grid grow grid-cols-2 gap-5">
                                <div class="form-group col-span-1"><label for="display_name"
                                        class="text-sm font-bold text-gray-500">Full name<span
                                            class="font-normal text-primary">*</span></label>
                                    <div class="relative">
                                        <div class="flex">
                                            <div class="relative w-full"><input
                                                    class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                    id="display_name" placeholder="Nguyễn Văn A"
                                                    value="PHAN NGOC BAO VINH" readonly></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-span-2 md:col-span-1"><label for="birthday"
                                        class="text-sm font-bold text-gray-500">Dob </label>
                                    <div class="relative w-full text-gray-700"><input
                                            class="relative transition-all duration-300 py-2.5 pl-4 pr-14 w-full border-gray-300 dark:bg-slate-800 dark:text-white/80 dark:border-slate-600 rounded-lg tracking-wide font-light text-sm placeholder-gray-400 bg-white focus:ring disabled:opacity-40 disabled:cursor-not-allowed focus:border-blue-500 focus:ring-blue-500/20"
                                            placeholder="DD/MM/YYYY" id="birthday" autocomplete="off"
                                            role="presentation" type="text" value=""><button type="button"
                                            class="absolute right-0 h-full px-3 text-gray-400 focus:outline-none disabled:opacity-40 disabled:cursor-not-allowed"><svg
                                                class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z">
                                                </path>
                                            </svg></button>

                                    </div>
                                </div>
                                <div class="form-group col-span-2 md:col-span-1"><label for=""
                                        class="text-sm font-bold text-gray-500">Sex</label>
                                    <div class="grid grid-cols-3 justify-items-stretch overflow-hidden">
                                        <button type="button"  class="h-[40px] rounded-bl rounded-tl border">Male</button>
                                            <button type="button" class="h-[40px] border">Female</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-sm font-bold uppercase text-gray-400"></h2>
                        <div class="grid grid-cols-2 gap-3 md:gap-5">
                            <div class="form-group col-span-2 md:col-span-1"><label for="position"
                                    class="text-sm font-bold text-gray-500">Job a position<span
                                        class="font-normal text-primary">*</span></label>
                                <div class="relative">
                                    <div class="flex">
                                        <div class="relative w-full"><input
                                                class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                id="position" placeholder="Ví dụ: Back- end developer"
                                                value="developer"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Year a experience<span
                                        class="font-normal text-primary">*</span></label>
                                <div class="relative">
                                    <div class="flex">
                                        <div class="relative w-full"><input
                                                class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                min="0" placeholder="Ví dụ: 2" type="number" value="1" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Email </label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            disabled="" value="pv198357@gmail.com" readonly></div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Contact <span
                                        class="font-normal text-primary"></span></label>
                                <div class="relative">
                                    <div class="flex">
                                        <div class="relative w-full"><input
                                                class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                                placeholder="Nhập số điện thoại" value="0344052691" readonly></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Address </label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="Nhập tên đường, phường, quận" value=""></div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Thành phố/ Tỉnh<span
                                        class="font-normal text-primary">*</span></label>
                                 <LocationPicker ></LocationPicker>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="text-sm font-bold text-gray-500">Social </label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="https://www.linkedin.com/username" value=""></div>
                                </div>
                            </div>
                            <div class="form-group col-span-2 md:col-span-1"><label for=""
                                    class="hidden text-sm font-bold text-gray-500 md:block">&nbsp;</label>
                                <div class="flex">
                                    <div class="relative w-full"><input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-white placeholder:text-gray-300 border-gray-300 text-gray-500 focus:ring-0 focus:border-gray-300 p-2.5 text-sm rounded"
                                            placeholder="https://github.com/username" value=""></div>
                                </div>
                            </div>
                            <div class="form-group col-span-2"><label for="" class="text-sm font-bold text-gray-500">Skill<span class="font-normal text-primary">*</span></label>
                                <div class="relative w-full border rounded-md h-min p-3">
                                    <div class="grid grid-cols-6 gap-4">
                                        <div class="col-start-1 col-end-6">
                                            <div class="flex flex-wrap gap-2 w-2/3" id="skill-selected">
                                                <kbd v-for="(skill, index) in selectedSkills" :key="index" class="kbd">
                                                    {{ skill }}
                                                    <button @click="removeSkill(skill)" class="ml-2 text-red-500">
                                                        <i class="fa-solid fa-x"></i>
                                                    </button>
                                                </kbd>
                                            </div>
                                        </div>
                                        <div class="flex justify-end items-center gap-2">
                                            <button v-if="selectedSkills.length" @click="removeAll"
                                                class="flex items-center justify-center w-10 h-10 text-red-500">
                                                <i class="fa-solid fa-x"></i>
                                            </button>
                                            <p class="divider divider-horizontal divider-neutral h-auto"></p>
                                            <select class="select w-auto" @change="addSkill($event)">
                                                <option disabled selected>Select a skill</option>
                                                <option v-for="(skill, index) in availableSkills" :key="index"
                                                    :value="skill">
                                                    {{ skill }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <div class="flex gap-2">
                        <button class="btn ">Close</button>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
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
                                    </svg>
                                    <span @click="showProfile"
                                        class="px-4 py-2 text-sm font-semibold text-neutral-900">Edit
                                        profile</span></button></div>
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