<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
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

Route::post('admin/product_category/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.product_category.delete');

Route::get('admin/product_category/detail/{id}', [ProductCategoryController::class, 'detail'])->name('admin.product_category.detail');

Route::post('admin/product_category/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.product_category.update');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('product', ProductController::class);
});
Route::post('admin/product/make-slug', [ProductController::class, 'makeSlug'])->name('admin.product.make.slug');
