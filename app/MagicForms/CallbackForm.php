<?php

namespace App\MagicForms;

use Waynelogic\MagicForms\Form\AbstractForm;

class CallbackForm extends AbstractForm
{
    public string $group = 'Модальное окно';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Ваше имя',
            'phone' => 'Ваш телефон',
        ];
    }
}
