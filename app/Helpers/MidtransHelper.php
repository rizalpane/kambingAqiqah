<?php

namespace App\Helpers;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransHelper
{
    public static function initialize()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.isSanitized');
    }

    public static function getSnapToken($payload)
    {
        self::initialize();
        return Snap::getSnapToken($payload);
    }

    public static function generateOrderId($orderId)
    {
        return 'ORDER-' . $orderId . '-' . time();
    }

    public static function createPayloadFromOrder($order)
    {
        return [
            'transaction_details' => [
                'order_id' => self::generateOrderId($order->id),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
                'billing_address' => [
                    'address' => $order->user->address,
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
    }
}
