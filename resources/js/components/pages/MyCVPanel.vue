<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
import CvItem from '@/components/listItems/CvItem.vue';
export default {
  components: {
    NavigatorCV,CvItem
  },
}

</script>
<template>
  <div>
    <NavigatorCV pageActive="My CV"></NavigatorCV>
    <div class="mt-6 border-b"></div>
    <div class="container h-4 mt-6">
      <div class="lg:float-left flex mt-8">
        <a @click="" class="text-[#0E7490] text-sm md:text-lg lg:text-2xl font-semibold lg:hover:scale-105">CV
          Management</a>
        <p class="divider divider-horizontal divider-neutral h-auto mx-5 "></p>
        <a @click="" class="text-[#0E7490] text-sm md:text-lg lg:text-2xl font-semibold lg:hover:scale-105">Letter
          Recommandation</a>
      </div>
      <div class="lg:float-right flex">
        <span class=""><a
            class="btn sm:btn-sm md:btn-md lg:btn-lg bg-[#393E46]  text-white font-extrabold m-3 lg:hover:scale-105 lg:hover:bg-lime-950">Upload
            CV <i class="ml-3 fa-solid fa-cloud-arrow-up"></i></a></span>
        <span class=""><a
            class="btn sm:btn-sm md:btn-md lg:btn-lg bg-[#0D91B7] text-white font-extrabold m-3 lg:hover:scale-105 lg:hover:bg-primary">New
            CV <i class="ml-3 fa-regular fa-newspaper"></i></a></span>
      </div>
    </div>
    <div class="mt-20 sm:mt-20 md:mt-20 lg:clear-both"></div>
       <!-- =)) vài bữa đẩy cái số lượng vào 10 record 1 trang maybe:D -->
    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
            <th>CV Name</th>
            <th>CV's Status</th>
            <th>Updated at</th>
            <th>Options</th>
          </tr>
        </thead>

        <tbody>
          <CvItem v-for="index in 5" :key="index"></CvItem>
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

<style></style>