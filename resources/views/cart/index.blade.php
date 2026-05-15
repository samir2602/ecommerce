@extends('layouts.app')

@section('title', 'Cart - ShopLaravel')

@section('content')
   <h2 class="fw-bold mb-4">🛒 My Cart</h2>
   @if(count($cart) > 0)   
       <div class="row">
            {{-- Cart Items --}}
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        @foreach($cart as $item)
                            <div class="row align-items-center mb-3 pb-3 border-bottom">
                                <div class="col-md-2">
                                    @if($item['image'])                                    
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded" alt="{{ $item['name'] }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height:60px;">
                                            <span>🛍️</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-0">{{ $item['name'] }}</h6>
                                    <small class="text-muted">${{ number_format($item['price'], 2) }} each</small>
                                </div>
                                <div class="col-md-3">
                                    <form method="POST" action="/cart/{{ $item['id'] }}">
                                        @csrf()
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" class="form-control form-control-sm" onchange="this.form.submit()">
                                    </form>
                                </div>
                                <div class="col-md-2 text-center">
                                    <span class="fw-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                                <div class="col-md-1">
                                    <form method="POST" action="/cart/{{ $item['id'] }}">
                                        @csrf()
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- Order Summary --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Order Summary</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span class="text-primary">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-grid mt-3">
                            <a href="/checkout" class="btn btn-primary btn-lg">
                                Proceed to Checkout →
                            </a>
                        </div>
                        <div class="d-grid mt-2">
                            <a href="/products" class="btn btn-outline-secondary">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
       </div>
   @else
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body p-5">
                <div style="font-size:4rem;">🛒</div>
                <h4 class="fw-bold mt-3">Your cart is empty!</h4>
                <p class="text-muted">Add some products to get started</p>
                <a href="/products" class="btn btn-primary">Browse Products</a>
            </div>
        </div>       
   @endif
@endsection