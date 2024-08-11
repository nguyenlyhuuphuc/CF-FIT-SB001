<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function (){
    return view('test.abc.xyz.test');
});

Route::get('abc', function(){
    echo '<h1>ABC</h1>';
});

Route::get('a/b/c/x/y/z', function (){
    echo '<i>Z</i>';
});

Route::get('test-sum', function (){
    $number1 = 10;
    $number2 = 5;

    echo sprintf('%s + %s = %s', $number1, $number2, $number1 + $number2);
});


Route::get('product/detail/{productId}', function ($productId){
    echo "Product id : $productId";
});


Route::get('product/{productId}/qty/{qty?}', function ($productId, $qty = 1){
    echo sprintf("Add product Id : %s, into card with qty : %s", $productId, $qty);
});
