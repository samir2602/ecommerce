@extends('layouts.app')

@section('title', 'Manage Products - Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Manage Products</h2>
        <a href="/admin/products/create" class="btn btn-primary">+ Add Product</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" style="width:50px;height:50px;object-fit:cover;" class="rounded">
                                @else
                                    <span>🛍️</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form method="POST" action="/admin/products/{{ $product->id }}" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection