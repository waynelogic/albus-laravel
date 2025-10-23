<script setup lang="ts">
import { Button } from "@/components/action";
import { SectionHeader } from "@/components/ui";
import { money } from "@/lib/utils";
import { PhCheck } from "@phosphor-icons/vue";

const includedFeatures = ["Администрирование", "Сопровожение 1С", "Разработка WEB сайтов", "Настройка оборудования"];
</script>

<template>
    <section id="hour-pricing" class="relative isolate mt-12 bg-primary-950">
        <div class="absolute -top-24 right-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
            <div class="aspect-1404/767 w-[87.75rem] bg-linear-to-r from-[#80caff] to-[#4f46e5] opacity-25" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)" />
        </div>
        <div class="container py-12">
            <SectionHeader class="dark" center title="Простая ценовая политика" subtitle="Прозрачность, которую вы цените: Единая ставка для всех экспертов." />
            <div class="mt-6 flex rounded-3xl bg-primary-50/80 ring-1 ring-gray-200 max-md:flex-col sm:mt-6">
                <div class="p-8 sm:p-10 lg:flex-auto">
                    <h3 class="text-3xl font-semibold tracking-tight text-gray-900">Единая цена за час работы специалиста</h3>
                    <p class="mt-6 text-base/7 text-gray-600">Все наши специалисты имеют многолетний опыт работы, поэтому цена за час работы специалиста единая для всех.</p>
                    <div class="mt-10 flex items-center gap-x-4">
                        <h4 class="flex-none text-base/6 font-semibold text-primary-600">Какие имеенно работы?</h4>
                        <div class="h-px flex-auto bg-primary-200/80" />
                    </div>
                    <ul role="list" class="mt-8 grid grid-cols-1 gap-4 text-sm/6 text-gray-600 sm:grid-cols-2 sm:gap-6">
                        <li v-for="feature in includedFeatures" :key="feature" class="flex gap-x-3">
                            <PhCheck class="h-6 w-5 flex-none text-indigo-600" aria-hidden="true" />
                            {{ feature }}
                        </li>
                    </ul>
                </div>
                <div class="m-4 flex flex-col justify-center rounded-2xl bg-gray-50/50 p-6 text-center ring-1 ring-gray-900/20 ring-inset lg:w-full lg:max-w-md">
                    <p class="text-base font-semibold text-gray-600">Цена без учета НДС</p>
                    <p class="mt-6 flex items-baseline justify-center gap-x-2">
                        <span class="text-5xl font-semibold tracking-tight text-gray-900">{{ money(3000) }}</span>
                        <span class="text-sm/6 font-semibold tracking-wide text-gray-600">/ н. час.</span>
                    </p>
                    <Button class="mx-auto mt-10 w-full max-w-xs">Заказать</Button>
                    <p class="mt-6 text-xs/5 text-gray-600">Все рассчеты производятся в рублях.</p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped></style>
