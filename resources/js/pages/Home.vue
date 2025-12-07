<script setup lang="ts">
import { Button } from "@/components/action";
import { PostCard } from "@/components/blog";
import { HomeHeroSlider, HourPricing } from "@/components/home";
import { ProductCard } from "@/components/products";
import { CategoryCard } from "@/components/services";
import { SectionBadge, SectionHeader, Swiper, SwiperSlide } from "@/components/ui";
import AppLayout from "@/layouts/AppLayout.vue";
import { BlogPost, Partner, Product, ServiceCategory } from '@/types';
import { PhAppleLogo, PhAppWindow, PhBarcode, PhBriefcase, PhCheck, PhCrown, PhDatabase, PhGlobe, PhPiggyBank, PhPulse, PhSketchLogo } from "@phosphor-icons/vue";
import { SwiperOptions } from "swiper/types";

defineProps<{
    products: Product[];
    partners: Partner[];
    posts: BlogPost[];
}>();

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

const about = [
    {
        title: "Настроенные и эффективные системы учета",
    },
    {
        title: "Безопасную локальную и внешнюю сеть",
    },
    {
        title: "Лицензионное программное обеспечение",
    },
    {
        title: "Корректный бухгалтерский и управленческий учет",
    },
    {
        title: "Красивый и информативный сайт",
    },
];

