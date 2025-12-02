<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Helpers\MidtransHelper;

// find or create user
$user = User::first();
if (! $user) {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('secret'),
    ]);
}

// find or create product
$product = Product::first();
if (! $product) {
    $product = Product::create([
        'name' => 'Sample Kambing',
        'price' => 1000000,
        'location' => 'Jakarta',
        'stock' => 10,
        'category' => 'Kambing',
        'description' => 'Sample product created for testing',
        'image' => null,
    ]);
}

// create order
$order = Order::create([
    'user_id' => $user->id,
    'product_id' => $product->id,
    'quantity' => 1,
    'price' => $product->price,
    'total_price' => $product->price,
    'status' => 'pending',
]);

// store midtrans order id
try {
    $midtransOrderId = MidtransHelper::generateOrderId($order->id);
    $order->update(['midtrans_order_id' => $midtransOrderId]);
} catch (Exception $e) {
    // ignore if helper not available
}

echo "ORDER_ID={$order->id}\n";
echo "PAYMENT_URL=http://127.0.0.1:8000/user/payment/{$order->id}\n";

return 0;
