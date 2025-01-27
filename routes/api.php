<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ServiceCategoryController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\ProductCategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\TeamController;

// API route for public data
Route::prefix('teams')->group(function () {
    Route::get('/', [TeamController::class, 'index'])->name('api.teams');
    Route::get('/{id}', [TeamController::class, 'show'])->name('api.teams.show');
});
Route::prefix('services')->group(function () {
    Route::controller(ServiceCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('service.categories');
        Route::get('/category/{id}', 'show')->name('service.category.show');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('service');
        Route::get('/{id}', 'show')->name('service.show');
    });
});
Route::prefix('products')->group(function () {
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('products.categories');
        Route::get('/category/{id}', 'show')->name('products.category.show');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('products');
        Route::get('/{id}', 'show')->name('products.show');
    });
});