<?php

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

Route::get('admin/product_category', function (){
    return view('admin.pages.product_category.index');
});

Route::get('admin/product_category/create', function (){
    return view('admin.pages.product_category.create');
});
