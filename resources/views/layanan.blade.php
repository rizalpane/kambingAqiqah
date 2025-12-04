@extends('layouts.layoutMain')

@section('title', 'Layanan - Paket Aqiqah Terlengkap')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="bi bi-award me-2"></i>Layanan Kami
                    </span>
                    
                    <h1 class="hero-title">Paket Layanan Aqiqah Lengkap</h1>
                    
                    <p class="hero-subtitle">
                        Kami menyediakan berbagai paket layanan aqiqah yang dapat disesuaikan dengan kebutuhan dan budget keluarga Anda
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4 class="service-title">Paket Hemat</h4>
                    <p class="service-description">Paket ekonomis untuk aqiqah sederhana namun tetap berkualitas dan sesuai syariat.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check2"></i> 1 Ekor Kambing (Jantan/Betina)</li>
                        <li><i class="bi bi-check2"></i> Pemotongan Sesuai Syariat</li>
                        <li><i class="bi bi-check2"></i> Sertifikat Halal</li>
                        <li><i class="bi bi-check2"></i> Gratis Pengiriman Area Jakarta</li>
                    </ul>
                    <div class="service-price">
                        <span class="price-from">Mulai dari</span>
                        <span class="price-amount">Rp 2.500.000</span>
                    </div>
                    <a href="/produk" class="btn btn-service">Lihat Produk</a>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card featured">
                    <div class="featured-badge">Paling Populer</div>
                    <div class="service-icon">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h4 class="service-title">Paket Standar</h4>
                    <p class="service-description">Paket lengkap dengan tambahan layanan olahan daging siap masak untuk kemudahan Anda.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check2"></i> 2 Ekor Kambing (Anak Laki-laki)</li>
                        <li><i class="bi bi-check2"></i> Pemotongan Sesuai Syariat</li>
                        <li><i class="bi bi-check2"></i> Sertifikat Halal</li>
                        <li><i class="bi bi-check2"></i> Gratis Pengiriman Jabodetabek</li>
                        <li><i class="bi bi-check2"></i> Dokumentasi Foto</li>
                        <li><i class="bi bi-check2"></i> Konsultasi Gratis</li>
                    </ul>
                    <div class="service-price">
                        <span class="price-from">Mulai dari</span>
                        <span class="price-amount">Rp 5.000.000</span>
                    </div>
                    <a href="/produk" class="btn btn-service">Lihat Produk</a>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi bi-gem"></i>
                    </div>
                    <h4 class="service-title">Paket Premium</h4>
                    <p class="service-description">Paket eksklusif dengan layanan terlengkap dan kambing pilihan kualitas terbaik.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check2"></i> Kambing Premium Pilihan</li>
                        <li><i class="bi bi-check2"></i> Pemotongan di Lokasi</li>
                        <li><i class="bi bi-check2"></i> Sertifikat Halal</li>
                        <li><i class="bi bi-check2"></i> Gratis Pengiriman Se-Indonesia</li>
                        <li><i class="bi bi-check2"></i> Dokumentasi Foto & Video</li>
                        <li><i class="bi bi-check2"></i> Pendampingan Ustadz</li>
                        <li><i class="bi bi-check2"></i> Paket Nasi Box (50 pax)</li>
                    </ul>
                    <div class="service-price">
                        <span class="price-from">Mulai dari</span>
                        <span class="price-amount">Rp 8.000.000</span>
                    </div>
                    <a href="/produk" class="btn btn-service">Lihat Produk</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Keunggulan Layanan</span>
            <h2 class="section-title">Mengapa Memilih Layanan Kami?</h2>
            <p class="section-subtitle">Komitmen kami untuk memberikan layanan terbaik</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-box bg-gradient-primary">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="feature-box-title">100% Halal</h5>
                    <p class="feature-box-text">Tersertifikasi halal dan dipotong sesuai syariat Islam</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-box bg-gradient-success">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5 class="feature-box-title">Tepat Waktu</h5>
                    <p class="feature-box-text">Pengiriman sesuai jadwal yang telah disepakati</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-box bg-gradient-warning">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="feature-box-title">Tim Profesional</h5>
                    <p class="feature-box-text">Ditangani oleh tim ahli dan berpengalaman</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-box bg-gradient-info">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h5 class="feature-box-title">Customer Service</h5>
                    <p class="feature-box-text">Siap melayani konsultasi 24/7</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Alur Pemesanan</span>
            <h2 class="section-title">Cara Pesan Layanan Kami</h2>
            <p class="section-subtitle">Proses pemesanan yang mudah dan praktis</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">01</div>
                    <div class="process-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h5 class="process-title">Registrasi</h5>
                    <p class="process-text">Daftar akun atau login jika sudah punya akun</p>
                </div>
                <div class="process-line"></div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">02</div>
                    <div class="process-icon">
                        <i class="bi bi-basket-fill"></i>
                    </div>
                    <h5 class="process-title">Pilih Paket</h5>
                    <p class="process-text">Pilih kambing dan paket yang sesuai kebutuhan</p>
                </div>
                <div class="process-line"></div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">03</div>
                    <div class="process-icon">
                        <i class="bi bi-credit-card-fill"></i>
                    </div>
                    <h5 class="process-title">Pembayaran</h5>
                    <p class="process-text">Lakukan pembayaran dengan berbagai metode</p>
                </div>
                <div class="process-line"></div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">04</div>
                    <div class="process-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5 class="process-title">Pengiriman</h5>
                    <p class="process-text">Pesanan diproses dan dikirim ke alamat Anda</p>
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
                    <h2 class="cta-title">Siap Memesan Layanan Aqiqah?</h2>
                    <p class="cta-text">Daftar sekarang dan dapatkan penawaran terbaik untuk keluarga Anda</p>
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

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 120px 0 80px;
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
    margin-bottom: 20px;
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.95;
    max-width: 700px;
    margin: 0 auto;
}

