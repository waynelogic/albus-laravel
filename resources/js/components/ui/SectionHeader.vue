<script setup lang="ts">
defineProps<{
    title: string;
    subtitle?: string;
    center?: boolean;
}>();
</script>

<template>
    <header :class="[center ? 'mx-auto max-w-2xl text-center' : '', 'flex flex-col gap-2']">
        <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl dark:text-white">{{ title }}</h2>
        <p v-if="subtitle" class="mt-2 text-lg/8 text-gray-700 dark:text-gray-300">{{ subtitle }}</p>
        <slot />
    </header>
</template>

<style scoped></style>
