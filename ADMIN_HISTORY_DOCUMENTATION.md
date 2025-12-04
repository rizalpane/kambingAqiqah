# 📊 FITUR RIWAYAT PEMBELIAN ADMIN

## Overview
Fitur untuk admin memantau dan mengelola semua transaksi/pembelian dari semua user. Admin dapat melihat status pembayaran, filter order, dan detail lengkap setiap transaksi.

---

## 🎯 Fitur yang Tersedia

### 1. **Dashboard Statistics**
Ditampilkan di atas tabel dengan 4 kartu info:
- ✅ **Total Order** - Jumlah semua order
- ✅ **Order Sukses** - Order dengan status 'success'
- ✅ **Pending** - Order dengan status 'pending'
- ✅ **Total Revenue** - Total uang dari order sukses (format Rp)

### 2. **Filter & Search**
- ✅ **Filter by Status:**
  - Semua Status (default)
  - Pending
  - Sukses
  - Gagal

- ✅ **Filter by Date Range:**
  - Dari Tanggal (date picker)
  - Sampai Tanggal (date picker)

- ✅ **Tombol Cari** untuk apply filter

### 3. **Tabel History Pembelian**
Kolom-kolom yang ditampilkan:

| Kolom | Keterangan |
|-------|-----------|
| ID Order | Nomor order (#ID) |
| Pembeli | Nama + Email user dengan avatar |
| Produk | Nama produk + lokasi |
| Qty | Jumlah ekor (badge) |
| Harga/Unit | Harga per unit dalam format Rp |
| Total | Total harga dalam format Rp (primary color) |
| Tanggal | Tanggal & waktu order dibuat |
| Pembayaran | Tanggal pembayaran atau "Belum Dibayar" (warning badge) |
| Status | Badge dengan warna sesuai status |
| Aksi | Tombol "Detail" |

### 4. **Status Badge**
Tampilan status dengan warna berbeda:

```
✅ Sukses (bg-success) - Order berhasil, pembayaran diterima
⏳ Pending (bg-warning) - Order menunggu pembayaran
❌ Gagal (bg-danger) - Order gagal atau dibatalkan
```

### 5. **Detail Modal**
Saat klik tombol "Detail", akan muncul modal berisi:

**Informasi Pembeli:**
- Nama
- Email
- Telepon
- Alamat

**Informasi Order:**
- ID Order
- Tanggal Order
- Status (badge)
- Tanggal Pembayaran

**Detail Produk:**
- Foto produk
- Nama produk
- Kategori
- Lokasi
- Kuantitas (ekor)
- Harga/Unit
- Total Harga

### 6. **Pagination**
- ✅ Tampil 20 order per halaman
- ✅ Pagination links untuk navigasi
- ✅ Filter preserved saat pindah halaman

---

## 📁 File-File yang Berkaitan

### Controllers
- `app/Http/Controllers/DashboardController.php`
  - `adminDashboard()` - Dashboard dengan statistik order
  - `orderHistory()` - Tampilkan history dengan filter

### Views
- `resources/views/admin/history.blade.php` - Halaman riwayat pembelian

### Routes
```php
Route::get('/admin/history', [DashboardController::class, 'orderHistory'])->name('admin.history');
```

### Models
- `app/Models/Order.php` - Model Order
  - Relasi: `user()`, `product()`

---

## 📊 Status Pembayaran

### Status Order
```php
// Database enum values
'pending'  - Order baru, menunggu pembayaran
'success'  - Pembayaran berhasil
'failed'   - Pembayaran gagal atau dibatalkan
```

### Indikator Pembayaran
```
payment_date = NULL      → "Belum Dibayar" (warning badge)
payment_date = datetime  → Tampilkan tanggal pembayaran (success text)
```

---

## 🧪 Testing

### Test Case 1: Lihat Semua Order
1. Login sebagai admin
2. Buka `/admin/history`
3. Verifikasi:
   - Statistik cards menampilkan angka benar
   - Semua order dari semua user tampil
   - Status payment terlihat jelas

### Test Case 2: Filter by Status
1. Pilih "Pending" di dropdown status
2. Klik tombol "Cari"
3. Verifikasi: Hanya order dengan status pending ditampilkan

### Test Case 3: Filter by Date Range
1. Pilih tanggal "Dari" dan "Sampai"
2. Klik tombol "Cari"
3. Verifikasi: Hanya order dalam range tanggal ditampilkan

### Test Case 4: Lihat Detail Order
1. Klik tombol "Detail" pada salah satu order
2. Verifikasi: Modal muncul dengan informasi lengkap:
   - Data pembeli
   - Data order
   - Data produk

### Test Case 5: Pagination
1. Jika order > 20, klik halaman berikutnya
2. Verifikasi: Order berbeda tampil, filter tetap terjaga

### Test Case 6: kombinasi Filter
1. Filter status "Sukses" + Date range
2. Klik "Cari"
3. Verifikasi: Hasil filter kombinasi benar

---

## 💡 Query Details

### Query Filter
```php
// Base query
$query = Order::with(['user', 'product'])
    ->orderBy('created_at', 'desc');

// Filter status
if ($request->filled('status')) {
    $query->where('status', $request->status);
}

// Filter date range
if ($request->filled('from_date')) {
    $query->whereDate('created_at', '>=', $request->from_date);
}
if ($request->filled('to_date')) {
    $query->whereDate('created_at', '<=', $request->to_date);
}

$orders = $query->paginate(20);
```

### Statistics Query
```php
$totalOrders = Order::count();
$successOrders = Order::where('status', 'success')->count();
$pendingOrders = Order::where('status', 'pending')->count();
$failedOrders = Order::where('status', 'failed')->count();
$totalRevenue = Order::where('status', 'success')->sum('total_price');
```

---

## 🎨 UI/UX Features

1. **Responsive Table** - Scrollable di mobile
2. **Avatar Display** - User avatar dengan fallback default
3. **Color Coding** - Status dengan warna intuitif
4. **Hover Effect** - Table row hover untuk better UX
5. **Icons** - Bootstrap icons untuk visual clarity
6. **Modal Detail** - Full information tanpa meninggalkan halaman

---

## 📈 Statistik yang Ditampilkan

| Statistik | Formula | Contoh |
|-----------|---------|--------|
| Total Order | COUNT(*) | 5 |
| Order Sukses | COUNT(*) WHERE status='success' | 5 |
| Pending | COUNT(*) WHERE status='pending' | 0 |
| Total Revenue | SUM(total_price) WHERE status='success' | Rp 15.000.000 |

---

## 🔐 Security

- ✅ Authorization: Hanya admin yang bisa akses (`role:admin`)
- ✅ Data Protection: Query dengan proper relationship loading
- ✅ Pagination: Prevent mass data loading
- ✅ Input Validation: Date range validation

---

## 📝 Current Statistics

**Database (Real-time):**
```
Total Orders: 5
Success Orders: 5
Pending Orders: 0
Failed Orders: 0
Total Revenue: Rp 15.000.000
```

---

## 🚀 Cara Menggunakan

1. **Login sebagai Admin**
2. **Buka**: `http://127.0.0.1:8000/admin/history`
3. **Lihat**: Dashboard statistik + tabel semua order
4. **Filter**: Pilih status dan/atau range tanggal
5. **Detail**: Klik tombol "Detail" untuk info lengkap

---

## 📋 Status Payment Indicators

```
✅ Sukses
   - Status: success (badge hijau)
   - Pembayaran: Ada (tanggal terlihat)
   - Action: Sudah terselesaikan

⏳ Pending
   - Status: pending (badge kuning)
   - Pembayaran: Belum Dibayar (badge warning)
   - Action: Menunggu user pembayaran

❌ Gagal
   - Status: failed (badge merah)
   - Pembayaran: Belum Dibayar / Ada (tergantung flow)
   - Action: Sudah dibatalkan
```

---

**Created:** 04 Dec 2025
**Version:** 1.0
**Status:** ✅ Production Ready
