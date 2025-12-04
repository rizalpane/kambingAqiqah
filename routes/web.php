<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/produk', function () {
    $products = \App\Models\Product::all();
    return view('produk', compact('products'));
})->name('produk');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

//auth routes (guest only - redirect if already authenticated)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login.page');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register.page');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

    // Password Reset Routes
    Route::get('/forgot', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//user routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        $products = \App\Models\Product::all();
        return view('user.dashboard', compact('products'));
    })->name('user.dashboard');
    
    Route::get('/user/checkout/{product}', [OrderController::class, 'checkout'])->name('user.checkout');
    Route::post('/user/checkout', [OrderController::class, 'store'])->name('user.checkout.store');
    
    Route::get('/user/payment/{order}', [OrderController::class, 'payment'])->name('user.payment');
    Route::post('/user/payment/{order}/success', [OrderController::class, 'paymentSuccess'])->name('user.payment.success');
    Route::post('/user/payment/{order}/failed', [OrderController::class, 'paymentFailed'])->name('user.payment.failed');
    // Client-side callback (Snap) to notify server on payment result (local fallback when webhook not available)
    Route::post('/user/payment/{order}/client-callback', [OrderController::class, 'clientCallback'])->name('user.payment.callback');
    
    Route::get('/user/history', [OrderController::class, 'history'])->name('user.history');
    Route::delete('/user/order/{order}', [OrderController::class, 'deleteOrder'])->name('user.order.delete');
    Route::post('/user/order/{order}/confirm-received', [OrderManagementController::class, 'confirmReceived'])->name('user.order.confirm');
    
    Route::get('/user/payrole', function () {
        return view('user.payrole');
    })->name('user.payrole');
    
    Route::get('/user/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');
});

//admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    Route::get('/admin/order', [OrderManagementController::class, 'index'])->name('admin.order');
    Route::put('/admin/order/{order}/update-status', [OrderManagementController::class, 'updateStatus'])->name('admin.order.update');
    
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    Route::get('/admin/history', [DashboardController::class, 'orderHistory'])->name('admin.history');

    // Settings routes
    Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::post('/admin/setting/profile', [SettingController::class, 'updateProfile'])->name('admin.setting.profile');
    Route::post('/admin/setting/general', [SettingController::class, 'updateGeneral'])->name('admin.setting.general');
    Route::post('/admin/setting/reset', [SettingController::class, 'resetData'])->name('admin.setting.reset');

    // Notification routes
    Route::get('/admin/notifications/orders', [NotificationController::class, 'getOrderNotifications'])->name('admin.notifications.orders');
    Route::get('/admin/notifications/system', [NotificationController::class, 'getSystemNotifications'])->name('admin.notifications.system');
    Route::post('/admin/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark-read');
    Route::post('/admin/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.mark-all-read');

    // Product routes
    Route::prefix('admin/products')->name('admin.products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });
});

// Midtrans webhook (incoming notifications) - exclude CSRF in middleware
Route::post('/webhook/midtrans', [OrderController::class, 'webhookNotification'])->name('webhook.midtrans');