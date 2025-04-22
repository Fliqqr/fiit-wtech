<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/admin', 'admin');
Route::view('/cart', 'cart');
Route::view('/delivery', 'delivery');
Route::view('/edit-product', 'edit_product');
Route::view('/item', 'item');
Route::view('/login', 'login');
Route::view('/payment', 'payment');
Route::view('/products', 'products');
Route::view('/register', 'register');
Route::view('/welcome', 'welcome');
