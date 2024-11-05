<script>
import { HTTP } from "@/http-common.js";

export default {
  data() {
    return {
      provinces: [],
      districts: [],
      wards: [],
      selectedProvince: '',
      selectedDistrict: '',
    };
  },
  async created() {
    await this.fetchProvinces();
  },
  methods: {
    async fetchProvinces() {
      const BASE_API_URL = 'https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1';
      try {
        const response = await HTTP.get(`${BASE_API_URL}`).then(response => {
          this.provinces = response.data.data.data;
        });
      } catch (error) {
        console.error('loi tinh:', error);
      }
    },
    async fetchDistricts() {
      if (this.selectedProvince) {
        try {
          const response = await HTTP.get(`https://vn-public-apis.fpo.vn/districts/getByProvince?provinceCode=${this.selectedProvince}&limit=-1`).then(response => {
            this.districts = response.data.data.data;
            this.wards = [];
            console.log(this.districts);
            this.selectedDistrict = '';
          });
        } catch (error) {
          console.error('loi quan:', error);
        }
      }
    },
    async fetchWards() {
      if (this.selectedDistrict) {
        try {
          const response = await axios.get(`https://vn-public-apis.fpo.vn/wards/getByDistrict?districtCode=${this.selectedDistrict}&limit=-1`).then(response => {
            this.wards = response.data.data.data;
            console.log(this.wards);
          }
          );
        
        } catch (error) {
          console.error('loi xa:', error);
        }
      }
    },
  },
};
</script>
<template>
  <div class="w-full">
    <div>
      <h2 for="province">Tỉnh:</h2>
      <select class="select select-secondary w-full" id="province" v-model="selectedProvince" @change="fetchDistricts">
        <option value="">Chọn tỉnh</option>
        <option v-for="province in provinces" :key="province.code" :value="province.code">
          {{ province.name }}
        </option>
      </select>
    </div>
    <div  v-if="districts.length">
      <h2 for="district">Huyện/Quận:</h2>
      <select class="select select-secondary w-full" id="district" v-model="selectedDistrict" @change="fetchWards">
        <option value="">Chọn huyện</option>
        <option v-for="district in districts" :key="district.code" :value="district.code">
          {{ district.name }}
        </option>
      </select>
    </div>

    <div  v-if="wards.length">
      <h2 for="ward">Xã/Phường:</h2>
      <select class="select select-secondary w-full" id="ward">
        <option value="">Chọn xã</option>
        <option v-for="ward in wards" :key="ward.code" :value="ward.code">
          {{ ward.name }}
        </option>
      </select>
    </div>
  </div>
</template>
<style scoped></style>