<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderEmailAdmin;
use App\Mail\OrderEmailCustomer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function addProductToCart(Request $request, int $productId, int $qty = 1){
        $cart = session()->get('cart', []);

        $product = Product::find($productId);

        if($product->qty <= 0){
            return response()->json(['message' => 'Product out of stock']);
        }

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
        try{
            DB::beginTransaction();

            $total = 0;
            $cart = session()->get('cart', []);
            foreach($cart as $item){
                $total += $item['price'] * $item['qty'];
            }

            $order = new Order;
            $order->address = $request->name;
            $order->note = $request->notes;
            $order->status = 'pending';
            $order->user_id = Auth::user()->id;
            $order->total = $total;
            $order->save(); // Insert new record

            foreach($cart as $productId => $item){
                $orderItem = new OrderItem;
                $orderItem->price = $item['price'];
                $orderItem->qty = $item['qty'];
                $orderItem->image = $item['image'];
                $orderItem->name = $item['name'];
                $orderItem->product_id = $productId;
                $orderItem->order_id = $order->id;
                $orderItem->save(); // Insert new record
            }

            $user = Auth::user();
            $user->phone = $request->phone;
            $user->save(); //update record

            //Empty Cart
            session()->put('cart', []);

            //Send mail customer
            Mail::to('nguyenlyhuuphucwork@gmail.com')->send(new OrderEmailCustomer($order));
            //Send mail admin
            Mail::to('nguyenlyhuuphucwork@gmail.com')->send(new OrderEmailAdmin($order));
            //Minus qty on product
            foreach($cart as $productId => $item){
                $product = Product::find($productId);
                $product->qty -= $item['qty'];
                $product->save(); //update record
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        //Flash message
        return redirect()->route('home')->with('message', '');
    }
}
