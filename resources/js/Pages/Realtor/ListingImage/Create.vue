<template>
  <div class="mb-4">
    <Link 
      href="/realtor/listing"
    >
      ← Go back to Listings
    </Link>
  </div>
  <Box>
 <template #header>Upload New Images</template>
 <form  @submit.prevent="upload"
 >
 <section class="flex items-center gap-2 my-4">
  <div v-if="Object.keys(form.errors).length" class="input-error">
                 <span>The file should be an image</span>
                </div>
    <input type="file" class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700
     file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium
      file:hover:bg-gray-200 file:dark:hover:bg-gray-700
       file:hover:cursor-pointer file:mr-4" multiple  @input="form.images=$event.target.files" ref="fileInput"/>
    <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="form.processing || !canUpload">
      <span v-if="!form.processing">Upload</span>
      <span v-else>Uploading...</span>
    </button>
    <button @click.stop.prevent="reset" :disabled="form.processing || !canUpload" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed">
      Reset
    </button>
  </section>
    </form>
</Box>
<Box v-if="listing.images.length" class="mt-4">
    <template #header>Current Listing Images</template>
    <section class="mt-4 grid grid-cols-3 gap-4">
      <div v-for="image in listing.images" :key="image.id" 
       class="flex flex-col justify-between">
        <img :src="image.src" class="rounded-md" />
        <Link 
          :href="`/realtor/listing/${listing.id}/image/${image.id}`"
          method="delete"
          as="button"
          class="mt-2 btn-outline text-xs"
        >
          Delete
        </Link>
      </div>
    </section>
  </Box>
</template>
<script setup>
const prop=defineProps({
    listing: Object,
});
import Box from '@/Components/UI/Box.vue';
import {useForm} from '@inertiajs/vue3';
import { ref,computed } from 'vue';
import {Link} from '@inertiajs/vue3';
const form=useForm({
    images:[],
});
const fileInput=ref(null);
const canUpload=computed(()=>form.images.length>0);
function upload(){
 form.post(`/realtor/listing/${prop.listing.id}/image`,{
     onSuccess:()=>reset(),
 });
}
function reset(){
    form.reset('images'); // this would make form.images an empty array
    if(fileInput.value){ //  this would reset the file input
        fileInput.value.value='';
    }
}
</script>