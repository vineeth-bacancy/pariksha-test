<template>
    <span>{{ timeAgo }}</span>
</template>

<script setup>
import { computed } from "vue";

// Props
const props = defineProps({
    date: String,
});

// Computed property to calculate time ago
const timeAgo = computed(() => {
    const diff = (new Date() - new Date(props.date)) / 1000;
    if (diff < 60) return `${Math.round(diff)} seconds ago`;
    else if (diff < 3600)
        return `${Math.round(diff / 60)} minute${
            Math.round(diff / 60) > 1 ? "s" : ""
        } ago`;
    else if (diff < 86400)
        return `${Math.round(diff / 3600)} hour${
            Math.round(diff / 3600) > 1 ? "s" : ""
        } ago`;
    else
        return `${Math.round(diff / 86400)} day${
            Math.round(diff / 86400) > 1 ? "s" : ""
        } ago`;
});
</script>
