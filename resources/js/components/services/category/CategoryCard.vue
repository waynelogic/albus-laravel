<script setup lang="ts">
import { ServiceCategory } from "@/types";

defineProps<{
    category: ServiceCategory;
}>();
</script>

<template>
    <article class="group/service-card relative flex flex-col rounded-3xl bg-white/40 p-2 shadow-lg ring-1 ring-black/5 backdrop-blur-sm duration-300 hover:translate-y-1 hover:bg-white/70 hover:backdrop-blur-xs">
        <div class="flex flex-1 flex-col p-4">
            <component :is="category.icon" weight="duotone" class="group-hover/service-card:animate-wobble-vertical size-14 text-primary-600" />
            <div class="mt-2 text-lg/7 font-medium">
                <a href="/blog/gdpr-is-just-a-suggestion-a-guide-to-european-privacy-laws">
                    {{ category.name }}
                </a>
            </div>
            <div class="mt-2 flex-1 text-sm/6 text-balance text-gray-600">
                {{ category.preview_text }}
            </div>
        </div>
    </article>
</template>

<style scoped></style>
