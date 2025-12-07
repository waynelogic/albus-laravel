<script setup lang="ts">
import { ServiceCategory } from "@/types";

defineProps<{
    category: ServiceCategory;
}>();
</script>

<template>
    <article class="group/service-card relative flex flex-col rounded-3xl bg-white/40 shadow-lg ring-1 ring-black/5 backdrop-blur-sm duration-150 overflow-hidden hover:translate-y-1 hover:bg-white/70 hover:shadow hover:backdrop-blur-xs">
        <a class="absolute inset-0" href="/blog/gdpr-is-just-a-suggestion-a-guide-to-european-privacy-laws">

        </a>
        <div class="flex flex-1 flex-col p-6">
            <component :is="category.icon" weight="duotone" class="size-14 text-primary-600 group-hover/service-card:animate-wobble-vertical" />
            <div class="mt-2 text-lg/7 font-medium">
                {{ category.name }}
            </div>
            <div class="mt-2 flex-1 text-sm/6 text-balance text-gray-600">
                {{ category.preview_text }}
            </div>
        </div>
    </article>
</template>

<style scoped></style>
