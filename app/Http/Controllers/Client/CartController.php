<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart(Request $request, int $productId, int $qty = 1){
        $cart = session()->get('cart', []);

        $product = Product::find($productId);

        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'qty' => isset($cart[$productId]['qty']) ? ($cart[$productId]['qty'] + $qty) : 1
        ];

        session()->put('cart', $cart);

        return response()->json(['message' => 'Add product to cart success!']);
    }

    public function index(){
        $cart = session()->get('cart', []);

        return view('client.pages.shopping-cart', ['cart' => $cart]);
    }

    public function deleteProductToCart(int $productId){
        $cart = session()->get('cart', []);

        if(array_key_exists($productId, $cart)){
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Delete product on cart success!']);
    }

    public function checkout(){
        $cart = session()->get('cart', []);
        return view('client.pages.checkout', ['cart' => $cart]);
    }

    public function placeOrder(Request $request){
        dd($request->all());
    }
}
