<?php

use App\Http\Controllers\backend\PortfolioController;
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
    Route::post('/{id}', [TeamController::class, 'show'])->name('api.teams.show');
});
Route::prefix('services')->group(function () {
    Route::controller(ServiceCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('service.categories');
        Route::post('/category/{id}', 'show')->name('service.category.show');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('service');
        Route::post('/{id}', 'find')->name('service.show');
    });
});
Route::prefix('products')->group(function () {
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('products.categories');
        Route::post('/category/{id}', 'show')->name('products.category.show');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('products');
        Route::post('/{id}', 'show')->name('products.show');
    });
});
Route::prefix('/portfolio')->group(function () {
    Route::controller(PortfolioController::class)->group(function () {
        Route::get('/', 'getData')->name('portfolio');
        Route::post('/add', 'store')->name('portfolio.add');
        Route::get('/data', 'getData')->name('portfolio.data');
        // Route::get('/edit/{id}', 'edit')->name('portfolio.edit');
        // Route::post('/update/{id}', 'update')->name('portfolio.update');
        // Route::get('/destroy/{id}', 'destroy')->name('portfolio.destroy');
    });
});