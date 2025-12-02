<?php
require 'vendor/autoload.php';
$app = require_once('bootstrap/app.php');
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$users = \Illuminate\Support\Facades\DB::table('users')->get();
echo "Users: " . count($users) . PHP_EOL;
foreach ($users as $user) {
    echo "  - " . $user->email . " (" . $user->role . ")" . PHP_EOL;
}

$products = \Illuminate\Support\Facades\DB::table('products')->get();
echo "Products: " . count($products) . PHP_EOL;
foreach ($products as $product) {
    echo "  - " . $product->name . " (Stock: " . $product->stock . ")" . PHP_EOL;
}

$orders = \Illuminate\Support\Facades\DB::table('orders')->get();
echo "Orders: " . count($orders) . PHP_EOL;
