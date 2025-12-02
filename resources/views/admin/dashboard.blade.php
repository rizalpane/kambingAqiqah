@extends('layouts.layoutAdmin')

@section('title', 'Halaman Index')

@section('content')

<div class="p-5 my-4 bg-body-secondary rounded-3 container">   
        <h1 class="display-5 fw-bold">Hi, Admin</h1>
        <p class="col-md-8 fs-4">Apakah Kamu Siap Melakukan Sesuatu Hari ini ?</p>
</div>

<div class="container" style="height: 100vh;">
    <p class="fs-4">Overview</p>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <a href="{{ route('admin.users') }}" class="card text-white p-3 text-decoration-none border-0 bg-warning" style=" border-radius: 8px; ">
                <div class="d-flex align-items-center">
                    <!-- Ikon besar dengan opacity -->
                    <div class="flex-shrink-0 me-3" style="opacity: 0.3; font-size: 2.5rem;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <!-- Teks -->
                    <div>
                        <div class="fs-4 fw-bold">Pengguna</div>
                        <div class="fs-6">{{ $totalUsers }} Orang</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="{{ route('admin.order') }}" class="card text-white p-3 text-decoration-none border-0 bg-success" style=" border-radius: 8px; ">
                <div class="d-flex align-items-center">
                    <!-- Ikon besar dengan opacity -->
                    <div class="flex-shrink-0 me-3" style="opacity: 0.3; font-size: 2.5rem;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <!-- Teks -->
                    <div>
                        <div class="fs-4 fw-bold">Pesanan</div>
                        <div class="fs-6">{{ $totalOrders }} Pesanan</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="{{ route('admin.products.index') }}" class="card text-white p-3 text-decoration-none border-0 bg-primary" style=" border-radius: 8px; ">
                <div class="d-flex align-items-center">
                    <!-- Ikon besar dengan opacity -->
                    <div class="flex-shrink-0 me-3" style="opacity: 0.3; font-size: 2.5rem;">
                        <i class="bi bi-cart4"></i>
                    </div>
                    <!-- Teks -->
                    <div>
                        <div class="fs-4 fw-bold">Produk</div>
                        <div class="fs-6">{{ $totalProducts }} Hewan</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="{{ route('admin.history') }}" class="card text-white p-3 text-decoration-none border-0 bg-danger" style=" border-radius: 8px; ">
                <div class="d-flex align-items-center">
                    <!-- Ikon besar dengan opacity -->
                    <div class="flex-shrink-0 me-3" style="opacity: 0.3; font-size: 2.5rem;">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <!-- Teks -->
                    <div>
                        <div class="fs-4 fw-bold">Pendapatan</div>
                        <div class="fs-6">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

@endsection