<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">E-mail (username)</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="input"
                />
                <div v-if="form.errors.email" class="input-error">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="input"
                />
                <div v-if="form.errors.password" class="input-error">
                    {{ form.errors.password }}
                </div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Login</button>
            </div>
            <div class="mt-2">
                <label class="flex items-center text-sm text-gray-500">
                    <input
                        type="checkbox"
                        v-model="form.remember"
                        class="mr-2 rounded border-gray-300"
                    />
                    Remember Me
                </label>
            </div>
            <div class="mt-2 text-center">
                <Link href="/user-account/create" class="text-sm text-gray-500">
                    Need an account? Click here
                </Link>
            </div>
        </div>
    </form>
</template>
<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
    remember:false
});
const login = () => form.post("/login");
</script>
