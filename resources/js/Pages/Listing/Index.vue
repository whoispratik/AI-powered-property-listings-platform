<template>
    <Filter :filters="filters"></Filter>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box
            v-for="(listing, index) in listings.data"
            :key="index"
            class="list-group"
        >
            <div>
                <Link :href="`/listing/${listing.id}`">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <ListingSpace :listing="listing" class="text-lg" />
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </Link>
            </div>
        </Box>
    </div>
    <div
        v-if="listings.data.length"
        class="w-full flex justify-center mt-8 mb-8"
    >
        <Pagniation :links="listings.links"></Pagniation>
    </div>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import { Link } from "@inertiajs/vue3";
import Pagniation from "@/Components/UI/Pagniation.vue";
import Filter from "@/Components/Filter.vue";
defineProps({
    listings: {
        type: Object,
        required: true,
    },
    filters: {
        type: Object,
        required: true,
    },
});
/*
async function pricePredicor(){
    let data ={
        description:"i like playing sports"};
let response = await fetch(' http://127.0.0.1:9000/category_predict', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json;charset=utf-8'
  },
  body: JSON.stringify(data)
});
let result = await response.json();
console.log(result)
}
pricePredicor()
*/
</script>
