@extends('layouts.layoutAuth')

@section('title', 'Reset Password')

@section('content')

<div class="auth-wrapper">
    <!-- Background Elements -->
    <div class="auth-bg">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
        <div class="circle circle-4"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                
                <div class="auth-card">
                    <div class="card-body p-5">
                        
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="auth-icon mb-3">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <h2 class="auth-title mb-2">Buat Password Baru</h2>
                            <p class="auth-subtitle">Masukkan password baru untuk akun Anda</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mb-0 mt-2 small">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <!-- Email (Read-only) -->
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    <i class="bi bi-envelope me-1"></i>Email
                                </label>
                                <input type="email" class="form-control form-control-lg rounded-3 bg-light" 
                                       value="{{ $email }}" readonly>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>Email tidak dapat diubah
                                </small>
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    <i class="bi bi-lock me-1"></i>Password Baru <span class="text-danger">*</span>
                                </label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror" 
                                           id="password" name="password" placeholder="Minimal 8 karakter" required autofocus>
                                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                            onclick="togglePassword('password')" style="text-decoration: none; z-index: 10;">
                                        <i class="bi bi-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i>Minimal 8 karakter
                                </small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="form-label text-secondary fw-semibold">
                                    <i class="bi bi-lock-fill me-1"></i>Konfirmasi Password Baru <span class="text-danger">*</span>
                                </label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg rounded-3 @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" required>
                                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-secondary" 
                                            onclick="togglePassword('password_confirmation')" style="text-decoration: none; z-index: 10;">
                                        <i class="bi bi-eye" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Info Alert -->
                            <div class="alert alert-info-custom rounded-3 mb-4">
                                <i class="bi bi-lightbulb me-2"></i>
                                <strong>Tips:</strong> Gunakan kombinasi huruf besar, kecil, angka, dan simbol untuk password yang lebih kuat.
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn-gradient-auth btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Reset Password
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="text-center">
                                <div class="auth-divider">
                                    <span>atau</span>
                                </div>
                                <p class="auth-link-text mb-0">
                                    Ingat password Anda? 
                                    <a class="auth-link" href="{{ route('auth.login') }}">
                                        Login di sini <i class="bi bi-arrow-right"></i>
                                    </a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="text-center mt-4">
                    <div class="auth-note">
                        <i class="bi bi-shield-check me-2"></i>
                        Link reset password berlaku selama 1 jam
                    </div>
                </div>

            </div>
        </div>
    </div>
<style>
/* Auth Wrapper with Gradient Background */
.auth-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

/* Background Circles */
.auth-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 20s infinite ease-in-out;
}

.circle-1 {
    width: 300px;
    height: 300px;
    top: -100px;
    left: -100px;
    animation-delay: 0s;
}

.circle-2 {
    width: 200px;
    height: 200px;
    top: 50%;
    right: -50px;
    animation-delay: 2s;
}

.circle-3 {
    width: 250px;
    height: 250px;
    bottom: -80px;
    left: 30%;
    animation-delay: 4s;
}

.circle-4 {
    width: 150px;
    height: 150px;
    top: 20%;
    right: 20%;
    animation-delay: 1s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-30px) rotate(180deg);
    }
}

/* Auth Card */
.auth-card {
    background: white;
    border-radius: 25px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    position: relative;
    z-index: 1;
    animation: slideUp 0.5s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Auth Icon */
.auth-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.auth-icon i {
    font-size: 2.5rem;
    color: white;
}

/* Auth Title */
.auth-title {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.auth-subtitle {
    color: #6c757d;
    font-size: 1rem;
}

/* Form Controls */
.form-label {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    background: #f8f9ff;
}

.form-control.bg-light {
    background: #f8f9fa !important;
}

/* Gradient Button */
.btn-gradient-auth {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    font-weight: 700;
    padding: 1rem;
    border-radius: 15px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-gradient-auth:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-gradient-auth:active {
    transform: translateY(-1px);
}

/* Auth Divider */
.auth-divider {
    position: relative;
    margin: 2rem 0 1.5rem 0;
    text-align: center;
}

.auth-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, #dee2e6, transparent);
}

.auth-divider span {
    background: white;
    padding: 0 1rem;
    color: #6c757d;
    font-size: 0.9rem;
    position: relative;
    z-index: 1;
}

/* Auth Links */
.auth-link-text {
    color: #6c757d;
    font-size: 0.95rem;
}

.auth-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
}

.auth-link:hover {
    color: #764ba2;
    text-decoration: none;
}

/* Auth Note */
.auth-note {
    color: white;
    font-size: 0.9rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    backdrop-filter: blur(10px);
    display: inline-block;
}

/* Alert Styles */
.alert {
    border-radius: 15px;
    border: none;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-success {
    background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
    color: #155724;
}

.alert-danger {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: #721c24;
}

.alert-info-custom {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    border: none;
    color: #004085;
    padding: 1rem;
}

/* Password Toggle */
.btn-link {
    color: #667eea;
}

.btn-link:hover {
    color: #764ba2;
}

/* Small Text */
small.text-muted {
    color: #6c757d !important;
}

/* Responsive */
@media (max-width: 768px) {
    .auth-title {
        font-size: 1.5rem;
    }
    
    .auth-icon {
        width: 60px;
        height: 60px;
    }
    
    .auth-icon i {
        font-size: 2rem;
    }
}
</style>r: #004085;
}
</style>

<script>
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
