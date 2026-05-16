@extends('layouts.app')

@section('title', 'My Orders - ShopLaravel')

@section('content')
    <h2 class="fw-bold mb-4">📦 My Orders</h2>

    @if($orders->count() > 0)    
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'processing' ? 'bg-info' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="/orders/{{ $order->id }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    @else
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body p-5">
                <div style="font-size:4rem;">📦</div>
                <h4 class="fw-bold mt-3">No orders yet!</h4>
                <p class="text-muted">Start shopping to place your first order</p>
                <a href="/products" class="btn btn-primary">Browse Products</a>
            </div>
        </div>       
    @endif
@endsection