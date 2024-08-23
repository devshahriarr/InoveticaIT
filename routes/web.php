<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\serviceController;
use App\Http\Controllers\backend\ServiceCategoryController;
use App\Http\Controllers\backend\productCategoryController;
use App\Http\Controllers\backend\productController;
use App\Http\Controllers\backend\productSubCategoryController;
use App\Http\Controllers\backend\teamController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//routes for dashboard
// Route::get('/', function () {
//     return view('backend.dashboard');
// });

Route::prefix('backend/services')->group(function () {
    Route::controller(ServiceCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('backend.service.categories');
        Route::post('/category/store', 'store')->name('backend.service.category.store');
        Route::get('/category/view', 'show')->name('category.view');
        // Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        // Route::post('/category/update/{id}', 'update')->name('category.update');
        // Route::get('/category/delete/{id}', 'delete')->name('category.delete');
    });
    Route::controller(serviceController::class)->group(function () {
        Route::get('/', 'index')->name('backend.services');
        Route::post('/store', 'store')->name('backend.service.store');
        // Route::get('/category/view', 'show')->name('category.view');
        // Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        // Route::post('/category/update/{id}', 'update')->name('category.update');
        // Route::get('/category/delete/{id}', 'delete')->name('category.delete');
    });
});
Route::prefix('backend/product')->group(function () {
    Route::controller(productCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('backend.product.categories');
        Route::post('/category/store', 'store')->name('backend.product.category.store');
        // Route::get('/category/view', 'show')->name('category.view');
        // Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        // Route::post('/category/update/{id}', 'update')->name('category.update');
        // Route::get('/category/delete/{id}', 'delete')->name('category.delete');
    });
    Route::controller(productSubCategoryController::class)->group(function () {
        Route::get('/subcategories', 'index')->name('backend.product.subcategories');
        // Route::post('/category/store', 'store')->name('backend.product.category.store');
        // Route::get('/category/view', 'show')->name('category.view');
        // Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        // Route::post('/category/update/{id}', 'update')->name('category.update');
        // Route::get('/category/delete/{id}', 'delete')->name('category.delete');
    });
    Route::controller(productController::class)->group(function () {
        Route::get('/', 'index')->name('backend.product');
        // Route::post('/store', 'store')->name('backend.product.store');
        Route::get('/category/view', 'show')->name('backend.product.list');
        // Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        // Route::post('/category/update/{id}', 'update')->name('category.update');
        // Route::get('/category/delete/{id}', 'delete')->name('category.delete');
    });
});

Route::prefix('backend/team')->group(function () {
    Route::controller(TeamController::class)->group(function () {
        Route::get('/', 'index')->name('backend.team');
        Route::post('/add', 'store')->name('backend.team.add');
        Route::get('/data', 'getData')->name('backend.team.data');
        Route::get('/edit/{id}', 'edit')->name('team.edit');
        Route::post('/update/{id}', 'update')->name('team.update');
        Route::get('/destroy/{id}', 'destroy')->name('team.destroy');
    });
});

});

// Route::prefix('services')->group(function () {
//     Route::get('/category', [ServiceController::class, 'index'])->name(''); // Show all services
//     Route::get('/', [ServiceController::class, 'index'])->name('services.index'); // Show all services
//     Route::get('/create', [ServiceController::class, 'create'])->name('services.create'); // Show form to create a service
//     Route::post('/', [ServiceController::class, 'store'])->name('services.store'); // Store a new service
//     Route::get('/{id}', [ServiceController::class, 'show'])->name('services.show'); // Show a single service
//     Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit'); // Show form to edit a service
//     Route::put('/{id}', [ServiceController::class, 'update'])->name('services.update'); // Update a service
//     Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('services.destroy'); // Delete a service
// });
require __DIR__ . '/auth.php';
