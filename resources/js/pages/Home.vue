<script setup lang="ts">
import { PostCard } from "@/components/blog";
import { HomeHeroSlider, HourPricing } from "@/components/home";
import { ProductCard } from "@/components/products";
import { CategoryCard } from "@/components/services";
import { SectionBadge, SectionHeader, Swiper, SwiperSlide } from "@/components/ui";
import AppLayout from "@/layouts/AppLayout.vue";
import { ServiceCategory } from "@/types";
import {
    PhAppleLogo, PhAppWindow, PhBarcode, PhBriefcase, PhCheck, PhDatabase, PhGlobe, PhPiggyBank,
    PhPulse, PhSketchLogo, PhTruck
} from '@phosphor-icons/vue';
import { SwiperOptions } from "swiper/types";

const categories: ServiceCategory[] = [
    {
        id: 1,
        name: "Автоматизация бизнеса",
        preview_text: "Продажа, внедрение, настройка и сопровождение программ 1С Предприятие и других систем учета.",
        icon: PhBriefcase,
    },
    {
        id: 2,
        name: "Бухгалтерская и налоговая отчетность",
        preview_text: "Ведение бухгалтерии, подготовка и сдача отчетности по всем направлениям.",
        icon: PhPiggyBank,
    },
    {
        id: 3,
        name: "Разработка сайтов под ключ",
        preview_text: "Создание сайта с индивидуальным дизайном под ключ.",
        icon: PhGlobe,
    },
    {
        id: 4,
        name: "Программные продукты",
        preview_text: "Продажа и настройка программных продуктов любого типа.",
        icon: PhAppWindow,
    },
    {
        id: 5,
        name: "Торговое оборудование",
        preview_text: "Установка и настройка технических средств для работы в розничных точках.",
        icon: PhBarcode,
    },
    {
        id: 6,
        name: "Серверное оборудование",
        preview_text: "Подбор и настройка серверного оборудования под ваши нужды.",
        icon: PhDatabase,
    },
    {
        id: 7,
        name: "Ремонт техники Apple",
        preview_text: "Ремонт либой техники от компании Apple от iPhone до iMac",
        icon: PhAppleLogo,
    },
    {
        id: 8,
        name: "Дизайн и фирменный стиль",
        preview_text: "Разработка индивидуального стиля для вашей компании.",
        icon: PhSketchLogo,
    },
];

