<script setup>
defineProps({
    title: {
        type: String,
        isRequired: true,
    },
});
</script>

<template>
    <div class="section-header">
        <h1>{{ title }}</h1>
        <slot />
    </div>
</template>
