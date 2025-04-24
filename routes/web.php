<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryController;


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/item', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/delivery/submit', [DeliveryController::class, 'store'])->name('delivery.submit');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::get('/confirm', [CartController::class, 'confirmOrder'])->name('cart.confirm');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::view('/admin', 'admin')->name('admin');
Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/edit-product', 'edit_product')->name('edit-product');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

require __DIR__.'/auth.php';

