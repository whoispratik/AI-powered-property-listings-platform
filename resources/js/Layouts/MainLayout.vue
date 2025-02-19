<template>
    <!---
    <Link href="/listing">View Listings</Link>&nbsp;
    <Link href="/listing/create">Create Listings</Link>
    <div v-if="flashSuccess" class="alert alert-success">
        {{ flashSuccess }}
    </div>
--->
<nav class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button @click="smallScreenMenuToggle" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:text-white " aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg v-if="!smallScreenMenu" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg v-else class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
    <div
                    class="text-xl text-fuchsia-600 dark:text-fuchsia-300 font-bold text-center"
                >
                    <Link href="/">EstateInsight</Link>
                </div>
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-800 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <Link href="/listing" :class="{'bg-gray-800 text-white' : $page.url === '/listing'}" class="rounded-md  px-3 py-2 text-sm font-medium text-white">Listings</Link>
            <Link href="/ai" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">AI Tools</Link>
            <Link href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Reports</Link>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <Link v-if="user" href="/realtor/notification" as="button" :class="{'rounded-full bg-gray-800':$page.url === '/realtor/notification'}" class="relative  p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
          </svg>
          <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
              {{ notificationCount }}
            </div>
        </Link>

        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div v-if="user">
            <button ref="toggleRef" @click="dropdownProfileToggle" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
               <span class="size-8 rounded-full bg-fuchsia-500 text-amber-50 text-xl">{{ user.name[0]}}</span> 
            </button>
          </div>
          <div v-else-if="smAndLarger">
            <div class="relative flex gap-3">
                <Link href="/user-account/create" class="btn-primary"
                >Register</Link
                >
                <Link href="/login" class="btn-primary">Login</Link>
            </div>
          </div>

          <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div ref="dropdownRef" v-show="isProfileDropdown && user" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md  dark:border-gray-700 bg-white dark:bg-gray-900 py-1 ring-1 shadow-lg dark:text-gray-300 ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-700 outline-hidden", Not Active: "" -->
            <Link href="/realtor/listing" :class="{'dark:bg-gray-700 outline-hidden' : $page.url ==='/realtor/listing'}" class="block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Listings</Link>
            <Link href="/realtor/listing/create" :class="{'dark:bg-gray-700 outline-hidden' : $page.url === '/realtor/listing/create'}" class="block px-4 py-2 text-sm text-gray-5" role="menuitem" tabindex="-1" id="user-menu-item-1">+ New Listing</Link>
            <Link href="/logout" class="block px-4 py-2 text-sm " role="menuitem" tabindex="-1" id="user-menu-item-2">Log out</Link>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div v-if="smallScreenMenu"  id="mobile-menu">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <Link href="/listing" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" >Listings</Link>
      <Link href="/ai" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Ai Tools</Link>
      <Link href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Reports</Link>
      <template v-if="!user">
          <Link href="/user-account/create" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Register</Link>
          <Link href="/login" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Login</Link>
        </template>
    </div>
  </div>
</nav>

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
import { computed, ref, watch ,useTemplateRef, onMounted } from "vue";
import { breakpointsTailwind, useBreakpoints  , onClickOutside} from "@vueuse/core";

const breakpoints = useBreakpoints(breakpointsTailwind);
const smAndLarger =  breakpoints.greaterOrEqual('sm');

const dropdownRef = ref(null);
const toggleRef = ref(null);

onMounted(() => {
  onClickOutside(dropdownRef, event => {
      if (isProfileDropdown.value) {
          isProfileDropdown.value = false
      }
  },{capture: true, ignore: [toggleRef]})
})


const isProfileDropdown=ref(false);
const smallScreenMenu=ref(false);
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
const error = computed(() => page.props.flash.error);
const user = computed(() => page.props.user);

function dropdownProfileToggle(){
    isProfileDropdown.value=!isProfileDropdown.value;
}
function smallScreenMenuToggle(){
    smallScreenMenu.value=!smallScreenMenu.value;
}
function activeChecker(url){
    return $path.url === url
}
const notificationCount = computed(
  () => Math.min(page.props.user?.notificationCount, 9),
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
