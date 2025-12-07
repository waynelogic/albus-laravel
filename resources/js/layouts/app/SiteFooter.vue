<script setup lang="ts">
import { Max } from "@/components/icons/social";
import { PhTelegramLogo, PhWhatsappLogo } from "@phosphor-icons/vue";

const social = [
    {
        title: "Max",
        link: "https://max.ru/u/f9LHodD0cOIHJFjgUYUZIsepQYenrfniuJov97w_Emt6U3Sqq_-_422tv60",
        icon: Max,
    },
    {
        title: "WhatsApp",
        link: "https://wa.me/message/JOK7KM4GUSXTE1",
        icon: PhWhatsappLogo,
    },
    {
        title: "Telegram",
        link: "https://t.me/lexter_wayne",
        icon: PhTelegramLogo,
    },
];
</script>

<template>
    <footer class="border-t border-gray-900/10 bg-white">
        <div class="container py-12 md:flex md:items-center md:justify-between">
            <div class="flex justify-center gap-x-6 md:order-2">
                <a target="_blank" v-for="(item, index) in social" :key="index" :href="item.link" class="text-gray-600 hover:text-gray-800">
                    <span class="sr-only">{{ item.title }}</span>
                    <component :is="item.icon" class="size-8 text-primary-600 duration-150 hover:text-primary-700" aria-hidden="true" />
                </a>
            </div>
            <p class="mt-8 text-center text-sm/6 text-gray-600 md:order-1 md:mt-0">&copy; 2018 - {{ new Date().getFullYear() }} Все права защищены компанией Albus.</p>
        </div>
    </footer>
</template>

<style scoped></style>
