<script setup lang="ts">
import { useModel } from "vue";

const props = defineProps<{
    modelValue: string | number | null;
    options: any;
    label?: string;
    placeholder?: string;
    required?: boolean;
}>();

const value = useModel(props, "modelValue");
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <select v-model="value" @input="emit('update:modelValue', $event.target.value)" class="w-full border border-primary-600 py-2 pr-7 pl-3.5 font-medium text-primary-950 outline-primary-800 placeholder:text-primary-700 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6">
        <option :value="null" :selected="value === null">{{ placeholder ? placeholder : "Выбрать" }}</option>
        <option v-for="valueItem in options" :key="valueItem.id" :value="valueItem.id">
            {{ valueItem.value }}
        </option>
    </select>
</template>

<style scoped></style>
