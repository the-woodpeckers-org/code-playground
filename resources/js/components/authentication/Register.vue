<script>
export default {
    name: "Register"
}
</script>

<template>
    <form>
        <div class="w-full my-3 grid grid-cols-6">
            <span class="col-span-1"></span>
            <div class="col-span-4">
                <label class="font-bold my-auto">Email</label>
                <input type="email" class="border rounded p-1 w-full my-auto mb-2" placeholder="example@email.com">
                <label class="font-bold my-auto">First name</label>
                <input type="text" class="border rounded p-1 w-full my-auto mb-2" placeholder="John">
                <label class="font-bold my-auto">Last name</label>
                <input type="text" class="border rounded p-1 w-full my-auto mb-2" placeholder="Doe">
                <label class="font-bold my-auto">Phone number</label>
                <input type="tel" class="border rounded p-1 w-full my-auto mb-2" placeholder="+8412345678">
                <label class="font-bold my-auto">Phone number</label>
                <input type="text" class="border rounded p-1 w-full my-auto mb-2" placeholder="36 La Xuan Oai st., Thu Duc City, HCM City">
                <label class="font-bold my-auto">Gender</label>
                <div class="mb-2">
                    <input id="male-gender" type="radio" name="gender" value="male" class="border rounded p-1 me-3 my-auto">
                    <label for="male-gender">Male</label>
                    <br>
                    <input id="female-gender" type="radio" name="gender" value="female" class="border rounded p-1 me-3 my-auto">
                    <label for="female-gender">Female</label>
                    <br>
                    <input id="none-gender" type="radio" name="gender" value="none" class="border rounded p-1 me-3 my-auto">
                    <label for="female-gender">Prefer not to say</label>
                    <br>
                </div>
                <label class="font-bold my-auto">Password</label>
                <input type="password" class="border rounded p-1 w-full my-auto mb-2">
                <label class="font-bold my-auto">Confirm password</label>
                <input type="password" class="border rounded p-1 w-full my-auto mb-2">
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">I agree to our terms and conditions</label>
                <br>
                <input class="p-1 me-3" type="checkbox">
                <label class="my-auto">Receive our newest information</label>
                <br>
                <div class="text-center my-3">
                    <button type="button" class="rounded bg-amber-300 hover:bg-amber-600 p-2">Sign Up</button>
                </div>
            </div>
            <span class="col-span-1"></span>
        </div>
    </form>
</template>

<style scoped>

</style>
