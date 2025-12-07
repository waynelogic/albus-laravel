<script setup lang="ts">
import blog from "@/routes/blog";
import { BlogPost } from "@/types";
import { Link } from "@inertiajs/vue3";

defineProps<{
    post: BlogPost;
}>();
</script>

<template>
    <article class="group/blog-card relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pt-80 pb-8 sm:pt-48 lg:pt-80">
        <img :src="post.cover_url" alt="" class="absolute inset-0 -z-10 size-full object-cover duration-300 group-hover/blog-card:scale-105" />
        <div class="absolute inset-0 -z-10 bg-linear-to-t from-primary-950 via-primary-900/40" />
        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-gray-900/10 ring-inset" />

        <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
            <time :datetime="post.published_at" class="mr-8">{{ new Date(post.published_at).toLocaleDateString() }}</time>
            <div v-if="post.category" class="-ml-4 flex items-center gap-x-4">
                <svg viewBox="0 0 2 2" class="-ml-0.5 size-0.5 flex-none fill-white/50">
                    <circle cx="1" cy="1" r="1" />
                </svg>
                <div class="flex gap-x-2.5">
                    {{ post.category.name }}
                </div>
            </div>
        </div>
        <h3 class="mt-3 text-lg/6 font-semibold text-white">
            <Link :href="blog.post(post.slug)">
                <span class="absolute inset-0" />
                {{ post.title }}
            </Link>
        </h3>
    </article>
</template>

<style scoped></style>
