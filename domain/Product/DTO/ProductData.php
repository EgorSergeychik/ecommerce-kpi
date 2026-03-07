<?php

namespace Domain\Product\DTO;

use Illuminate\Foundation\Http\FormRequest;

class ProductData
{
    public function __construct(
        public readonly ?int $id,
        public readonly array $translations,
        public readonly string $slug,
        public readonly float $price,
    ) {
    }

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            id: $request->product?->id,
            translations: $request->translations,
            slug: $request->slug,
            price: $request->price,
        );
    }
}
