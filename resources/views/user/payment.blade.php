@extends('layouts.layoutUser')

@section('title', 'Payment')

@section('content')

<div class="container card my-5 p-5">
    <div class="row">
        <div class="col-md-8">
            <h3 class="display-6 mb-4">Pembayaran Pesanan</h3>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Detail Pesanan</h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Produk:</strong></p>
                            <p>{{ $order->product->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Jumlah:</strong></p>
                            <p>{{ $order->quantity }} Ekor</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Harga/Unit:</strong></p>
                            <p>Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Lokasi:</strong></p>
                            <p>{{ $order->product->location }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5><strong>Total Pembayaran:</strong></h5>
                            <h3 class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Metode Pembayaran</h5>
                    <hr>
                    <p class="text-muted">Pembayaran melalui Midtrans (tersedia berbagai metode):</p>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="top: 100px;">
                <div class="card-body">
                    <h5 class="card-title">Status Pesanan</h5>
                    <hr>
                    <p class="mb-2">
                        <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                    </p>
                    <small class="text-muted">ID Pesanan: #{{ $order->id }}</small>
                    <hr>
                    
                    <div class="d-grid gap-2">
                        @if(isset($snapToken))
                            <button id="pay-button" class="btn btn-primary mb-2">
                                <i class="bi bi-credit-card"></i> Bayar dengan Midtrans
                            </button>
                        @endif

                        <a href="{{ route('user.history') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke History
                        </a>
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
