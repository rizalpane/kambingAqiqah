# 📋 SETUP MIDTRANS SANDBOX - PANDUAN LENGKAP

## 📌 Langkah 1: Registrasi & Dapatkan Credentials

### 1.1 Buat Akun Midtrans Sandbox
1. Buka website: https://account.midtrans.com/register
2. Isi form registrasi:
   - Email
   - Password
   - Nama Perusahaan
   - Nomor Handphone
3. Klik "Daftar"
4. Verifikasi email Anda

### 1.2 Login ke Dashboard
1. Buka: https://dashboard.sandbox.midtrans.com/
2. Login dengan email dan password Anda
3. Pilih "Sandbox Mode" (bukan Production)

### 1.3 Dapatkan API Keys
1. Pergi ke: **Settings** → **Access Keys**
2. Di halaman tersebut, Anda akan melihat:
   - **Server Key** (Sandbox)
   - **Client Key** (Sandbox)

**Contoh:**
```
Server Key: SB-Mid-server-xxxxxxxxxxxxxxxx
Client Key: SB-Mid-client-xxxxxxxxxxxxxxxx
```

---

## 🛠️ Langkah 2: Konfigurasi di Laravel

### 2.1 Update File `.env`

Buka file `.env` di root project dan tambahkan:

```dotenv
# Midtrans Configuration
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxxxx
```

**⚠️ PENTING:** Ganti nilai di atas dengan credentials Anda dari Midtrans Dashboard

### 2.2 File `config/midtrans.php` (Sudah dibuat)

File ini sudah ada di: `config/midtrans.php`

Isinya:
```php
<?php

return [
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'serverKey' => env('MIDTRANS_SERVER_KEY'),
    'clientKey' => env('MIDTRANS_CLIENT_KEY'),
];
```

---

## 📦 Langkah 3: Package Sudah Diinstall

Package `midtrans/midtrans-php` sudah diinstall via Composer.

Verifikasi dengan membuka `composer.json` dan cari:
```json
"midtrans/midtrans-php": "^2.6"
```

---

## 🔄 Langkah 4: Update OrderController

File OrderController perlu diupdate untuk integrasi Midtrans. Update method:

### 4.1 Method `payment()`

```php
public function payment(Order $order)
{
    if ($order->user_id != Auth::id()) {
        abort(403);
    }

    try {
        // Set Midtrans config
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.is_production');

        // Prepare data
        $payload = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
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

        // Get Snap token
        $snapToken = \Midtrans\Snap::getSnapToken($payload);
        
        return view('user.payment', compact('order', 'snapToken'));
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
```

### 4.2 Webhook Handler

```php
public function webhookNotification(Request $request)
{
    try {
        $notif = new \Midtrans\Notification();
        $order_id = explode('-', $notif->order_id)[1];
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['status' => 'not found'], 404);
        }

        // Update based on transaction status
        if ($notif->transaction_status == 'settlement') {
            $order->update(['status' => 'success', 'payment_date' => now()]);
            $order->product->decrement('stock', $order->quantity);
        } elseif ($notif->transaction_status == 'pending') {
            $order->update(['status' => 'pending']);
        } else {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['status' => 'ok']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error'], 400);
    }
}
```

---

## 🎨 Langkah 5: Update Payment View

File `resources/views/user/payment.blade.php` perlu diupdate.

Ganti bagian metode pembayaran dengan Midtrans Snap JS:

```blade
<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script type="text/javascript">
    function payWithMidtrans() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // Redirect to success page
                window.location.href = '{{ route("user.payment.success", $order->id) }}';
            },
            onPending: function(result) {
                console.log('pending: ', result);
            },
            onError: function(result) {
                // Redirect to failed page
                window.location.href = '{{ route("user.payment.failed", $order->id) }}';
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran');
            }
        });
    }

    // Auto trigger payment dialog when page loaded
    window.addEventListener('load', function() {
        payWithMidtrans();
    });
</script>
```

---

## 🔗 Langkah 6: Update Routes

Tambah route webhook di `routes/web.php`:

```php
// Webhook from Midtrans
Route::post('/webhook/midtrans', [OrderController::class, 'webhookNotification']);
```

**Perhatian:** Route ini TIDAK memerlukan authentication.

---

## 🧪 Langkah 7: Testing Dengan Sandbox

### 7.1 Test Card Numbers

Gunakan card berikut di payment form Midtrans:

**Pembayaran Berhasil:**
```
Card Number: 4811 1111 1111 1114
CVV: 123
Exp Date: 12/25
```

**Pembayaran Ditolak:**
```
Card Number: 4111 1111 1111 1112
CVV: 123
Exp Date: 12/25
```

### 7.2 Testing Flow

1. Login sebagai user
2. Klik "Beli Sekarang" pada produk
3. Isi jumlah dan klik "Lanjutkan ke Pembayaran"
4. Midtrans payment form akan muncul
5. Gunakan test card di atas
6. Isi OTP: 123456
7. Pembayaran akan diproses

---

## 📊 Langkah 8: Monitor di Dashboard

Setelah membuat transaksi, lihat hasilnya di:
- Dashboard Midtrans: https://dashboard.sandbox.midtrans.com/
- Menu: **Transactions** → Lihat detail order

---

## ⚠️ PENTING: Production Setup

Ketika ready untuk production:

1. Buat akun Production di Midtrans (bukan Sandbox)
2. Dapatkan Production API Keys
3. Update `.env`:
   ```dotenv
   MIDTRANS_IS_PRODUCTION=true
   MIDTRANS_SERVER_KEY=Mid-prod-xxxxxxxxxxxxxxxx
   MIDTRANS_CLIENT_KEY=Mid-prod-xxxxxxxxxxxxxxxx
   ```
4. Update payment.blade.php URL dari sandbox ke production:
   ```
   https://app.midtrans.com/snap/snap.js (production)
   ```

---

## 🐛 Troubleshooting

### Error: "Client Key is required"
- Pastikan `MIDTRANS_CLIENT_KEY` sudah diset di `.env`
- Jalankan: `php artisan config:cache`

### Error: "Invalid Server Key"
- Pastikan `MIDTRANS_SERVER_KEY` benar
- Gunakan Server Key dari Sandbox, bukan Client Key

### Payment Form Tidak Muncul
- Cek Browser Console (F12) untuk error
- Pastikan Snap.js sudah ter-load dari CDN Midtrans

### Webhook Tidak Diterima
- Set Webhook URL di Midtrans Dashboard
- URL: `https://yourdomain.com/webhook/midtrans`
- Pastikan route tidak memerlukan authentication

---

## 📱 Midtrans Support

- Website: https://midtrans.com
- Dokumentasi: https://docs.midtrans.com
- Email Support: support@midtrans.com
- Chat Support: Tersedia di Dashboard

---

**Setup Selesai! Sekarang aplikasi Anda siap menerima pembayaran via Midtrans Sandbox.** ✅
