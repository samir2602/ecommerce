<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::create(['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Electronic products']);
        $clothing = Category::create(['name' => 'Clothing', 'slug' => 'clothing', 'description' => 'Fashion and clothing']);
        $books = Category::create(['name' => 'Books', 'slug' => 'books', 'description' => 'Books and literature']);

        Product::create(['name' => 'Laravel Book', 'slug' => Str::slug('Laravel Book'), 'description' => 'Learn Laravel from scratch', 'price' => 29.99, 'stock' => 50, 'category_id' => $books->id, 'is_active' => true]);
        Product::create(['name' => 'PHP T-Shirt', 'slug' => Str::slug('PHP T-Shirt'), 'description' => 'Cool PHP developer t-shirt', 'price' => 19.99, 'stock' => 100, 'category_id' => $clothing->id, 'is_active' => true]);
        Product::create(['name' => 'Laptop Stand', 'slug' => Str::slug('Laptop Stand'), 'description' => 'Ergonomic laptop stand', 'price' => 49.99, 'stock' => 30, 'category_id' => $electronics->id, 'is_active' => true]);
        Product::create(['name' => 'Mechanical Keyboard', 'slug' => Str::slug('Mechanical Keyboard'), 'description' => 'RGB mechanical keyboard', 'price' => 99.99, 'stock' => 20, 'category_id' => $electronics->id, 'is_active' => true]);
        Product::create(['name' => 'JavaScript Book', 'slug' => Str::slug('JavaScript Book'), 'description' => 'Master JavaScript', 'price' => 24.99, 'stock' => 40, 'category_id' => $books->id, 'is_active' => true]);
        Product::create(['name' => 'Developer Hoodie', 'slug' => Str::slug('Developer Hoodie'), 'description' => 'Comfortable developer hoodie', 'price' => 39.99, 'stock' => 60, 'category_id' => $clothing->id, 'is_active' => true]);
    }
}
