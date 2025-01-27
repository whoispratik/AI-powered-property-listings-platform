<template>
    <!---
    <Link href="/listing">View Listings</Link>&nbsp;
    <Link href="/listing/create">Create Listings</Link>
    <div v-if="flashSuccess" class="alert alert-success">
        {{ flashSuccess }}
    </div>
--->
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link href="/listing">Listings</Link>
                </div>
                <div
                    class="text-xl text-fuchsia-600 dark:text-fuchsia-300 font-bold text-center"
                >
                    <Link href="/listing">EstateInsight</Link>
                </div>
                <div v-if="user" class="flex items-center gap-4">
                    <Link class="text-sm text-gray-500" href="/realtor/listing">
                        Welcome {{ user.name }}
                    </Link>
                    <Link href="/realtor/listing/create" class="btn-primary"
                        >+ New Listing</Link
                    >
                    <Link href="/logout" class="btn-primary">Logout</Link>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link href="/user-account/create" class="btn-primary"
                        >Register</Link
                    >
                    <Link href="/login" class="btn-primary">Login</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
        >
            {{ flashSuccess }}
        </div>
        <div
            v-if="error"
            class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2"
        >
            {{ error }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed, watch } from "vue";
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
const error = computed(() => page.props.flash.error);
const user = computed(() => page.props.user);
watch(error, (value) => {
    if (value) {
        setTimeout(() => {
            page.props.flash.error = null;
        }, 5000);
    }
});
watch(flashSuccess, (value) => {
    if (value) {
        setTimeout(() => {
            page.props.flash.success = null;
        }, 5000);
    }
});
</script>
