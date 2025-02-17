<template>
    <Box>
      <template #header>Offer <span v-if="!offer.accepted_at && !offer.rejected_at">Made</span>
        <span v-else-if="offer.accepted_at" class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1">accepted
          </span>
        <span v-else-if="offer.rejected_at" class="dark:bg-red-900 dark:text-red-200 bg-green-200 text-red-900 p-1 rounded-md uppercase ml-1">Rejected</span>
        </template>
      <Price :price="offer.amount" class="text-3xl" />
      <section class="mt-2 flex flex-col md:flex-row justify-between text-gray-500">
        <div>Made on</div>
        <div class="font-medium">{{ offerMadeOn }}</div>
      </section>
    </Box>
  </template>
  <script setup>
  import { computed } from 'vue'
  import Price from '@/Components/Price.vue'
  import Box from '@/Components/UI/Box.vue'
  const props = defineProps({
    offer: Object,
  })
  const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString(),
  )
  </script>