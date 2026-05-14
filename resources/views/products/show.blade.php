@extends('layouts.app')

@section('title', $product->name . ' - ShopLaravel')

@section('content')
    <div class="row">
        {{-- Product Image --}}
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top rounded" alt="{{ $product->name }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height:400px;">
                        <span style="font-size:6rem;">🛍️</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Product Details --}}
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
                    <h2 class="fw-bold">{{ $product->name }}</h2>
                    <h3 class="text-primary fw-bold">${{ number_format($product->price, 2) }}</h3>

                    <hr>

                    <p class="text-muted lh-lg">{{ $product->description }}</p>

                    <div class="mb-3">
                        @if($product->stock > 0)
                            <span class="badge bg-success">✅ In Stock ({{ $product->stock }} available)</span>
                        @else
                            <span class="badge bg-danger">❌ Out of Stock</span>
                        @endif
                    </div>

                    @auth
                        @if($product->stock > 0)
                            <form method="POST" action="/cart/{{ $product->id }}">
                                @csrf
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <label class="fw-semibold">Quantity:</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width:80px" />
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Add to Cart 🛒
                                    </button>
                                    <a href="/products" class="btn btn-outline-secondary btn-lg">
                                        ← Back
                                    </a>
                                </div>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
                        @endif
                    @else
                        <a href="/login" class="btn btn-primary btn-lg">Login to Buy</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Related Products</h4>
            <div class="row">
                @foreach($relatedProducts as $related)
                    <div class="col-md-3 mb-3">
                        <div class="card product-card shadow-sm border-0">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top" style="height:150px;object-fit:cover;" alt="{{ $related->name }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height:150px;">
                                    <span style="font-size:2rem;">🛍️</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="fw-bold">{{ $related->name }}</h6>
                                <p class="text-primary fw-bold">${{ number_format($related->price, 2) }}</p>
                                <a href="/products/{{ $related->id }}" class="btn btn-outline-primary btn-sm w-100">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection