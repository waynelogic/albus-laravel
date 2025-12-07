<script setup lang="ts">
import { Button, Modal } from "@/components/action";
import { isShowCallback } from "@/composables/useModals";
import { contactsDB } from "@/data/contactsDB";
import CallbackForm from "@/layouts/app/CallbackForm.vue";
import SiteLogo from "@/layouts/app/SiteLogo.vue";
import { Link } from "@inertiajs/vue3";
import { PhHeadset, PhList, PhX } from "@phosphor-icons/vue";
import { ref } from "vue";
const menuOpen = ref<boolean>(false);

const navItems = [
    {
        title: "Главная",
        url: "/",
    },
    // {
    //     title: 'Каталог',
    //     url: route('catalog.index')
    // },
    {
        title: "О нас",
        url: "/about",
    },
    {
        title: "Блог",
        url: "/blog",
    },
    {
        title: "Контакты",
        url: "/contacts",
    },
];
</script>

<template>
    <Modal title="Обратная связь" v-model="isShowCallback">
        <CallbackForm @formSubmitted="isShowCallback = false" />
    </Modal>

    <header class="sticky top-0 isolate z-50 border-b border-primary-100/50 shadow">
        <div class="absolute inset-0 -z-1 bg-white/70 backdrop-blur" />
        <div class="container flex items-center justify-between py-2">
            <SiteLogo class="inline w-20" />
            <transition enter-active-class="duration-300" enter-from-class="opacity-0" leave-active-class="duration-300" enter-to-class="opacity-100">
                <div v-if="menuOpen" class="fixed inset-0 bg-black/50 lg:hidden" @click="menuOpen = false" />
            </transition>
            <nav :class="{ 'max-lg:-translate-x-full': !menuOpen }" class="flex transition-transform duration-300 max-lg:fixed max-lg:inset-0 max-lg:mr-20 max-lg:max-w-sm max-lg:flex-col max-lg:bg-white max-md:inset-0 max-md:z-50 max-md:h-full">
                <!-- Логотип-->
                <div class="flex items-center justify-between border-b border-primary-300 px-3 py-2 lg:hidden">
                    <Link href="/">
                        <SiteLogo class="inline w-20" />
                    </Link>
                    <Button color="primary" size="square" type="button" @click="menuOpen = false" class="p-2">
                        <PhX weight="bold" class="size-6" />
                    </Button>
                </div>
                <ul class="flex max-lg:flex-col">
                    <li v-for="(item, index) in navItems" :key="index">
                        <Link :href="item.url" class="border-primary hover:text-primary flex px-4 py-2 duration-300 max-lg:border-b max-lg:border-primary-300 md:px-2">
                            {{ item.title }}
                        </Link>
                    </li>
                </ul>
            </nav>
            <div class="flex items-center justify-between gap-5">
                <div class="flex gap-4 xl:gap-6">
                    <a v-for="(item, index) in [contactsDB.phone, contactsDB.email]" :key="index" :href="item.href" class="flex items-center gap-2">
                        <component :is="item.icon" weight="duotone" class="size-6 shrink-0 text-primary-900" />
                        <span :class="['font-medium md:text-lg', index === 0 ? 'max-sm:hidden' : 'max-sm:hidden']">{{ item.content }}</span>
                    </a>
                </div>
                <!--                <button class="group/cart-button relative" type="button">-->
                <!--                    <span class="absolute -top-1 -right-1 flex size-4.5 items-center justify-center rounded-full bg-primary-500 text-xs text-white">9</span>-->
                <!--                    <svg class="size-8 text-gray-500 group-hover/cart-button:text-primary-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">-->
                <!--                        <path fill="currentColor" d="M14.583 17.334a1.25 1.25 0 0 0-2.5 0v4a1.25 1.25 0 1 0 2.5 0zm4.084-1.25c.69 0 1.25.56 1.25 1.25v4a1.25 1.25 0 1 1-2.5 0v-4c0-.69.56-1.25 1.25-1.25"></path>-->
                <!--                        <path fill="currentColor" fill-rule="evenodd" d="M13 6.74a1.25 1.25 0 0 0-2.322-.633L7.742 11H4.25a1.25 1.25 0 0 0-.16 2.49A36 36 0 0 0 4 16c0 .933.04 1.865.108 2.77.26 3.488.39 5.232 2.14 6.982s3.494 1.88 6.982 2.14c.904.067 1.837.108 2.77.108.932 0 1.865-.04 2.77-.108 3.487-.26 5.231-.39 6.982-2.14 1.75-1.75 1.88-3.494 2.14-6.982.067-.905.108-1.837.108-2.77 0-.844-.034-1.687-.09-2.51a1.25 1.25 0 0 0-.16-2.49h-3.492l-2.936-4.893a1.25 1.25 0 1 0-2.144 1.286L21.342 11H10.658l2.164-3.606c.123-.205.18-.431.178-.654M6.595 13.5h18.81c.06.826.095 1.667.095 2.5 0 .861-.038 1.731-.101 2.584-.273 3.656-.423 4.408-1.415 5.4s-1.744 1.143-5.4 1.415c-.853.063-1.723.101-2.584.101a35 35 0 0 1-2.584-.101c-3.656-.272-4.408-.422-5.4-1.415-.993-.992-1.143-1.744-1.415-5.4A35 35 0 0 1 6.5 16c0-.833.035-1.674.095-2.5"></path>-->
                <!--                    </svg>-->
                <!--                </button>-->
                <!--                <Button type="button" rounded="xl" href="/login"> Войти </Button>-->
                <Button size="square" class="p-2 lg:hidden" @click="menuOpen = !menuOpen">
                    <PhList class="size-5" />
                </Button>
                <Button color="primary" @click="isShowCallback = true">
                    <PhHeadset class="size-5" />
                    <span class="hidden lg:inline">Заказать звонок</span>
                </Button>
            </div>
        </div>
    </header>
</template>

<style scoped></style>
