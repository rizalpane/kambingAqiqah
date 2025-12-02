<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function adminDashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $totalOrders = 0; // Sesuaikan dengan model Order ketika ada
        $totalRevenue = 0; // Sesuaikan dengan model Order ketika ada

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue'
        ));
    }
}