/* Services Section */
.services-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.service-card {
    background: white;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.service-card.featured {
    border: 3px solid #667eea;
    transform: scale(1.05);
}

.service-card.featured:hover {
    transform: scale(1.05) translateY(-10px);
}

.featured-badge {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
}

.service-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    color: white;
    font-size: 2.5rem;
}

.service-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 15px;
}

.service-description {
    color: #6c757d;
    text-align: center;
    margin-bottom: 25px;
    line-height: 1.6;
}

.service-features {
    list-style: none;
    padding: 0;
    margin-bottom: 25px;
    flex: 1;
}

.service-features li {
    padding: 10px 0;
    color: #2c3e50;
    display: flex;
    align-items: start;
    gap: 10px;
}

.service-features i {
    color: #667eea;
    font-size: 1.2rem;
    margin-top: 2px;
}

.service-price {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 25px;
}

.price-from {
    display: block;
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.price-amount {
    display: block;
    color: #667eea;
    font-size: 1.8rem;
    font-weight: 700;
}

.btn-service {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-service:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    color: white;
}

/* Features Section */
.features-section {
    padding: 80px 0;
    background: white;
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

.feature-box {
    text-align: center;
    padding: 30px 20px;
}

.feature-icon-box {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2.5rem;
    color: white;
}

.bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.bg-gradient-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%); }
.bg-gradient-warning { background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%); }
.bg-gradient-info { background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%); }

.feature-box-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.feature-box-text {
    color: #6c757d;
    margin: 0;
}

/* Process Section */
.process-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.process-card {
    text-align: center;
    position: relative;
}

.process-number {
    font-size: 3rem;
    font-weight: 800;
    color: rgba(102, 126, 234, 0.1);
    margin-bottom: -20px;
}

.process-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 3rem;
    color: white;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.process-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.process-text {
    color: #6c757d;
    margin: 0;
}

.process-line {
    position: absolute;
    top: 50px;
    left: 100%;
    width: calc(100% - 100px);
    height: 3px;
    background: linear-gradient(90deg, #667eea 0%, rgba(102, 126, 234, 0.2) 100%);
    margin-left: 20px;
}

.col-lg-3:last-child .process-line {
    display: none;
}

/* CTA Section */
.cta-section {
    padding: 80px 0;
    background: white;
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

/* Responsive */
@media (max-width: 992px) {
    .process-line {
        display: none;
    }

    .service-card.featured {
        transform: scale(1);
    }

    .service-card.featured:hover {
        transform: scale(1) translateY(-10px);
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .cta-title {
        font-size: 1.8rem;
    }

    .cta-card {
        padding: 40px 30px;
    }
}
</style>

@endsection
