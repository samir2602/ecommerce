# ShopLaravel 🛍️

A full-featured e-commerce application built with Laravel. Users can browse products, add to cart, place orders and track their order history. Includes a complete admin panel for managing products, categories and orders.

## 🌐 Live Demo
[View Live](your-railway-url-here)

## ✨ Features

### Customer
- Browse products with search and filters
- Filter by category, price sorting
- Product detail page with related products
- Shopping cart using sessions
- Checkout with delivery information
- Order history and order detail page
- Order confirmation email

### Admin Panel
- Dashboard with stats (products, orders, users)
- Manage products (add, edit, delete, image upload)
- Manage categories
- Manage and update order status
- Pagination on all admin tables

## 🛠️ Tech Stack

- **Framework:** Laravel 11
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Frontend:** Blade, Bootstrap 5
- **Email:** Mailtrap (testing)
- **File Storage:** Laravel Storage
- **Deployment:** Railway

## ⚙️ Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/ecommerce.git
cd ecommerce
```

2. Install dependencies
```bash
composer install
npm install
```

3. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env` then run:
```bash
php artisan migrate
php artisan db:seed
```

5. Create storage link
```bash
php artisan storage:link
```

6. Start the server
```bash
php artisan serve
npm run dev
```

## 👤 Admin Access

Register a user then run this in tinker to make them admin:
```php
App\Models\User::where('email', 'your@email.com')->update(['is_admin' => 1]);
```

## 📄 License
MIT