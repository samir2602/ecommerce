<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function show(Order $order){
        $order->load('items.product', 'user');
        return view('admin.orders.show', ['order' => $order]);
    }

    public function update(Request $request, Order $order){
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect('/admin/orders/' . $order->id)->with('success', 'Order status updated!');
    }
}
