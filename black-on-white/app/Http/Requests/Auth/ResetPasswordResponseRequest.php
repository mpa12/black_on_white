<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordResponseRequest extends FormRequest
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
            'remember_token' => 'required|string|exists:users',
            'new_password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'remember_token.required' => 'Поле "remember_token" обязательно для заполнения.',
            'remember_token.exists' => 'Пользователь не найден.',
            'new_password.required' => 'Поле "new_password" обязательно для заполнения.',
            'new_password.min' => 'Минимальная длина пароля должна быть 6 символов.',
        ];
    }
}
