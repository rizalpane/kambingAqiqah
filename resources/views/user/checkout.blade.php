@extends('layouts.layoutUser')

@section('title', 'Checkout')

@section('content')

<style>
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header-checkout {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .page-title-checkout {
        color: white;
        font-weight: 800;
        font-size: 2rem;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-subtitle-checkout {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0.5rem 0 0 0;
    }

    .checkout-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header-checkout {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .card-header-checkout h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .card-body-checkout {
        padding: 2rem;
    }

    .product-image-checkout {
        width: 100%;
        height: 350px;
        object-fit: contain;
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 2px solid #e0e0e0;
    }

    .product-title-checkout {
        color: #333;
        font-weight: 800;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .product-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding: 0.8rem 1rem;
        background: #f8f9fa;
        border-radius: 12px;
        border-left: 4px solid #667eea;
    }

    .product-location i {
        color: #667eea;
        font-size: 1.2rem;
    }

    .info-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.2rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-radius: 12px;
        margin-bottom: 1rem;
        border-left: 4px solid #667eea;
    }

    .info-label {
        color: #667eea;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .info-value {
        color: #333;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .product-description {
        color: #666;
        line-height: 1.7;
        padding: 1.2rem;
        background: #f8f9fa;
        border-radius: 12px;
        font-size: 0.95rem;
    }

    .form-group-checkout {
        margin-bottom: 1.5rem;
    }

    .form-label-checkout {
        color: #667eea;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label-checkout i {
        font-size: 1.2rem;
    }

    .form-control-checkout {
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 1rem 1.2rem;
        font-size: 1.1rem;
        font-weight: 700;
        transition: all 0.3s ease;
        background: #f8f9fa;
        text-align: center;
    }

    .form-control-checkout:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        outline: none;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-quantity {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-quantity:hover {
        background: #667eea;
        color: white;
        transform: scale(1.1);
    }

    .btn-quantity:active {
        transform: scale(0.95);
    }

    .quantity-input {
        flex: 1;
    }

    .total-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px;
        margin: 2rem 0;
        text-align: center;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .total-label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .total-price {
        color: white;
        font-weight: 900;
        font-size: 3rem;
        margin: 0;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        line-height: 1;
    }

    .btn-checkout {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1.2rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-checkout i {
        font-size: 1.5rem;
    }

    .btn-cancel {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
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

    .btn-cancel:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .stock-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.8rem;
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
        border-radius: 10px;
        margin-top: 1rem;
        border-left: 4px solid #28a745;
    }

    .stock-info i {
        color: #28a745;
        font-size: 1.2rem;
    }

    .stock-info span {
        color: #28a745;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .category-badge-checkout {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .badge-jantan-checkout {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-betina-checkout {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    @media (max-width: 768px) {
        .page-title-checkout {
            font-size: 1.5rem;
        }

        .product-title-checkout {
            font-size: 1.4rem;
        }

        .total-price {
            font-size: 2rem;
        }

        .product-image-checkout {
            height: 250px;
        }

        .btn-checkout,
        .btn-cancel {
            font-size: 1rem;
        }
    }
</style>

<div class="container checkout-container my-5">
    <!-- Page Header -->
    <div class="page-header-checkout">
        <h1 class="page-title-checkout">
            <i class="bi bi-cart-check me-2"></i>Checkout
        </h1>
        <p class="page-subtitle-checkout">Tinjau pesanan Anda dan lanjutkan ke pembayaran</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row g-4">
                <!-- Product Details Column -->
                <div class="col-md-6">
                    <div class="checkout-card">
                        <div class="card-header-checkout">
                            <h5><i class="bi bi-box-seam me-2"></i>Detail Produk</h5>
                        </div>
                        <div class="card-body-checkout">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image-checkout">
                            @else
                                <img src="{{ asset('images/goat.png') }}" alt="Default" class="product-image-checkout">
                            @endif

                            <span class="category-badge-checkout badge-{{ strtolower($product->category) }}-checkout">
                                <i class="bi bi-tag-fill"></i>
                                {{ $product->category }}
                            </span>

                            <h2 class="product-title-checkout">{{ $product->name }}</h2>

                            <div class="product-location">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $product->location }}</span>
                            </div>

                            <div class="info-box">
                                <span class="info-label">
                                    <i class="bi bi-cash"></i> Harga per Unit
                                </span>
                                <span class="info-value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="info-box">
                                <span class="info-label">
                                    <i class="bi bi-box-seam"></i> Stok Tersedia
                                </span>
                                <span class="info-value">{{ $product->stock }} Ekor</span>
                            </div>

                            @if($product->description)
                                <div class="mt-3">
                                    <label class="form-label-checkout">
                                        <i class="bi bi-info-circle"></i>
                                        Deskripsi
                                    </label>
                                    <div class="product-description">
                                        {{ $product->description }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Form Column -->
                <div class="col-md-6">
                    <div class="checkout-card">
                        <div class="card-header-checkout">
                            <h5><i class="bi bi-clipboard-check me-2"></i>Form Pemesanan</h5>
                        </div>
                        <div class="card-body-checkout">
                            <form action="{{ route('user.checkout.store') }}" method="POST" id="checkoutForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="form-group-checkout">
                                    <label for="quantity" class="form-label-checkout">
                                        <i class="bi bi-123"></i>
                                        Jumlah Kambing (Ekor)
                                    </label>
                                    <div class="quantity-controls">
                                        <button type="button" class="btn-quantity" id="decreaseQty">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" 
                                               id="quantity" 
                                               name="quantity" 
                                               class="form-control form-control-checkout quantity-input" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $product->stock }}" 
                                               required>
                                        <button type="button" class="btn-quantity" id="increaseQty">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    <div class="stock-info">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Maksimal {{ $product->stock }} ekor tersedia</span>
                                    </div>
                                </div>

                                <div class="total-section">
                                    <div class="total-label">Total Pembayaran</div>
                                    <h2 id="totalPrice" class="total-price">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                                </div>

                                <button type="submit" class="btn-checkout">
                                    <i class="bi bi-credit-card-2-front-fill"></i>
                                    Lanjutkan ke Pembayaran
                                </button>
                                <a href="{{ route('user.dashboard') }}" class="btn-cancel">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Kembali ke Dashboard
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    (function(){
        var price = {{ (int) $product->price }};
        var maxStock = {{ (int) $product->stock }};
        var qtyInput = document.getElementById('quantity');
        var totalEl = document.getElementById('totalPrice');
        var decreaseBtn = document.getElementById('decreaseQty');
        var increaseBtn = document.getElementById('increaseQty');

        function formatRupiah(n) {
            return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function updateTotal(){
            var q = parseInt(qtyInput.value) || 1;
            if (q < 1) q = 1;
            if (q > maxStock) q = maxStock;
            qtyInput.value = q;
            totalEl.textContent = formatRupiah(price * q);
            
            // Update button states
            decreaseBtn.disabled = q <= 1;
            increaseBtn.disabled = q >= maxStock;
        }

        // Decrease quantity
        decreaseBtn.addEventListener('click', function() {
            var currentQty = parseInt(qtyInput.value) || 1;
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                updateTotal();
            }
        });

        // Increase quantity
        increaseBtn.addEventListener('click', function() {
            var currentQty = parseInt(qtyInput.value) || 1;
            if (currentQty < maxStock) {
                qtyInput.value = currentQty + 1;
                updateTotal();
            }
        });

        // Input change
        qtyInput.addEventListener('input', updateTotal);
        
        // Initialize
        document.addEventListener('DOMContentLoaded', updateTotal);
    })();
</script>
@endpush
