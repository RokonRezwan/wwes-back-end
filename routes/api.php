<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PriceTypeController;
use App\Http\Controllers\Api\ProductRestoreController;
use App\Http\Controllers\Api\CategoryRestoreController;
use App\Http\Controllers\Api\PriceTypeRestoreController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class)->except(['create', 'edit']);
Route::get('categories/toggle-status/{category}', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

Route::apiResource('products', ProductController::class)->except(['create', 'edit']);
Route::get('products/toggle-status/{product}', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

Route::apiResource('price-types', PriceTypeController::class)->except(['create', 'edit']);
Route::get('price-types/toggle-status/{priceType}', [PriceTypeController::class, 'toggleStatus'])->name('price-types.toggleStatus');

Route::post('product/price-list/{price_id}', [ProductController::class, 'priceListDestroy']); // For Product Price List Delete







/* Category Restore */
/* Route::controller(CategoryRestoreController::class)->prefix('categories')->as('categoriesRestore.')->group(function () {
    Route::get('/restore-index', [CategoryRestoreController::class, 'index'])->name('index');
    Route::get('/restore-all', [CategoryRestoreController::class, 'restoreAll'])->name('restoreAll');
    Route::get('/restore/{category}', [CategoryRestoreController::class, 'restore'])->name('restore');
    Route::get('/delete/{category}', [CategoryRestoreController::class, 'delete'])->name('delete');
}); */