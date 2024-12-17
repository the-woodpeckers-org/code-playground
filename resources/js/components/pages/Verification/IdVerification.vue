<template>
  <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200">
    <div class="bg-blue-600 text-white p-4 text-center">
      <h2 class="text-2xl font-bold">Verification CardID</h2>
    </div>

    <div class="p-4 space-y-4">
      <!-- Image Preview -->
      <div v-if="previewImage" class="mb-4 relative">
        <img :src="previewImage" alt="Ảnh CCCD" class="w-full h-64 object-cover rounded-lg shadow-md" />
      </div>

      <!-- File Input -->
      <div class="flex items-center justify-center w-full">
        <label for="dropzone-file"
          class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
          <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-10 h-10 text-gray-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                clip-rule="evenodd" />
            </svg>
            <p class="mb-2 text-sm text-gray-500">
              {{ selectedFile ? selectedFile.name : "Nhấp để tải ảnh CCCD" }}
            </p>
            <p class="text-xs text-gray-400">PNG, JPG or JPEG</p>
          </div>
          <input id="dropzone-file" type="file" class="hidden" accept="image/*" @change="handleFileChange" />
        </label>
      </div>

      <!-- Verify Button -->
      <button @click="uploadAndVerify" :disabled="!selectedFile || loading" class="w-full py-3 bg-blue-600 text-white rounded-lg 
          hover:bg-blue-700 transition-colors 
          disabled:opacity-50 disabled:cursor-not-allowed 
          flex items-center justify-center space-x-2">
        <svg v-if="loading" class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
          </path>
        </svg>
        <svg v-else class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ loading ? 'Validating...' : 'Authentication CardID' }}
      </button>


      <!-- Verification Result -->
      <div v-if="verificationResult" class="mt-6 bg-gray-50 p-4 rounded-lg space-y-3">
        <h3 class="text-lg font-bold text-blue-600 flex items-center">
          <svg class="w-6 h-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Information Verification
        </h3>

        <div class="grid grid-cols-2 gap-3">
          <info-item label="Card ID" :value="verificationResult.id" />
          <info-item label="Full name" :value="verificationResult.name" />
          <info-item label="Dob" :value="verificationResult.dob" />
          <info-item label="Sex" :value="verificationResult.sex" />
          <info-item label="Country" :value="verificationResult.nationality" />
          <info-item label="Address" :value="verificationResult.address" />
        </div>

        <div v-if="verificationResult.face_base64" class="mt-4">
          <h4 class="font-semibold mb-2">Face Image</h4>
          <img :src="`data:image/png;base64,${verificationResult.face_base64}`" alt="Hình ảnh khuôn mặt"
            class="w-40 h-48 object-cover rounded-lg shadow-md" />
        </div>
        <div class="flex justify-between">
          <button @click="confirmVerification" :disabled="!verificationResult || confirmLoading" class="flex-1 py-3 bg-green-600 text-white rounded-lg 
              hover:bg-green-700 transition-colors 
              disabled:opacity-50 disabled:cursor-not-allowed 
              flex items-center justify-center space-x-2">
            <svg v-if="confirmLoading" class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
            <svg v-else class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ confirmLoading ? 'Validating...' : 'Confirm' }}
          </button>
        </div>
      </div>
    </div>
  </div>
  <Toast v-if="isUpdated" :toastData="{ type: 'success', message: 'Authentication successfully!' }"></Toast>

  <Toast v-if="isFailed" :toastData="{ type: 'success', message: 'Card ID already exists!' }"></Toast>

</template>

<script>
import Toast from "@/components/messages/Toast.vue";
import { HTTP } from "@/http-common.js";
export default {
  components: {
    'info-item': {
      props: ['label', 'value'],
      template: `
        <div class="bg-white p-2 rounded border border-gray-200">
          <span class="text-xs text-gray-500 block">{{ label }}</span>
          <span class="font-medium">{{ value || 'N/A' }}</span>
        </div>
      `
    }
    , Toast
  },
  data() {
    return {
      selectedFile: null,
      previewImage: null,
      verificationResult: null,
      loading: false,
      apiKey: 'O7Tiuyvfm9xQaAAtTDlRve5CuBLNvOX8',
      isUpdated: false,
      isFailed: false,
    };
  },
  methods: {
    handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.selectedFile = file;

        // Create preview image
        const reader = new FileReader();
        reader.onloadend = () => {
          this.previewImage = reader.result;
        };
        reader.readAsDataURL(file);
      }
    },
    async uploadAndVerify() {
      if (!this.selectedFile) {
        this.$toast.error('Vui lòng chọn ảnh để xác thực');
        return;
      }

      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.selectedFile);
      formData.append("face", 1);

      try {
        const response = await fetch("https://api.fpt.ai/vision/idr/vnm", {
          method: "POST",
          headers: {
            'api_key': this.apiKey
          },
          body: formData
        });

        const data = await response.json();
        if (response.ok) {
          this.verificationResult = data.data[0];
        } else {
          this.$toast.error('Không thể xác thực ảnh CCCD');
        }
      } catch (error) {
        this.$toast.error('Lỗi kết nối. Vui lòng thử lại');
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    async confirmVerification() {
    this.confirmLoading = true;
    this.isFailed = false;
  try {
    const response = await HTTP.post('/api/verificationCardID', { 
      cardID: this.verificationResult.id 
    });
    this.confirmLoading = false;
    if (response.data.message === 'Success') {
        this.isUpdated = true;
      setTimeout(() => {
          window.location.href = '/';
        },3000);
    } else {
      this.isFailed = true;
      this.confirmLoading = false;
    }
  } catch (error) {
    console.error('Verification error:', error);
    this.$toast.error('Lỗi xác thực. Vui lòng thử lại.');
    this.confirmLoading = false;
  }
}
  }
};
</script>