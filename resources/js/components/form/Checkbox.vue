<script setup lang="ts">
// Checkbox component
import { useModel } from "vue";

const props = defineProps<{
    modelValue: boolean;
}>();

const emit = defineEmits(["update:modelValue"]);

const value = useModel(props, "modelValue");
</script>

<template>
    <input type="checkbox" :checked="value" @input="emit('update:modelValue', $event.target.checked)" />
</template>

<style scoped></style>
