<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('client', function () {
    echo 'client';
});

Route::get('home', [HomeController::class, 'index'])->name('client.home');

Route::get('contact', function(){
    return view('client.pages.contact');
});

Route::get('product/{slug}', [ProductController::class, 'detail'])->name('client.product.slug');

Route::get('cart/add-product/{productId?}/qty/{qty?}', [CartController::class, 'addProductToCart'])
->name('client.cart.add-product')->middleware('auth');

Route::get('shopping-cart', [CartController::class, 'index'])
->name('client.shopping-cart')->middleware('auth');

Route::get('cart/delete-product/{productId?}', [CartController::class, 'deleteProductToCart'])
->name('client.cart.delete-product')->middleware('auth');

Route::get('checkout', [CartController::class, 'checkout'])->name('client.checkout')->middleware('auth');

Route::post('place-order', [CartController::class, 'placeOrder'])->name('client.cart.checkout')->middleware('auth');
