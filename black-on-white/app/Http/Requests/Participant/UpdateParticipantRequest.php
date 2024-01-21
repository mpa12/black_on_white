<?php

namespace App\Http\Requests\Participant;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateParticipantRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ];

        if ($this->hasFile('photo')) {
            $rules['photo'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}
