<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

// Create test user if not exists
$user = \App\Models\User::where('email', 'test@example.com')->first();
if (!$user) {
    $user = \App\Models\User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
        'address' => 'Test Address',
        'phone' => '081234567890',
        'role' => 'user',
    ]);
    echo "✓ Created test user: test@example.com\n";
} else {
    echo "✓ Test user already exists\n";
}

// Create test product if not exists
$product = \App\Models\Product::where('name', 'Test Product')->first();
if (!$product) {
    $product = \App\Models\Product::create([
        'name' => 'Test Product',
        'price' => 100000,
        'stock' => 10,
        'location' => 'Test Location',
        'category' => 'Test',
        'description' => 'Test Description',
    ]);
    echo "✓ Created test product\n";
} else {
    echo "✓ Test product already exists\n";
}

// Create test order
$order = \App\Models\Order::create([
    'user_id' => $user->id,
    'product_id' => $product->id,
    'quantity' => 1,
    'price' => $product->price,
    'total_price' => $product->price,
    'status' => 'pending',
    'midtrans_order_id' => 'ORDER-' . uniqid() . '-' . time(),
]);
echo "✓ Created test order ID: {$order->id}\n";

// Try to generate Snap token
try {
    $helper = new \App\Helpers\MidtransHelper();
    
    $payload = [
        'transaction_details' => [
            'order_id' => $order->midtrans_order_id,
            'gross_amount' => (int) $order->total_price,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
        ],
        'item_details' => [
            [
                'id' => $product->id,
                'price' => (int) $product->price,
                'quantity' => $order->quantity,
                'name' => $product->name,
            ]
        ],
    ];
    
    $snapToken = $helper->getSnapToken($payload);
    echo "✓ Snap Token generated successfully!\n";
    echo "Token (first 50 chars): " . substr($snapToken, 0, 50) . "...\n";
    echo "\nAccess payment page at: http://127.0.0.1:8000/user/payment/{$order->id}\n";
    echo "Login with: test@example.com / password123\n";
    
} catch (\Exception $e) {
    echo "✗ Error generating Snap token:\n";
    echo "  Message: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "  Stack:\n";
    $i = 0;
    foreach ($e->getTrace() as $trace) {
        if ($i++ > 5) break; // Only show first 5 traces
        echo "    #" . $i . " " . ($trace['file'] ?? 'unknown') . ":" . ($trace['line'] ?? '?') . "\n";
    }
}
