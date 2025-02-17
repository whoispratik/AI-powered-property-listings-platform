<template>

    <h1 class="text-3xl mb-4">Your Notifications</h1>
<section v-if="notifications.data.length" class="text-gray-700 dark:text-gray-400">
    <div v-for="notification in notifications.data" :key="notification.id" class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center">
        <div>
            <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                Offer <Price :price="notification.data.amount" /> for
                <Link
                :href="`/realtor/listing/${notification.data.listing_id}`"
                class="text-indigo-600 dark:text-indigo-400 underline"

                >listing</Link> was made
            </span>
            <span v-if="notification.type === 'App\\Notifications\\OfferAccepted'">
               You're offer  for
                <Link
                :href="`/listing/${notification.data.listing_id}`"
                class="text-green-600 dark:text-green-400 underline"
                >listing</Link> was Accepted
            </span>
            <span v-if="notification.type === 'App\\Notifications\\OfferRejected'">
               You're offer  for
                <Link
                :href="`/listing/${notification.data.listing_id}`"
                class="text-red-600 dark:text-red-400 underline"
                >listing</Link> was rejected
            </span>
        </div>
        <div>
            <Link :href="`/realtor/notification/${notification.id}`" 
            method="put" 
            as="button" 
            class="btn-outline text-xs font-medium uppercase"
            v-if="!notification.read_at" 
             >
                Mark as read
            </Link>
        </div>
    </div>
</section>
<div v-else>No notifications yet!</div>
<section
v-if="notifications.data.length" 
class="w-full flex justify-center mt-8 mb-8"
>
  <Pagniation :links="notifications.links"></Pagniation>
</section>
</template>
<script setup>
import Price from '@/Components/Price.vue'
import Pagniation from '@/Components/UI/Pagniation.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
notifications: Object,
})
</script>