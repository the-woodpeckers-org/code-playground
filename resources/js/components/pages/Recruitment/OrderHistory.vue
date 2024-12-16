<template>
 <div v-if="orders.length == 0 " class="text-center flex flex-col items-center justify-center min-h-screen">
    <div class="h-10"></div>
    <i class="fa-solid fa-cart-shopping text-6xl text-gray-500 mb-6"></i>
    <h1 class="text-2xl font-semibold text-gray-700">There's nothing here :(</h1>
  </div>

  <div v-else class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
      <h1  class="text-3xl font-extrabold text-gray-900 mb-8">Order History</h1>
      <div  class="space-y-8">
        <Order v-for="(order, index) in orders" :key="index" :data="order" />
      </div>
    </div>
  </div>
</template>
<script>
import { HTTP } from '@/http-common.js'
import Order from '@/components/cards/Order.vue'
export default {
    name: 'OrderHistory',
    components: {
        Order
    },
    data: function () {
        return {
            orders: [],
            loading: false,
            subscriptionsHistory: []
        }
    },
    async mounted() {
        await this.getOrders();
    },
    methods: {
        async getOrders() {
            console.log("Heh");
            await HTTP.get('/api/orders').then(response => {
          
                if(response.data.data){;
                    this.orders = response.data.data;       
                    console.log(response.data.data);
                }
                else{
                    this.orders = [];
                    this.Subscriptions = [];
                }
          }).catch(error => {
            });
        },
    }
}
</script>
<style scoped></style>
