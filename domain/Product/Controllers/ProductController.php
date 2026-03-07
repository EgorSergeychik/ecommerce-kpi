<?php

namespace Domain\Product\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\DTO\ProductData;
use Domain\Product\Models\Product;
use Domain\Product\Requests\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function store(CreateProductRequest $request): JsonResponse
    {
        $data = ProductData::fromRequest($request);

        $product = Product::create([
            'translations' => $data->translations,
            'slug' => $data->slug,
            'price' => $data->price,
        ]);

        Log::info('Product created', ['product_id' => $product->id]);

        return $this->success($product);
    }
}
