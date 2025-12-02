<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
                'address' => 'Jl. Test No. 123',
                'phone' => '081234567890',
                'role' => 'user',
            ]
        );
        echo "✓ User created: {$user->email}\n";

        // Create test products
        $products = [
            [
                'name' => 'Kambing Jawa Pejantan',
                'price' => 1500000,
                'stock' => 5,
                'location' => 'Bandung',
                'category' => 'Pejantan',
                'description' => 'Kambing jawa berkualitas tinggi untuk aqiqah',
                'image' => 'default.jpg',
            ],
            [
                'name' => 'Kambing Jawa Betina',
                'price' => 1200000,
                'stock' => 8,
                'location' => 'Jakarta',
                'category' => 'Betina',
                'description' => 'Kambing jawa betina sehat dan gemuk',
                'image' => 'default.jpg',
            ],
            [
                'name' => 'Domba Premium',
                'price' => 2000000,
                'stock' => 3,
                'location' => 'Surabaya',
                'category' => 'Domba',
                'description' => 'Domba premium untuk aqiqah mewah',
                'image' => 'default.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
            echo "✓ Product created: {$product['name']}\n";
        }
    }
}
