<template>
    <!---
    <Link href="/listing">View Listings</Link>&nbsp;
    <Link href="/listing/create">Create Listings</Link>
    <div v-if="flashSuccess" class="alert alert-success">
        {{ flashSuccess }}
    </div>
--->
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full"
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
                <div>
                    <Link
                        href="/listing/create"
                        class="bg-fuchsia-600 hover:bg-fuchsia-500 text-white font-medium p-2 rounded-md"
                        >+ New Listing</Link
                    >
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
        >
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
</script>
