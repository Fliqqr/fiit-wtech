<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('index');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/item', [ProductController::class, 'show'])->name('product.show');

Route::view('/admin', 'admin');
Route::view('/delivery', 'delivery');
Route::view('/edit-product', 'edit_product');
Route::view('/login', 'login');
Route::view('/payment', 'payment');
Route::view('/register', 'register');
Route::view('/welcome', 'welcome');

