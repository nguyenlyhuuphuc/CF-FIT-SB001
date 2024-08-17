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

