<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    type="text"
                    placeholder="Price from"
                    class="input-filter-l w-28"
                    v-model.number="filterForm.priceFrom"
                />
                <input
                    type="text"
                    placeholder="Price to"
                    class="input-filter-r w-28"
                    v-model.number="filterForm.priceTo"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select class="input-filter-l w-28" v-model="filterForm.beds">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
                <select class="input-filter-r w-28" v-model="filterForm.baths">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    type="text"
                    placeholder="Area from"
                    class="input-filter-l w-28"
                    v-model.number="filterForm.areaFrom"
                />
                <input
                    type="text"
                    placeholder="Area to"
                    class="input-filter-r w-28"
                    v-model.number="filterForm.areaTo"
                />
            </div>
            <button type="submit" class="btn-normal">Filter</button>
            <button type="reset" @click="clear">Clear</button>
        </div>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    filters: {
        type: Object,
        required: true,
    },
});
//initially if the user just visits the /listing page the filters prop will be an empty array  and hence all the properties will be null because of undefined ?? null
const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
});
function filter() {
    filterForm.get("/listing", {
        preserveState: true,
        preserveScroll: true,
    });
}
function clear() {
    filterForm.priceFrom =
        filterForm.priceTo =
        filterForm.beds =
        filterForm.baths =
        filterForm.areaFrom =
        filterForm.areaTo =
            null;
    filter();
}
</script>
