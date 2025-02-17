<template>
    <span>
     {{ listing.city }}
    </span>
</template>
<script setup>
const props = defineProps({
    listing: Object,
});
</script>
