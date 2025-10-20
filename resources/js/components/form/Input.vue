<script setup lang="ts">
import { computed } from "vue";

const props = defineProps<{
    defaultValue?: string | number;
    modelValue?: string | number;
    type: "text" | "email" | "password" | "number" | "tel" | "hidden" | "file";
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
    (e: "update:modelValue", payload: string | number): void;
}>();
</script>

<template>
    <input v-model="value" :type="type" :required="required" class="block w-full rounded-lg px-4 py-3 text-base text-primary-950 outline-1 -outline-offset-1 outline-primary-800 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600" />
</template>

<style scoped></style>
