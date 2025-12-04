<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransHelper;
use App\Models\Order;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Show checkout page for a product
     */
    public function checkout(Product $product)
    {
        return view('user.checkout', compact('product'));
    }

    /**
     * Store order
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check if stock is available
        if ($product->stock < $request->quantity) {
            return redirect()->back()
                ->withErrors(['quantity' => 'Stok tidak cukup'])
                ->withInput();
        }

        $totalPrice = $product->price * $request->quantity;

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // generate and store Midtrans order id so we can reference it later
            $midtransOrderId = MidtransHelper::generateOrderId($order->id);
            $order->update(['midtrans_order_id' => $midtransOrderId]);

            // Redirect to payment page
            return redirect()->route('user.payment', $order->id)
                ->with('success', 'Order dibuat, silahkan lakukan pembayaran');
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Gagal membuat order'])
                ->withInput();
        }
    }

    /**
     * Show payment page and generate Snap token
     */
    public function payment(Order $order)
    {
        // Ensure user can only see their own orders
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        try {
            // Use stored midtrans order id if available, otherwise generate one
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

            $snapToken = MidtransHelper::getSnapToken($payload);

            return view('user.payment', compact('order', 'snapToken'));
        } catch (\Exception $e) {
            Log::error('Payment page error: ' . $e->getMessage());
            return redirect()->route('user.checkout', $order->product_id)
                ->withErrors(['error' => 'Gagal membuat transaksi. Silahkan coba lagi.']);
        }
    }

    /**
     * Webhook handler for Midtrans notification
     */
    public function webhookNotification(Request $request)
    {
        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            Log::error('Webhook Error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 400);
        }

        $transaction = $notif->transaction_status;
        $order_id = explode('-', $notif->order_id)[1] ?? null; // Extract order ID from order_id

        if (!$order_id) {
            Log::warning('Webhook: invalid order_id: ' . ($notif->order_id ?? 'null'));
            return response()->json(['status' => 'invalid order id'], 400);
        }

        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['status' => 'order not found'], 404);
        }

        Log::info('Webhook Notification - Order: ' . $order_id . ', Status: ' . $transaction);

        // Handle based on transaction status
        if ($transaction == 'capture' || $transaction == 'settlement') {
            $order->update([
                'status' => 'success',
                'payment_date' => now(),
                'order_status' => 'pending', // Set order status to pending after payment
            ]);

            // Reduce product stock
            $order->product->decrement('stock', $order->quantity);

            // Create order notification
            ActivityLog::create([
                'type' => 'order',
                'action' => 'new_order',
                'message' => 'Pesanan baru #' . $order->order_number . ' dari ' . $order->user->name . ' - ' . $order->product->name,
                'icon' => 'bi-bag-check-fill',
                'related_id' => $order->id,
                'related_type' => 'order',
            ]);

            Log::info('Order ' . $order_id . ' marked as success');
        } elseif ($transaction == 'pending') {
            $order->update(['status' => 'pending']);
            Log::info('Order ' . $order_id . ' still pending');
        } elseif ($transaction == 'deny' || $transaction == 'cancel' || $transaction == 'expire') {
            $order->update([
                'status' => 'failed',
                'payment_date' => now(),
            ]);

            Log::info('Order ' . $order_id . ' marked as failed');
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle payment success (manual confirmation / COD)
     */
    public function paymentSuccess(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        if ($order->status === 'success') {
            return redirect()->route('user.history')->with('info', 'Order sudah terkonfirmasi.');
        }

        $order->update([
            'status' => 'success',
            'payment_date' => now(),
            'order_status' => 'pending',
        ]);

        // Reduce product stock if available
        try {
            $order->product->decrement('stock', $order->quantity);
        } catch (\Exception $e) {
            Log::warning('Failed to decrement stock for order ' . $order->id . ': ' . $e->getMessage());
        }

        // Create order notification
        ActivityLog::create([
            'type' => 'order',
            'action' => 'new_order',
            'message' => 'Pesanan baru #' . $order->order_number . ' dari ' . $order->user->name . ' - ' . $order->product->name,
            'icon' => 'bi-bag-check-fill',
            'related_id' => $order->id,
            'related_type' => 'order',
        ]);

        return redirect()->route('user.history')
            ->with('success', 'Pembayaran dikonfirmasi. Terima kasih.');
    }

    /**
     * Handle payment failed / cancel
     */
    public function paymentFailed(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        $order->update([
            'status' => 'failed',
            'payment_date' => now(),
        ]);

        return redirect()->route('user.history')
            ->with('error', 'Pembayaran dibatalkan / gagal. Order akan dihapus otomatis jika tidak dibayar.');
    }

    /**
     * Client-side callback from Snap (fallback when webhook not available)
     */
    public function clientCallback(Request $request, Order $order)
    {
        // ensure the order belongs to the authenticated user
        if ($order->user_id != Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $data = $request->all();

        // Prefer transaction_status sent from client
        $status = $data['transaction_status'] ?? $data['status'] ?? null;
        $orderIdFromMidtrans = $data['order_id'] ?? $data['transaction_details']['order_id'] ?? null;

        // Basic validation: ensure the midtrans order id matches
        if ($order->midtrans_order_id && $orderIdFromMidtrans && $order->midtrans_order_id !== $orderIdFromMidtrans) {
            return response()->json(['error' => 'Order ID mismatch'], 400);
        }

        // Map statuses
        if (in_array($status, ['capture', 'settlement', 'success', 'completed'])) {
            $order->update(['status' => 'success', 'payment_date' => now(), 'order_status' => 'pending']);
            try { $order->product->decrement('stock', $order->quantity); } catch (\Exception $e) { Log::warning($e->getMessage()); }
        } elseif ($status === 'pending') {
            $order->update(['status' => 'pending']);
        } else {
            $order->update(['status' => 'failed', 'payment_date' => now()]);
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Show user order history
     */
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('orders'));
    }

    /**
     * Delete order (for pending/failed orders only)
     */
    public function deleteOrder(Order $order)
    {
        // Ensure user can only delete their own orders
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        // Only allow deletion of pending or failed orders
        if (!in_array($order->status, ['pending', 'failed'])) {
            return redirect()->route('user.history')
                ->withErrors(['error' => 'Hanya order yang pending atau gagal yang dapat dihapus.']);
        }

        try {
            $order->delete();
            return redirect()->route('user.history')
                ->with('success', 'Order berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Order deletion failed: ' . $e->getMessage());
            return redirect()->route('user.history')
                ->withErrors(['error' => 'Gagal menghapus order.']);
        }
    }
}
