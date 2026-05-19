<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::withCount('products')->latest()->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect('/admin/categories')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category){
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect('/admin/categories')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect('/admin/categories')->with('success', 'Category deleted successfully!');
    }
}
