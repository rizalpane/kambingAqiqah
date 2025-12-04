# 📋 FITUR MANAJEMEN USER ADMIN

## Overview
Fitur untuk admin mengelola semua user dengan role 'user'. Admin dapat melihat, mengedit, dan menghapus data user.

---

## 🎯 Fitur yang Tersedia

### 1. **Halaman Daftar User** (`GET /admin/users`)
- ✅ Menampilkan semua user dengan role 'user'
- ✅ Tampil: ID, Nama, Email, Alamat, Telepon, Tanggal Terdaftar
- ✅ Avatar user dengan fallback default
- ✅ Tombol Edit dan Hapus untuk setiap user
- ✅ Modal konfirmasi sebelum hapus
- ✅ Sorting: User terbaru di atas
- ✅ Alert success/error untuk feedback

### 2. **Edit Data User** (`GET /admin/users/{user}/edit`)
- ✅ Form lengkap dengan data user
- ✅ Edit field: Nama, Email, Alamat, Telepon
- ✅ **Edit Password** (opsional)
  - Password minimal 8 karakter
  - Harus ada konfirmasi password
  - Jika kosong, password tidak diubah
- ✅ Tampilkan role user (read-only)
- ✅ Tampilkan tanggal terdaftar (read-only)
- ✅ Avatar user ditampilkan (tapi tidak bisa diedit dari admin, hanya user yang bisa)
- ✅ Statistik user:
  - Total order
  - Order berhasil
  - Total transaksi sukses

### 3. **Update Data User** (`PUT /admin/users/{user}`)
- ✅ Validasi email unik (kecuali email user sendiri)
- ✅ Password hashing otomatis jika diubah
- ✅ Update semua field
- ✅ Redirect dengan pesan sukses

### 4. **Hapus User** (`DELETE /admin/users/{user}`)
- ✅ Soft confirmation via modal
- ✅ Validasi: hanya user dengan role 'user' bisa dihapus
- ✅ Admin tidak bisa dihapus dari halaman ini
- ✅ Redirect dengan pesan sukses

---

## 🔐 Keamanan

1. **Authorization:**
   - Hanya admin yang bisa akses halaman ini (`role:admin` middleware)
   - Admin tidak bisa edit admin lain
   - Admin tidak bisa hapus admin lain

2. **Validation:**
   - Email harus unik
   - Password minimal 8 karakter jika diubah
   - Semua field required divalidasi

3. **Password:**
   - Auto-hashed dengan bcrypt
   - Hanya diubah jika field password tidak kosong

---

## 📂 File-File yang Berkaitan

### Controllers
- `app/Http/Controllers/UserController.php`
  - `index()` - Tampilkan daftar user
  - `edit()` - Tampilkan form edit
  - `update()` - Update data user
  - `destroy()` - Hapus user

### Views
- `resources/views/admin/users.blade.php` - Daftar user dengan table
- `resources/views/admin/users-edit.blade.php` - Form edit user

### Routes
```php
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
```

### Models
- `app/Models/User.php` - Relasi ke Order
  - `orders()` - Menampilkan semua order user

---

## 📊 Tampilan Data

### Daftar User - Table View
```
ID | Nama | Email | Alamat | Telepon | Terdaftar | Aksi
1  | User 1 | user@email.com | ... | ... | 04 Des 2025 | [Edit] [Hapus]
```

### Edit User - Form
```
[Avatar Preview]
Nama Lengkap: [text input]
Email: [email input]
Alamat: [textarea]
Telepon: [text input]
---
Password Baru: [password input] (opsional)
Konfirmasi: [password input]
---
Role: user (read-only)
Terdaftar: 04 Des 2025 (read-only)

[Simpan] [Kembali]
```

---

## 🧪 Testing

### Test Case 1: Lihat Daftar User
1. Login sebagai admin
2. Buka `/admin/users`
3. Verifikasi: Semua user dengan role 'user' tampil

### Test Case 2: Edit User
1. Klik tombol Edit
2. Ubah nama, email, alamat, telepon
3. Klik Simpan
4. Verifikasi: Alert sukses muncul, data berubah

### Test Case 3: Edit Password User
1. Klik tombol Edit
2. Isi Password Baru dan Konfirmasi
3. Klik Simpan
4. Verifikasi: Password berubah (test dengan login)

### Test Case 4: Hapus User
1. Klik tombol Hapus
2. Klik konfirmasi di modal
3. Verifikasi: User dihapus, alert sukses muncul

### Test Case 5: Validasi
1. Edit email jadi email yang sudah ada
2. Verifikasi: Error "email harus unik"
3. Edit password kurang dari 8 karakter
4. Verifikasi: Error "minimal 8 karakter"

---

## 💡 Tips & Trick

1. **Password Tidak Wajib Diubah**
   - Jika tidak ingin ubah password, kosongkan kedua field password
   - System akan hanya update field lain

2. **Lihat Statistik User**
   - Scroll ke bawah di halaman edit
   - Ada 3 box: Total Order, Order Berhasil, Total Transaksi

3. **Avatar User**
   - Avatar tidak bisa diedit admin
   - User bisa ubah avatar di halaman profil mereka
   - Admin bisa lihat preview avatar

4. **Email Update**
   - Email harus unik tapi excludes email user tersebut
   - Sistem cek sebelum update

---

## 📈 Future Improvements

- [ ] Export user data ke CSV/Excel
- [ ] Bulk operations (edit multiple users)
- [ ] Search/filter users
- [ ] Pagination untuk banyak user
- [ ] Activity log (siapa yang edit, kapan)
- [ ] User status (active/inactive)
- [ ] Audit trail untuk password changes

---

**Created:** 04 Dec 2025
**Version:** 1.0
