@extends('layouts.layoutUser')

@section('title', 'Dashboard - Produk Aqiqah')

@section('content')

<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h1 class="display-4 fw-bold mb-3">
                                    <i class="bi bi-shop me-3"></i>Produk Aqiqah Kami
                                </h1>
                            </div>
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-none d-lg-block">
                                @csrf
                                <button type="submit" class="btn-logout-hero">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                        <p class="lead mb-4">
                            Pilih paket aqiqah terbaik untuk buah hati Anda. Kami menyediakan kambing berkualitas dengan pelayanan terpercaya.
                        </p>
                        <div class="d-flex gap-3 flex-wrap align-items-center">
                            <div class="stat-card">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>100% Halal</span>
                            </div>
                            <div class="stat-card">
                                <i class="bi bi-truck text-primary"></i>
                                <span>Gratis Antar</span>
                            </div>
                            <div class="stat-card">
                                <i class="bi bi-star-fill text-warning"></i>
                                <span>Terpercaya</span>
                            </div>
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-lg-none">
                                @csrf
                                <button type="submit" class="btn-logout-hero">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center">
                    <img src="{{ asset('images/goat.png') }}" alt="Kambing Aqiqah" class="hero-image">
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-section">
        <div class="container">
            
            <!-- Filter & Search Bar -->
            <div class="filter-bar mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="searchProduct" placeholder="Cari produk...">
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="category" id="all" checked>
                            <label class="btn btn-outline-primary" for="all">Semua</label>
                            
                            <input type="radio" class="btn-check" name="category" id="jantan">
                            <label class="btn btn-outline-primary" for="jantan">Jantan</label>
                            
                            <input type="radio" class="btn-check" name="category" id="betina">
                            <label class="btn btn-outline-primary" for="betina">Betina</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-4" id="productsContainer">
                @forelse ($products as $product)
                    <div class="col product-item" data-category="{{ strtolower($product->category) }}" data-name="{{ strtolower($product->name) }}">
                        <div class="product-card h-100">
                            
                            <!-- Product Image -->
                            <div class="product-image-wrapper">
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" class="product-image" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/goat.png') }}" class="product-image" alt="default">
                                @endif
                                
                                <!-- Category Badge -->
                                <span class="category-badge badge-{{ strtolower($product->category) }}">
                                    <i class="bi bi-tag-fill me-1"></i>{{ $product->category }}
                                </span>

                                <!-- Stock Badge -->
                                @if($product->stock > 0)
                                    <span class="stock-badge bg-success">
                                        <i class="bi bi-check-circle-fill me-1"></i>Tersedia
                                    </span>
                                @else
                                    <span class="stock-badge bg-danger">
                                        <i class="bi bi-x-circle-fill me-1"></i>Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="product-body">
                                <h5 class="product-title">{{ $product->name }}</h5>
                                
                                <div class="product-price">
                                    <span class="price-label">Harga:</span>
                                    <span class="price-value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>

                                <div class="product-meta">
                                    <div class="meta-item">
                                        <i class="bi bi-geo-alt-fill text-danger"></i>
                                        <span>{{ $product->location }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-box-seam text-primary"></i>
                                        <span>Stok: <strong>{{ $product->stock }}</strong> Ekor</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="product-actions">
                                    @if($product->stock > 0)
                                        <a href="{{ route('user.checkout', $product->id) }}" class="btn btn-primary btn-buy">
                                            <i class="bi bi-cart-plus me-2"></i>Beli Sekarang
                                        </a>
                                        <button class="btn btn-outline-primary btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $product->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-secondary" disabled>
                                            <i class="bi bi-x-circle me-2"></i>Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal{{ $product->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="bi bi-info-circle me-2"></i>Detail Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-3">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}" style="max-height: 250px;">
                                        @else
                                            <img src="{{ asset('images/goat.png') }}" class="img-fluid rounded" alt="default" style="max-height: 250px;">
                                        @endif
                                    </div>
                                    <h4 class="mb-3">{{ $product->name }}</h4>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><i class="bi bi-tag me-2"></i>Kategori</td>
                                            <td><strong>{{ $product->category }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><i class="bi bi-cash me-2"></i>Harga</td>
                                            <td><strong class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><i class="bi bi-geo-alt me-2"></i>Lokasi</td>
                                            <td>{{ $product->location }}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="bi bi-box-seam me-2"></i>Stok</td>
                                            <td>{{ $product->stock }} Ekor</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    @if($product->stock > 0)
                                        <a href="{{ route('user.checkout', $product->id) }}" class="btn btn-primary">
                                            <i class="bi bi-cart-plus me-2"></i>Beli Sekarang
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                            <h4>Belum Ada Produk</h4>
                            <p class="text-muted">Produk belum tersedia saat ini. Silakan kembali lagi nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- No Results Message -->
            <div class="no-results text-center py-5" style="display: none;">
                <i class="bi bi-search display-1 text-muted mb-3"></i>
                <h4>Tidak Ada Produk Ditemukan</h4>
                <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Container */
.dashboard-container {
    background: #f8f9fa;
    min-height: 100vh;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0 60px;
    margin-top: 70px;
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
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
    opacity: 0.5;
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-content h1 {
    text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    font-weight: 800;
    animation: fadeInUp 0.8s ease;
}

.hero-content .lead {
    text-shadow: 1px 1px 4px rgba(0,0,0,0.1);
    animation: fadeInUp 1s ease;
}

.btn-logout-hero {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-logout-hero:hover {
    background: rgba(220, 53, 69, 0.9);
    border-color: #dc3545;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
}

.btn-logout-hero i {
    font-size: 1.1rem;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-image {
    max-width: 100%;
    height: auto;
    filter: drop-shadow(0 15px 40px rgba(0,0,0,0.3));
    animation: float 3s ease-in-out infinite;
    position: relative;
    z-index: 1;
}

@keyframes float {
    0%, 100% { 
        transform: translateY(0) rotate(-5deg); 
    }
    50% { 
        transform: translateY(-20px) rotate(5deg); 
    }
}

.stat-card {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(15px);
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.95rem;
    border: 2px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
    animation: fadeInUp 1.2s ease;
}

.stat-card:hover {
    background: rgba(255,255,255,0.35);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.stat-card i {
    font-size: 22px;
}

/* Products Section */
.products-section {
    padding: 60px 0;
    background: #f8f9fa;
    position: relative;
}

.filter-bar {
    background: white;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    border: 1px solid rgba(102, 126, 234, 0.1);
    margin-bottom: 2rem;
}

.input-group-lg .input-group-text {
    border-right: none;
    background: white;
    border-color: #e0e0e0;
    border-radius: 15px 0 0 15px;
}

.input-group-lg .form-control {
    border-left: none;
    border-color: #e0e0e0;
    border-radius: 0 15px 15px 0;
    font-size: 1rem;
}

.input-group-lg .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
}

.input-group-lg .input-group-text {
    padding: 0.8rem 1.2rem;
}

.btn-group label {
    font-weight: 600;
    padding: 0.7rem 1.5rem;
    border-radius: 12px !important;
    transition: all 0.3s ease;
    border: 2px solid #667eea;
    color: #667eea;
}

.btn-check:checked + label {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-color: #667eea !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-group label:hover {
    background: rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

/* Product Card */
.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    flex-direction: column;
    border: 2px solid transparent;
}

.product-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
    border-color: #667eea;
}

.product-image-wrapper {
    position: relative;
    height: 240px;
    overflow: hidden;
    background: linear-gradient(135deg, #f5f7fa 0%, #e8ebf0 100%);
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.5s ease;
    padding: 1rem;
}

.product-card:hover .product-image {
    transform: scale(1.15) rotate(2deg);
}

.category-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    backdrop-filter: blur(10px);
}

.badge-jantan {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.badge-betina {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.stock-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 700;
    color: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    gap: 5px;
}

.product-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    background: white;
}

.product-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 18px;
    min-height: 50px;
    line-height: 1.4;
}

.product-price {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
    padding: 18px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 15px;
    border-left: 4px solid #667eea;
}

.price-label {
    font-size: 0.7rem;
    color: #667eea;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.price-value {
    font-size: 1.6rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.product-meta {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 12px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
    color: #495057;
    font-weight: 600;
}

.meta-item i {
    font-size: 18px;
}

.product-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
}

.btn-buy {
    flex: 1;
    font-weight: 700;
    padding: 14px;
    border-radius: 12px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.btn-buy:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.btn-detail {
    width: 50px;
    padding: 14px;
    border-radius: 12px;
    border: 2px solid #667eea;
    color: #667eea;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: #667eea;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

/* Modal Styling */
.modal-content {
    border-radius: 20px;
    border: none;
    overflow: hidden;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1.5rem;
}

.modal-header .modal-title {
    font-weight: 700;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.modal-body {
    padding: 2rem;
}

.modal-body .table td {
    padding: 0.8rem 0.5rem;
    font-size: 0.95rem;
}

.modal-body .table td:first-child {
    color: #667eea;
    font-weight: 700;
}

.modal-footer {
    border: none;
    padding: 1rem 2rem 2rem;
    background: #f8f9fa;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 100px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
}

.empty-state i {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.no-results {
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
}

.no-results i {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0 40px;
        margin-top: 60px;
    }

    .hero-content h1 {
        font-size: 2rem;
    }

    .stat-card {
        font-size: 0.85rem;
        padding: 10px 18px;
    }

    .filter-bar {
        padding: 20px;
    }

    .filter-bar .btn-group {
        width: 100%;
        display: flex;
    }

    .filter-bar .btn-group label {
        flex: 1;
        padding: 0.6rem 0.8rem;
        font-size: 0.85rem;
    }

    .product-card {
        margin-bottom: 1rem;
    }
}

@media (max-width: 576px) {
    .product-price {
        padding: 15px;
    }
    
    .price-value {
        font-size: 1.4rem;
    }
    
    .product-actions {
        flex-direction: column;
    }
    
    .btn-detail {
        width: 100%;
    }
}
</style>

@push('scripts')
<script>
// Search functionality
document.getElementById('searchProduct')?.addEventListener('input', function(e) {
    filterProducts();
});

// Category filter
document.querySelectorAll('input[name="category"]').forEach(radio => {
    radio.addEventListener('change', function() {
        filterProducts();
    });
});

function filterProducts() {
    const searchTerm = document.getElementById('searchProduct').value.toLowerCase();
    const selectedCategory = document.querySelector('input[name="category"]:checked').id;
    const products = document.querySelectorAll('.product-item');
    let visibleCount = 0;

    products.forEach(product => {
        const name = product.dataset.name;
        const category = product.dataset.category.toLowerCase(); // Convert to lowercase for comparison
        
        const matchesSearch = name.includes(searchTerm);
        const matchesCategory = selectedCategory === 'all' || category === selectedCategory.toLowerCase();

        if (matchesSearch && matchesCategory) {
            product.style.display = '';
            visibleCount++;
        } else {
            product.style.display = 'none';
        }
    });

    // Show/hide no results message
    const noResults = document.querySelector('.no-results');
    if (visibleCount === 0 && products.length > 0) {
        noResults.style.display = 'block';
    } else {
        noResults.style.display = 'none';
    }
}
</script>
@endpush

@endsection