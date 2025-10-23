<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Главная",
        href: "/",
    },
    {
        title: "Блог",
        href: "/blog",
    },
];
</script>

<template>
    <AppLayout title="Блог" :breadcrumbs="breadcrumbs">

    </AppLayout>
</template>

<style scoped></style>
