<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:available,pending,sold'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Nazwa jest wymagana.'),
            'status.required' => __('Status jest wymagany.'),
            'status.in' => __('Nieprawidłowy status.'),
        ];
    }
}

