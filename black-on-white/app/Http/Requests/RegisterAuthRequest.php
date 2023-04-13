<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class RegisterAuthRequest extends FormRequest
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
    public function authorize()
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
