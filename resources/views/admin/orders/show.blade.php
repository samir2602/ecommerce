@extends('layouts.app')

@section('title', 'Order #{{ $order->id }} - Admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Order Header --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">Order #{{ $order->id }}</h4>
                            <small class="text-muted">{{ $order->created_at->format('d M Y h:i A') }}</small>
                        </div>
                        <span class="badge fs-6 {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'processing' ? 'bg-info' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">Update Status</div>
                <div class="card-body">
                    <form method="POST" action="/admin/orders/{{ $order->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex gap-3 align-items-center">
                            <select name="status" class="form-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">Order Items</div>
                <div class="card-body">
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <h6 class="fw-bold mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                            </div>
                            <span class="fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between fw-bold fs-5 mt-2">
                        <span>Total</span>
                        <span class="text-primary">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Customer Info --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">Customer Information</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Name:</strong> {{ $order->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p class="mb-0"><strong>Address:</strong> {{ $order->address }}</p>
                </div>
            </div>

            <a href="/admin/orders" class="btn btn-outline-secondary">← Back to Orders</a>
        </div>
    </div>
@endsection