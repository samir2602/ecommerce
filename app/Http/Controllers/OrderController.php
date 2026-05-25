<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout(){
        $cart = session('cart', []);

        if(empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] + $item['quantity'];
        }

        return view('checkout.index', ['cart' => $cart, 'total' => $total]);
    }

    public function store(Request $request){
        $cart = session('cart', []);

        if(empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required|min:10',
        ]);

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        foreach($cart as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
        }

        Mail::to($order->email)->send(new OrderConfirmation($order));
        session()->forget('cart');

        return redirect('/orders/'. $order->id)->with('success', 'Order placed successfully!');
    }

    public function index(){
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order){
        if($order->user_id != auth()->id()){
            abort(403);
        }

        return view('orders.show', ['order' => $order]);
    }
}
