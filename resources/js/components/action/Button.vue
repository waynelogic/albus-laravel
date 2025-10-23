<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { tv } from "tailwind-variants";

const props = withDefaults(
    defineProps<{
        href?: string;
        color?: "primary" | "secondary" | "danger" | "success" | "warning" | "info" | "white" | "dark" | "glass";
        rounded?: "sm" | "md" | "lg" | "xl" | "full";
        size?: "xs" | "sm" | "md" | "lg" | "xl" | "square";
        vibrate?: boolean;
    }>(),
    {
        color: "primary",
        size: "lg",
        rounded: "xl",
    },
);

const btnClasses = tv({
    base: "inline-flex items-center justify-center gap-3 font-medium text-white text-center border border-transparent cursor-pointer select-none duration-300",
    variants: {
        color: {
            primary: "bg-primary-600 hover:bg-primary-700",
            secondary: "bg-secondary-600 hover:bg-secondary-700",
            success: "bg-green-600 hover:bg-green-700",
            danger: "bg-red-600 hover:bg-red-700",
            warning: "bg-yellow-600 hover:bg-yellow-700",
            info: "bg-blue-600 hover:bg-blue-700",
            white: "bg-gray-100 text-gray-900 hover:text-primary-700 hover:bg-gray-200",
            dark: "bg-gray-900 hover:bg-gray-800",
        },
        rounded: {
            sm: "rounded-sm",
            md: "rounded-md",
            lg: "rounded-lg",
            xl: "rounded-xl",
            full: "rounded-full",
        },
        size: {
            xs: "text-xs px-2 py-1",
            sm: "text-sm px-3 py-2",
            md: "text-sm px-4 py-2",
            lg: "text-base px-4 py-2",
            xl: "text-base px-6 py-3",
            square: "aspect-square",
        },
    },
});

const emit = defineEmits(["click"]);

const handleClick = () => {
    emit("click");
    if (props.vibrate) {
        navigator.vibrate(100);
    }
};
</script>

<template>
    <component @click="handleClick" :is="href ? Link : 'button'" :href="href" :class="btnClasses({ color, size, rounded })">
        <slot />
    </component>
</template>

<style scoped></style>
