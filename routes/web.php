<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SupplierController;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {

//main route
    Route::get('/', function () {
        $usersCount = User::all()->except([1])->count();
        return view('welcome',
        [
            'usersCount' => $usersCount
        ]);
    });

    // Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/edit/{supplier}', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::patch('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

//Products
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products/create', [ProductController::class, 'store']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
    Route::patch('/products/{product}/edit', [ProductController::class, 'update']);

//Purchases cart
    Route::get('/purchases/cart/search', [CartController::class, 'show'])->name('cart.search');
    Route::get('/purchases/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/purchases/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

//Purchases
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/details/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::post('/purchases/outward/{purchase}', [PurchaseController::class, 'outward'])->name('purchases.return');

//Users Management
    Route::middleware('can:viewAny,' . User::class)->group(function(){
        Route::get('/users', [RegisteredUserController::class, 'index']);
        Route::post('/users', [RegisteredUserController::class, 'store']);
        Route::get('/users/{user}', [RegisteredUserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}', [RegisteredUserController::class, 'update'])->name('users.update');
    });

});


//Login
Route::get('/login', [\App\Http\Controllers\SessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\SessionController::class, 'store']);
Route::post('/logout', [\App\Http\Controllers\SessionController::class, 'destroy'])->name('logout');
