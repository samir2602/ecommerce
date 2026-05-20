<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// public route
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function() {
        return redirect('/products');
    })->name('dashboard');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Order routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin Route
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
    Route::get('/', [AdminProductController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Products
    Route::get('/products', [AdminProductController::class, 'products'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.product.store');    
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

    // Admin Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');    
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Admin Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.order.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.order.show');
    Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.order.update');
});

Route::get('/make-admin', function() {
    \App\Models\User::where('email', 'samir@email.com')->update(['is_admin' => 1]);
    return 'Done - you are now admin!';
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
