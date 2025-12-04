@extends('layouts.layoutUser')

@section('title', 'Payment')

@section('content')

<style>
    .payment-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header-payment {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .page-title-payment {
        color: white;
        font-weight: 800;
        font-size: 2rem;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-subtitle-payment {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0.5rem 0 0 0;
    }

    .payment-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .card-header-custom h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .card-body-custom {
        padding: 2rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #667eea;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .info-value {
        color: #333;
        font-weight: 600;
        font-size: 1rem;
        text-align: right;
    }

    .total-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        padding: 1.5rem;
        border-radius: 15px;
        margin-top: 1rem;
    }

    .total-label {
        color: #667eea;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .total-price {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2.5rem;
        margin: 0;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .payment-method-item {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .payment-method-item:hover {
        border-color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    .payment-method-item i {
        font-size: 2rem;
        color: #667eea;
    }

    .payment-method-item p {
        margin: 0.5rem 0 0 0;
        font-size: 0.75rem;
        color: #666;
        font-weight: 600;
    }

    .sidebar-sticky {
        position: sticky;
        top: 120px;
    }

    .status-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .status-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
    }

    .status-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .status-body {
        padding: 1.5rem;
    }

    .order-id-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        color: #667eea;
        padding: 0.8rem 1.2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        text-align: center;
        margin: 1rem 0;
    }

    .status-badge-custom {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 1rem;
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #333;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-pay {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-pay:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-pay i {
        font-size: 1.3rem;
    }

    .btn-back {
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
    }

    .btn-back:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .security-info {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
        border-left: 4px solid #28a745;
        padding: 1rem;
        border-radius: 10px;
        margin-top: 1rem;
    }

    .security-info p {
        margin: 0;
        color: #28a745;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .security-info i {
        font-size: 1.2rem;
        margin-right: 0.5rem;
    }

    .product-image-payment {
        width: 100%;
        height: 200px;
        object-fit: contain;
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
</style>

<div class="container payment-container my-5">
    <!-- Page Header -->
    <div class="page-header-payment">
        <h1 class="page-title-payment">
            <i class="bi bi-credit-card me-2"></i>Pembayaran Pesanan
        </h1>
        <p class="page-subtitle-payment">Selesaikan pembayaran untuk melanjutkan pesanan Anda</p>
    </div>
    <div class="row">
        <div class="col-md-8">
            <!-- Product Image -->
            <div class="payment-card">
                <div class="card-body-custom text-center">
                    <img src="{{ asset($order->product->image) }}" alt="{{ $order->product->name }}" class="product-image-payment">
                </div>
            </div>

            <!-- Order Details Card -->
            <div class="payment-card">
                <div class="card-header-custom">
                    <h5><i class="bi bi-receipt me-2"></i>Detail Pesanan</h5>
                </div>
                <div class="card-body-custom">
                    <div class="info-row">
                        <span class="info-label">Produk</span>
                        <span class="info-value">{{ $order->product->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jumlah</span>
                        <span class="info-value">{{ $order->quantity }} Ekor</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Harga/Unit</span>
                        <span class="info-value">Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Lokasi</span>
                        <span class="info-value">{{ $order->product->location }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kategori</span>
                        <span class="info-value">{{ $order->product->category }}</span>
                    </div>

                    <div class="total-section">
                        <div class="total-label">Total Pembayaran</div>
                        <h2 class="total-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>

            <!-- Payment Method Card -->
            <div class="payment-card">
                <div class="card-header-custom">
                    <h5><i class="bi bi-wallet2 me-2"></i>Metode Pembayaran</h5>
                </div>
                <div class="card-body-custom">
                    <p style="color: #666; font-weight: 600; margin-bottom: 1rem;">
                        Pembayaran melalui <strong style="color: #667eea;">Midtrans</strong> - Tersedia berbagai metode pembayaran:
                    </p>
                    
                    <div class="payment-methods">
                        <div class="payment-method-item">
                            <i class="bi bi-credit-card-fill"></i>
                            <p>Kartu Kredit</p>
                        </div>
                        <div class="payment-method-item">
                            <i class="bi bi-bank"></i>
                            <p>Transfer Bank</p>
                        </div>
                        <div class="payment-method-item">
                            <i class="bi bi-phone-fill"></i>
                            <p>E-Wallet</p>
                        </div>
                        <div class="payment-method-item">
                            <i class="bi bi-shop"></i>
                            <p>Indomaret</p>
                        </div>
                        <div class="payment-method-item">
                            <i class="bi bi-building"></i>
                            <p>Alfamart</p>
                        </div>
                    </div>

                    <div class="security-info">
                        <p>
                            <i class="bi bi-shield-check"></i>
                            Pembayaran Anda dijamin aman dengan enkripsi SSL dan standar keamanan PCI-DSS
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar-sticky">
                <!-- Status Card -->
                <div class="status-card">
                    <div class="status-header">
                        <h5><i class="bi bi-info-circle me-2"></i>Status Pesanan</h5>
                    </div>
                    <div class="status-body">
                        <div class="text-center">
                            <div class="status-badge-custom">
                                <i class="bi bi-clock-fill"></i>
                                {{ ucfirst($order->status) }}
                            </div>
                        </div>

                        <div class="order-id-badge">
                            <i class="bi bi-hash"></i>Order ID: {{ $order->id }}
                        </div>

                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 12px; margin: 1rem 0;">
                            <p style="margin: 0; color: #666; font-size: 0.9rem; text-align: center;">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                        <hr style="margin: 1.5rem 0;">
                        
                        @if(isset($snapToken))
                            <button id="pay-button" class="btn-pay">
                                <i class="bi bi-credit-card-2-front-fill"></i>
                                Bayar Sekarang
                            </button>
                        @endif

                        <a href="{{ route('user.history') }}" class="btn-back">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali ke Riwayat
                        </a>

                        <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 1rem; border-radius: 12px; margin-top: 1rem; border-left: 4px solid #667eea;">
                            <p style="margin: 0; color: #667eea; font-weight: 600; font-size: 0.85rem;">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Selesaikan pembayaran dalam 24 jam untuk menghindari pembatalan otomatis
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@if(isset($snapToken))
    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var payButton = document.getElementById('pay-button');
                if (!payButton) return;
                payButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            // Try to notify server about success (local fallback)
                            fetch('{{ route('user.payment.callback', $order->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(result)
                            }).then(function(){
                                window.location.href = '{{ route("user.history") }}';
                            }).catch(function(){
                                window.location.href = '{{ route("user.history") }}';
                            });
                        },
                        onPending: function(result){
                            fetch('{{ route('user.payment.callback', $order->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(result)
                            }).then(function(){
                                alert('Pembayaran pending. Mohon tunggu konfirmasi.');
                                window.location.href = '{{ route("user.history") }}';
                            }).catch(function(){
                                alert('Pembayaran pending. Mohon tunggu konfirmasi.');
                                window.location.href = '{{ route("user.history") }}';
                            });
                        },
                        onError: function(result){
                            alert('Terjadi kesalahan pada pembayaran.');
                        },
                        onClose: function(){
                            // user closed the popup without finishing
                        }
                    });
                });
            });
        </script>
    @endpush
@endif
