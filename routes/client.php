<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('client', function () {
    echo 'client';
});

Route::get('home', [HomeController::class, 'index'])->name('client.home');

Route::get('contact', function(){
    return view('client.pages.contact');
});

Route::get('cart/add-product/{productId?}', [CartController::class, 'addProductToCart'])->name('client.cart.add-product');

Route::get('shopping-cart', [CartController::class, 'index'])->name('client.shopping-cart');
