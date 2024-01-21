<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordAuthRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|exists:users',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "E-mail" обязательно для заполнения.',
            'email.max' => 'Максимальная длина e-mail 255 символов.',
            'email.exists' => 'Пользователь не найден.',
            'email.email' => 'E-mail не прошел валидацию.',
        ];
    }
}
