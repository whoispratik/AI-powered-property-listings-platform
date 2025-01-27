<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>

    <section>
        <RealtorFilters :filters="props.filters" />
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id">
            <div
                class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
            >
                <div>
                    <div class="xl:flex items-center gap-2">
                        <Price
                            :price="listing.price"
                            class="text-2xl font-medium"
                        />
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingAddress :listing="listing" />
                </div>
                <div
                    class="flex items-center gap-1 text-gray-600 dark:text-gray-300"
                >
                    <a
                        class="btn-outline text-xs font-medium"
                        :href="`/listing/${listing.id}`"
                        target="_blank"
                        >Preview</a
                    >
                    <Link
                        class="btn-outline text-xs font-medium"
                        :href="`/realtor/listing/${listing.id}/edit`"
                        >Edit</Link
                    >
                    <Link
                        class="btn-outline text-xs font-medium"
                        :href="`/realtor/listing/${listing.id}`"
                        method="DELETE"
                        as="button"
                        >Delete</Link
                    >
                </div>
            </div>
        </Box>
    </section>
    <section
        v-if="listings.data.length"
        class="w-full flex justify-center mt-4 mb-4"
    >
        <Pagniation :links="listings.links" />
    </section>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import RealtorFilters from "./Index/Components/RealtorFilters.vue";
import { Link } from "@inertiajs/vue3";
import Pagniation from "@/Components/UI/Pagniation.vue";
const props = defineProps({ listings: Object, filters: Object });
</script>
