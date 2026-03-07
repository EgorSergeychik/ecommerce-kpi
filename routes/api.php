<?php

use Domain\Product\Models\Product;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'prefix' => '/v1'], function () {
    Route::group(['prefix' => '/products'], function () {
//        Route::get('/', [\Domain\Product\Controllers\ProductController::class, 'index']);
        Route::post('/', [\Domain\Product\Controllers\ProductController::class, 'store'])
            ->can('create', Product::class);
//        Route::get('/{product}', [\Domain\Product\Controllers\ProductController::class, 'show']);
//        Route::put('/{product}', [\Domain\Product\Controllers\ProductController::class, 'update']);
//        Route::delete('/{product}', [\Domain\Product\Controllers\ProductController::class, 'destroy']);
    });
});

Route::get('/health', [\App\Http\Controllers\AppController::class, 'health']);
Route::get('/hard-request', [\App\Http\Controllers\AppController::class, 'hardRequest']);
