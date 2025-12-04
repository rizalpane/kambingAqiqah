@extends('layouts.layoutAdmin')
@section('title', 'Pengaturan')
@section('content')

<style>
    .setting-page {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem 2rem;
        border-radius: 25px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .page-title {
        color: white;
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    .alert-gradient {
        border-radius: 15px;
        border: none;
        padding: 1.2rem 1.5rem;
        margin-bottom: 2rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .alert-success-gradient {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(32, 201, 151, 0.15) 100%);
        color: #28a745;
        border: 2px solid rgba(40, 167, 69, 0.2);
    }

    .alert-danger-gradient {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.15) 0%, rgba(200, 35, 51, 0.15) 100%);
        color: #dc3545;
        border: 2px solid rgba(220, 53, 69, 0.2);
    }

    .alert-info-gradient {
        background: linear-gradient(135deg, rgba(23, 162, 184, 0.15) 0%, rgba(13, 202, 240, 0.15) 100%);
        color: #17a2b8;
        border: 2px solid rgba(23, 162, 184, 0.2);
    }

    .alert-warning-gradient {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 152, 0, 0.15) 100%);
        color: #ffc107;
        border: 2px solid rgba(255, 193, 7, 0.2);
    }

    .custom-tabs {
        background: white;
        border-radius: 20px;
        padding: 1rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        border: none;
    }

    .custom-tabs .nav-link {
        border: none;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        font-weight: 700;
        color: #6c757d;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .custom-tabs .nav-link:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .custom-tabs .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .content-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }

    .content-card-header h5 {
        margin: 0;
        font-weight: 800;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .content-card-body {
        padding: 2rem;
    }

    .avatar-section {
        text-align: center;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 20px;
        margin-bottom: 2rem;
    }

    .avatar-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: #667eea;
    }

    .form-control,
    .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .form-control-lg {
        padding: 1rem 1.2rem;
        font-size: 1.1rem;
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-gradient-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .btn-gradient-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-gradient-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, #e9ecef, transparent);
        margin: 2rem 0;
    }

    .section-title {
        color: #667eea;
        font-weight: 800;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .preview-card {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
    }

    .preview-title {
        color: #667eea;
        font-weight: 800;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .preview-content {
        background: white;
        border-radius: 15px;
        padding: 3rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
        border-color: #667eea;
    }

    .stat-card h3 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0.5rem 0;
    }

    .stat-card p {
        margin: 0;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .stat-card-primary h3 { color: #667eea; }
    .stat-card-success h3 { color: #28a745; }
    .stat-card-info h3 { color: #17a2b8; }
    .stat-card-warning h3 { color: #ffc107; }

    .warning-box {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 152, 0, 0.1) 100%);
        border: 2px solid rgba(255, 193, 7, 0.3);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .warning-box h6 {
        color: #dc3545;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .custom-tabs .nav-link {
            font-size: 0.9rem;
            padding: 0.8rem 1rem;
        }
    }
</style>

<div class="setting-page">
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-content">
                <h1 class="page-title">
                    <i class="bi bi-gear-fill"></i>
                    Pengaturan
                </h1>
                <p class="page-subtitle">Kelola pengaturan sistem dan profil admin</p>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-gradient alert-success-gradient alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-gradient alert-danger-gradient alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs custom-tabs" id="settingTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                    <i class="bi bi-person-circle"></i>Profil Admin
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="false">
                    <i class="bi bi-gear"></i>Pengaturan Umum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reset-tab" data-bs-toggle="tab" data-bs-target="#reset" type="button" role="tab" aria-controls="reset" aria-selected="false">
                    <i class="bi bi-trash"></i>Reset Data
                </button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="settingTabsContent">
            <!-- TAB 1: PROFIL ADMIN -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5><i class="bi bi-person-circle"></i>Profil Admin</h5>
                    </div>
                    <div class="content-card-body">
                        <form action="{{ route('admin.setting.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="avatar-section">
                                        @if($admin->avatar)
                                            <img src="{{ asset('storage/' . $admin->avatar) }}" alt="Avatar" class="avatar-img">
                                        @else
                                            <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="avatar-img">
                                        @endif
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="bi bi-camera"></i>
                                                Foto Profil
                                            </label>
                                            <input type="file" name="avatar" class="form-control" accept="image/*">
                                            <small class="text-muted">Max 2MB (JPG, PNG)</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">
                                                <i class="bi bi-person"></i>
                                                Nama Lengkap <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">
                                                <i class="bi bi-envelope"></i>
                                                Email <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">
                                                <i class="bi bi-telephone"></i>
                                                Nomor Telepon
                                            </label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="role" class="form-label">
                                                <i class="bi bi-shield-check"></i>
                                                Role
                                            </label>
                                            <input type="text" class="form-control" value="{{ ucfirst($admin->role) }}" readonly>
                                            <small class="text-muted">Role tidak dapat diubah</small>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label">
                                                <i class="bi bi-geo-alt"></i>
                                                Alamat
                                            </label>
                                            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $admin->address) }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="divider"></div>
                                    
                                    <h6 class="section-title">
                                        <i class="bi bi-lock"></i>
                                        Ubah Password (opsional)
                                    </h6>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="current_password" class="form-label">
                                                <i class="bi bi-key"></i>
                                                Password Saat Ini
                                            </label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" id="current_password" name="current_password">
                                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                                        onclick="togglePassword('current_password')" style="text-decoration: none; z-index: 10;">
                                                    <i class="bi bi-eye" id="current_password-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label for="new_password" class="form-label">
                                                <i class="bi bi-key-fill"></i>
                                                Password Baru
                                            </label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" id="new_password" name="new_password">
                                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                                        onclick="togglePassword('new_password')" style="text-decoration: none; z-index: 10;">
                                                    <i class="bi bi-eye" id="new_password-icon"></i>
                                                </button>
                                            </div>
                                            <small class="text-muted">Min 8 karakter</small>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label for="new_password_confirmation" class="form-label">
                                                <i class="bi bi-key-fill"></i>
                                                Konfirmasi Password Baru
                                            </label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                                        onclick="togglePassword('new_password_confirmation')" style="text-decoration: none; z-index: 10;">
                                                    <i class="bi bi-eye" id="new_password_confirmation-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn-gradient-primary btn-lg">
                                            <i class="bi bi-save"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TAB 2: PENGATURAN UMUM -->
            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5><i class="bi bi-gear"></i>Pengaturan Umum</h5>
                    </div>
                    <div class="content-card-body">
                        <div class="alert-gradient alert-info-gradient">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Info:</strong> Pengaturan ini akan mempengaruhi tampilan pada halaman landing page (index.blade.php)
                        </div>
                        
                        <form action="{{ route('admin.setting.general') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="site_title" class="form-label">
                                    <i class="bi bi-type-h1"></i>
                                    Judul Utama <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="site_title" name="site_title" value="{{ old('site_title', $siteTitle) }}" required>
                                <small class="text-muted">Judul besar yang muncul di halaman utama</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="site_subtitle" class="form-label">
                                    <i class="bi bi-type-h2"></i>
                                    Sub Judul <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="site_subtitle" name="site_subtitle" value="{{ old('site_subtitle', $siteSubtitle) }}" required>
                                <small class="text-muted">Kalimat pendek di bawah judul utama</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="site_description" class="form-label">
                                    <i class="bi bi-text-paragraph"></i>
                                    Deskripsi
                                </label>
                                <textarea class="form-control" id="site_description" name="site_description" rows="4">{{ old('site_description', $siteDescription) }}</textarea>
                                <small class="text-muted">Deskripsi tambahan (opsional)</small>
                            </div>
                            
                            <div class="divider"></div>
                            
                            <div class="preview-card">
                                <h6 class="preview-title">
                                    <i class="bi bi-eye"></i>
                                    Preview
                                </h6>
                                <div class="preview-content">
                                    <h1 class="display-4 fw-bold" id="preview-title" style="color: #667eea;">{{ $siteTitle }}</h1>
                                    <p class="lead" id="preview-subtitle">{{ $siteSubtitle }}</p>
                                    <p class="text-muted" id="preview-description">{{ $siteDescription }}</p>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn-gradient-success btn-lg">
                                    <i class="bi bi-save"></i>Simpan Pengaturan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TAB 3: RESET DATA -->
            <div class="tab-pane fade" id="reset" role="tabpanel" aria-labelledby="reset-tab">
                <div class="content-card">
                    <div class="content-card-header" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                        <h5><i class="bi bi-trash"></i>Reset Data</h5>
                    </div>
                    <div class="content-card-body">
                        <div class="alert-gradient alert-danger-gradient">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan! Pastikan Anda yakin sebelum menghapus data.
                        </div>
                        
                        <!-- Statistics -->
                        <div class="stats-grid">
                            <div class="stat-card stat-card-primary">
                                <i class="bi bi-people-fill" style="font-size: 2rem; color: #667eea;"></i>
                                <h3>{{ $stats['users'] }}</h3>
                                <p>Users</p>
                            </div>
                            <div class="stat-card stat-card-success">
                                <i class="bi bi-cart4" style="font-size: 2rem; color: #28a745;"></i>
                                <h3>{{ $stats['products'] }}</h3>
                                <p>Products</p>
                            </div>
                            <div class="stat-card stat-card-info">
                                <i class="bi bi-box-seam" style="font-size: 2rem; color: #17a2b8;"></i>
                                <h3>{{ $stats['orders'] }}</h3>
                                <p>Total Orders</p>
                            </div>
                            <div class="stat-card stat-card-warning">
                                <i class="bi bi-check-circle" style="font-size: 2rem; color: #ffc107;"></i>
                                <h3>{{ $stats['success_orders'] }}</h3>
                                <p>Success Orders</p>
                            </div>
                        </div>
                        
                        <form action="{{ route('admin.setting.reset') }}" method="POST" id="resetForm">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="reset_type" class="form-label">
                                    <i class="bi bi-list-check"></i>
                                    Pilih Data yang Akan Dihapus
                                </label>
                                <select class="form-select form-select-lg" id="reset_type" name="reset_type" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="users">Hapus Semua User ({{ $stats['users'] }} user)</option>
                                    <option value="products">Hapus Semua Produk ({{ $stats['products'] }} produk)</option>
                                    <option value="orders">Hapus Semua Order ({{ $stats['orders'] }} order)</option>
                                    <option value="success_orders">Hapus Order Sukses ({{ $stats['success_orders'] }} order)</option>
                                    <option value="pending_orders">Hapus Order Pending ({{ $stats['pending_orders'] }} order)</option>
                                    <option value="failed_orders">Hapus Order Gagal ({{ $stats['failed_orders'] }} order)</option>
                                    <option value="all" class="text-danger fw-bold">❌ HAPUS SEMUA DATA (Users + Products + Orders)</option>
                                </select>
                            </div>
                            
                            <div class="warning-box" id="warningBox" style="display: none;">
                                <h6><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Penghapusan</h6>
                                <p class="mb-3" id="warningText" style="color: #333; font-weight: 600;"></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirmReset" required>
                                    <label class="form-check-label" for="confirmReset" style="font-weight: 700;">
                                        Saya mengerti dan ingin melanjutkan penghapusan
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn-gradient-danger btn-lg" id="resetButton" disabled>
                                    <i class="bi bi-trash"></i>Hapus Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview for general settings
document.getElementById('site_title')?.addEventListener('input', function(e) {
    document.getElementById('preview-title').textContent = e.target.value || 'Selamat Datang';
});

document.getElementById('site_subtitle')?.addEventListener('input', function(e) {
    document.getElementById('preview-subtitle').textContent = e.target.value || 'Layanan Aqiqah Terpercaya';
});

document.getElementById('site_description')?.addEventListener('input', function(e) {
    document.getElementById('preview-description').textContent = e.target.value || '';
});

// Reset form validation
const resetType = document.getElementById('reset_type');
const warningBox = document.getElementById('warningBox');
const warningText = document.getElementById('warningText');
const confirmReset = document.getElementById('confirmReset');
const resetButton = document.getElementById('resetButton');

resetType?.addEventListener('change', function() {
    const value = this.value;
    if (value) {
        warningBox.style.display = 'block';
        const option = this.options[this.selectedIndex].text;
        warningText.textContent = `Anda akan ${option.toLowerCase()}. Data yang dihapus tidak dapat dikembalikan!`;
        confirmReset.checked = false;
        resetButton.disabled = true;
    } else {
        warningBox.style.display = 'none';
        resetButton.disabled = true;
    }
});

confirmReset?.addEventListener('change', function() {
    resetButton.disabled = !this.checked;
});

// Confirm before submit
document.getElementById('resetForm')?.addEventListener('submit', function(e) {
    if (!confirm('Apakah Anda benar-benar yakin ingin menghapus data ini? Tindakan ini TIDAK DAPAT DIBATALKAN!')) {
        e.preventDefault();
    }
});

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
