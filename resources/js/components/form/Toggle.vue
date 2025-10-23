<script setup lang="ts">
import { computed } from "vue";

const props = defineProps<{
    defaultValue?: string | number;
    modelValue?: boolean;
    required?: boolean;
}>();

const value = computed({
    get() {
        return props.modelValue !== undefined ? props.modelValue : props.defaultValue;
    },
    set(newValue) {
        emit("update:modelValue", newValue);
    },
});

const emit = defineEmits<{
    (e: "update:modelValue", payload: boolean): void;
}>();
</script>

<template>
    <div class="group relative inline-flex w-8 shrink-0 rounded-full bg-gray-200 p-px inset-ring inset-ring-gray-900/5 outline-offset-2 outline-primary-600 transition-colors duration-200 ease-in-out has-checked:bg-primary-600 has-focus-visible:outline-2">
        <span class="size-4 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-3.5"></span>
        <input type="checkbox" :required="required" @change="value = $event.target.checked" class="absolute inset-0 appearance-none focus:outline-hidden" />
    </div>
</template>

<style scoped></style>
