<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ValidateTokenRequest extends FormRequest
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
        ];
    }
}
