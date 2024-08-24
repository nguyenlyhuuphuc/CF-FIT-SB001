<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('admin/dashboard', function (){
    return view('admin.pages.dashboard');
});

Route::get('admin/product', function (){
    return view('admin.pages.product');
});

Route::get('admin/blog', function (){
    return view('admin.pages.blog');
});


Route::get('admin/product_category', [ProductCategoryController::class, 'index'])->name('admin.product_category.index');

Route::get('admin/product_category/create', [ProductCategoryController::class, 'create'])->name('admin.product_category.create');

Route::post('admin/product_category/store', [ProductCategoryController::class, 'store'])->name('admin.product_category.store');
