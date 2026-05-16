@extends('layouts.app')

@section('title', 'Checkout - ShopLaravel')

@section('content')
    <h2 class="fw-bold mb-4">💳 Checkout</h2>

    <div class="row">
        {{-- Checkout Form --}}
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Delivery Information</div>
                <div class="card-body p-4">
                    <form method="POST" action="/orders">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter phone number" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Enter delivery address" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Place Order →</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Order Summary</div>
                <div class="card-body">
                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-primary">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection