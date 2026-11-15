<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/menu', [SiteController::class, 'menu'])->name('menu');
Route::get('/cart', [SiteController::class, 'cart'])->name('cart');
Route::post('/cart/{coffeeItem}', [SiteController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart', [SiteController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', [SiteController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [SiteController::class, 'placeOrder'])->name('checkout.place');
Route::get('/order/{uuid}', [SiteController::class, 'receipt'])->name('orders.receipt');
Route::post('/newsletter', [SiteController::class, 'subscribe'])->name('newsletter');

Route::prefix('studio')->name('studio.')->middleware('studio')->group(function (): void {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::patch('/orders/{cafeOrder}', [AdminController::class, 'updateStatus'])->name('orders.status');
});
