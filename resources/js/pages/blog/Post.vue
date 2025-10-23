<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BlogPost, BreadcrumbItem } from '@/types';
import { BreadcrumbItems } from '@/layouts/app';

const props = defineProps<{
    post: BlogPost;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Главная",
        href: "/",
    },
    {
        title: "Блог",
        href: "/blog",
    },
    {
        title: 'Запись',
        href: `/blog/${props.post.slug}`,
    },
];
</script>

<template>
    <AppLayout :title="post.title">
        <section class="relative">
            <div class="absolute h-10/12 w-full bg-primary-300"></div>
            <div class="relative container">
                <BreadcrumbItems :breadcrumbs="breadcrumbs" class="mb-4 pt-4" />
                <div class="group relative overflow-hidden rounded-xl shadow-lg duration-300 hover:shadow-xl">
                    <div class="absolute inset-0 bg-white/20 opacity-0 backdrop-blur-sm duration-300 group-hover:opacity-50"></div>
                    <img :src="post.cover_url" :alt="post.title" class="aspect-[2/1] w-full object-cover duration-300 xl:aspect-[5/2]" />
                </div>
            </div>
        </section>
        <section>
            <div class="container py-12">
                <h1 class="mb-2 font-serif text-4xl font-semibold">{{ post.title }}</h1>
                <div class="mb-2">
                    <span class="text-base font-bold text-primary-950">{{ new Date(post.published_at).toLocaleDateString() }}</span>
                </div>
                <div class="prose max-w-none" v-html="post.content"></div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
