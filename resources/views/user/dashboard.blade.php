@extends('layouts.layoutUser')

@section('title', 'Halaman Dashboard User')

@section('content')

<div class="container mt-5 p-5 card">
    <div>
        <h3 class="mb-5 display-6">Produk Kami</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4 ">
        @forelse ($products as $product)
            <div class="col">
                <div class="card p-3 h-100 d-flex flex-column">

                    <span class="badge bg-secondary w-25">{{ $product->category }}</span>

                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/goat.png') }}" class="card-img-top" alt="default">
                    @endif

                    <div class="card-body d-flex flex-column">

                        <!-- Bagian atas yang fleksibel -->
                        <div class="flex-grow-1">
                            <p class="card-title">{{ $product->name }}</p>
                            <p class="h6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>

                        <!-- Bagian tombol -->
                        <div class="d-flex mb-2">
                            <a class="btn btn-primary btn-sm me-3" href="{{ route('user.checkout', $product->id) }}">Beli Sekarang</a>
                            <a class="btn btn-outline-primary btn-sm" href="#">Detail</a>
                        </div>

                        <!-- Bagian bawah tetap -->
                        <p class="mb-0"><small>{{ $product->location }}</small></p>
                        <p class="text-secondary">Tersedia : {{ $product->stock }} Ekor </p>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <p class="mb-0">Belum ada produk tersedia. Silakan kembali lagi nanti.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection