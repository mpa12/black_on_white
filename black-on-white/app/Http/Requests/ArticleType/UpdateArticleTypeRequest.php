<?php

namespace App\Http\Requests\ArticleType;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleTypeRequest extends FormRequest
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
            'title' => 'required|string|max:32',
        ];
    }
}
