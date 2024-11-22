<template>
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">User Management</h3>
        <div class="flex flex-wrap gap-[0.45]">
            <div class="flex items-center w-full sm:w-1/2 md:w-1/2">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Filter by the role</span>
                    </div>
                    <select class="select select-bordered">
                        <option disabled selected>Pick one</option>
                        <option>User</option>
                        <option>Employers</option>
                    </select>
                </label>
            </div>
           
        </div>
        <div class="mt-3"></div>
        <table class="table">
        <thead>
          <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
            <th>User</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
            <UserItemM v-for="(item, index) in this.listUser" :key="index" :user="item.name" :email="item.email" :phone="item.phone_number" :role="item.role" ></UserItemM>
        </tbody>
      </table>
    </div>
</template>

<script>
import { HTTP } from "@/http-common.js";
import UserItemM from "@/components/listItems/Management/UserItemM.vue";
export default {
    name: "UseAdmin",
    components: {
        UserItemM
    },
    data() {
        return {
            listUser: [],
            listFilter: []
        }
    },
    methods: {
      async  getUsers() {
           await HTTP.get('/api/getAllUser')
                .then(response => {
                    this.listUser = response.data.data;
                    this.listUser = this.listUser;
                    console.log(this.listUser);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    },
    async mounted() {
     await  this.getUsers();
    }
}
</script>

<style></style>
