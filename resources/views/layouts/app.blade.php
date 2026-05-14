<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'ShopLaravel')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            body { background-color: #f8f9fa; }
            .product-card { transition: transform 0.2s; }
            .product-card:hover { transform: translateY(-3px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
            .navbar-brand { font-size: 1.5rem; }
            .cart-badge { position: relative; }
        </style>
    </head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand fw-bold" href="/">🛍️ ShopLaravel</a>
        <div class="navbar-nav ms-auto d-flex flex-row gap-3 align-items-center">
            <a class="nav-link text-white" href="/products">Products</a>

            @auth
                <a class="nav-link text-white" href="/cart">
                    🛒 Cart
                    @if(session('cart'))
                        <span class="badge bg-danger">{{ count(session('cart')) }}</span>
                    @endif
                </a>
                <a class="nav-link text-white" href="/orders">My Orders</a>

                @if(auth()->user()->is_admin)
                    <a class="btn btn-warning btn-sm" href="/admin">Admin Panel</a>
                @endif

                <form method="POST" action="/logout" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @endauth

            @guest
                <a class="nav-link text-white" href="/login">Login</a>
                <a class="btn btn-primary btn-sm" href="/register">Register</a>
            @endguest
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                ❌ {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center py-4 mt-5 border-top text-muted">
        <small>ShopLaravel &copy; {{ date('Y') }} — Built with Laravel ❤️</small>
    </footer>
</html>
