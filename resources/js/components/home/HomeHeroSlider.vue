<script setup lang="ts">
import { Button } from "@/components/action";
import { Swiper, SwiperSlide } from "@/components/ui";
</script>

<template>
    <Swiper navigation="bottom" class="overflow-hidden rounded-3xl shadow-low">
        <SwiperSlide class="flex flex-col">
            <img class="absolute -z-2 size-full object-cover object-right" src="/images/home/hero2.png" alt="" />
            <div class="absolute top-0 left-0 -z-1 h-full w-full bg-black/20" />
            <div class="flex h-full flex-col p-6 md:max-w-3/5 md:p-12">
                <h1 class="font-serif text-3xl font-semibold tracking-tight text-pretty text-white drop-shadow sm:text-5xl">Премиальное сопровождение бизнеса по всей России</h1>
                <p class="mt-8 mb-10 text-lg font-medium text-pretty text-gray-100 drop-shadow sm:text-xl">Наши эксперты помогут вам оптимизировать ваш бизнес и принести отличные результаты. Не ждите, улучшайте свой бизнес уже сейчас с Albus.</p>
                <div class="mt-auto flex items-center gap-x-6">
                    <Button color="white" rounded="xl" size="lg"> Подробнее </Button>
                </div>
            </div>
        </SwiperSlide>
    </Swiper>
</template>

<style scoped></style>
