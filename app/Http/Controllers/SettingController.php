<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $admin = Auth::user();
        
        // Get general settings
        $siteTitle = Setting::get('site_title', 'Selamat Datang');
        $siteSubtitle = Setting::get('site_subtitle', 'Layanan Aqiqah Terpercaya dan Berkualitas');
        $siteDescription = Setting::get('site_description', 'Kami menyediakan layanan aqiqah terbaik');

        // Get statistics for reset tab
        $stats = [
            'users' => User::where('role', 'user')->count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'success_orders' => Order::where('status', 'success')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'failed_orders' => Order::where('status', 'failed')->count(),
        ];

        return view('admin.setting', compact('admin', 'siteTitle', 'siteSubtitle', 'siteDescription', 'stats'));
    }

    /**
     * Update admin profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update basic info
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->address = $request->address;
        $admin->phone = $request->phone;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $admin->avatar = $path;
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
            $admin->password = Hash::make($request->new_password);
            
            // Log password change
            ActivityLog::create([
                'type' => 'system',
                'action' => 'update_password',
                'message' => 'Admin ' . $admin->name . ' telah mengubah password',
                'icon' => 'bi-shield-check-fill',
                'related_id' => $admin->id,
                'related_type' => 'user',
            ]);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profil admin berhasil diperbarui.');
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_subtitle' => 'required|string|max:255',
            'site_description' => 'nullable|string',
        ]);

        Setting::set('site_title', $request->site_title);
        Setting::set('site_subtitle', $request->site_subtitle);
        Setting::set('site_description', $request->site_description);

        return redirect()->back()->with('success', 'Pengaturan umum berhasil diperbarui.');
    }

    /**
     * Reset specific data
     */
    public function resetData(Request $request)
    {
        $request->validate([
            'reset_type' => 'required|in:users,products,orders,success_orders,pending_orders,failed_orders,all'
        ]);

        $type = $request->reset_type;
        $message = '';

        try {
            DB::beginTransaction();

            switch ($type) {
                case 'users':
                    User::where('role', 'user')->delete();
                    $message = 'Semua data user berhasil dihapus.';
                    break;

                case 'products':
                    // Delete product images
                    $products = Product::all();
                    foreach ($products as $product) {
                        if ($product->image && file_exists(public_path($product->image))) {
                            unlink(public_path($product->image));
                        }
                    }
                    Product::truncate();
                    $message = 'Semua data produk berhasil dihapus.';
                    break;

                case 'orders':
                    Order::truncate();
                    $message = 'Semua data order berhasil dihapus.';
                    break;

                case 'success_orders':
                    Order::where('status', 'success')->delete();
                    $message = 'Semua order sukses berhasil dihapus.';
                    break;

                case 'pending_orders':
                    Order::where('status', 'pending')->delete();
                    $message = 'Semua order pending berhasil dihapus.';
                    break;

                case 'failed_orders':
                    Order::where('status', 'failed')->delete();
                    $message = 'Semua order gagal berhasil dihapus.';
                    break;

                case 'all':
                    // Delete all users except admin
                    User::where('role', 'user')->delete();
                    
                    // Delete all products and images
                    $products = Product::all();
                    foreach ($products as $product) {
                        if ($product->image && file_exists(public_path($product->image))) {
                            unlink(public_path($product->image));
                        }
                    }
                    Product::truncate();
                    
                    // Delete all orders
                    Order::truncate();
                    
                    $message = 'Semua data (users, products, orders) berhasil dihapus.';
                    break;
            }

            // Log reset action
            ActivityLog::create([
                'type' => 'system',
                'action' => 'reset_data',
                'message' => 'Admin melakukan reset data: ' . $message,
                'icon' => 'bi-exclamation-triangle-fill',
                'related_id' => null,
                'related_type' => 'system',
            ]);

            DB::commit();
            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}
