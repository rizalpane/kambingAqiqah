@extends('layouts.layoutUser')

@section('title', 'Checkout')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card p-4">
                <h3 class="mb-3">Checkout</h3>

                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $product->name }}</h5>
                        <p class="text-muted">Lokasi: {{ $product->location }}</p>

                        @if($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3">
                        @endif

                        <p><strong>Harga per unit:</strong> Rp {{ number_format($product->price,0,',','.') }}</p>
                        <p><strong>Stok tersedia:</strong> {{ $product->stock }} Ekor</p>
                        <p class="text-muted">{{ $product->description ?? '' }}</p>
                    </div>

                    <div class="col-md-6">
                        <form action="{{ route('user.checkout.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah (Ekor)</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                <div id="totalPrice" class="h4 text-primary">Rp {{ number_format($product->price,0,',','.') }}</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
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
        var qtyInput = document.getElementById('quantity');
        var totalEl = document.getElementById('totalPrice');

        function formatRupiah(n) {
            return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function updateTotal(){
            var q = parseInt(qtyInput.value) || 1;
            if (q < 1) q = 1;
            if (q > {{ (int) $product->stock }}) q = {{ (int) $product->stock }};
            qtyInput.value = q;
            totalEl.textContent = formatRupiah(price * q);
        }

        qtyInput.addEventListener('input', updateTotal);
        document.addEventListener('DOMContentLoaded', updateTotal);
    })();
</script>
@endpush
