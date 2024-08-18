<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function (){
    return view('client.pages.home');
});

Route::get('contact', function (){
    return view('client.pages.contact');
});

Route::get('test', function (){
    return view('client.layout.master');
});


Route::get('admin/dashboard', function (){
    return view('admin.layout.master');
});
