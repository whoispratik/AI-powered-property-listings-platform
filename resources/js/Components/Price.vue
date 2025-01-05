<template>
    <span>{{ formattedPrice }}</span>
</template>
<script setup>
import { computed } from "vue";
const props = defineProps({
    price: [Number, String],
});
const formattedPrice = computed(() =>
    /*
    Number(props.price).toLocaleString("hi", {
        style: "currency",
        currency: "INR",
        maximumFractionDigits: 0,
    })
       
        "रु " +
        Number(props.price).toLocaleString("ne", {
            maximumFractionDigits: 0,
        })
            */
    Number(props.price).toLocaleString("hi", {
        style: "currency",
        currency: "NPR",
        maximumFractionDigits: 0,
    })
);
</script>
