<script setup lang="ts">
import { BreadcrumbItem } from "@/types";
import { Link } from "@inertiajs/vue3";
import { PhCaretRight, PhHouse } from "@phosphor-icons/vue";

defineProps<{
    breadcrumbs: BreadcrumbItem[];
}>();
</script>

<template>
    <ol class="flex flex-wrap items-center gap-2 md:gap-3 md:text-lg">
        <li v-for="(item, index) in breadcrumbs">
            <Link class="flex min-w-0 items-center gap-2 drop-shadow-xs duration-200 hover:text-primary-500 md:gap-3" :href="item.href">
                <PhHouse v-if="index === 0" />
                <PhCaretRight v-else />
                <span class="break-all">{{ item.title }}</span>
            </Link>
        </li>
    </ol>
</template>

<style scoped></style>
