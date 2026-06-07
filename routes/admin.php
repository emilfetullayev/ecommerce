<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\TranslationController;


Route::get('/users/', function () {
    return view('admin.products.index');
});
Route::get('/users/create', function () {
    return view('admin.products.create');
});

Route::group(['middleware' => 'guest:web'], function () {

    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);


});


Route::middleware('auth:web')->group(function () {

    Route::get('/translations', [TranslationController::class, 'index'])
        ->name('admin.translations.index');

    Route::post('/translations', [TranslationController::class, 'store'])
        ->name('admin.translations.store');

    Route::get('/translations/{group}/{key}/edit', [TranslationController::class, 'edit'])
        ->name('admin.translations.edit');

    Route::put('/translations/{group}/{key}', [TranslationController::class, 'update'])
        ->name('admin.translations.update');

    Route::delete('/translations/{group}/{key}', [TranslationController::class, 'destroy'])
        ->name('admin.translations.destroy');

    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('companies', CompanyController::class);

    Route::delete('/product-image/{id}', [ProductController::class, 'deleteImage'])
        ->name('products.image.delete');

    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');

});


