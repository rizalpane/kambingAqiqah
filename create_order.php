<?php
require 'vendor/autoload.php';
$app = require_once('bootstrap/app.php');
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

// Get test user and product
$user = User::where('email', 'test@example.com')->first();
$product = Product::where('name', 'Kambing Jawa Pejantan')->first();

if (!$user || !$product) {
    echo "Error: User or Product not found\n";
    exit(1);
}

// Create order
$order = Order::create([
    'user_id' => $user->id,
    'product_id' => $product->id,
    'quantity' => 2,
    'price' => $product->price,
    'total_price' => $product->price * 2,
    'status' => 'pending',
    'midtrans_order_id' => 'ORDER-TEST-' . time(),
]);

echo "✓ Order created successfully\n";
echo "Order ID: {$order->id}\n";
echo "User: {$user->email}\n";
echo "Product: {$product->name}\n";
echo "Total: Rp " . number_format($order->total_price, 0, ',', '.') . "\n";
echo "\nLogin with:\n";
echo "  Email: test@example.com\n";
echo "  Password: password123\n";
echo "\nAccess payment page at: http://127.0.0.1:8000/user/payment/{$order->id}\n";
