<script setup lang="ts">
import { onMounted, ref, useTemplateRef } from 'vue';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import { PhCaretLeft } from '@phosphor-icons/vue';
import { SwiperOptions } from 'swiper/types';

const props = defineProps<{
    direction?: "horizontal" | "vertical";
    options?: SwiperOptions;
    loop?: boolean;
    navigation: 'horizontal' | 'bottom' | 'none';
    pagination?: boolean;
}>();

const swiperEl = useTemplateRef<HTMLDivElement>("swiperEl");
const swiper = ref<Swiper | null>(null);

onMounted(() => {
    swiper.value = new Swiper(swiperEl.value!, {
        modules: [Navigation, Pagination],
        direction: "horizontal",
        loop: true,
        pagination: {
            el: ".swiper-pagination",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        ...props.options,
    });
});
</script>

<template>
    <div class="swiper" ref="swiperEl">
        <div class="swiper-wrapper swiper-autoheight">
            <slot/>
        </div>
        <div class="swiper-pagination"></div>

        <template v-if="props.navigation === 'horizontal'">
            <div class="swiper-button-prev absolute left-5 top-1/2 -translate-y-1/2 z-10 [.swiper-button-lock]:hidden">
                <PhCaretLeft class="size-6"/>
            </div>
            <div class="swiper-button-next absolute right-5 top-1/2 -translate-y-1/2 z-10 [.swiper-button-lock]:hidden">
                <PhCaretLeft class="size-6 rotate-180"/>
            </div>
        </template>
        <template v-else-if="props.navigation === 'bottom'">
            <div class="max-lg:hidden flex items-center gap-6 absolute bottom-12 right-12">
                <div class="swiper-button-prev">
                    <PhCaretLeft class="size-6"/>
                </div>
                <div class="swiper-button-next">
                    <PhCaretLeft class="size-6 rotate-180"/>
                </div>
            </div>
        </template>
        <template v-else-if="props.navigation === 'none'">

        </template>

        <div class="swiper-scrollbar"></div>
    </div>
</template>

<style scoped>

</style>
