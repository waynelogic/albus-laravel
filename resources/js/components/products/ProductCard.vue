<script setup lang="ts">
import Button from "@/components/action/Button.vue";
import { money } from "@/lib/utils";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <article class="group/product-card flex flex-col overflow-hidden rounded-3xl border border-transparent bg-white p-4 shadow-low duration-300 hover:-translate-y-1 hover:shadow dark:border-neutral-700 dark:bg-neutral-800">
        <Link>
            <img src="https://mtscdn.ru/upload/iblock/75d/cmn5ki0o5dyk5laamf0idch2n77qf8gd.png" alt="" />
            <h3 class="mt-4 line-clamp-2 dark:text-white">Xiaomi Redmi 14C 8/256 Гб 4G Полночный черный</h3>
        </Link>
        <div class="mt-2 mb-2 flex items-center gap-2">
            <span class="text-xl font-bold text-primary-600">{{ money(3500) }}</span>
            <del class="text-gray-400">{{ money(4000) }}</del>
        </div>
        <Button class="mt-auto w-full" rounded="xl">
            <span>Подробнее</span>
        </Button>
    </article>
</template>

<style scoped></style>
