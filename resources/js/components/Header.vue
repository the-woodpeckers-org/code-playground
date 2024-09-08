<script>
export default {
    methods: {
        logout() {
            let _this = this
            axios.get('/api/logout')
                .then(function (response) {
                    _this.$root.auth = null
                })
                .catch(function (error) {

                })
        }
    }
}
</script>

<template>
    <header class="bg-amber-200">
        <nav class="mx-auto max-w-7xl items-center justify-between h-10">
            <h1 class="text-center text-3xl">LIVE CODE EDITOR</h1>
        </nav>
    </header>
    <div class="w-full text-end">
        <a href="#" @click="logout" class="p-1 border rounded bg-green-200" v-if="$root.auth !== null" :data="$root.auth">Logout</a>
        <router-link class="p-1 border rounded bg-green-200" to="/login" v-if="$root.auth === null" :data="$root.auth">Login</router-link>
    </div>
</template>
<script setup>
</script>
