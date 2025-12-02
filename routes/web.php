<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;

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

//auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login.page');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register.page');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/forgot', function () {
    return view('forgot');
});

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
    
    Route::get('/user/payrole', function () {
        return view('user.payrole');
    })->name('user.payrole');
    
    Route::get('/user/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');
});

//admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    Route::get('/admin/order', function () {
        return view('admin.order');
    })->name('admin.order');
    
    Route::get('/admin/users', function () {
        return view('admin.users');
    })->name('admin.users');
    
    Route::get('/admin/history', function () {
        return view('admin.history');
    })->name('admin.history');

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