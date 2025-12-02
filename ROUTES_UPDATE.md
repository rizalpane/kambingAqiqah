{{--
FILE: routes/web.php - ROUTES YANG PERLU DITAMBAHKAN

Tambahkan route berikut di akhir file web.php (sebelum closing bracket):

UNTUK USER ROUTES (di dalam middleware auth, role:user):
--}}

// Webhook from Midtrans (TANPA authentication)
Route::post('/webhook/midtrans', [OrderController::class, 'webhookNotification']);

// Manual payment check
Route::post('/user/payment/{order}/check', [OrderController::class, 'checkPaymentStatus'])
    ->middleware(['auth', 'role:user'])
    ->name('user.payment.check');

{{--
Hasilnya struktur routes akan seperti ini:

Route::middleware(['auth', 'role:user'])->group(function () {
    // ... existing routes ...
    Route::post('/user/payment/{order}/check', [OrderController::class, 'checkPaymentStatus'])
        ->name('user.payment.check');
});

// Webhook HARUS DILUAR middleware
Route::post('/webhook/midtrans', [OrderController::class, 'webhookNotification']);
--}}