const partnersSliderOpt: SwiperOptions = {
    breakpoints: {
        384: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
        1280: { slidesPerView: 5 },
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
                <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                    <div class="relative isolate flex flex-col justify-center">
                        <svg class="absolute top-1/2 right-[102%] w-20 -translate-y-1/2 animate-bounce text-primary-400" width="100%" height="100%" viewBox="0 0 246 395" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                            <path fill="currentColor" transform="matrix(8.74108e-17,-1.42753,1.24503,7.62364e-17,-3271.11,1942.2)" d="M1352.24,2766.97C1360.49,2776.78 1362.82,2791.3 1358.17,2803.84C1353.52,2816.38 1342.79,2824.52 1330.9,2824.52L1113.63,2824.52C1101.74,2824.52 1091.01,2816.38 1086.36,2803.84C1081.71,2791.3 1084.05,2776.78 1092.29,2766.97C1127.78,2724.76 1174.25,2669.46 1200.93,2637.72C1206.52,2631.08 1214.22,2627.32 1222.27,2627.32C1230.31,2627.32 1238.02,2631.08 1243.6,2637.72C1270.28,2669.46 1316.75,2724.76 1352.24,2766.97Z"/>\
                        </svg>
<!--                        <img class="absolute top-1/2 right-[102%] h-50 w-28 -translate-y-1/2 animate-bounce hue-rotate-[200deg]" src="/images/home/triangle.png" alt="" />-->
                        <div class="relative xl:size-full">
                            <div class="absolute top-11/12 z-1 flex max-w-md items-center gap-5 rounded-lg bg-white p-4 shadow-out">
                                <PhPulse weight="bold" class="size-12 shrink-0 text-primary-600" />
                                <p>Более 10 лет мы успешно внедряем различные решения для бизнеса!</p>
                            </div>
                            <img class="w-full object-contain max-md:h-90 xl:absolute xl:size-full" src="/images/home/audit.svg" alt="" />
                        </div>
                        <!--                        <img class="absolute right-0 z-1 size-20 -translate-y-1/3 rounded-full bg-white md:translate-x-1/3" src="/images/home/certificate.png" alt="" />-->
                        <!--                        <img class="size-full rounded-3xl object-cover object-center shadow max-md:h-90 md:absolute" src="/images/home/about-image.jpg" alt="" />-->
                    </div>
                    <div class="flex flex-col gap-5">
                        <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-4xl lg:text-5xl">Премиальное сопровождение бизнеса по всей России</h2>
                        <p>Наши эксперты помогут вам оптимизировать ваш бизнес и принести отличные результаты. Не ждите, улучшайте свой бизнес уже сейчас с Albus.</p>
                        <div class="grid grid-cols-1 gap-10 xl:grid-cols-2">
                            <div>
                                <h3 class="mb-2 text-lg font-semibold">Что получает наш клиент?</h3>
                                <ul class="flex flex-col gap-4">
                                    <li v-for="(item, index) in about" :key="index" class="flex items-center gap-4 font-medium duration-150 select-none">
                                        <PhCheck weight="bold" class="size-5 shrink-0 text-primary-600" />
                                        <span>{{ item.title }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="max-xl:hidden">
                                <div class="flex flex-col gap-4 rounded-2xl bg-white/30 p-8 shadow backdrop-blur">
                                    <PhCrown class="size-14 text-primary-600" weight="duotone" />
                                    <h4 class="text-xl font-semibold">Мы поможем вашему бизнесу стать еще лучше!</h4>
                                    <Button> Обратная связь </Button>
                                </div>
                            </div>
                        </div>

                        <!--                        <div class="w-full divide-y divide-gray-300 overflow-hidden rounded-2xl border border-gray-300">-->
                        <!--                            <details v-for="item in about" class="group peer w-full">-->
                        <!--                                <summary class="flex cursor-pointer items-center gap-4 px-5 py-4 font-medium duration-150 select-none group-open:bg-primary-200 hover:bg-primary-300">-->
                        <!--                                    <PhCheck weight="bold" class="size-5 shrink-0 text-primary-600" />-->
                        <!--                                    <span>{{ item }}</span>-->
                        <!--                                </summary>-->
                        <!--                                <p class="border-t border-gray-300 px-5 py-3 bg-primary-200">Раскрывающийся текст</p>-->
                        <!--                            </details>-->
                        <!--                        </div>-->
                        <!--                        <div class="grid grid-cols-2 gap-4">-->
                        <!--                            <div class="flex items-center gap-4" v-for="i in 2">-->
                        <!--                                <PhTruck weight="duotone" class="size-20 text-primary-600" />-->
                        <!--                                <div>-->
                        <!--                                    <h3 class="font-semibold">Business Growth</h3>-->
                        <!--                                    <p class="text-sm">Quickly productivate just in time strategic lacus mirina</p>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
        </section>

        <section class="relative isolate mt-12 overflow-hidden border-y border-primary-300 bg-primary-100">
            <div class="absolute -top-24 right-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
                <div class="aspect-1404/767 w-[87.75rem] bg-linear-to-r from-primary-400 to-primary-500 opacity-25" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)" />
            </div>
            <div class="container flex flex-col pt-12">
                <SectionHeader center title="Наши клиенты и партнеры" subtitle="За прошедшее десятилетие мы стали надёжным партнёром для свыше 1000 компаний по всему миру. Присоединяйтесь к лидерам рынка, которые выбрали нас для достижения своих целей." />
                <div class="mt-10 rounded-2xl border-gray-300 px-4 py-10">
                    <Swiper :options="partnersSliderOpt" navigation="none">
                        <SwiperSlide v-for="partner in partners">
                            <img loading="lazy" class="max-h-12 w-full object-contain object-left" :src="partner.logo_url" :alt="partner.name" width="158" height="48" />
                        </SwiperSlide>
                    </Swiper>
                </div>
<!--                                <Button rounded="full" color="primary" size="sm" class="mt-10 mx-auto" @click="isShowCallback = true">-->
<!--                                    Хотите стать клентом или партнером компании Albus?-->
<!--                                </Button>-->
            </div>
        </section>

        <section>
            <div class="container py-12">
                <header class="mb-4 flex items-center justify-between">
                    <h2 class="font-serif text-3xl font-medium">Товары</h2>
                    <SectionBadge as="a" href="/"> Каталог </SectionBadge>
                </header>
                <div class="grid grid-cols-1 gap-5 xs:grid-cols-2 md:gap-8 lg:grid-cols-4">
                    <ProductCard v-for="product in products" :key="product.id" :product="product" />
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
