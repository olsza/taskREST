<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:available,pending,sold'],
            'category' => ['nullable', 'array'],
            'category.id' => ['nullable', 'integer'],
            'category.name' => ['nullable', 'string'],
            'photoUrls' => ['required', 'array'],
            'photoUrls.*' => ['string'],
            'tags' => ['required', 'array'],
            'tags.*.id' => ['nullable', 'integer'],
            'tags.*.name' => ['nullable', 'string'],
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

