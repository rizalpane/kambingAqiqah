<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderManagementController extends Controller
{
    /**
     * Display all orders that are in progress (paid but not received yet)
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product'])
            ->where('status', 'success') // Only paid orders
            ->orderBy('created_at', 'desc');

        // Filter by order_status if provided
        if ($request->filled('order_status')) {
            $query->where('order_status', $request->order_status);
        }

        $orders = $query->paginate(20);

        // Statistics
        $totalOrders = Order::where('status', 'success')->count();
        $pendingOrders = Order::where('status', 'success')->where('order_status', 'pending')->count();
        $processingOrders = Order::where('status', 'success')->where('order_status', 'processing')->count();
        $shippedOrders = Order::where('status', 'success')->where('order_status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'success')->where('order_status', 'delivered')->count();
        $receivedOrders = Order::where('status', 'success')->where('is_received', true)->count();

        return view('admin.order', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'receivedOrders'
        ));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Check if order is already received by user
        if ($order->is_received) {
            return redirect()->back()->withErrors(['error' => 'Order sudah dikonfirmasi diterima, tidak dapat diubah lagi.']);
        }

        // Check if order is paid
        if ($order->status !== 'success') {
            return redirect()->back()->withErrors(['error' => 'Order belum dibayar.']);
        }

        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered'
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $request->order_status;

        $order->update([
            'order_status' => $newStatus
        ]);

        // Log status change
        $statusLabels = [
            'pending' => 'Pending',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Terkirim'
        ];

        ActivityLog::create([
            'type' => 'system',
            'action' => 'update_order_status',
            'message' => 'Status pesanan #' . $order->order_number . ' diubah dari ' . $statusLabels[$oldStatus] . ' ke ' . $statusLabels[$newStatus],
            'icon' => 'bi-arrow-repeat',
            'related_id' => $order->id,
            'related_type' => 'order',
        ]);

        return redirect()->back()->with('success', 'Status order berhasil diperbarui.');
    }

    /**
     * User confirms order received
     */
    public function confirmReceived(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if order is delivered
        if ($order->order_status !== 'delivered') {
            return redirect()->back()->withErrors(['error' => 'Order belum dalam status "Dikirim/Delivered".']);
        }

        // Check if already received
        if ($order->is_received) {
            return redirect()->back()->with('info', 'Order sudah dikonfirmasi sebelumnya.');
        }

        $order->update([
            'is_received' => true,
            'received_at' => now(),
            'order_status' => 'received'
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Pesanan telah dikonfirmasi diterima.');
    }
}
