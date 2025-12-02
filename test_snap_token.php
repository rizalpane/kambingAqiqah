<?php
require 'vendor/autoload.php';
$app = require_once('bootstrap/app.php');
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Order;
use App\Models\User;
use App\Helpers\MidtransHelper;
use Illuminate\Support\Facades\Auth;

// Get order
$order = Order::find(6);
if (!$order) {
    echo "Order not found\n";
    exit(1);
}

// Simulate auth
Auth::loginUsingId($order->user_id);

try {
    echo "Testing Snap Token Generation for Order #{$order->id}\n";
    echo "=========================================\n\n";
    
    // Prepare payload (same as in OrderController)
    $midtransOrderId = $order->midtrans_order_id ?? MidtransHelper::generateOrderId($order->id);
    
    $payload = [
        'transaction_details' => [
            'order_id' => $midtransOrderId,
            'gross_amount' => (int) $order->total_price,
        ],
        'customer_details' => [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'billing_address' => [
                'address' => Auth::user()->address,
            ],
        ],
        'item_details' => [
            [
                'id' => $order->product->id,
                'price' => (int) $order->price,
                'quantity' => $order->quantity,
                'name' => $order->product->name,
            ]
        ],
    ];
    
    echo "Payload:\n";
    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n\n";
    
    echo "Generating Snap Token...\n";
    $snapToken = MidtransHelper::getSnapToken($payload);
    
    if ($snapToken) {
        echo "✓ SUCCESS! Token generated\n";
        echo "Token (first 100 chars): " . substr($snapToken, 0, 100) . "...\n";
        echo "\nYou can now access the payment page:\n";
        echo "http://127.0.0.1:8000/user/payment/6\n";
    } else {
        echo "✗ FAILED: No token returned\n";
    }
    
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack Trace:\n";
    echo $e->getTraceAsString();
}
