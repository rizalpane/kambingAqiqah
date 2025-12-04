@extends('layouts.layoutMain')

@section('title', 'Produk - Pilihan Kambing Aqiqah Berkualitas')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="bi bi-basket me-2"></i>Produk Kami
                    </span>
                    
                    <h1 class="hero-title">Pilihan Kambing Aqiqah Terbaik</h1>
                    
                    <p class="hero-subtitle">
                        Tersedia berbagai pilihan kambing jantan dan betina dengan kualitas premium untuk memenuhi kebutuhan aqiqah keluarga Anda
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="filter-card">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2 justify-content-md-end">
                                <input type="radio" class="btn-check" name="category" id="all" value="all" checked>
                                <label class="btn btn-outline-primary" for="all">
                                    <i class="bi bi-grid me-1"></i>Semua
                                </label>

                                <input type="radio" class="btn-check" name="category" id="jantan" value="jantan">
                                <label class="btn btn-outline-primary" for="jantan">
                                    <i class="bi bi-gender-male me-1"></i>Jantan
                                </label>

                                <input type="radio" class="btn-check" name="category" id="betina" value="betina">
                                <label class="btn btn-outline-primary" for="betina">
                                    <i class="bi bi-gender-female me-1"></i>Betina
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products-section">
    <div class="container">
        @if($products->count() > 0)
            <div class="row g-4" id="productsGrid">
                @foreach($products as $product)
                <div class="col-lg-4 col-md-6 product-item" data-name="{{ strtolower($product->name) }}" data-category="{{ strtolower($product->jenis_kelamin) }}">
                    <div class="product-card">
                        <div class="product-image">
                            <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            <span class="product-badge badge-{{ strtolower($product->jenis_kelamin) }}">
                                <i class="bi bi-gender-{{ $product->jenis_kelamin == 'jantan' ? 'male' : 'female' }}"></i>
                                {{ ucfirst($product->jenis_kelamin) }}
                            </span>
                            @if($product->stock < 5 && $product->stock > 0)
                                <span class="stock-badge badge-warning">Stok Terbatas</span>
                            @elseif($product->stock == 0)
                                <span class="stock-badge badge-danger">Habis</span>
                            @endif
                        </div>
                        
                        <div class="product-body">
                            <h5 class="product-name">{{ $product->name }}</h5>
                            <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                            
                            <div class="product-meta">
                                <div class="meta-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $product->location }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-box-seam"></i>
                                    <span>Stok: {{ $product->stock }}</span>
                                </div>
                            </div>
                            
                            <div class="product-price">
                                <span class="price-label">Harga:</span>
                                <span class="price-value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="product-footer">
                            <button class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                                <i class="bi bi-info-circle me-2"></i>Detail
                            </button>
                            @auth
                                @if($product->stock > 0)
                                    <a href="/user/checkout/{{ $product->id }}" class="btn btn-primary">
                                        <i class="bi bi-cart-plus me-2"></i>Beli
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        <i class="bi bi-x-circle me-2"></i>Habis
                                    </button>
                                @endif
                            @else
                                <a href="/login" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Product Detail Modal -->
                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-3">
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th width="40%">Nama</th>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>
                                                <span class="badge bg-{{ $product->jenis_kelamin == 'jantan' ? 'primary' : 'danger' }}">
                                                    {{ ucfirst($product->jenis_kelamin) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $product->location }}</td>
                                        </tr>
                                        <tr>
                                            <th>Stok</th>
                                            <td>{{ $product->stock }}</td>
                                        </tr>
                                        <tr>
                                            <th>Harga</th>
                                            <td class="text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td>{{ $product->description }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                @auth
                                    @if($product->stock > 0)
                                        <a href="/user/checkout/{{ $product->id }}" class="btn btn-primary">
                                            <i class="bi bi-cart-plus me-2"></i>Beli Sekarang
                                        </a>
                                    @endif
                                @else
                                    <a href="/login" class="btn btn-primary">Login untuk Membeli</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div id="noResults" class="text-center py-5" style="display: none;">
                <i class="bi bi-search fs-1 text-muted"></i>
                <h4 class="mt-3">Produk Tidak Ditemukan</h4>
                <p class="text-muted">Coba kata kunci atau filter lainnya</p>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <h4 class="mt-3">Belum Ada Produk</h4>
                <p class="text-muted">Produk akan segera tersedia</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0 text-center text-lg-start">
                    <h2 class="cta-title">Butuh Bantuan Memilih?</h2>
                    <p class="cta-text">Konsultasikan kebutuhan aqiqah Anda dengan tim kami</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="/kontak" class="btn btn-light btn-lg px-5">
                        <i class="bi bi-telephone me-2"></i>Hubungi Kami
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

/* Filter Section */
.filter-section {
    padding: 40px 0;
    background: white;
    margin-top: -40px;
    position: relative;
    z-index: 10;
}

.filter-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.input-group-text {
    border: 1px solid #e9ecef;
    border-right: 0;
}

.input-group .form-control {
    border-left: 0;
}

.input-group .form-control:focus {
    box-shadow: none;
    border-color: #e9ecef;
}

.btn-outline-primary {
    border-color: #667eea;
    color: #667eea;
}

.btn-outline-primary:hover,
.btn-check:checked + .btn-outline-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
}

/* Products Section */
.products-section {
    padding: 60px 0 80px;
    background: #f8f9fa;
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.product-image {
    position: relative;
    height: 250px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.product-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 8px 15px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 5px;
}

.badge-jantan {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.badge-betina {
    background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
}

.stock-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 8px 15px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    color: white;
}

.badge-warning {
    background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
}

.badge-danger {
    background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
}

.product-body {
    padding: 20px;
    flex: 1;
}

.product-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.product-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 15px;
    line-height: 1.6;
}

.product-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
    font-size: 0.9rem;
}

.meta-item i {
    color: #667eea;
    font-size: 1rem;
}

.product-price {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 15px;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price-label {
    color: rgba(255,255,255,0.9);
    font-size: 0.9rem;
}

.price-value {
    color: white;
    font-size: 1.3rem;
    font-weight: 700;
}

.product-footer {
    padding: 20px;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 10px;
}

.btn-detail {
    flex: 1;
    background: white;
    border: 2px solid #667eea;
    color: #667eea;
    padding: 10px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: #667eea;
    color: white;
}

.product-footer .btn-primary {
    flex: 1;
    padding: 10px;
    border-radius: 10px;
    font-weight: 600;
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
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .filter-card {
        padding: 20px;
    }

    .cta-title {
        font-size: 1.8rem;
    }

    .cta-card {
        padding: 40px 30px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryRadios = document.querySelectorAll('input[name="category"]');
    const productItems = document.querySelectorAll('.product-item');
    const noResults = document.getElementById('noResults');

    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = document.querySelector('input[name="category"]:checked').value;
        let visibleCount = 0;

        productItems.forEach(item => {
            const name = item.getAttribute('data-name');
            const category = item.getAttribute('data-category');
            
            const matchesSearch = name.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

            if (matchesSearch && matchesCategory) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', filterProducts);
    categoryRadios.forEach(radio => {
        radio.addEventListener('change', filterProducts);
    });
});
</script>

@endsection
