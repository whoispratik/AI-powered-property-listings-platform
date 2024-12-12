<template>
    Hello
    <p>{{ message }}</p>
</template>

<script setup>
defineProps({
    message: "string",
});
</script>
