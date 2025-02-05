<template>
    <Box>
      <template #header>Make an Offer</template>
      <div>
        <form @submit.prevent.stop="submitForm">
          <input v-model.number="form.amount" type="text" class="input"/>
          <input
            v-model.number="form.amount"
            type="range" :min="min"
            :max="max" step="10000"
            class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />
          <button type="submit" class="btn-outline w-full mt-2 text-sm">
            Make an Offer
          </button>
        </form>
      </div>
      <div class="flex justify-between text-gray-500 mt-2">
        <div>Difference</div>
        <div>
          <Price :price="difference" />
        </div>
      </div>
    </Box>
  </template>
  <script setup>
  import Price from '@/Components/Price.vue'
  import Box from '@/Components/UI/Box.vue'
  import { useForm } from '@inertiajs/vue3'
  import { computed,watch } from 'vue'
  const emit=defineEmits(['offerChange']);
  const props = defineProps({
    listingId: Number,
    price: Number,
  })
  const form = useForm({
    amount: props.price,
  })
  function submitForm(){
    form.post(`/listing/${props.listingId}/offer`,{
        preserveState:true,
        preserveScroll:true
    })
  }
  const difference = computed(() => form.amount - props.price); // the difference is being calculate using the amount offered minus the original fixed price
  const min = computed(() => Math.round(props.price / 2)); // there wont be recomputation of min and max since props wont change 
  const max = computed(() => Math.round(props.price * 2));
  watch(() => form.amount,(newVal,oldVal)=>{
    emit('offerChange',newVal);
  })
  </script>