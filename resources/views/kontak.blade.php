@extends('layouts.layoutMain')

@section('title', 'Kontak - Hubungi Kami')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="bi bi-telephone me-2"></i>Hubungi Kami
                    </span>
                    
                    <h1 class="hero-title">Kami Siap Membantu Anda</h1>
                    
                    <p class="hero-subtitle">
                        Punya pertanyaan tentang layanan aqiqah kami? Tim customer service kami siap membantu Anda 24/7
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="contact-info-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5 class="info-title">Alamat Peternakan</h5>
                    <p class="info-text">Jl sederhana No.26 <br> Kec. Percut Sei Tuan <br>Sumatera Utara</p>
                    <a href="https://maps.app.goo.gl/PqbzHBzGsgvzF2rh8" target="_blank" class="info-link">
                        <i class="bi bi-arrow-right"></i> Lihat di Maps
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h5 class="info-title">Telepon</h5>
                    <p class="info-text">
                        <strong>Kantor:</strong> (021) 1234-5678<br>
                        <strong>WhatsApp:</strong> +62 812-3456-7890<br>
                        <strong>Hotline:</strong> +62 811-2233-4455
                    </p>
                    <a href="tel:+6281234567890" class="info-link">
                        <i class="bi bi-arrow-right"></i> Hubungi Sekarang
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h5 class="info-title">Email</h5>
                    <p class="info-text">
                        <strong>Umum:</strong> info@sikambing.com<br>
                        <strong>Support:</strong> support@sikambing.com<br>
                        <strong>Sales:</strong> sales@sikambing.com
                    </p>
                    <a href="mailto:info@sikambing.com" class="info-link">
                        <i class="bi bi-arrow-right"></i> Kirim Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="contact-content">
                    <span class="section-badge">Formulir Kontak</span>
                    <h2 class="section-title">Kirim Pesan Kepada Kami</h2>
                    <p class="section-subtitle">Isi formulir di bawah ini dan kami akan segera menghubungi Anda kembali dalam waktu 24 jam.</p>
                    
                    <div class="contact-features">
                        <div class="feature-item">
                            <div class="feature-icon-small">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <h6>Jam Operasional</h6>
                                <p>Senin - Jumat: 08.00 - 17.00 WIB<br>Sabtu - Minggu: 08.00 - 14.00 WIB</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-small">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <div>
                                <h6>Fast Response</h6>
                                <p>Kami berkomitmen merespon setiap pertanyaan dengan cepat dan profesional</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-small">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <h6>Privasi Terjamin</h6>
                                <p>Data pribadi Anda aman dan tidak akan dibagikan kepada pihak ketiga</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-card">
                    <form id="contactForm">
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-person me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" required placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" name="email" required placeholder="nama@email.com">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-telephone me-2"></i>Nomor Telepon <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control" name="phone" required placeholder="08123456789">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-tag me-2"></i>Subjek <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="subject" required>
                                <option value="">Pilih Subjek</option>
                                <option value="Informasi Produk">Informasi Produk</option>
                                <option value="Konsultasi Aqiqah">Konsultasi Aqiqah</option>
                                <option value="Keluhan">Keluhan</option>
                                <option value="Kerjasama">Kerjasama</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-chat-left-text me-2"></i>Pesan <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="message" rows="5" required placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-submit w-100">
                            <i class="bi bi-send me-2"></i>Kirim Pesan
                        </button>

                        <div class="alert alert-success mt-3" id="successMessage" style="display: none;">
                            <i class="bi bi-check-circle me-2"></i>Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="social-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Media Sosial</span>
            <h2 class="section-title">Ikuti Kami</h2>
            <p class="section-subtitle">Dapatkan update terbaru dan promo menarik di media sosial kami</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <a href="https://facebook.com" target="_blank" class="social-card">
                    <div class="social-icon facebook">
                        <i class="bi bi-facebook"></i>
                    </div>
                    <h5 class="social-name">Facebook</h5>
                    <p class="social-handle">@SiKambingAqiqah</p>
                    <span class="social-link">Kunjungi <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="https://instagram.com" target="_blank" class="social-card">
                    <div class="social-icon instagram">
                        <i class="bi bi-instagram"></i>
                    </div>
                    <h5 class="social-name">Instagram</h5>
                    <p class="social-handle">@sikambing.id</p>
                    <span class="social-link">Kunjungi <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="https://wa.me/6281234567890" target="_blank" class="social-card">
                    <div class="social-icon whatsapp">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h5 class="social-name">WhatsApp</h5>
                    <p class="social-handle">+62 812-3456-7890</p>
                    <span class="social-link">Chat <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="https://twitter.com" target="_blank" class="social-card">
                    <div class="social-icon twitter">
                        <i class="bi bi-twitter"></i>
                    </div>
                    <h5 class="social-name">Twitter</h5>
                    <p class="social-handle">@SiKambing</p>
                    <span class="social-link">Kunjungi <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="map-card">
            <div class="map-header">
                <h4><i class="bi bi-map me-2"></i>Lokasi Kami</h4>
                <p>Kunjungi kantor kami untuk konsultasi langsung</p>
            </div>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15927.990516039974!2d98.78466743246561!3d3.588017966507489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303136fa44b9cb71%3A0x5fd43abd6f3cdc34!2sJl.%20Sederhana%20ujung.%20Gang%20bakung%20No.26%2C%20Telaga%20Sari%2C%20Kec.%20Tj.%20Morawa%2C%20Kabupaten%20Deli%20Serdang%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1764879820637!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
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

/* Contact Info Section */
.contact-info-section {
    padding: 80px 0;
    background: #f8f9fa;
    margin-top: -40px;
    position: relative;
    z-index: 10;
}

.info-card {
    background: white;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    text-align: center;
}

.info-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.info-icon {
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

.info-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.info-text {
    color: #6c757d;
    line-height: 1.8;
    margin-bottom: 20px;
}

.info-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
}

.info-link:hover {
    color: #764ba2;
    gap: 10px;
}

/* Contact Form Section */
.contact-form-section {
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
    margin-bottom: 15px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 30px;
}

.contact-features {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.feature-item {
    display: flex;
    gap: 20px;
}

.feature-icon-small {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.feature-item h6 {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.feature-item p {
    color: #6c757d;
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.6;
}

.form-card {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.form-control,
.form-select {
    padding: 12px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
}

.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

/* Social Section */
.social-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.social-card {
    display: block;
    background: white;
    padding: 35px 25px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.social-icon {
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

.social-icon.facebook { background: linear-gradient(135deg, #3b5998 0%, #2d4373 100%); }
.social-icon.instagram { background: linear-gradient(135deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
.social-icon.whatsapp { background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); }
.social-icon.twitter { background: linear-gradient(135deg, #1da1f2 0%, #0d8bd9 100%); }

.social-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.social-handle {
    color: #6c757d;
    margin-bottom: 15px;
}

.social-link {
    color: #667eea;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Map Section */
.map-section {
    padding: 80px 0;
    background: white;
}

.map-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.map-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    text-align: center;
}

.map-header h4 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.map-header p {
    margin: 0;
    opacity: 0.9;
}

.map-container {
    height: 450px;
}

/* Responsive */
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

    .form-card {
        padding: 25px;
    }

    .contact-content {
        margin-bottom: 40px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulasi pengiriman form
        setTimeout(() => {
            successMessage.style.display = 'block';
            form.reset();
            
            // Sembunyikan pesan sukses setelah 5 detik
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }, 500);
    });
});
</script>

@endsection
