<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
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
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'success')->sum('total_price');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue'
        ));
    }

    /**
     * Show order history for all users
     */
    public function orderHistory(Request $request)
    {
        $query = Order::with(['user', 'product'])
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment date range if provided
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->paginate(20);

        // Statistics
        $totalOrders = Order::count();
        $successOrders = Order::where('status', 'success')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $failedOrders = Order::where('status', 'failed')->count();
        $totalRevenue = Order::where('status', 'success')->sum('total_price');

        return view('admin.history', compact(
            'orders',
            'totalOrders',
            'successOrders',
            'pendingOrders',
            'failedOrders',
            'totalRevenue'
        ));
    }
}
