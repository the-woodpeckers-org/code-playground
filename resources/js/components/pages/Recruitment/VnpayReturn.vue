<template>

     <dialog class="modal modal-open" v-if="isUpdated" >
            <div class="modal-box text-center overflow-hidden bg-green-100 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold text-green-600 mb-4">Success</h3>
                <div class="w-full text-center text-5xl text-green-600 animate-jump-in mb-4">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <p class="py-4 font-semibold text-lg text-gray-800">Upgrade to Premium was successful!</p>
                <button @click="goLanding" class="btn btn-primary mt-4">Close</button>
            </div>
        </dialog>

        <dialog class="modal modal-open" v-if="isFailed" >
            <div class="modal-box text-center overflow-hidden bg-green-100 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold text-green-600 mb-4">Some Wrong !</h3>
                <div class="w-full text-center text-5xl text-green-600 animate-jump-in mb-4">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <p class="py-4 font-semibold text-lg text-gray-800">Upgrade to Premium was failed!</p>
                <button @click="goLanding" class="btn btn-primary mt-4">Close</button>
            </div>
        </dialog>
</template>


<script>
import { HTTP } from '@/http-common.js';
export default {
    data() {
        return {
            amount: null,
            transactionStatus: null,
            responseCode: null,
            orderInfo: null,
            isUpdated: false,
            isFailed: false
        };
    },
    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        this.amount = urlParams.get('vnp_Amount');
        this.transactionStatus = urlParams.get('vnp_TransactionStatus');
        this.responseCode = urlParams.get('vnp_ResponseCode');
        this.orderInfo = urlParams.get('vnp_OrderInfo');

        if (this.responseCode === '00' && this.transactionStatus === '00') {
            this.handleSuccessfulTransaction();
        } else {
            this.handleFailedTransaction();
        }
    },
    methods: {
        async handleSuccessfulTransaction() {
            console.log('Transaction successful!');
            try {
                const response = await HTTP.get('/api/vnpayReturn', { params: this.$route.query });
                console.log(response.data);
                if (response.data.status === '200') {
                    this.isUpdated = true;
                    setTimeout(() => {
                        this.goLanding();
                    }, 2000);
                }
                
            } catch (e) {
                console.error('Error processing the payment:', e);
                this.isFailed = true;
            
            }
        },
        handleFailedTransaction() {
            console.log('Transaction failed!');
            this.isFailed = true;
            setTimeout(() => {
                this.goLanding();
            }, 3000);
        },
        goLanding() {
           window.location.href = '/';
        }
    }
};
</script>

<style scoped>
/* Thêm các kiểu CSS nếu cần */
</style>