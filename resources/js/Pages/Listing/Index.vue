<template>
    <Filter></Filter>
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
            <div>
                <Link :href="`/listing/${listing.id}/edit`">Edit</Link>
            </div>
            <div>
                <Link
                    :href="`/listing/${listing.id}`"
                    method="DELETE"
                    as="button"
                >
                    Delete
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
});
</script>
