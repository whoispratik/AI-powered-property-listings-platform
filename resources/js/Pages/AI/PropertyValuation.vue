<template>
    <Link 
      href="/ai"
    >
      ← Go back
    </Link>
    <p class="text-xl text-center mt-2 mb-3 dark:text-gray-100">AI Property Valuation</p>
    <form @submit.prevent.stop="valuate">
  <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
    <!-- Beds -->
    <div class="col-span-1 md:col-span-2">
      <label class="label">Beds</label>
      <input type="text" v-model.number="form.beds" class="input" required/>
    </div>

    <!-- Baths -->
    <div class="col-span-1 md:col-span-2">
      <label class="label">Baths</label>
      <input type="text" v-model.number="form.baths" class="input" required/>
    </div>

    <!-- Parking Checkbox -->
    <div class="col-span-1 md:col-span-1">
      <!-- On md screens, add an empty label to align with text inputs -->
      <label class="label hidden md:block">&nbsp;</label>
      <label class="inline-flex items-center gap-2">
        <input
          type="checkbox"
          v-model="form.parking"
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        />
        Parking
      </label>

    </div>

    <!-- Road Access Checkbox -->
    <div class="col-span-1 md:col-span-1">
      <!-- On md screens, add an empty label to align with text inputs -->
      <label class="label hidden md:block">&nbsp;</label>
      <label class="inline-flex items-center gap-2">
        <input
          type="checkbox"
          v-model="form.road_access"
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        />
        Road Access
      </label>

    </div>

    <!-- Area -->
    <div class="col-span-1 md:col-span-3">
      <label class="label">Area</label>
      <input type="text" v-model.number="form.area" class="input" required/>

    </div>

    <!-- Unit -->
    <div class="col-span-1 md:col-span-3">
      <label class="label">Unit</label>
      <select v-model="form.unit" class="input" required>
        <option value="" disabled>select the unit of measurement</option>
        <option value="ropani">Ropani</option>
        <option value="aana">Aana</option>
      </select>

    </div>

    <!-- City -->
    <div class="col-span-1 md:col-span-4">
      <label class="label">City</label>
      <select v-model="form.city" class="input" required>
        <option value="" disabled>Select the city your property is located at</option>
        <option v-for="city in validCities">{{city}}</option>
        </select>
    </div>

    <!-- Facing -->
    <div class="col-span-1 md:col-span-2">
      <label class="label">Facing</label>
      <select v-model="form.facing" class="input" required>
        <option value="" disabled>select the direction your house/property faces</option>
        <option value="North">North</option>
        <option value="South">South</option>
        <option value="East">East</option>
        <option value="West">West</option>
        <option value="Northeast">North East</option>
        <option value="Northwest">North West</option>
        <option value="Southeast">South East</option>
        <option value="Southwest">South West</option>
      </select>
      
    </div>
    <div class="col-span-1 md:col-span-6">
      <label class="label">Property Age</label>
      <input type="text" v-model.number="form.age" class="input" required/>
    </div>

    <!-- Submit Button -->
    <div class="col-span-1 md:col-span-6">
      <button
        type="submit"
        class="btn-primary disabled:opacity-25 disabled:cursor-not-allowed"
        :disabled="processing"
      >
        <span v-if="!processing">Valuate</span>
        <span v-else>valuating...</span>
      </button>
    </div>
  </div>
</form>
<modal v-if="toggleStatus" :price="predictedPrice" @toogle-modal="toggleStatus = false"></modal>
</template>
<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import modal from './components/modal.vue';
const toggleStatus=ref(false);
const processing=ref(false)
const predictedPrice=ref(0);
const form=ref({
    beds: '',
    baths: '',
    area: '',
    city: '',
    unit: '',
    parking: false,
    facing: '',
    road_access: false,
    age: '',
})
const validCities=['Banepa', 'Bhaktapur', 'Bharatpur', 'Biratnagar', 'Birgunj', 'Butwal',
 'Damangadhi', 'Dharan', 'Dhulikhel', 'Ghorahi', 'Gorkha', 'Hetauda', 'Itahari', 'Janakpur',
  'Kathmandu', 'Kirtipur', 'Lalitpur', 'Lamahi', 'Mechinagar', 'Nepalgunj', 'Panauti', 'Pokhara', 
  'Putalibazar', 'Siddharthanagar', 'Tansen', 'Tikapur', 'Tulsipur'];

async function valuate(){
    processing.value=true;
    let data={
        bedrooms: form.value.beds,
        bathrooms: form.value.baths,
        area: form.value.area + ' ' + form.value.unit,
        city: form.value.city,
        parking: form.value.parking ? 'Yes' : 'No',
        facing: form.value.facing,
        road_access: form.value.road_access ? 'Yes' : 'No',
        age: form.value.age,
    }
    let response = await fetch('http://127.0.0.1:9000/predict', {
        method: 'POST',
        headers: {
    'Content-Type': 'application/json;charset=utf-8'
  },
  body: JSON.stringify(data)
});
let result = await response.json();
processing.value=false;
predictedPrice.value=result.predicted_price;
toggleStatus.value=true;
console.log(result.predicted_price)
}
</script>