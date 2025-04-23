<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/item', [ProductController::class, 'show'])->name('product.show');

Route::view('/cart', 'cart')->name('cart');
Route::view('/', 'index')->name('home');
Route::view('/admin', 'admin')->name('admin');
Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/edit-product', 'edit_product')->name('edit-product');
Route::view('/login', 'login')->name('login');
Route::view('/payment', 'payment')->name('payment');
Route::view('/register', 'register')->name('register');

require __DIR__.'/auth.php';

