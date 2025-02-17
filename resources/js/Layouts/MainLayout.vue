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
                    <Link href="/">EstateInsight</Link>
                </div>
                <div v-if="user" class="flex items-center gap-4">
                    <Link class="text-gray-500 relative pr-2 py-2 text-lg" href="/realtor/notification">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M10.268 21a2 2 0 0 0 3.464 0"/><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/></svg>
            <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
              {{ notificationCount }}
            </div>
        </Link>
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
const notificationCount = computed(
  () => Math.min(page.props.user.notificationCount, 9),
)
watch(error, (value) => {
    if (value) {
        setTimeout(() => {
            page.props.flash.error = null;
        }, 5000);
    }
},
{ immediate: true });
watch(flashSuccess, (value) => {
    if (value) {
        setTimeout(() => {
            page.props.flash.success = null;
        }, 5000);
    }
});
</script>
