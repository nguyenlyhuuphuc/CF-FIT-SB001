<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart(Request $request, int $productId){
        $cart = [];

        $product = Product::find($productId);

        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'qty' => 1
        ];

        session()->put('cart', $cart);

        return response()->json(['message' => 'Add product to cart success!']);
    }

    public function index(){
        $cart = session()->get('cart', []);

        dd($cart);
    }
}
