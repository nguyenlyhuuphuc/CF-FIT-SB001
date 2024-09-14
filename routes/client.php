<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\GoogleController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('test-send-mail', function(){
    $name = Auth::user()->name;
    Mail::to('nguyenlyhuuphucwork@gmail.com')->send(new TestEmail($name));
});

Route::get('google/callback', [GoogleController::class, 'callback'])->name('client.google.callback');
Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('client.google.redirect');
