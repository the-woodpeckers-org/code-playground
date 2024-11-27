<template>
    <div class="p-2 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-left py-4">User Management</h3>
        <div class="flex flex-wrap gap-2">
            <div class="flex items-center w-full sm:w-1/2 md:w-1/2">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Filter by the role</span>
                    </div>
                    <select class="select select-bordered" v-model="selectedRole" @change="filterUsers">
                        <option value="" disabled selected>Pick one</option>
                        <option value="User">User</option>
                        <option value="contributor">Contributor</option>
                        <option value="company">Company</option>
                        <option value="All">All</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="overflow-x-auto">


            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-zinc-900 text-md md:text-lg lg:text-xl font-semibold">
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <UserItemM v-for="item in filteredUsers" :key="item.id" :user="item.name" :email="item.email"
                        :phone="item.phone_number" :role="item.role"></UserItemM>
                </tbody>
            </table>
        </div>
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
            filteredUsers: [],
            openId: null,
            selectedRole: ""
        };
    },
    methods: {
        async getUsers() {
            try {
                const response = await HTTP.get('/api/getAllUser');
                this.listUser = response.data.data;
                this.filteredUsers = this.listUser;
            } catch (e) {
                console.error("Error fetching users:", e);
            }
        },
        setOpenId(id) {
            this.openId = this.openId === id ? null : id; // Toggle openId if the same item is clicked
        },
        filterUsers() {
            if(this.selectedRole === "All") {
                this.filteredUsers = this.listUser;
                return;
            }
            this.filteredUsers = this.selectedRole
                ? this.listUser.filter(user => user.role === this.selectedRole)
                : this.listUser;
        }
    },
    async mounted() {
        await this.getUsers();
    }
};
</script>
