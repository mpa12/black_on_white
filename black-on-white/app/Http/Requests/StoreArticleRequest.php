<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'text' => 'required|string',
            'photo' => 'required|image',
            'article_type_id' => 'required|exists:article_type,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Название новости" обязательно для заполнения.',
            'title.max' => 'Максимальная длина поля "Название новости" должна быть 255 символов.',
            'description.required' => 'Поле "Краткое описание новости" обязательно для заполнения.',
            'description.max' => 'Максимальная длина поля "Краткое описание новости" должна быть 255 символов.',
            'text.required' => 'Поле "Текст новости" обязательно для заполнения.',
            'photo.required' => 'Поле "Главное изображение новости" обязательно для заполнения.',
            'photo.image' => 'Поле "Главное изображение новости" должно содержать изображение.',
            'article_type_id.required' => 'Поле "Тип новости" обязательно для заполнения.',
            'article_type_id.exists' => 'Выбранный тип новости недопустим.',
        ];
    }
}
