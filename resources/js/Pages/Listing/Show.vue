<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div v-if="listing.images.length" class="grid grid-cols-2 gap-1">
        <img
          v-for="image in listing.images" :key="image.id"
          :src="image.src"
        />
      </div>
      <div v-else class="w-full text-center font-medium text-gray-500">No images</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header> Basic info </template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #header>Additional Information</template>
                    <span class="font-bold">Parking: </span>
                    <span class="text-gray-400">{{ listing.parking ? 'Yes' : 'No' }}</span>
                    &nbsp;
                    <span class="font-bold">Facing: </span>
                    <span class="text-gray-400">{{ listing.facing }}</span>
                    &nbsp;
                    <span class="font-bold">Road Access: </span>
                    <span class="text-gray-400">{{ listing.road_access ? 'Yes' : 'No' }}</span>
            </Box>
            <Box>
                <template #header> Monthly Payment </template>
                <div>
                    <label class="label"
                        >Interest rate ({{ interest }} %)</label
                    >
                    <input
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        v-model.number="interest"
                    />
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        type="range"
                        min="3"
                        max="35"
                        step="1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        v-model="duration"
                    />
                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>
                </div>
                <div class="mt-2 text-gray-500">
                    <div class="flex justify-between">
                        <div>Total paid</div>
                        <div>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Principal paid</div>
                        <div>
                            <Price :price="thereIsOffer?offer:listing.price" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Interest paid</div>
                        <div>
                            <Price :price="totalInterest" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>
            <!-- issue might persist in conditional rendering so analyze all cases-->
            <MakeOffer 
            v-if="(!isOwner && user) && !offerMadeByMe" :listing-id="listing.id" 
            :price="listing.price"
            @offer-change="emitHandler"
            ></MakeOffer>
           <OfferMade v-else-if="offerMadeByMe" :offer="offerMadeByMe"></OfferMade>
        </div>
    </div>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import ListingAddress from "@/Components/ListingAddress.vue";

import Box from "@/Components/UI/Box.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";
import { ref,computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import MakeOffer from "./Show/Components/MakeOffer.vue";
import OfferMade from "./Show/Components/OfferMade.vue";
const page = usePage();
const interest = ref(0.1);
const duration = ref(3);
const props = defineProps({
    listing: {
        type: Object,
        required: true,
    },
    isOwner: Boolean,
    offerMadeByMe: [ Object, null],
});
const thereIsOffer = ref(false);
const offer = ref(props.listing.price);
const user = computed(() => page.props.user);
function emitHandler(newOffer){
    offer.value= newOffer;
    thereIsOffer.value=true;
}
const { monthlyPayment, totalInterest, totalPaid } = useMonthlyPayment(
    offer,
    interest,
    duration
);
</script>
