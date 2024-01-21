<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
{
    use FailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^(\+7|8|7){1}\d{10}$/', 'max:255', 'string'],
            'email' => 'required|email|string|max:255',
            'message' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.max' => 'Максимальная длина поля "Имя" 255 символов.',
            'message.required' => 'Поле "Сообщение" обязательно для заполнения.',
            'message.max' => 'Максимальная длина поля "Сообщение" 255 символов.',
            'email.required' => 'Поле "E-mail" обязательно для заполнения.',
            'email.email' => 'Поле "E-mail" в неверном формате.',
            'email.max' => 'Максимальная длина поля "E-mail" 255 символов.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.max' => 'Максимальная длина поля "Телефон" 255 символов.',
            'phone.regex' => 'Номер телефона введен в неверном формате. Примеры: 89998889988, 79998889988, +79998889988.',
        ];
    }
}
