<?php

namespace Domain\Product\Requests;

use App\Support\Enums\Locale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'translations' => [
                'required',
                'array',
                'min:1',
            ],
            'translations.*.locale' => [
                'required',
                'string',
                Rule::in(Locale::values()),
            ],
            'translations.*.name' => [
                'required',
                'string',
            ],
            'translations.*.description' => [
                'required',
                'string',
            ],
            'slug' => [
                'required',
            ],
            'price' => [
                'required',
                'numeric',
                'gt:0',
            ],
        ];
    }
}
