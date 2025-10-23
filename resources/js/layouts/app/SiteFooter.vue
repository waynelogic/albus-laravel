<script setup lang="ts">
import { Max } from '@/components/icons/social';
import { PhTelegramLogo, PhWhatsappLogo } from '@phosphor-icons/vue';

const social = [
    {
        title: 'Max',
        link: 'https://max.ru/u/f9LHodD0cOIHJFjgUYUZIsepQYenrfniuJov97w_Emt6U3Sqq_-_422tv60',
        icon: Max
    },
    {
        title: "WhatsApp",
        link: "https://wa.me/message/JOK7KM4GUSXTE1",
        icon: PhWhatsappLogo
    },
    {
        title: 'Telegram',
        link: 'https://t.me/lexter_wayne',
        icon: PhTelegramLogo
    }
]

</script>

<template>
    <footer class="border-t border-gray-900/10 bg-white">
        <div class="container py-12 md:flex md:items-center md:justify-between">
            <div class="flex justify-center gap-x-6 md:order-2">
                <a target="_blank" v-for="(item, index) in social" :key="index" :href="item.link" class="text-gray-600 hover:text-gray-800">
                    <span class="sr-only">{{ item.title }}</span>
                    <component :is="item.icon" class="size-8 text-primary-600 hover:text-primary-700 duration-150" aria-hidden="true" />
                </a>
            </div>
            <p class="mt-8 text-center text-sm/6 text-gray-600 md:order-1 md:mt-0">&copy; 2018 - {{ new Date().getFullYear() }} Все права защищены компанией Albus.</p>
        </div>
    </footer>
    <!--    <footer class="mx-auto max-w-7xl px-6 lg:px-8">-->
    <!--        <div class="border-t border-gray-900/10 pt-20 pb-8 sm:pt-24">-->
    <!--            <div class="xl:grid xl:grid-cols-3 xl:gap-8">-->
    <!--                <div class="grid grid-cols-2 gap-8 xl:col-span-2">-->
    <!--                    <div class="md:grid md:grid-cols-2 md:gap-8">-->
    <!--                        <div>-->
    <!--                            <h3 class="text-sm/6 font-semibold text-gray-900">Solutions</h3>-->
    <!--                            <ul role="list" class="mt-6 space-y-4">-->
    <!--                                <li v-for="item in footerNavigation.solutions" :key="item.name">-->
    <!--                                    <a :href="item.href" class="text-sm/6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                        <div class="mt-10 md:mt-0">-->
    <!--                            <h3 class="text-sm/6 font-semibold text-gray-900">Support</h3>-->
    <!--                            <ul role="list" class="mt-6 space-y-4">-->
    <!--                                <li v-for="item in footerNavigation.support" :key="item.name">-->
    <!--                                    <a :href="item.href" class="text-sm/6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="md:grid md:grid-cols-2 md:gap-8">-->
    <!--                        <div>-->
    <!--                            <h3 class="text-sm/6 font-semibold text-gray-900">Company</h3>-->
    <!--                            <ul role="list" class="mt-6 space-y-4">-->
    <!--                                <li v-for="item in footerNavigation.company" :key="item.name">-->
    <!--                                    <a :href="item.href" class="text-sm/6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                        <div class="mt-10 md:mt-0">-->
    <!--                            <h3 class="text-sm/6 font-semibold text-gray-900">Legal</h3>-->
    <!--                            <ul role="list" class="mt-6 space-y-4">-->
    <!--                                <li v-for="item in footerNavigation.legal" :key="item.name">-->
    <!--                                    <a :href="item.href" class="text-sm/6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="mt-10 xl:mt-0">-->
    <!--                    <h3 class="text-sm/6 font-semibold text-gray-900">Subscribe to our newsletter</h3>-->
    <!--                    <p class="mt-2 text-sm/6 text-gray-600">The latest news, articles, and resources, sent to your inbox weekly.</p>-->
    <!--                    <form class="mt-6 sm:flex sm:max-w-md">-->
    <!--                        <label for="email-address" class="sr-only">Email address</label>-->
    <!--                        <input type="email" name="email-address" id="email-address" autocomplete="email" required="" class="w-full min-w-0 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:w-64 sm:text-sm/6 xl:w-full" placeholder="Enter your email" />-->
    <!--                        <div class="mt-4 sm:mt-0 sm:ml-4 sm:shrink-0">-->
    <!--                            <button type="submit" class="flex w-full items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Subscribe</button>-->
    <!--                        </div>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">-->
    <!--                <div class="flex gap-x-6 md:order-2">-->
    <!--                    <a v-for="item in footerNavigation.social" :key="item.name" :href="item.href" class="text-gray-600 hover:text-gray-800">-->
    <!--                        <span class="sr-only">{{ item.name }}</span>-->
    <!--                        <component :is="item.icon" class="size-6" aria-hidden="true" />-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                <p class="mt-8 text-sm/6 text-gray-600 md:order-1 md:mt-0">&copy; 2024 Your Company, Inc. All rights reserved.</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </footer>-->
</template>

<style scoped></style>
