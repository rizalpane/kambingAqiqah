@extends('layouts.layoutAdmin')
@section('title', 'Riwayat Pembelian')
@section('content')

<style>
    .history-page {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem 2rem;
        border-radius: 25px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .page-title {
        color: white;
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
        border-color: #667eea;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-info h3 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0.5rem 0 0 0;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: rotate(10deg) scale(1.1);
    }

    .stat-total .stat-icon {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        color: #667eea;
    }
    .stat-total h3 { color: #667eea; }

    .stat-success .stat-icon {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(32, 201, 151, 0.15) 100%);
        color: #28a745;
    }
    .stat-success h3 { color: #28a745; }

    .stat-pending .stat-icon {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 152, 0, 0.15) 100%);
        color: #ffc107;
    }
    .stat-pending h3 { color: #ffc107; }

    .stat-revenue .stat-icon {
        background: linear-gradient(135deg, rgba(23, 162, 184, 0.15) 0%, rgba(13, 202, 240, 0.15) 100%);
        color: #17a2b8;
    }
    .stat-revenue h3 { color: #17a2b8; }

    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .filter-card .form-label {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .filter-card .form-label i {
        color: #667eea;
    }

    .filter-card .form-select,
    .filter-card .form-control {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-card .form-select:focus,
    .filter-card .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .table-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .custom-table {
        margin: 0;
    }

    .custom-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .custom-table thead th {
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 1rem;
        border: none;
        white-space: nowrap;
    }

    .custom-table thead th:first-child {
        border-radius: 15px 0 0 0;
    }

    .custom-table thead th:last-child {
        border-radius: 0 15px 0 0;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    }

    .custom-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        font-weight: 600;
        color: #333;
        white-space: nowrap;
    }

    .custom-table tbody td:nth-child(3) {
        min-width: 180px;
        white-space: normal;
    }

    .custom-table tbody td:nth-child(5),
    .custom-table tbody td:nth-child(6) {
        min-width: 120px;
    }

    .custom-table tbody td:nth-child(7),
    .custom-table tbody td:nth-child(8) {
        min-width: 130px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 700;
        color: #333;
        font-size: 0.95rem;
    }

    .user-email {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        max-width: 200px;
    }

    .product-name {
        font-weight: 700;
        color: #333;
        white-space: normal;
        line-height: 1.3;
    }

    .product-location {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        white-space: normal;
        line-height: 1.3;
        margin-top: 0.3rem;
    }

    .badge-qty {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        color: #667eea;
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        font-weight: 700;
        border: 2px solid rgba(102, 126, 234, 0.2);
        display: inline-block;
        white-space: nowrap;
        font-size: 0.9rem;
    }

    .badge-status {
        padding: 0.6rem 1.2rem;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 2px solid transparent;
        white-space: nowrap;
    }

    .badge-success-custom {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(32, 201, 151, 0.15) 100%);
        color: #28a745;
        border-color: rgba(40, 167, 69, 0.2);
    }

    .badge-pending-custom {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 152, 0, 0.15) 100%);
        color: #ffc107;
        border-color: rgba(255, 193, 7, 0.2);
    }

    .badge-failed-custom {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.15) 0%, rgba(200, 35, 51, 0.15) 100%);
        color: #dc3545;
        border-color: rgba(220, 53, 69, 0.2);
    }

    .badge-unpaid {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.2) 0%, rgba(255, 152, 0, 0.2) 100%);
        color: #ffc107;
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        font-weight: 700;
        border: 2px solid rgba(255, 193, 7, 0.3);
        display: inline-block;
        white-space: nowrap;
        font-size: 0.85rem;
    }

    .btn-detail {
        background: linear-gradient(135deg, #17a2b8 0%, #0dcaf0 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.6rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .modal-content {
        border-radius: 25px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 25px 25px 0 0;
        padding: 1.8rem 2rem;
        border: none;
    }

    .modal-header .modal-title {
        font-weight: 800;
        font-size: 1.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-body {
        padding: 2rem;
    }

    .info-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-section h6 {
        color: #667eea;
        font-weight: 800;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-section p {
        margin-bottom: 0.8rem;
        color: #333;
        font-weight: 600;
    }

    .info-section p strong {
        color: #6c757d;
        font-weight: 700;
        min-width: 130px;
        display: inline-block;
    }

    .product-image {
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        height: auto;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        color: #667eea;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .empty-text {
        color: #6c757d;
        font-weight: 600;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="history-page">
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-content">
                <h1 class="page-title">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Pembelian
                </h1>
                <p class="page-subtitle">Kelola dan pantau semua transaksi dari semua user</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card stat-total">
                <div class="stat-content">
                    <div class="stat-info">
                        <div class="stat-label">
                            <i class="bi bi-basket"></i> Total Order
                        </div>
                        <h3>{{ $totalOrders }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-basket"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card stat-success">
                <div class="stat-content">
                    <div class="stat-info">
                        <div class="stat-label">
                            <i class="bi bi-check-circle"></i> Order Sukses
                        </div>
                        <h3>{{ $successOrders }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card stat-pending">
                <div class="stat-content">
                    <div class="stat-info">
                        <div class="stat-label">
                            <i class="bi bi-hourglass-split"></i> Pending
                        </div>
                        <h3>{{ $pendingOrders }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card stat-revenue">
                <div class="stat-content">
                    <div class="stat-info">
                        <div class="stat-label">
                            <i class="bi bi-cash-stack"></i> Total Revenue
                        </div>
                        <h3 style="font-size: 1.5rem;">Rp {{ number_format($totalRevenue / 1000000, 1) }}Jt</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-card">
            <form method="GET" class="row g-3">
                <div class="col-lg-3 col-md-6">
                    <label for="status" class="form-label">
                        <i class="bi bi-funnel"></i>
                        Filter Status
                    </label>
                    <select class="form-select" id="status" name="status">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Sukses</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="from_date" class="form-label">
                        <i class="bi bi-calendar-event"></i>
                        Dari Tanggal
                    </label>
                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="to_date" class="form-label">
                        <i class="bi bi-calendar-check"></i>
                        Sampai Tanggal
                    </label>
                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-filter">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- History Table -->
        <div class="table-card">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="custom-table table table-hover">
                        <thead>
                            <tr>
                                <th>ID Order</th>
                                <th>Pembeli</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga/Unit</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <strong>#{{ $order->id }}</strong>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            @if($order->user->avatar)
                                                <img src="{{ asset('storage/' . $order->user->avatar) }}" alt="Avatar" class="user-avatar">
                                            @else
                                                <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="user-avatar">
                                            @endif
                                            <div class="user-details">
                                                <span class="user-name">{{ $order->user->name }}</span>
                                                <span class="user-email">{{ $order->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-info">
                                            <span class="product-name">{{ $order->product->name }}</span>
                                            <span class="product-location">
                                                <i class="bi bi-geo-alt"></i> {{ $order->product->location }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-qty">{{ $order->quantity }} Ekor</span>
                                    </td>
                                    <td>
                                        Rp {{ number_format($order->price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <strong style="color: #667eea;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <small>{{ $order->created_at->format('d M Y H:i') }}</small>
                                    </td>
                                    <td>
                                        @if($order->payment_date)
                                            <small style="color: #28a745; font-weight: 700;">{{ $order->payment_date->format('d M Y H:i') }}</small>
                                        @else
                                            <span class="badge-unpaid">Belum Dibayar</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status === 'success')
                                            <span class="badge-status badge-success-custom">
                                                <i class="bi bi-check-circle"></i>Sukses
                                            </span>
                                        @elseif($order->status === 'pending')
                                            <span class="badge-status badge-pending-custom">
                                                <i class="bi bi-hourglass-split"></i>Pending
                                            </span>
                                        @elseif($order->status === 'failed')
                                            <span class="badge-status badge-failed-custom">
                                                <i class="bi bi-x-circle"></i>Gagal
                                            </span>
                                        @else
                                            <span class="badge-status badge-pending-custom">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>

                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailLabel{{ $order->id }}">
                                                    <i class="bi bi-receipt me-2"></i>
                                                    Detail Order #{{ $order->id }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="info-section">
                                                            <h6>
                                                                <i class="bi bi-person-circle"></i>
                                                                Informasi Pembeli
                                                            </h6>
                                                            <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                                                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                                            <p><strong>Telepon:</strong> {{ $order->user->phone ?? '-' }}</p>
                                                            <p class="mb-0"><strong>Alamat:</strong> {{ $order->user->address ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="info-section">
                                                            <h6>
                                                                <i class="bi bi-cart-check"></i>
                                                                Informasi Order
                                                            </h6>
                                                            <p><strong>ID Order:</strong> #{{ $order->id }}</p>
                                                            <p><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                                                            <p><strong>Status:</strong> 
                                                                @if($order->status === 'success')
                                                                    <span class="badge-status badge-success-custom">Sukses</span>
                                                                @elseif($order->status === 'pending')
                                                                    <span class="badge-status badge-pending-custom">Pending</span>
                                                                @else
                                                                    <span class="badge-status badge-failed-custom">Gagal</span>
                                                                @endif
                                                            </p>
                                                            <p class="mb-0"><strong>Tanggal Pembayaran:</strong> {{ $order->payment_date ? $order->payment_date->format('d M Y H:i') : 'Belum Dibayar' }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="info-section">
                                                    <h6>
                                                        <i class="bi bi-box-seam"></i>
                                                        Detail Produk
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            @if($order->product->image)
                                                                <img src="{{ asset($order->product->image) }}" alt="{{ $order->product->name }}" class="product-image">
                                                            @else
                                                                <img src="{{ asset('images/goat.png') }}" alt="default" class="product-image">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p><strong>Produk:</strong> {{ $order->product->name }}</p>
                                                            <p><strong>Kategori:</strong> {{ $order->product->category }}</p>
                                                            <p><strong>Lokasi:</strong> {{ $order->product->location }}</p>
                                                            <p><strong>Kuantitas:</strong> {{ $order->quantity }} Ekor</p>
                                                            <p><strong>Harga/Unit:</strong> Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                                                            <hr style="border-color: #e9ecef; margin: 1rem 0;">
                                                            <p class="mb-0">
                                                                <strong>Total Harga:</strong> 
                                                                <span style="color: #667eea; font-weight: 800; font-size: 1.5rem;">
                                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>
                    <p class="empty-text">Tidak ada data pembelian ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection