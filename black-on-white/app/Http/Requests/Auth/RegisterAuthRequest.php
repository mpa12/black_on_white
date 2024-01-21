<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя пользователя" обязательно для заполнения.',
            'name.max' => 'Максимальная длина поля "Название новости" должна быть 255 символов.',
            'email.required' => 'Поле "E-mail" обязательно для заполнения.',
            'email.max' => 'Максимальная длина поля "E-mail" должна быть 255 символов.',
            'email.unique' => 'Такой E-mail же используется.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Минимальная длина пароля должна быть 6 символов.',
        ];
    }
}
