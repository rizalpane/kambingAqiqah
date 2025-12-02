@extends('layouts.layoutUser')

@section('title', 'Checkout')

@section('content')

<div class="container card my-5 p-5">
    <h3 class="display-6 mb-4">Checkout Produk</h3>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Validasi Gagal!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Detail Produk</h5>
                    <hr>
                    
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/goat.png') }}" alt="default" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                    @endif

                    <p><strong>{{ $product->name }}</strong></p>
                    <p class="text-muted">Lokasi: {{ $product->location }}</p>
                    <p class="text-muted">Stok Tersedia: <span class="badge bg-info">{{ $product->stock }} Ekor</span></p>
                    
                    @if ($product->description)
                        <hr>
                        <p><strong>Deskripsi:</strong></p>
                        <p>{{ $product->description }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Checkout</h5>
                    <hr>

                    <form action="{{ route('user.checkout.store') }}" method="POST">
                        @csrf
                        
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah (Ekor) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" min="1" max="{{ $product->stock }}" 
                                   value="{{ old('quantity', 1) }}" required>
                            @error('quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong>Harga/Unit:</strong><br>
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <p class="mb-0">
                                    <strong>Total Harga:</strong><br>
                                    <span class="h4 text-primary" id="total-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Lanjutkan ke Pembayaran
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const productPrice = {{ $product->price }};
    const quantityInput = document.getElementById('quantity');
    const totalPriceSpan = document.getElementById('total-price');

    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value) || 1;
        const totalPrice = productPrice * quantity;
        totalPriceSpan.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }

    quantityInput.addEventListener('input', updateTotalPrice);
</script>

@endsection