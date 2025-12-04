# Reset Password Feature - Testing Guide

## 📧 Fitur Reset Password Sudah Siap!

### ✅ Yang Sudah Dibuat:

1. **Controller**: `PasswordResetController`
   - `showForgotForm()` - Tampilkan form forgot password
   - `sendResetLink()` - Kirim email reset password
   - `showResetForm()` - Tampilkan form reset password
   - `resetPassword()` - Proses reset password

2. **Mail Class**: `ResetPasswordMail`
   - Template email profesional dengan gradient design
   - Button reset password
   - Warning untuk expiry (1 jam)
   - Alternative link jika button tidak berfungsi

3. **Views**:
   - `forgot.blade.php` - Form request reset (updated)
   - `reset-password.blade.php` - Form reset password baru
   - `emails/reset-password.blade.php` - Email template

4. **Routes**:
   - GET `/forgot` - Form request reset
   - POST `/forgot` - Kirim email reset
   - GET `/reset-password/{token}` - Form reset dengan token
   - POST `/reset-password` - Proses reset

5. **Database**:
   - Table `password_reset_tokens` sudah ada (migration default Laravel)
   - Columns: email, token, created_at

---

## 🧪 Cara Test:

### 1. Pastikan XAMPP MySQL & Apache Running
```bash
# Check di XAMPP Control Panel
```

### 2. Test Forgot Password Flow:

**Step 1: Request Reset**
- Buka: http://127.0.0.1:8000/forgot
- Masukkan email yang terdaftar (contoh: user@example.com)
- Klik "Kirim Link Reset"

**Step 2: Cek Email**
- Login ke Gmail: tidakada420@gmail.com
- Cek inbox untuk email "Reset Password - Layanan Aqiqah"
- Klik button "Reset Password Sekarang" atau copy URL

**Step 3: Reset Password**
- Browser akan membuka halaman reset password
- Email sudah terisi otomatis (read-only)
- Masukkan password baru (min 8 karakter)
- Konfirmasi password
- Klik "Reset Password"

**Step 4: Login dengan Password Baru**
- Redirect ke login page
- Muncul alert success "Password berhasil direset!"
- Login dengan email & password baru

---

## 🔧 Email Configuration (sudah setup di .env):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tidakada420@gmail.com
MAIL_PASSWORD=ioohwqdbvzjdyclx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tidakada420@gmail.com
MAIL_FROM_NAME=Laravel
```

---

## 🎯 Fitur yang Sudah Diimplementasi:

✅ **Security Features:**
- Token expiry: 1 jam (60 menit)
- Token hanya bisa digunakan 1x
- Token di-hash di database
- Validasi email exists
- Password minimal 8 karakter
- Password confirmation required

✅ **User Experience:**
- Email template profesional & responsive
- Alternative link jika button tidak berfungsi
- Warning tentang expiry time
- Success/error messages yang jelas
- Redirect otomatis setelah success

✅ **Error Handling:**
- Email tidak terdaftar → error message
- Token expired → hapus token & redirect
- Token invalid → error message
- Email gagal terkirim → error message

---

## 📝 Test Case:

### Test 1: Email Tidak Terdaftar
- Input: random@email.com
- Expected: "Email tidak terdaftar dalam sistem"

### Test 2: Email Terdaftar Valid
- Input: email user yang ada di database
- Expected: "Link reset password telah dikirim ke email Anda"
- Check: Email masuk dengan token valid

### Test 3: Token Expired
- Gunakan token yang dibuat > 1 jam lalu
- Expected: "Token reset password telah kadaluarsa"

### Test 4: Password Tidak Match
- Input password & confirmation berbeda
- Expected: "Konfirmasi password tidak cocok"

### Test 5: Password < 8 Karakter
- Input: "123"
- Expected: "Password minimal 8 karakter"

### Test 6: Success Flow
- Request → Email → Reset → Login
- Expected: Semua berjalan lancar

---

## 🐛 Troubleshooting:

**Email Tidak Terkirim:**
1. Check internet connection
2. Verify Gmail credentials di .env
3. Check Gmail "App Password" masih valid
4. Run: `php artisan config:clear`
5. Check logs: `storage/logs/laravel.log`

**Token Tidak Valid:**
1. Check database table `password_reset_tokens`
2. Pastikan token match dengan URL
3. Check created_at tidak > 1 jam

**Database Error:**
1. Check migration sudah run: `php artisan migrate:status`
2. Check connection di .env

---

## 📧 Email Preview:

Email akan berisi:
- 🔐 Icon & Header "Reset Password"
- Greeting dengan nama user
- Button "Reset Password Sekarang" (gradient purple)
- ⚠️ Warning: Link berlaku 1 jam
- Alternative link (plain URL)
- ℹ️ Info: Jika tidak request, abaikan email
- Footer dengan copyright & contact

---

## 🎉 Status: READY TO TEST!

Semua file sudah dibuat dan routes sudah terdaftar.
Silakan test di browser!
