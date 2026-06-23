<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest:company'], function () {
    // Qeydiyyat (Register)
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Giriş (Login)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('company.login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/company/logout', [AuthController::class, 'logout'])->name('company.logout');

Route::get('/contact', [ContactController::class, 'index'])->name('web.contact');
Route::get('/products', [ProductController::class, 'index'])->name('web.product');
Route::get('/category/{id}', [ProductController::class, 'byCategory'])->name('category.products');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [HomeController::class, 'show'])->name('web.product.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/cart/complete', [CartController::class, 'completeOrder'])
    ->name('cart.complete');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['az', 'en', 'ru', 'zh'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
