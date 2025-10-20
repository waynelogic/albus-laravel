<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { PhCaretRight } from "@phosphor-icons/vue";
import { tv } from "tailwind-variants/lite";

withDefaults(
    defineProps<{
        href?: string;
        icon?: any;
        color?: "primary" | "secondary" | "danger" | "success" | "warning" | "info" | "white" | "dark" | "glass";
    }>(),
    {
        color: "primary",
        icon: PhCaretRight,
    },
);

const linkClasses = tv({
    base: "group/link inline-flex items-center font-semibold shrink-0 gap-2",
    variants: {
        color: {
            primary: "text-primary-600",
            secondary: "text-secondary-600",
            danger: "text-danger-600",
            success: "text-success-600",
            warning: "text-warning-600",
            info: "text-info-600",
            white: "text-white",
            dark: "text-dark",
            glass: "text-glass",
        },
    },
});
</script>

<template>
    <component :is="href ? Link : 'button'" :href="href" :class="linkClasses({ color })">
        <slot />
        <component :is="icon" weight="bold" class="duration-300 group-hover/link:-ml-1 group-hover/link:animate-pulse" />
    </component>
</template>

<style scoped></style>
