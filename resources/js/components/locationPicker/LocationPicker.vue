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
      selectedWard: '',
    };
  },
  props: {
    province: {
      type: String,
      default: null,
    },
    district: {
      type: String,
      default:null,
    },
    ward: {
      type: String,
      default: null,
    },
  },
  async mounted() {
    await this.fetchProvinces();
    if (this.province) {
      const foundProvince = this.provinces.find(
        (p) => p.name === this.province
      );
      if (foundProvince) {
        this.selectedProvince = foundProvince.code;
        await this.fetchDistricts();
      }
    }

    if (this.district) {
      const foundDistrict = this.districts.find(
        (d) => d.name === this.district
      );
      if (foundDistrict) {
        this.selectedDistrict = foundDistrict.code;
        await this.fetchWards();
      }
    }

    if (this.ward) {
      const foundWard = this.wards.find(
        (w) => w.name === this.ward
      );
      if (foundWard) {
        this.selectedWard = foundWard.code;
        console.log('foundWard', foundWard);
      }
    }
  },
  watch: {
    province(newProvinceName) {
      const foundProvince = this.provinces.find(
        (p) => p.name === newProvinceName
      );
      if (foundProvince) {
        this.selectedProvince = foundProvince.code;
        this.fetchDistricts();
        
      }
    },
    district(newDistrictName) {
      const foundDistrict = this.districts.find(
        (d) => d.name === newDistrictName
      );
      if (foundDistrict) {
        this.selectedDistrict = foundDistrict.code;
        this.fetchWards();
      }
    },
    ward(newWardName) {
      const foundWard = this.wards.find(
        (w) => w.name === newWardName
      );
      if (foundWard) {
        this.selectedWard = foundWard.code;
        
      }
    },
  },
  methods: {
    async fetchProvinces() {
      const BASE_API_URL = 'https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1';
      try {
        const response = await HTTP.get(BASE_API_URL);
        this.provinces = response.data.data.data;
      } catch (error) {
        console.error('Error fetching provinces:', error);
      }
    },
    async fetchDistricts() {
      if (this.selectedProvince) {
        try {
          const response = await HTTP.get(
            `https://vn-public-apis.fpo.vn/districts/getByProvince?provinceCode=${this.selectedProvince}&limit=-1`
          );
          this.districts = response.data.data.data;
          this.wards = [];
          this.selectedDistrict = '';
        } catch (error) {
          console.error('Error fetching districts:', error);
        }
      }
    },
    async fetchWards() {
      if (this.selectedDistrict) {
        try {
          const response = await HTTP.get(
            `https://vn-public-apis.fpo.vn/wards/getByDistrict?districtCode=${this.selectedDistrict}&limit=-1`
          );
          this.wards = response.data.data.data;
          this.selectedWard = ''; 
          
        } catch (error) {
          console.error('Error fetching wards:', error);
        }
      }
    },
    emitFullAddress()
    {
      const province = this.provinces.find(p => p.code === this.selectedProvince);
      const district = this.districts.find(d => d.code === this.selectedDistrict);
      const ward = this.wards.find(w => w.code === this.selectedWard);
      this.$emit('address-updated', {
      province: province ? province.name : '',
      district: district ? district.name : '',
      ward: ward ? ward.name : ''
    });
    }
  },
};
</script>


<template>
  <div class="w-full">
    <div>
      <h2 for="province">Province:</h2>
      <select class="select select-secondary w-full" id="province" v-model="selectedProvince" @change="fetchDistricts">
        <option value="">Chọn tỉnh</option>
        <option v-for="province in provinces" :key="province.code" :value="province.code">
          {{ province.name }}
        </option>
      </select>
    </div>
    <div  v-if="districts.length">
      <h2 for="district">Districts</h2>
      <select class="select select-secondary w-full" id="district" v-model="selectedDistrict" @change="fetchWards">
        <option value="">Chọn huyện</option>
        <option v-for="district in districts" :key="district.code" :value="district.code">
          {{ district.name }}
        </option>
      </select>
    </div>
    <div  v-if="wards.length">
      <h2 for="ward">Ward</h2>
      <select class="select select-secondary w-full" id="ward" v-model="selectedWard" @change="emitFullAddress">
        <option value="">Chọn xã</option>
        <option v-for="ward in wards" :key="ward.code" :value="ward.code">
          {{ ward.name }}
        </option>
      </select>
    </div>
  </div>
</template>
<style scoped></style>