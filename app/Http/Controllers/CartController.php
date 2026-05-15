<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
        $cart = session('cart', []);
        $total = 0;

        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', ['cart' => $cart, 'total' => $total]);
    }

    public function add(Request $request, Product $product){
        $quantity = $request->quantity ?? 1;

        if($product->stock < $quantity){
            return back()->with('error', 'Not enough stock available!');
        }

        $cart = session('cart', []);

        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity'] += $quantity;
        }else{
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        session(['cart' => $cart]);

        return redirect('/cart')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Product $product){
        $cart = session('cart', []);

        if(isset($cart[$product->id])){
            if($request->quantity > 0){
                $cart[$product->id]['quantity'] = $request->quantity;
            }else{
                unset($cart[$product->id]);
            }
        }

        session(['cart' => $cart]);

        return redirect('/cart')->with('success', 'Cart updated!');
    }

    public function remove(Product $product){
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return redirect('/cart')->with('success', 'Item removed from cart!');
    }
}
