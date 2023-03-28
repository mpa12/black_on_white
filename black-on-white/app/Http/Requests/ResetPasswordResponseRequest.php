<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ResetPasswordResponseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json([
                'message' => "",
                'errors' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

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
