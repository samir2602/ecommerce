<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;
        $sort = $request->sort ?? 'latest';

        $categories = Category::all();

        $products = Product::with('category')
                ->where('is_active', true)
                ->when($search, function($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->when($category, function($query) use ($category) {
                    $query->where('category_id', $category);
                })
                ->when($sort == 'price_low', function($query){
                    $query->orderBy('price', 'asc');
                })
                ->when($sort == 'price_high', function($query){
                    $query->orderBy('price', 'desc');
                })
                ->when($sort == 'latest', function($query){
                    $query->latest();
                })
                ->paginate(12);
        
        return view('products.index', ['products' => $products, 'categories' => $categories, 'search' => $search, 'category' => $category, 'sort' => $sort]);
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
                        ->where('id', '!=', $product->id)
                        ->where('is_active', true)
                        ->take(4)
                        ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
