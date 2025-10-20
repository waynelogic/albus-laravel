<script setup lang="ts">
import { HTMLAttributes, useModel } from "vue";

const props = defineProps<{
    defaultValue?: string | number;
    modelValue?: string | number;
    class?: HTMLAttributes["class"];
    required?: boolean;
}>();

const value = useModel(props, "modelValue");
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <textarea :required="required" class="block w-full rounded-lg px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-primary-800 duration-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600" v-model="value" @input="emit('update:modelValue', $event.target.value)" />
</template>

<style scoped></style>
