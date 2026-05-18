@extends('layouts.app')

@section('title', 'Admin Dashboard - ShopLaravel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">⚙️ Admin Dashboard</h2>
        <div class="d-flex gap-2">
            <a href="/admin/products" class="btn btn-primary btn-sm">Manage Products</a>
            <a href="/admin/categories" class="btn btn-secondary btn-sm">Manage Categories</a>
            <a href="/admin/orders" class="btn btn-info btn-sm text-white">Manage Orders</a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h2 class="fw-bold text-primary">{{ $totalProducts }}</h2>
                    <p class="text-muted mb-0">Total Products</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h2 class="fw-bold text-primary">{{ $totalOrders }}</h2>
                    <p class="text-muted mb-0">Total Orders</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h2 class="fw-bold text-primary">{{ $totalUsers }}</h2>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">Recent Orders</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'processing' ? 'bg-info' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection