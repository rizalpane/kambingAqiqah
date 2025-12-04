@extends('layouts.layoutMain')

@section('title', 'Beranda - Layanan Aqiqah Terpercaya')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="bi bi-star-fill me-2"></i>Layanan Terpercaya
                    </span>
                    
                    <h1 class="hero-title">
                        {{ \App\Models\Setting::get('site_title', 'Selamat Datang') }}
                    </h1>
                    
                    <p class="hero-subtitle">
                        {{ \App\Models\Setting::get('site_subtitle', 'Layanan Aqiqah Terpercaya dan Berkualitas') }}
                    </p>
                    
                    @if(\App\Models\Setting::get('site_description'))
                        <p class="hero-description">
                            {{ \App\Models\Setting::get('site_description') }}
                        </p>
                    @endif

                    <div class="hero-buttons">
                        <a href="/register" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-person-plus me-2"></i>Mulai Sekarang
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-5">
                            <i class="bi bi-arrow-down-circle me-2"></i>Pelajari
                        </a>
                    </div>

                    <div class="hero-features">
                        <div class="feature-item">
                            <i class="bi bi-shield-check-fill"></i>
                            <span>100% Halal</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-truck"></i>
                            <span>Gratis Antar</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-star-fill"></i>
                            <span>Kualitas Terjamin</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-image-container">
                    <img src="{{ asset('images/goat.png') }}" alt="Kambing Aqiqah" class="hero-image">
                    <div class="hero-decoration decoration-1"></div>
                    <div class="hero-decoration decoration-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="stat-number">1000+</h3>
                    <p class="stat-label">Pelanggan Puas</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3 class="stat-number">500+</h3>
                    <p class="stat-label">Pesanan Selesai</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h3 class="stat-number">4.9</h3>
                    <p class="stat-label">Rating Layanan</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <h3 class="stat-number">100%</h3>
                    <p class="stat-label">Kepuasan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Keunggulan Kami</span>
            <h2 class="section-title">Mengapa Memilih Kami?</h2>
            <p class="section-subtitle">Pelayanan terbaik untuk momen istimewa keluarga Anda</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-gradient-primary">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="feature-title">100% Halal & Berkualitas</h4>
                    <p class="feature-text">Semua produk tersertifikasi halal dan dipotong sesuai syariat Islam oleh ahli berpengalaman.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-gradient-success">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h4 class="feature-title">Gratis Pengiriman</h4>
                    <p class="feature-text">Nikmati layanan antar gratis ke rumah Anda dengan tepat waktu dan aman.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-gradient-info">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h4 class="feature-title">Harga Terjangkau</h4>
                    <p class="feature-text">Paket aqiqah berkualitas dengan harga bersahabat dan transparan tanpa biaya tersembunyi.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-gradient-warning">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4 class="feature-title">Layanan 24/7</h4>
                    <p class="feature-text">Customer service kami siap membantu Anda kapan saja untuk konsultasi dan pemesanan.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-gradient-danger">
                        <i class="bi bi-award"></i>
                    </div>
                    <h4 class="feature-title">Kualitas Premium</h4>
                    <p class="feature-text">Kambing pilihan dengan kondisi sehat dan berkualitas terbaik untuk kepuasan Anda.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-gradient-purple">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h4 class="feature-title">Proses Cepat</h4>
                    <p class="feature-text">Pemesanan mudah dan proses pengiriman yang cepat untuk kenyamanan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Cara Pemesanan</span>
            <h2 class="section-title">Mudah & Praktis</h2>
            <p class="section-subtitle">Hanya 4 langkah sederhana untuk memesan</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h5 class="step-title">Daftar Akun</h5>
                    <p class="step-text">Buat akun gratis dengan data diri Anda</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    <h5 class="step-title">Pilih Paket</h5>
                    <p class="step-text">Pilih kambing sesuai kebutuhan</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="bi bi-credit-card-fill"></i>
                    </div>
                    <h5 class="step-title">Pembayaran</h5>
                    <p class="step-text">Bayar dengan aman via berbagai metode</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h5 class="step-title">Selesai</h5>
                    <p class="step-text">Pesanan diproses dan dikirim</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0 text-center text-lg-start">
                    <h2 class="cta-title">Siap Memulai Pemesanan?</h2>
                    <p class="cta-text">Bergabunglah dengan ribuan pelanggan yang puas dengan layanan kami</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="/register" class="btn btn-light btn-lg px-5">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title">
                    <i class="bi bi-shop me-2"></i>SiKambing
                </h5>
                <p class="footer-text">Penyedia layanan aqiqah terpercaya yang berkomitmen memberikan pelayanan terbaik untuk momen spesial keluarga Anda.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Menu</h5>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/produk">Produk</a></li>
                    <li><a href="/layanan">Layanan</a></li>
                    <li><a href="/kontak">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Kontak</h5>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt-fill"></i> Jl sederhana No.26 Kec. Percut Sei Tuan Sumatera Utara</li>
                    <li><i class="bi bi-telephone-fill"></i> +62 812-3456-7890</li>
                    <li><i class="bi bi-envelope-fill"></i> info@sikambing.com</li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Newsletter</h5>
                <p class="footer-text mb-3">Dapatkan info promo terbaru</p>
                <div class="newsletter-form">
                    <input type="email" class="form-control" placeholder="Email Anda">
                    <button class="btn btn-primary"><i class="bi bi-send"></i></button>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="text-center">
            <p class="footer-copyright mb-0">
                &copy; {{ date('Y') }} SiKambing. All rights reserved. Made with <i class="bi bi-heart-fill text-danger"></i>
            </p>
        </div>
    </div>
</footer>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 150px 0 100px;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 25px;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 15px;
    opacity: 0.95;
}

.hero-description {
    font-size: 1.1rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.hero-buttons {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.hero-features {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}

.feature-item i {
    font-size: 1.5rem;
}

.hero-image-container {
    position: relative;
    text-align: center;
}

.hero-image {
    width: 100%;
    max-width: 500px;
    height: auto;
    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.hero-decoration {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.decoration-1 {
    width: 300px;
    height: 300px;
    top: -50px;
    right: -50px;
    animation: pulse 4s ease-in-out infinite;
}

.decoration-2 {
    width: 200px;
    height: 200px;
    bottom: -30px;
    left: -30px;
    animation: pulse 4s ease-in-out infinite 2s;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.1; }
    50% { transform: scale(1.1); opacity: 0.2; }
}

/* Stats Section */
.stats-section {
    padding: 60px 0;
    background: white;
}

.stat-card {
    padding: 30px 20px;
    border-radius: 15px;
    background: white;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: white;
    font-size: 1.8rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-label {
    color: #6c757d;
    margin: 0;
}

/* Features Section */
.features-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.section-badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
}

.feature-card {
    background: white;
    padding: 35px 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    height: 100%;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.feature-icon {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 20px;
}

.bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.bg-gradient-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%); }
.bg-gradient-info { background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%); }
.bg-gradient-warning { background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%); }
.bg-gradient-danger { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); }
.bg-gradient-purple { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

.feature-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.feature-text {
    color: #6c757d;
    line-height: 1.6;
    margin: 0;
}

/* How It Works */
.how-section {
    padding: 80px 0;
    background: white;
}

.step-card {
    text-align: center;
    position: relative;
    padding: 30px 20px;
}

.step-number {
    position: absolute;
    top: 0;
    right: 20px;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.step-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: #667eea;
    margin: 0 auto 20px;
    transition: all 0.3s ease;
}

.step-card:hover .step-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: scale(1.1);
}

.step-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.step-text {
    color: #6c757d;
    margin: 0;
}

/* CTA Section */
.cta-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.cta-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 50px;
    border-radius: 20px;
    color: white;
    box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.cta-text {
    font-size: 1.2rem;
    margin: 0;
    opacity: 0.9;
}

/* Footer */
.footer-section {
    background: #2c3e50;
    color: white;
    padding: 60px 0 30px;
}

.footer-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: white;
}

.footer-text {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.7;
}

.social-links {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.social-link {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #667eea;
    transform: translateY(-3px);
    color: white;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: white;
    padding-left: 5px;
}

.footer-contact {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-contact li {
    display: flex;
    align-items: start;
    gap: 10px;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 12px;
}

.footer-contact i {
    color: #667eea;
    margin-top: 3px;
}

.newsletter-form {
    display: flex;
    gap: 10px;
}

.newsletter-form .form-control {
    border-radius: 10px;
    border: none;
    padding: 12px 20px;
}

.newsletter-form .btn {
    border-radius: 10px;
    padding: 12px 20px;
}

.footer-divider {
    border-color: rgba(255, 255, 255, 0.1);
    margin: 30px 0 20px;
}

.footer-copyright {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
}

/* Responsive */
@media (max-width: 992px) {
    .hero-section {
        padding: 120px 0 80px;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .cta-title {
        font-size: 2rem;
    }

    .cta-card {
        padding: 40px 30px;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 100px 0 60px;
    }

    .hero-title {
        font-size: 2rem;
    }

    .hero-buttons {
        justify-content: center;
    }

    .hero-features {
        justify-content: center;
        gap: 15px;
    }

    .feature-item {
        font-size: 0.9rem;
    }

    .stat-number {
        font-size: 2rem;
    }

    .features-section,
    .how-section {
        padding: 60px 0;
    }
}
</style>

@endsection
