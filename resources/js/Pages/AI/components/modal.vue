<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-gray-500/75" aria-hidden="true"></div>

  <!-- Modal container -->
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!-- Modal panel -->
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex w-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0">
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-base font-semibold text-gray-900" id="modal-title"> Predicted Price: <Price :price="props.price"></Price></h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                    Our AI aims to provide useful and accurate responses, but it’s not immune to errors. Always trust your instincts and verify information when it matters most.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button @click="$emit('toogleModal')" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
            ok
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

</template>
<script setup>
import { defineProps } from 'vue';
import Price from '@/Components/Price.vue';
const props=defineProps({
    price: Number,
})
</script>