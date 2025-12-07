<script setup lang="ts">
import Button from "@/components/action/Button.vue";
import { money } from "@/lib/utils";
import { Link } from "@inertiajs/vue3";
import { Product } from '@/types';

defineProps<{
    product: Product;
}>();
</script>

<template>
    <article class="group/product-card flex flex-col overflow-hidden rounded-3xl border border-transparent bg-white p-4 shadow-low duration-300 hover:-translate-y-1 hover:shadow dark:border-neutral-700 dark:bg-neutral-800">
        <Link>
            <img class="aspect-square object-contain object-center" :src="product.cover_url" alt="" />
            <h3 class="mt-4 line-clamp-2 dark:text-white">{{ product.name }}</h3>
        </Link>
        <div class="mt-2 mb-2 flex items-center gap-2">
            <template v-if="product.main_price">
                <span class="text-xl font-bold text-primary-600">{{ money(product.main_price.price) }}</span>
                <del v-if="product.main_price.old_price" class="text-gray-400">{{ money(product.main_price.old_price) }}</del>
            </template>
            <span v-else class="text-xl font-bold text-primary-600">
                Цена по запросу
            </span>
        </div>
        <Button class="mt-auto w-full" rounded="xl">
            <span>Подробнее</span>
        </Button>
    </article>
</template>

<style scoped></style>
