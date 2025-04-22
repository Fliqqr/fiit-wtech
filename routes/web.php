<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('index');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::view('/admin', 'admin');
Route::view('/cart', 'cart');
Route::view('/delivery', 'delivery');
Route::view('/edit-product', 'edit_product');
Route::view('/item', 'item');
Route::view('/login', 'login');
Route::view('/payment', 'payment');
Route::view('/register', 'register');
Route::view('/welcome', 'welcome');
