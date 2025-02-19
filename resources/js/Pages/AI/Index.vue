<template>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
            <Box>
                <template #header>Ai Property Valuation</template>
                <p>Our inhouse ml model that has been trained on nepali properties datasets to predict the price of your property</p>
                <Link href="/ai/propertyvaluation" as="button" class="btn-primary mt-2">more.. </Link>
            </Box>
            <Box>
                <template #header>Ai City Metrics</template>
                <p>Our inhouse ml model that has been trained on nepali properties 
                    datasets with just the information about the city and  the price of your property we can 
                    predict the kind of lifestyle you can expect
                </p>
                <Link  href="/ai/metrics" as="button" class="btn-primary mt-2" > more..</Link>
            </Box>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue';
</script>
