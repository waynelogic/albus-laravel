<script setup lang="ts">
import { BreadcrumbItems, SiteFooter, SiteHeader, Snow } from '@/layouts/app';
import { BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/vue3";

withDefaults(
    defineProps<{
        title?: string;
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <Head>
        <title v-if="title">{{ title }}</title>
    </Head>
    <Snow  :count="200" :speed="1.2" :size="5" :opacity="0.7"/>
    <div class="isolate flex min-h-screen flex-col bg-[#f2f3f7] dark:bg-[#14161a]">
        <SiteHeader />
        <section id="breadcrumbs" v-if="breadcrumbs.length" class="relative isolate overflow-hidden border-b border-gray-300">
            <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-1/2 -z-10 aspect-1155/678 w-144.5 max-w-none -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-288.75"></div>
            </div>
            <!--            <Image alt="Семена" class="absolute z-[-2] size-full object-cover object-bottom" src="/images/home/hero-flowers.png" lazy width="1920" height="1080" mode="fit" />-->

            <!--            <img class="absolute z-[-1] size-full object-cover" src="/images/common/breadcrumbs.webp" alt="" />-->
            <div class="container py-6 md:py-10">
                <BreadcrumbItems :breadcrumbs="breadcrumbs" />
                <h1 v-if="title" class="mt-2 font-serif text-4xl font-semibold">{{ title }}</h1>
            </div>
        </section>
        <main class="flex-1">
            <slot />
        </main>
        <SiteFooter />
    </div>
</template>

<style scoped></style>
