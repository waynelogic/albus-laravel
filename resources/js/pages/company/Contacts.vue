<script setup lang="ts">
import { Button } from "@/components/action";
import { Input, InputLabel, TextArea, Toggle } from "@/components/form";
import { contactsDB } from "@/data/contactsDB";
import AppLayout from "@/layouts/AppLayout.vue";
import { Form } from "@inertiajs/vue3";
import { PhCircle, PhPaperPlaneTilt } from "@phosphor-icons/vue";

import { SectionHeader } from "@/components/ui";
import { BreadcrumbItem } from "@/types";
import YandexMap from '@/components/company/YandexMap.vue';
import { ref } from 'vue';
import formsController from '@/actions/App/Http/Controllers/FormsController';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Главная",
        href: "/",
    },
    {
        title: "Контакты",
        href: "/contacts",
    },
];
const show = ref(false)
</script>

<template>
    <AppLayout title="Контакты" :breadcrumbs="breadcrumbs">
        <section id="contacts" class="relative">
            <div class="container py-12">
                <!-- TODO: Оформление                -->

                <!--                <div class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2">-->
                <!--                    <svg class="absolute inset-0 size-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">-->
                <!--                        <defs>-->
                <!--                            <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="100%" y="-1" patternUnits="userSpaceOnUse">-->
                <!--                                <path d="M130 200V.5M.5 .5H200" fill="none" />-->
                <!--                            </pattern>-->
                <!--                        </defs>-->
                <!--                        <rect width="100%" height="100%" stroke-width="0" fill="white" />-->
                <!--                        <svg x="100%" y="-1" class="overflow-visible fill-gray-50">-->
                <!--                            <path d="M-470.5 0h201v201h-201Z" stroke-width="0" />-->
                <!--                        </svg>-->
                <!--                        <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />-->
                <!--                    </svg>-->
                <!--                </div>-->
                <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                    <div>
                        <SectionHeader title="Оставайтесь на связи" subtitle="Мы всегда рады помочь вам!" />
                        <dl class="mt-10 space-y-6 text-base/7 text-gray-600">
                            <component :is="item.href ? 'a' : 'div'" v-for="item in contactsDB" :href="item.href" class="flex items-center gap-x-4 hover:text-primary-500">
                                <dt class="flex-none">
                                    <span class="sr-only">{{ item.title }}</span>
                                    <component :is="item.icon" weight="duotone" class="size-8 text-gray-400" aria-hidden="true" />
                                </dt>
                                <dd v-html="item.content" class="lg:text-lg font-medium"></dd>
                            </component>
                        </dl>
                    </div>
                    <div>
                        <Form :action="formsController.store()" method="POST" v-slot="{ errors, processing }" resetOnSuccess class="p-4" :options="{ preserveScroll: true }">
                            <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <Input type="hidden" name="magic_form_type" default-value="contact" />
                                <InputLabel class="sm:col-span-2" label="Ваше имя" :error="errors.name">
                                    <Input type="text" name="name" placeholder="Ваше имя" />
                                </InputLabel>
                                <InputLabel label="Телефон" :error="errors.phone">
                                    <Input type="tel" name="phone" placeholder="+7 (999) 999-99-99" />
                                </InputLabel>
                                <InputLabel label="E-mail" :error="errors.email">
                                    <Input type="text" name="email" placeholder="info@company.com" />
                                </InputLabel>
                                <InputLabel class="sm:col-span-2" label="Сообщение" :error="errors.message">
                                    <TextArea name="message" placeholder="Сообщение..." />
                                </InputLabel>
                                <label class="flex items-center gap-x-2 text-sm/6 text-gray-600 sm:col-span-2">
                                    <Toggle required name="agree" />
                                    <span class="inline">Отправляя заявку, я соглашаюсь на <a href="#" class="inline font-semibold whitespace-nowrap text-primary-600">обработку персональных данных</a>.</span>
                                </label>
                            </div>
                            <Button type="submit" class="w-full" :disabled="processing">
                                <PhCircle v-if="processing" class="h-4 w-4 animate-spin" />
                                <span>Отправить</span>
                                <PhPaperPlaneTilt v-if="!processing" class="ml-2 size-4" />
                            </Button>
                        </Form>
                    </div>
<!--                    <Button @click="show = !show">-->
<!--                        asdasd-->
<!--                    </Button>-->
                    <YandexMap class="md:col-span-2 rounded-2xl overflow-hidden shadow-lg min-h-[400px]"/>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
