<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; padding: 30px; }
        .header { text-align: center; border-bottom: 2px solid #0d6efd; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { color: #0d6efd; }
        .order-info { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #0d6efd; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #dee2e6; }
        .total { font-size: 18px; font-weight: bold; color: #0d6efd; text-align: right; margin-top: 15px; }
        .footer { text-align: center; margin-top: 20px; color: #6c757d; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ ShopLaravel</h1>
            <p>Thank you for your order!</p>
        </div>

        <p>Hi <strong>{{ $order->name }}</strong>,</p>
        <p>Your order has been placed successfully. Here are your order details:</p>

        <div class="order-info">
            <p><strong>Order #:</strong> {{ $order->id }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Delivery Address:</strong> {{ $order->address }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total: ${{ number_format($order->total, 2) }}
        </div>

        <div class="footer">
            <p>Thank you for shopping with ShopLaravel! 🎉</p>
            <p>If you have any questions, reply to this email.</p>
        </div>
    </div>
</body>
</html>