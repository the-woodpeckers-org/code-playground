<template>
  <div class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div id="stars-container"></div>
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto w-auto" src="https://res.cloudinary.com/ddgnrqr3j/image/upload/v1732898177/b0yiiiemh70zwsxua4bf.png" alt="Code Playground Logo">
        <h2 class="mt-6 text-center text-2xl font-extrabold text-gray-900 text-wrap">
          Upgrade to CP Premium package to experience utility services for only 10,000,000 VND
        </h2>
      </div>
      <button @click="Upgrade" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </span>
            Checkout
          </button>
    </div>
  </div>
  <div class="fixed inset-0 bg-white bg-opacity-80 flex justify-center items-center z-50" v-if="isLoading">
        <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span class="loading loading-spinner loading-lg">
                </span>
            </div>
            <p class="py-4 font-semibold">Switching to the checkout page!</p>
        </div>
    </div>
  <dialog class="modal modal-open" v-if="isUpdated">
    <div class="modal-box text-center overflow-hidden">
            <h3 class="text-lg font-bold"></h3>
            <div class="w-full text-center text-5xl text-green-600 animate-jump-in">
                <span>
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>
            <p class="py-4 font-semibold">Upgrade Premium successfully!</p>
        </div>
  </dialog>
</template>
<script>
import {HTTP} from '@/http-common.js'
export default {
  name: 'UpgradePremiumCheckout',
    data: function () {
        return {
            isUpdated: false,
            isLoading: false
        }
    },
  methods: {
    async Upgrade()
    {
      this.isLoading = true;
      await HTTP.post('/api/vnpay_payment').then(response => {

      // this.isUpdated= true;
      if(response.data.message === 'success')
      {setTimeout(() => {
       this.isLoading = false;
        window.location.href = response.data.data;
      }, 3000);
   
      }
      else{
        alert('Upgrade failed');
      }
      
      console.log(response.data); 
      
      }).catch(error => {
        console.log(error);
      });   
    }
  },
  
}
</script>

<style scoped>
.bg-gray-100 {
  background-color: #f7fafc;
}
.text-gray-900 {
  color: #1a202c;
}
.text-gray-600 {
  color: #718096;
}
.bg-blue-600 {
  background-color: #4299e1;
}
.hover\:bg-blue-700:hover {
  background-color: #3182ce;
}
.focus\:ring-blue-500:focus {
  --tw-ring-color: #3b82f6;
}
.rounded-md {
  border-radius: 0.375rem;
}
.shadow-sm {
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.appearance-none {
  appearance: none;
}
.focus\:outline-none:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}
.focus\:ring-2:focus {
  --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
  --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
  box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
}
.focus\:ring-offset-2:focus {
  --tw-ring-offset-width: 2px;
}
#stars-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

.star {
    position: absolute;
    background-color: white;
    border-radius: 50%;
    opacity: 0.8;
    animation: fall infinite linear;
}

@keyframes fall {
    0% {
        transform: translateY(-100%);
        opacity: 1;
    }
    100% {
        transform: translateY(100vh);
        opacity: 0;
    }
}

</style>