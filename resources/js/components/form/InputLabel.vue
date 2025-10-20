<script setup lang="ts">
defineProps<{
    label: string;
    required?: boolean;
    error?: string;
}>();
</script>

<template>
    <label class="flex flex-col gap-2">
        <span class="font-medium">{{ label }}<sup v-if="required" class="ml-1 text-red-600" aria-hidden="true">*</sup>:</span>
        <slot />
        <span v-if="error" class="text-red-600">{{ error }}</span>
    </label>
</template>

<style scoped></style>
