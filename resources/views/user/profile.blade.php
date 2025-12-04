@extends('layouts.layoutUser')

@section('title', 'Profil Saya')

@section('content')

<style>
    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header-profile {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .page-title-profile {
        color: white;
        font-weight: 800;
        font-size: 2rem;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-subtitle-profile {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0.5rem 0 0 0;
    }

    .profile-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .avatar-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
    }

    .avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .avatar-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        object-fit: cover;
        background: white;
    }

    .avatar-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        border: 3px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .user-name-display {
        color: #333;
        font-weight: 800;
        font-size: 1.8rem;
        margin: 0.5rem 0 0.2rem 0;
    }

    .user-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .profile-form-section {
        padding: 2rem;
    }

    .section-title {
        color: #667eea;
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border: none;
        margin: 2rem 0;
        border-radius: 2px;
    }

    .form-group-custom {
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        color: #667eea;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-control-custom {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control-custom:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        outline: none;
    }

    .form-control-custom:disabled,
    .form-control-custom:read-only {
        background: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input-custom {
        border: 2px dashed #667eea;
        border-radius: 12px;
        padding: 1.5rem;
        background: rgba(102, 126, 234, 0.05);
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-input-custom:hover {
        background: rgba(102, 126, 234, 0.1);
        border-color: #764ba2;
    }

    .file-input-custom i {
        font-size: 2rem;
        color: #667eea;
        margin-bottom: 0.5rem;
    }

    .file-input-custom p {
        margin: 0;
        color: #667eea;
        font-weight: 600;
    }

    .file-input-custom small {
        color: #666;
        font-size: 0.85rem;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-back-profile {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        padding: 0.8rem;
        border-radius: 15px;
        font-weight: 700;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .btn-back-profile:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .alert-custom {
        border-radius: 15px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .alert-success-custom {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
        border-left: 4px solid #28a745;
        color: #28a745;
    }

    .alert-danger-custom {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(200, 35, 51, 0.1) 100%);
        border-left: 4px solid #dc3545;
        color: #dc3545;
    }

    .password-hint {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-left: 4px solid #667eea;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .password-hint p {
        margin: 0;
        color: #667eea;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .row-gap-custom {
        gap: 1.5rem;
    }
</style>

<div class="container profile-container my-5">
    <!-- Page Header -->
    <div class="page-header-profile">
        <h1 class="page-title-profile">
            <i class="bi bi-person-circle me-2"></i>Profil Saya
        </h1>
        <p class="page-subtitle-profile">Kelola informasi profil dan keamanan akun Anda</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="profile-card">
                <!-- Avatar Section -->
                <div class="avatar-section">
                    <div class="avatar-container">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar-image">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="avatar-image">
                        @endif
                        <div class="avatar-badge">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                    </div>
                    <h2 class="user-name-display">{{ $user->name }}</h2>
                    <span class="user-role-badge">
                        <i class="bi bi-shield-check"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <!-- Form Section -->
                <div class="profile-form-section">
                    @if(session('success'))
                        <div class="alert-custom alert-success-custom">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert-custom alert-danger-custom">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Terjadi Kesalahan:</strong>
                            <ul class="mb-0 mt-2" style="padding-left: 1.5rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Picture Upload -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-image"></i>
                                Foto Profil
                            </label>
                            <div class="file-input-custom">
                                <i class="bi bi-cloud-upload d-block"></i>
                                <p>Klik untuk upload foto profil</p>
                                <small>Format: JPG, JPEG, PNG — Maksimal 2MB</small>
                                <input type="file" name="avatar" class="form-control" style="position: absolute; opacity: 0; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Personal Information Section -->
                        <h3 class="section-title">
                            <i class="bi bi-person-vcard"></i>
                            Informasi Pribadi
                        </h3>

                        <div class="row row-gap-custom">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">
                                        <i class="bi bi-person"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control form-control-custom" required placeholder="Masukkan nama lengkap">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">
                                        <i class="bi bi-envelope"></i>
                                        Email
                                    </label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control form-control-custom" required placeholder="email@example.com">
                                </div>
                            </div>
                        </div>

                        <div class="row row-gap-custom">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">
                                        <i class="bi bi-telephone"></i>
                                        Nomor Telepon
                                    </label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control form-control-custom" placeholder="08xx-xxxx-xxxx">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">
                                        <i class="bi bi-shield-lock"></i>
                                        Role
                                    </label>
                                    <input type="text" class="form-control form-control-custom" value="{{ ucfirst($user->role) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-geo-alt"></i>
                                Alamat Lengkap
                            </label>
                            <textarea name="address" class="form-control form-control-custom" rows="3" placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <hr class="section-divider">

                        <!-- Password Section -->
                        <h3 class="section-title">
                            <i class="bi bi-key"></i>
                            Keamanan Akun
                        </h3>

                        <div class="password-hint">
                            <p>
                                <i class="bi bi-info-circle me-2"></i>
                                Kosongkan jika tidak ingin mengubah password
                            </p>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-lock"></i>
                                Password Saat Ini
                            </label>
                            <div class="position-relative">
                                <input type="password" id="current_password" name="current_password" class="form-control form-control-custom" placeholder="Masukkan password lama">
                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                        onclick="togglePassword('current_password')" style="text-decoration: none; z-index: 10;">
                                    <i class="bi bi-eye" id="current_password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row row-gap-custom">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">
                                        <i class="bi bi-lock-fill"></i>
                                        Password Baru
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" id="new_password" name="new_password" class="form-control form-control-custom" placeholder="Masukkan password baru">
                                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                                onclick="togglePassword('new_password')" style="text-decoration: none; z-index: 10;">
                                            <i class="bi bi-eye" id="new_password-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">
                                        <i class="bi bi-check-circle"></i>
                                        Konfirmasi Password Baru
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control form-control-custom" placeholder="Ulangi password baru">
                                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                                onclick="togglePassword('new_password_confirmation')" style="text-decoration: none; z-index: 10;">
                                            <i class="bi bi-eye" id="new_password_confirmation-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <button type="submit" class="btn-save">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('user.dashboard') }}" class="btn-back-profile">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '-icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>

@endsection