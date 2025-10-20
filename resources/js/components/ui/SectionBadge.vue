<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
withDefaults(defineProps<{
    as?: 'div' | 'span' | 'a' | 'button',
    href?: string
}>(), {
    as: 'div',
})
</script>

<template>
    <component :is="as === 'a' ? Link : as" :href="href" class="inline-flex items-center py-2 px-4 border border-primary-100 bg-primary-50 rounded-full">
        <span class="block size-4 bg-primary-600 rounded-full mr-2"></span>
        <span class="font-medium uppercase"><slot/></span>
    </component>
</template>

<style scoped>

</style>
