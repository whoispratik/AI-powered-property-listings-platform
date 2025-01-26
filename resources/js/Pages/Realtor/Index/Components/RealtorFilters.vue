<template>
    <form>
        <div class="mb-4 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center gap-2">
                <input
                    id="deleted"
                    v-model="filterForm.deleted"
                    type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-fuchsia-600 focus:ring-fuchsia-500"
                />
                <label for="deleted">Deleted</label>
                <div>
                    <select v-model="filterForm.by" class="input-filter-l w-24">
                        <option value="created_at">Added</option>
                        <option value="price">Price</option>
                    </select>
                    <select
                        v-model="filterForm.order"
                        class="input-filter-r w-32"
                    >
                        <option
                            v-for="option in sortOptions"
                            :key="option.value"
                            :value="option.value"
                        >
                            {{ option.label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</template>
<script setup>
import { reactive, watch, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
const props = defineProps({ filters: Object });
const sortLabels = {
    created_at: [
        {
            label: "Latest",
            value: "desc",
        },
        {
            label: "Oldest",
            value: "asc",
        },
    ],
    price: [
        {
            label: "Expensive",
            value: "desc",
        },
        {
            label: "Cheapest",
            value: "asc",
        },
    ],
};
const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ?? "created_at",
    order: props.filters.order ?? "desc",
});
const sortOptions = computed(() => sortLabels[filterForm.by]);
// the reason we are using debounce is to prevent the server from being overwhelmed with requests so the method will only be called once every 1000ms of inactivity
watch(
    filterForm,
    debounce((newVal, oldVal) => {
        //  console.log(newVal, oldVal);
        router.get("/realtor/listing", filterForm, {
            preserveState: true,
            preserveScroll: true,
        });
    }, 1000)
);
</script>
