<template>
<form @submit.prevent.stop="create">
  <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
    <!-- Beds -->
    <div class="col-span-1 md:col-span-2">
      <label class="label">Beds</label>
      <input type="text" v-model.number="form.beds" class="input" />
      <div v-if="form.errors.beds" class="input-error">
        {{ form.errors.beds }}
      </div>
    </div>

    <!-- Baths -->
    <div class="col-span-1 md:col-span-2">
      <label class="label">Baths</label>
      <input type="text" v-model.number="form.baths" class="input" />
      <div v-if="form.errors.baths" class="input-error">
        {{ form.errors.baths }}
      </div>
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
      <div v-if="form.errors.parking" class="input-error">
        {{ form.errors.parking }}
      </div>
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
      <div v-if="form.errors.road_access" class="input-error">
        {{ form.errors.road_access }}
      </div>
    </div>

    <!-- Area -->
    <div class="col-span-1 md:col-span-3">
      <label class="label">Area</label>
      <input type="text" v-model.number="form.area" class="input" />
      <div v-if="form.errors.area" class="input-error">
        {{ form.errors.area }}
      </div>
    </div>

    <!-- Unit -->
    <div class="col-span-1 md:col-span-3">
      <label class="label">Unit</label>
      <select v-model="form.unit" class="input">
        <option value="ropani">Ropani</option>
        <option value="aana">Aana</option>
      </select>
      <div v-if="form.errors.unit" class="input-error">
        {{ form.errors.unit }}
      </div>
    </div>

    <!-- City -->
    <div class="col-span-1 md:col-span-4">
      <label class="label">City</label>
      <input type="text" v-model="form.city" class="input" />
      <div v-if="form.errors.city" class="input-error">
        {{ form.errors.city }}
      </div>
    </div>

    <!-- Facing -->
    <div class="col-span-1 md:col-span-2">
      <label class="label">Facing</label>
      <select v-model="form.facing" class="input">
        <option value="North">North</option>
        <option value="South">South</option>
        <option value="East">East</option>
        <option value="West">West</option>
        <option value="Northeast">North East</option>
        <option value="Northwest">North West</option>
        <option value="Southeast">South East</option>
        <option value="Southwest">South West</option>
      </select>
      <div v-if="form.errors.facing" class="input-error">
        {{ form.errors.facing }}
      </div>
    </div>

    <!-- Price -->
    <div class="col-span-1 md:col-span-6">
      <label class="label">Price</label>
      <input type="text" v-model="form.price" class="input" />
      <div v-if="form.errors.price" class="input-error">
        {{ form.errors.price }}
      </div>
    </div>

    <!-- Submit Button -->
    <div class="col-span-1 md:col-span-6">
      <button
        type="submit"
        class="btn-primary disabled:opacity-25 disabled:cursor-not-allowed"
        :disabled="form.processing"
      >
        <span v-if="!form.processing">Create</span>
        <span v-else>Creating...</span>
      </button>
    </div>
  </div>
</form>

</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    price: 0,
    unit: null,
    parking: false,
    facing: null,
    road_access: false,

});
const create = () => {
    form.post("/realtor/listing");
};
</script>
<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px;
}
</style>
