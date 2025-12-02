# 🎯 CHECKLIST INTEGRASI MIDTRANS SANDBOX

Berikut adalah checklist lengkap untuk mengintegrasikan Midtrans Sandbox ke aplikasi Laravel.

---

## ✅ STEP 1: Persiapan (DONE)

- [x] Package `midtrans/midtrans-php` sudah diinstall via Composer
- [x] File `config/midtrans.php` sudah dibuat
- [x] Helper `app/Helpers/MidtransHelper.php` sudah dibuat

**Status:** ✅ SELESAI

---

## 📝 STEP 2: Konfigurasi Environment Variables

### Apa yang perlu dilakukan:

1. **Buka file `.env`** di root project
2. **Tambahkan konfigurasi Midtrans** di bawah (di sebelah konfigurasi lainnya):

```dotenv
# Midtrans Configuration (Sandbox Mode)
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxxxx
```

### Dari mana mendapatkan keys?

1. Buka: https://dashboard.sandbox.midtrans.com/
2. Login dengan akun Midtrans Anda
3. Pergi ke: **Settings** → **Access Keys**
4. Copy **Server Key** dan **Client Key** (untuk Sandbox)
5. Paste ke `.env` file

**Status:** ⏳ PERLU DIKERJAKAN

---

## 🔧 STEP 3: Update OrderController

### Opsi A: Buat File Baru (RECOMMENDED)

1. Buka file: `app/Http/Controllers/OrderController.php`
2. Hapus semua isi file
3. Copy isi dari file: `ORDER_CONTROLLER_EXAMPLE.php` (sudah ada di root project)
4. Paste ke `OrderController.php`
5. Save

### Opsi B: Update Manual

Jika Anda ingin update manual, update method berikut:
- `__construct()` - Tambahkan Midtrans initialization
- `payment()` - Ubah untuk generate Snap Token
- Tambahkan `webhookNotification()` method
- Tambahkan `checkPaymentStatus()` method (opsional)

**File referensi:** `ORDER_CONTROLLER_EXAMPLE.php`

**Status:** ⏳ PERLU DIKERJAKAN

---

## 🎨 STEP 4: Update Payment View

### Update `resources/views/user/payment.blade.php`

1. Buka file: `resources/views/user/payment.blade.php`
2. Cari section "Metode Pembayaran" (yang hardcoded dengan radio buttons)
3. Replace section tersebut dengan code dari: `PAYMENT_VIEW_SNIPPET.md`

### Changes:
- Hapus radio buttons untuk Bank Transfer, E-Wallet, dll
- Tambahkan button "Bayar Sekarang via Midtrans"
- Tambahkan Midtrans Snap JS CDN
- Tambahkan JavaScript function `payWithMidtrans()`

**File referensi:** `PAYMENT_VIEW_SNIPPET.md`

**Status:** ⏳ PERLU DIKERJAKAN

---

## 🔗 STEP 5: Update Routes

### Tambahkan Routes Baru di `routes/web.php`

**Webhook route (HARUS DILUAR middleware):**
```php
Route::post('/webhook/midtrans', [OrderController::class, 'webhookNotification']);
```

**Payment check route (DALAM user middleware):**
```php
Route::post('/user/payment/{order}/check', [OrderController::class, 'checkPaymentStatus'])
    ->name('user.payment.check');
```

**Penempatan:**
- Webhook: Setelah closing brace user middleware
- Payment check: Dalam user middleware group

**File referensi:** `ROUTES_UPDATE.md`

**Status:** ⏳ PERLU DIKERJAKAN

---

## 🧪 STEP 6: Test Integrasi

### Test Tanpa Real Payment

1. Clear cache: `php artisan config:cache`
2. Login sebagai user
3. Pilih produk dan klik "Beli Sekarang"
4. Isi jumlah dan klik "Lanjutkan ke Pembayaran"
5. Form Midtrans akan muncul
6. Gunakan test card:

**Test Card Berhasil:**
- Nomor: 4811 1111 1111 1114
- CVV: 123
- Exp: 12/25

**Test Card Ditolak:**
- Nomor: 4111 1111 1111 1112
- CVV: 123
- Exp: 12/25

7. Isi OTP: 123456
8. Submit
9. Cek hasilnya di History

**Status:** ⏳ PERLU DIKERJAKAN

---

## 📊 STEP 7: Monitor di Dashboard Midtrans

1. Buka: https://dashboard.sandbox.midtrans.com/
2. Login
3. Pilih **Transactions**
4. Lihat semua orders yang dibuat
5. Klik order untuk melihat detail