const posts = [
    {
        id: 1,
        title: "Boost your conversion rate",
        href: "#",
        description: "Illo sint voluptas. Error voluptates culpa eligendi. Hic vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur nulla deserunt vel. Iusto corrupti dicta.",
        imageUrl: "https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80",
        date: "Mar 16, 2020",
        datetime: "2020-03-16",
        author: {
            name: "Michael Foster",
            imageUrl: "https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        },
    },
];

const about = ["Показатели под нашей надежной защитой", "Показатели под нашей надежной защитой", "Показатели под нашей надежной защитой"];

const partnersSliderOpt: SwiperOptions = {
    breakpoints: {
        720: {
            slidesPerView: 5,
        },
    },
};
</script>

<template>
    <AppLayout>
        <section id="hero-section">
            <div class="container py-4">
                <HomeHeroSlider />
            </div>
        </section>

        <section id="services">
            <div class="relative container py-6">
                <div class="absolute inset-x-0 top-1/2 -z-10 flex -translate-y-1/2 transform-gpu justify-center overflow-hidden blur-3xl sm:top-auto sm:right-[calc(50%-6rem)] sm:bottom-0 sm:translate-y-0 sm:transform-gpu sm:justify-end" aria-hidden="true">
                    <div class="aspect-1108/632 w-[69.25rem] flex-none bg-linear-to-r from-[#ff80b5] to-[#9089fc] opacity-25" style="clip-path: polygon(73.6% 48.6%, 91.7% 88.5%, 100% 53.9%, 97.4% 18.1%, 92.5% 15.4%, 75.7% 36.3%, 55.3% 52.8%, 46.5% 50.9%, 45% 37.4%, 50.3% 13.1%, 21.3% 36.2%, 0.1% 0.1%, 5.4% 49.1%, 21.4% 36.4%, 58.9% 100%, 73.6% 48.6%)" />
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <CategoryCard v-for="category in categories" :key="category.id" :category="category" />
                </div>
                <div class="absolute top-full right-0 left-1/2 -z-10 hidden -translate-y-1/2 transform-gpu overflow-hidden blur-3xl sm:block" aria-hidden="true">
                    <div class="aspect-1155/678 w-[72.1875rem] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                </div>
            </div>
        </section>

        <section id="about">
            <div class="container py-12">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                    <div class="relative isolate">
                        <img class="absolute top-1/2 right-[102%] -translate-y-1/2 h-50 w-28 animate-bounce hue-rotate-[200deg]" src="/images/home/triangle.png" alt="">
                        <div class="absolute bottom-0 -left-8 max-w-sm flex items-center gap-5 shadow-out p-4 rounded-lg bg-white z-1">
                            <PhPulse weight="bold" class="shrink-0 text-primary-600 size-12"/>
                            <p>
                                Более 5 лет мы успешно внедряем
                                различные решения для бизнеса!
                            </p>
                        </div>
                        <img class="absolute size-full object-contain" src="/images/home/audit.svg" alt="">
<!--                        <img class="absolute right-0 z-1 size-20 -translate-y-1/3 rounded-full bg-white md:translate-x-1/3" src="/images/home/certificate.png" alt="" />-->
<!--                        <img class="size-full rounded-3xl object-cover object-center shadow max-md:h-90 md:absolute" src="/images/home/about-image.jpg" alt="" />-->
                    </div>
                    <div class="md:col-span-2 flex flex-col items-start gap-5">
                        <SectionHeader title="Премиальное сопровождение бизнеса по всей России" />
                        <p>Наши эксперты помогут вам оптимизировать ваш бизнес и принести отличные результаты. Не ждите, улучшайте свой бизнес уже сейчас с Albus.</p>
                        <div class="w-full divide-y divide-gray-300 overflow-hidden rounded-2xl border border-gray-300">
                            <details v-for="item in about" class="group peer w-full">
                                <summary class="flex cursor-pointer items-center gap-4 px-5 py-4 font-medium duration-150 select-none group-open:bg-primary-200 hover:bg-primary-300">
                                    <PhCheck weight="bold" class="size-5 shrink-0 text-primary-600" />
                                    <span>{{ item }}</span>
                                </summary>
                                <p class="border-t border-gray-300 px-5 py-3 bg-primary-200">Раскрывающийся текст</p>
                            </details>
                        </div>
                        <div class="mt-12 grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-4" v-for="i in 2">
                                <PhTruck weight="duotone" class="size-20 text-primary-600" />
                                <div>
                                    <h3 class="font-semibold">Business Growth</h3>
                                    <p class="text-sm">Quickly productivate just in time strategic lacus mirina</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="relative isolate overflow-hidden bg-primary-950 px-6 py-16 text-center shadow-2xl sm:rounded-3xl sm:px-16">
                    <SectionHeader center class="dark" title="Наши клиенты и партнеры" subtitle="За прошедшее десятилетие мы стали надёжным партнёром для свыше 1000 компаний по всему миру. Присоединяйтесь к лидерам рынка, которые выбрали нас для достижения своих целей." />
                    <Swiper class="mt-10" :options="partnersSliderOpt" navigation="none">
                        <SwiperSlide v-for="i in 12">
                            <img class="max-h-12 w-full object-contain" src="https://tailwindui.com/plus-assets/img/logos/158x48/statamic-logo-white.svg" alt="Transistor" width="158" height="48" />
                        </SwiperSlide>
                    </Swiper>
                    <div class="absolute -top-24 right-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
                        <div class="aspect-1404/767 w-[87.75rem] bg-linear-to-r from-primary-950 to-primary-200 opacity-25" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)" />
                    </div>
                    <p class="relative mt-12 inline-flex rounded-full bg-gray-50 px-4 py-1.5 text-sm/6 text-gray-600 ring-1 ring-gray-900/5 ring-inset">
                        <span class="hidden md:inline">Over 2500 companies use our tools to better their business.</span>
                        <a href="#" class="font-semibold text-primary-600"><span class="absolute inset-0" aria-hidden="true" /> Read our customer stories <span aria-hidden="true">&rarr;</span></a>
                    </p>
                </div>
            </div>
        </section>

        <section>
            <div class="container py-12">
                <header class="mb-4 flex items-center justify-between">
                    <h2 class="font-serif text-3xl font-medium">Товары</h2>
                    <SectionBadge as="a" href="/"> Каталог </SectionBadge>
                </header>
                <div class="grid grid-cols-1 gap-5 xs:grid-cols-2 md:gap-8 lg:grid-cols-4">
                    <ProductCard v-for="i in 4" :key="i" />
                </div>
            </div>
        </section>
        <HourPricing />

        <section id="blog">
            <div class="container py-12">
                <SectionHeader title="Наши новости и статьи" class="mb-12" />
                <div class="grid auto-rows-fr grid-cols-1 gap-8 lg:grid-cols-3">
                    <PostCard v-for="post in posts" :key="post.id" :post="post" />
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
