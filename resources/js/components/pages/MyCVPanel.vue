<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
import CvItem from '@/components/listItems/CvItem.vue';
import { HTTP } from "@/http-common.js";
import {
  RouterView,
  RouterLink,
  useRouter,
  useRoute
}
  from 'vue-router';
export default {
  data() {
    return {
      router: useRouter(),
      route: useRoute(),
      listItemcvs: Array,
      listCompanys:Array,
      isLoading: false,
      title: null,
      file: null,
      isLookingForJob: false,
    };
  },
  components: {
    NavigatorCV, CvItem
  },
  async mounted() {
    let _this = this
    await
      HTTP.get('/api/cvsU')
        .then(response => {
         // console.log(response.data);
          _this.listItemcvs = response.data.data;
          _this.listCompanys = response.data.applications;
          console.log(response.data.applications);
        })
        .catch(error => {
          console.error(error);
        });
    _this.isLoading = true;
  },
  methods: {
    async newCV() {
      if (!this.title) {
        alert('Please enter the title');
        new_cv_modal.showModal();
        return;
      }
      HTTP.post('/api/newCV', { title: this.title })
        .then(response => {
          console.log("Đang vào controller để xử lý");
          const cvId = response.data.id;
          if (cvId) {
            this.router.push({ name: 'cvbuilder', params: { id: cvId } });
          }
        })
        .catch(error => {

          console.log(error);
        });
    },
    removeCv(id) {
      this.listItemcvs = this.listItemcvs.filter(cv => cv.id !== id);
    },
    onFileChange(event) {
      this.file = event.target.files[0];
    }
  }
}

</script>
<template>
  <dialog id="letter_cover_modal" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold text-center">Cover letter</h3>
      <h2 class="m-3 text-balance text-sm text-center font-semibold ">Write a self-introduction that impresses employers
        and increases your chances for attractive job positions.</h2>
      <p class="py-4">Press ESC key or click the button below to close</p>
      <div class="modal-action">
        <form method="dialog">
          <button class="btn">Close</button>
        </form>
      </div>
    </div>
  </dialog>
  <dialog id="new_cv_modal" class="modal">
    <div class="modal-box">
      <h1 class="text-center text-blue-600 text-balance p-3 font-medium ">Create a standard CV specifically for Software
        Developers</h1>
      <h4 class="text-center text-sm text-balance">Create a standard Developer CV on TopDev now, and we will suggest IT
        jobs that match your profile.</h4>
      <div class="mt-5 flex w-full justify-center">
        <form method="dialog">
          <label class="input input-bordered flex items-center gap-2 w-full m-3">
            Name CV
            <input type="text" class="grow required" v-model="title" placeholder="Daisy" />
          </label>
          <select class="select select-info w-full m-3">
            <option disabled selected>Select language</option>
            <option>English</option>
            <option>Japanese</option>
          </select>
          <div class="flex justify-end w-full mt-2 ml-5">
            <button class="btn btn-neutral m-2">Close</button>
            <button @click="newCV" class="btn btn-primary m-2" type="submit">Begin</button>
          </div>
        </form>
      </div>
    </div>
  </dialog>


  <div>
    <NavigatorCV pageActive="My CV"></NavigatorCV>
    <div class="mt-6 border-b"></div>
    <div class="container h-4 mt-6">
      <div class="lg:float-left flex mt-8">
        <a @click="" class="text-[#0E7490] text-sm md:text-lg lg:text-2xl font-semibold lg:hover:scale-105">CV
          Management</a>
        <p class="divider divider-horizontal divider-neutral h-auto mx-5 "></p>
        <a onclick="letter_cover_modal.showModal()"
          class="text-[#0E7490] text-sm md:text-lg lg:text-2xl font-semibold lg:hover:scale-105">Cover Letter</a>
      </div>
      <div class="lg:float-right flex">
        <span class=""><a onclick="new_cv_modal.showModal()"
            class="btn sm:btn-sm md:btn-md lg:btn-lg bg-[#0D91B7] text-white font-extrabold m-3 lg:hover:scale-105 lg:hover:bg-primary">New
            CV <i class="ml-3 fa-regular fa-newspaper"></i></a></span>
      </div>
    </div>
    <div class="mt-20 sm:mt-20 md:mt-20 lg:clear-both"></div>

    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
            <th>CV Name</th>
            <th>CV's Status</th>
            <th>Updated at</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="!isLoading">
            <span class="loading loading-dots loading-lg"></span>
          </div> 
          <CvItem v-for="index in listItemcvs " :title="index.title" :id="index.id" :updated="index.updated_at" 
            @delete="removeCv" ></CvItem>
        </tbody>
      </table>
    </div>
    <div class="mt-10 sm:mt-20 md:mt-10 lg:mt-25"></div>
    <div class="flex justify-between">
      <div>
        <span
          class="btn-link text-[#0E7490] text-sm md:text-lg lg:text-xl font-semibold "><router-link>Guide</router-link></span>
      </div>
      <div>
        <div class="justify-center">
          <div class="flex items-center space-x-1">
            <button
              class="flex items-center justify-center w-8 h-8 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition duration-200"
              aria-label="Previous">
              <span>&laquo;</span>
            </button>
            <button
              class="flex items-center justify-center w-8 h-8 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition duration-200">1</button>
            <button
              class="flex items-center justify-center w-8 h-8 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition duration-200">2</button>
            <button
              class="flex items-center justify-center w-8 h-8 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition duration-200">3</button>
            <button
              class="flex items-center justify-center w-8 h-8 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition duration-200"
              aria-label="Next">
              <span>&raquo;</span>
            </button>
          </div>
        </div>


      </div>
    </div>
  </div>
</template>

<style scoped>
.bg-green-100 {
  background-color: #d1fae5;
}
.bg-red-100 {
  background-color: #fee2e2;
}
</style>