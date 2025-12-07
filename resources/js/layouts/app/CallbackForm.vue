<script setup lang="ts">
import formsController from "@/actions/App/Http/Controllers/FormsController";
import { Button } from "@/components/action";
import { Input, InputLabel, TextArea, Toggle } from "@/components/form";
import { Form } from "@inertiajs/vue3";
import { PhCircle, PhPaperPlaneTilt } from "@phosphor-icons/vue";

const emit = defineEmits(["formSubmitted"]);
</script>

<template>
    <Form :action="formsController.store()" method="POST" v-slot="{ errors, processing }" @success="emit('formSubmitted')" resetOnSuccess class="p-4" :options="{ preserveScroll: true }">
        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
            <input type="hidden" name="magic_form_type" default-value="callback" />
            <InputLabel class="sm:col-span-2" label="Ваше имя" :error="errors.name">
                <Input type="text" name="name" placeholder="Ваше имя" />
            </InputLabel>
            <InputLabel label="Телефон" :error="errors.phone">
                <Input type="tel" name="phone" placeholder="+7 (999) 999-99-99" />
            </InputLabel>
            <InputLabel label="E-mail" :error="errors.email">
                <Input type="text" name="email" placeholder="info@company.com" />
            </InputLabel>
            <InputLabel class="sm:col-span-2" label="Сообщение" :error="errors.message">
                <TextArea name="message" placeholder="Сообщение..." />
            </InputLabel>
            <label class="flex items-center gap-x-2 text-sm/6 text-gray-600 sm:col-span-2">
                <Toggle required name="agree" />
                <span>Отправляя заявку, я соглашаюсь на <a href="#" class="font-semibold whitespace-nowrap text-primary-600">обработку персональных данных</a>.</span>
            </label>
        </div>
        <Button type="submit" class="w-full" :disabled="processing">
            <PhCircle v-if="processing" class="h-4 w-4 animate-spin" />
            <span>Отправить</span>
            <PhPaperPlaneTilt v-if="!processing" class="size-4" />
        </Button>
    </Form>
</template>

<style scoped></style>
