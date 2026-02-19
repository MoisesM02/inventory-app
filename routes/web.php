<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products/create', [ProductController::class, 'create']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/create', [ProductController::class, 'store']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);
Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
Route::patch('/products/{product}/edit', [ProductController::class, 'update']);

//Purchases
Route::get('/purchases/cart/search', [CartController::class, 'show'])->name('cart.search');
Route::get('/purchases/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/purchases/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('/purchases/details/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::post('/purchases/outward/{purchase}', [PurchaseController::class, 'outward'])->name('purchases.return');