**Status:** ⏳ PERLU DIKERJAKAN

---

## 🚀 STEP 8: Setup Webhook di Midtrans Dashboard (Optional tapi Recommended)

Untuk production, sangat penting setup webhook. Untuk sandbox, optional.

### Cara setup webhook:

1. Buka: https://dashboard.sandbox.midtrans.com/
2. Pergi ke: **Settings** → **HTTP Notification**
3. Input URL Webhook: `https://yourdomain.com/webhook/midtrans`
4. Pilih: **Update**

**Catatan:** 
- Untuk testing lokal, gunakan ngrok atau tunnel
- URL harus HTTPS
- Webhook handler sudah ada di OrderController

**Status:** ⏳ OPTIONAL

---

## ⚠️ IMPORTANT: Production Setup

Ketika siap untuk production:

1. Dapatkan Production API Keys dari Midtrans
2. Update `.env`:
   ```dotenv
   MIDTRANS_IS_PRODUCTION=true
   MIDTRANS_SERVER_KEY=Mid-prod-xxxxxxxxxxxxxxxx
   MIDTRANS_CLIENT_KEY=Mid-prod-xxxxxxxxxxxxxxxx
   ```
3. Update `PAYMENT_VIEW_SNIPPET.md` URL dari:
   ```
   https://app.sandbox.midtrans.com/snap/snap.js
   ```
   ke:
   ```
   https://app.midtrans.com/snap/snap.js
   ```
4. Setup webhook di production Dashboard
5. Test dengan real payment (gunakan produk test terlebih dahulu)

**Status:** ⏳ BELUM DILAKUKAN (akan dilakukan saat production)

---

## 📚 File-File yang Dibuat/Diperbarui

| File | Status | Keterangan |
|------|--------|-----------|
| `config/midtrans.php` | ✅ Dibuat | Config file untuk Midtrans |
| `app/Helpers/MidtransHelper.php` | ✅ Dibuat | Helper functions |
| `ORDER_CONTROLLER_EXAMPLE.php` | ✅ Dibuat | Contoh OrderController lengkap |
| `PAYMENT_VIEW_SNIPPET.md` | ✅ Dibuat | Snippet untuk payment view |
| `MIDTRANS_SETUP.md` | ✅ Dibuat | Panduan setup lengkap |
| `app/Http/Controllers/OrderController.php` | ⏳ Perlu Update | Implement Midtrans |
| `resources/views/user/payment.blade.php` | ⏳ Perlu Update | Integrate Snap JS |
| `routes/web.php` | ⏳ Perlu Update | Tambah webhook route |
| `.env` | ⏳ Perlu Update | Tambah Midtrans keys |

---

## 🔗 Useful Links

- **Midtrans Dashboard:** https://dashboard.sandbox.midtrans.com/
- **Midtrans Docs:** https://docs.midtrans.com
- **Midtrans PHP Library:** https://github.com/midtrans/midtrans-php
- **Payment Gateway:** https://midtrans.com

---

## ❓ Troubleshooting

### Error: "Client Key not found"
**Solusi:**
1. Pastikan `.env` sudah diupdate dengan Midtrans keys
2. Jalankan: `php artisan config:cache`
3. Refresh halaman

### Error: "Invalid Server Key"
**Solusi:**
1. Copy exact key dari Midtrans Dashboard
2. Pastikan tidak ada spasi di awal/akhir
3. Jalankan: `php artisan config:cache`

### Payment Form Tidak Muncul
**Solusi:**
1. Buka Browser Console (F12)
2. Cek error message
3. Pastikan Snap JS library sudah loaded dari CDN
4. Pastikan `data-client-key` di script tag benar

### Webhook Tidak Diterima
**Solusi:**
1. Pastikan route `/webhook/midtrans` tidak dalam middleware `auth`
2. Check Laravel logs: `storage/logs/laravel.log`
3. Setup webhook URL di Midtrans Dashboard
4. Test dengan curl atau Postman

---

## ✅ Checklist Kesiapan

Sebelum go live, pastikan:
- [ ] Keys sudah diupdate di `.env`
- [ ] OrderController sudah diupdate
- [ ] Payment view sudah diupdate
- [ ] Routes sudah diupdate
- [ ] Test dengan card test
- [ ] History menampilkan status "Berhasil"
- [ ] Stock berkurang setelah pembayaran sukses
- [ ] Webhook working (optional)

---

**Selamat! Sekarang aplikasi Anda siap dengan Midtrans Sandbox Payment Gateway!** 🎉
