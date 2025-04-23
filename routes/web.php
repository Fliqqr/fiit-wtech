<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/cart', 'cart')->name('cart');
Route::view('/admin', 'admin')->name('admin');
Route::view('/edit_product', 'edit_product')->name('edit_product');
Route::view('/item', 'item')->name('item');
Route::view('/payment', 'payment')->name('payment');
Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/services', 'services')->name('services');
Route::view('/gallery', 'gallery')->name('gallery');

// Route for products page
Route::get('/products', function () {
    $products = Product::paginate(6); //change pagination value to list different counts of products
    return view('products', compact('products'));
})->name('products.index');

require __DIR__.'/auth.php';
