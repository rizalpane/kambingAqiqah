# 🚀 MIDTRANS SANDBOX INTEGRATION - QUICK START GUIDE

## 📋 Yang Sudah Disiapkan

✅ **Package Midtrans** - Sudah diinstall via Composer
✅ **Config File** - `config/midtrans.php` sudah dibuat
✅ **Helper Class** - `app/Helpers/MidtransHelper.php` sudah dibuat
✅ **Dokumentasi** - Panduan setup lengkap tersedia

---

## 🎯 4 Langkah Cepat untuk Setup

### 1️⃣ Update `.env` File (2 menit)

Edit file `.env` dan tambahkan di bawah:

```dotenv
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxxxx
```

**Dapatkan keys dari:** https://dashboard.sandbox.midtrans.com/
- Settings → Access Keys
- Copy Server Key dan Client Key untuk Sandbox

---

### 2️⃣ Update `OrderController.php` (5 menit)

Pilih salah satu opsi:

**Opsi A: Copy seluruh file (Recommended)**
1. Buka: `ORDER_CONTROLLER_EXAMPLE.php` (file contoh di root)
2. Copy semua isi
3. Hapus isi lama di: `app/Http/Controllers/OrderController.php`
4. Paste isi baru
5. Save

**Opsi B: Update method tertentu**
- Baca file: `ORDER_CONTROLLER_EXAMPLE.php`
- Update method `payment()` dan tambahkan `webhookNotification()`

---

### 3️⃣ Update `payment.blade.php` (3 menit)

1. Buka: `resources/views/user/payment.blade.php`
2. Cari section: **"Metode Pembayaran"** 
3. Hapus radio buttons section
4. Lihat file: `PAYMENT_VIEW_SNIPPET.md`
5. Copy snippet dan paste

---

### 4️⃣ Update `routes/web.php` (2 menit)

Tambahkan di akhir file (sebelum closing brace):

```php
// Webhook from Midtrans (TANPA authentication)
Route::post('/webhook/midtrans', [OrderController::class, 'webhookNotification']);
```

---

## 🧪 Test Integrasi

### Setup Cache

```bash
php artisan config:cache
```

### Testing Flow

1. **Login sebagai user**
2. **Pilih produk** → Klik "Beli Sekarang"
3. **Isi jumlah** → Klik "Lanjutkan ke Pembayaran"
4. **Form Midtrans akan muncul** (Snap Payment)
5. **Gunakan test card:**

   **Pembayaran BERHASIL:**
   ```
   Card: 4811 1111 1111 1114
   CVV: 123
   Exp: 12/25
   OTP: 123456
   ```

   **Pembayaran DITOLAK:**
   ```
   Card: 4111 1111 1111 1112
   CVV: 123
   Exp: 12/25
   ```

6. **Cek hasilnya** di History Page
   - Order harus muncul dengan status "Berhasil"
   - Stock produk berkurang

---

## 📊 Monitor Transaksi

1. Buka: https://dashboard.sandbox.midtrans.com/
2. Login dengan akun Midtrans
3. Menu: **Transactions**
4. Lihat semua order yang dibuat
5. Klik order untuk detail lengkap

---

## 📁 File Referensi

Semua file sudah ada di root project untuk referensi:

```
PROJECT_ROOT/
├── MIDTRANS_SETUP.md              ← Panduan setup lengkap
├── INTEGRATION_CHECKLIST.md       ← Checklist lengkap
├── PAYMENT_VIEW_SNIPPET.md        ← Code untuk payment view
├── ORDER_CONTROLLER_EXAMPLE.php   ← Contoh OrderController
├── ROUTES_UPDATE.md               ← Update routes
├── config/
│   └── midtrans.php              ← Config (sudah dibuat)
└── app/
    └── Helpers/
        └── MidtransHelper.php    ← Helper (sudah dibuat)
```

---

## ⚡ Fitur yang Terintegrasi

✅ **Checkout** → Order dibuat
✅ **Payment** → Midtrans Snap modal muncul
✅ **Card Payment** → Support semua kartu
✅ **Auto Update Status** → Webhook dari Midtrans
✅ **Stock Reduction** → Otomatis berkurang saat pembayaran sukses
✅ **Order History** → Semua transaksi terecord
✅ **Auto Delete Failed** → Order gagal dihapus 72 jam

---

## 🔐 Security Tips

- ✅ Server Key dan Client Key disimpan di `.env` (tidak di commit ke git)
- ✅ Webhook route tidak memerlukan authentication
- ✅ User hanya bisa akses order mereka sendiri
- ✅ Stock reduction hanya setelah payment success
- ✅ Semua transaction tercatat dengan timestamp

---

## ❓ Quick Troubleshooting

| Error | Solusi |
|-------|--------|
| "Client Key not found" | Update `.env` + `php artisan config:cache` |
| "Invalid Server Key" | Copy exact key dari Midtrans Dashboard |
| Snap JS not loading | Pastikan CDN accessible |
| Webhook error | Pastikan route tanpa `auth` middleware |

---

## 📞 Support

- **Midtrans Dashboard:** https://dashboard.sandbox.midtrans.com/
- **Midtrans Docs:** https://docs.midtrans.com
- **Live Chat:** Di Midtrans Dashboard

---

## ✅ Next Steps

1. ✏️ Update `.env` dengan keys
2. 📝 Update OrderController
3. 🎨 Update payment.blade.php
4. 🔗 Update routes/web.php
5. 🧪 Test dengan card test
6. 📊 Monitor di Dashboard
7. 🚀 Go Live dengan Production Keys

---

**Setup Midtrans Sandbox SELESAI! 🎉**

Untuk pertanyaan lebih lanjut, lihat file dokumentasi yang tersedia.
