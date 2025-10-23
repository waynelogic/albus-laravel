<script setup lang="ts">
import { onMounted, ref, useTemplateRef } from 'vue';

const mapContainer = useTemplateRef<HTMLDivElement | null>("mapContainer");

const props = defineProps<{
    width?: string;
    height?: string;
    lang?: string;
    scroll?: boolean;
}>();

const show = ref(false);

onMounted(() => {
    const script = document.createElement('script');
    script.src = 'https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Abc699abae09f6e43662c64cf62e0997777e0b3bfd136adffc4d8f6ab24f2a38c&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true';
    script.async = true;
    script.id = 'yandex-map-script';

    // Проверяем, что контейнер существует, прежде чем добавлять скрипт
    if (mapContainer.value) {
        mapContainer.value.appendChild(script);
    }
})
</script>

<template>
    <div ref="mapContainer"/>
</template>

<style scoped>

</style>
