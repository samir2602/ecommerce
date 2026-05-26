<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function dashboard(){
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
    
        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'recentOrders' => $recentOrders,
        ]);
    }

    public function products(){
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', ['products' => $products]);
    }

    public function create(){
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',            
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/admin/products')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',            
            'image' => 'nullable|image|max:2048',
        ]);

        // ✅ Correct
        $imagePath = $product->image;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/admin/products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect('/admin/products')->with('success', 'Product deleted successfully!');
    }
}
