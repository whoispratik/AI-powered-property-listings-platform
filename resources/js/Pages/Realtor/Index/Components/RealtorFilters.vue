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
            </div>
        </div>
    </form>
</template>
<script setup>
import { reactive, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
defineProps({ listings: Array });
const filterForm = reactive({
    deleted: false,
});
// the reason we are using debounce is to prevent the server from being overwhelmed with requests so the method will only be called once every 1000ms of inactivity
watch(
    filterForm,
    debounce((newVal, oldVal) => {
        console.log(newVal, oldVal);
        router.get("/realtor/listing", filterForm, {
            preserveState: true,
            preserveScroll: true,
        });
    }, 1000)
);
</script>
