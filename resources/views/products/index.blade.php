@extends('layouts.app')

@section('title', 'Products - ShopLaravel')

@section('content')
    {{-- Hero --}}
    <div class="p-4 mb-4 bg-dark text-white rounded-3 text-center">
        <h1 class="fw-bold">🛍️ Our Products</h1>
        <p class="lead mb-0">Find the best products at the best prices!</p>
    </div>

    <div class="row">
        {{-- Sidebar Filters --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">🔍 Filter Products</div>
                <div class="card-body">
                    <form method="GET" action="/products">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ $search }}" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="/products" class="btn btn-outline-secondary">Clear Filters</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted mb-0">{{ $products->total() }} products found</p>
            </div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100 shadow-sm border-0">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="{{ $product->name }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                    <span style="font-size:3rem;">🛍️</span>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
                                <h6 class="card-title fw-bold">{{ $product->name }}</h6>
                                <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-primary fs-5">${{ number_format($product->price, 2) }}</span>
                                        <small class="text-muted">Stock: {{ $product->stock }}</small>
                                    </div>
                                    <div class="d-grid gap-2 mt-2">
                                        <a href="/products/{{ $product->id }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                        @auth
                                            @if($product->stock > 0)
                                                <form method="POST" action="/cart/{{ $product->id }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm w-100">Add to Cart 🛒</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                                            @endif
                                        @else
                                            <a href="/login" class="btn btn-primary btn-sm">Login to Buy</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No products found! Try different filters.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection