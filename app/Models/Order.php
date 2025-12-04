<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
        'status',
        'order_status',
        'is_received',
        'received_at',
        'payment_date',
        'notes',
        'midtrans_order_id',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'received_at' => 'datetime',
        'price' => 'decimal:0',
        'total_price' => 'decimal:0',
        'is_received' => 'boolean',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
