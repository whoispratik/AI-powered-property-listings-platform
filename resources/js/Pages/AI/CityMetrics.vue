<template>
    <div class="mb-4">
  
    </div>
    <Box>
   <template #header>LifeStyle Expect predictor</template>
   <form  @submit.prevent.stop="check"
   >
   <section class="flex items-center gap-2 my-4">
    <!-- City -->
    <div>
      <label class="label">City</label>
      <select v-model="form.city" class="input" required>
        <option value="" disabled>Select the city your property is located at</option>
        <option v-for="city in validCities">{{city}}</option>
        </select>
    </div>
      <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="isProcessing">
        <span v-if="!isProcessing">Check</span>
        <span v-else>Processing...</span>
      </button>
    </section>
      </form>
  </Box>
  <!-- placeholde where i will show the result-->
  <Box class="mt-4"  v-if="toggleStatus">
    <div class="flex items-center mb-5">
    <p class="bg-blue-100 text-blue-800 text-sm font-semibold inline-flex items-center p-1.5 rounded-sm dark:bg-blue-200 dark:text-blue-800">{{metricVal.overall}}</p>
    <p class="ms-2 font-medium text-gray-900 dark:text-white">
        <span v-if="metricVal.overall >=8">Excellent</span>
        <span v-else-if="metricVal.overall >=6">Good</span>
        <span v-else-if="metricVal.overall >=4">Satisfactory</span>
        <span v-else>Poor</span>
    </p>
    <span class="w-1 h-1 mx-2 bg-gray-900 rounded-full dark:bg-gray-500"></span>
    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Our AI aims to provide useful and accurate responses, but it’s not immune to errors. Always trust your instincts and verify information when it matters most.</p>
    <a href="#" class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500"></a>
</div>
<div class="gap-8 sm:grid sm:grid-cols-2" >
    <div>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Education</dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded-sm h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded-sm dark:bg-blue-500" :style="{ width: metricVal.education * 10 + '%' }"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{metricVal.education}}</span>
            </dd>
        </dl>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">HealthCare</dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded-sm h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded-sm dark:bg-blue-500" :style="{ width: metricVal.healthcare * 10 + '%' }"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{metricVal.healthcare}}</span>
            </dd>
        </dl>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Infrastructure</dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded-sm h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded-sm dark:bg-blue-500" :style="{ width: metricVal.infrastructure * 10 + '%' }"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{metricVal.infrastructure}}</span>
            </dd>
        </dl>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Economy</dt>
            <dd class="flex items-center">
                <div class="w-full bg-gray-200 rounded-sm h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded-sm dark:bg-blue-500" :style="{ width: metricVal.economy * 10 + '%' }"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ metricVal.economy }}</span>
            </dd>
        </dl>
    </div>
    <div>
        <dl>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Safety</dt>
            <dd class="flex items-center mb-3">
                <div class="w-full bg-gray-200 rounded-sm h-2.5 dark:bg-gray-700 me-2">
                    <div class="bg-blue-600 h-2.5 rounded-sm dark:bg-blue-500" :style="{ width: metricVal.safety * 10 + '%' }"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{metricVal.safety}}</span>
            </dd>
        </dl>
    </div>
</div>
    </Box>
  </template>
  <script setup>
  const prop=defineProps({
      listing: Object,
  });
  import Box from '@/Components/UI/Box.vue';
  import { computed, ref } from 'vue';
  const form=ref({
    city: '',
    price: 10000000,
})
const isProcessing = ref(false);
const predictedValue = ref(null);
const toggleStatus = ref(false);
const metricVal = computed(()=>{
      if(predictedValue.value){
        return Object.fromEntries(
        Object.entries(predictedValue.value).map(([key, value]) => 
            [key, typeof value === 'number' ? parseFloat((value * 10).toFixed(2)) : value]
        )
    );
        }
})
const validCities = ['Banepa', 'Bhaktapur', 'Bharatpur', 'Biratnagar', 'Birgunj', 'Butwal',
 'Damangadhi', 'Dharan', 'Dhulikhel', 'Ghorahi', 'Gorkha', 'Hetauda', 'Itahari', 'Janakpur',
  'Kathmandu', 'Kirtipur', 'Lalitpur', 'Lamahi', 'Mechinagar', 'Nepalgunj', 'Panauti', 'Pokhara', 
  'Putalibazar', 'Siddharthanagar', 'Tansen', 'Tikapur', 'Tulsipur'];

  async function check(){
    isProcessing.value=true;
    toggleStatus.value=false;
    let data = {
        city: form.value.city,
        price: form.value.price
    }
    let response = await fetch('http://127.0.0.1:9000/rating', {
        method: 'POST',
        headers: {
    'Content-Type': 'application/json;charset=utf-8'
  },
  body: JSON.stringify(data)
});
let result = await response.json();
isProcessing.value = false;
predictedValue.value = result;
if(metricVal.value){
    toggleStatus.value =  true;
    console.log(result);
}
  }
  </script>