<template>
  <div class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://via.placeholder.com/150" alt="Code Playground Logo">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Upgrade to Premium
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Complete your purchase to enjoy Code Playground to the fullest.
        </p>
      </div>

      <!-- <form class="mt-8 space-y-6" action="#" method="POST">
        <input type="hidden" name="remember" value="true">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="name" class="sr-only">Name</label>
            <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Name">
          </div>
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Email address">
          </div>
          <div>
            <label for="card-number" class="sr-only">Card Number</label>
            <input id="card-number" name="card-number" type="text" autocomplete="cc-number" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Card Number">
          </div>
          <div class="grid grid-cols-3 gap-4">
            <div>
              <label for="expiry-date" class="sr-only">Expiry Date</label>
              <input id="expiry-date" name="expiry-date" type="text" autocomplete="cc-exp" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="MM/YY">
            </div>
            <div>
              <label for="cvc" class="sr-only">CVC</label>
              <input id="cvc" name="cvc" type="text" autocomplete="cc-csc" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="CVC">
            </div>
            <div>
              <label for="zip-code" class="sr-only">Zip Code</label>
              <input id="zip-code" name="zip-code" type="text" autocomplete="postal-code" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Zip Code">
            </div>
          </div>
        </div>

        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </span>
            Complete Purchase
          </button>
        </div>
      </form> -->
      <button @click="Upgrade" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </span>
            Complete Purchase
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
      await HTTP.post('/api/checkout').then(response => {
      this.isLoading = false;
      this.isUpdated= true;
      setTimeout(() => {
        this.isUpdated = false;
        this.$router.push('/');
      }, 3000);
      }).catch(error => {
        console.log(error);
      });   
    }
  }
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
</style>