<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'location',
        'stock',
        'image',
        'category',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'stock' => 'integer',
    ];
}
