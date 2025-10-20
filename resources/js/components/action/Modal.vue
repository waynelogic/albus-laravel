<script setup lang="ts">
import { computed, ref, watch } from "vue";

const props = withDefaults(
    defineProps<{
        modelValue: boolean;
        title?: string;
        width?: "sm" | "md" | "lg" | "xl" | "2xl" | "6xl";
    }>(),
    {
        title: "Заголовок по умолчанию",
        width: "2xl",
    },
);

const emit = defineEmits<{
    (e: "update:modelValue", value: boolean): void;
}>();

const modalRef = ref<HTMLDialogElement | null>(null);

// Watch for changes to the modelValue prop
watch(
    () => props.modelValue,
    (newValue) => {
        if (!modalRef.value) return;

        if (newValue) {
            modalRef.value.showModal();
            document.body.style.overflow = "hidden";
        } else {
            setTimeout(() => {
                modalRef.value.close();
                document.body.style.overflow = "auto";
            }, 300);
        }
    },
    { immediate: true },
);

const closeModal = () => {
    emit("update:modelValue", false);
};

// Handle clicks on the backdrop
const handleBackdropClick = (event: MouseEvent) => {
    if (event.target === modalRef.value) {
        closeModal();
    }
};

const widthClass = computed(() => {
    return {
        sm: "max-w-sm",
        md: "max-w-md",
        lg: "max-w-lg",
        xl: "max-w-xl",
        "2xl": "max-w-2xl",
        "6xl": "max-w-6xl",
    }[props.width];
});
</script>

<template>
    <transition enter-active-class="duration-300" leave-active-class="duration-300" enter-from-class="opacity-0" leave-to-class="opacity-0">
        <dialog ref="modalRef" v-show="modelValue" :class="['m-auto rounded-lg bg-white backdrop:bg-black/50']" @click="handleBackdropClick" @close="closeModal">
            <div :class="['content', widthClass]">
                <slot name="header">
                    <div class="flex items-center justify-between border-b border-gray-200 px-4 py-3">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ title }}
                        </h3>
                        <button @click="closeModal" class="top-2 right-2 cursor-pointer px-2 text-4xl text-gray-400 hover:text-gray-600">&times;</button>
                    </div>
                </slot>
                <slot>
                    <p class="text-sm text-gray-500">Тело модального окна по умолчанию.</p>
                </slot>
                <div v-if="$slots.footer" class="flex items-center gap-4 px-4 py-3">
                    <slot name="footer" />
                </div>
            </div>
        </dialog>
    </transition>
</template>

<style scoped></style>
