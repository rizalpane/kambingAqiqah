@extends('layouts.layoutAdmin')
@section('title', 'Manajemen Pesanan')
@section('content')

<style>
    .order-page {
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
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
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

    .stat-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.8rem;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: #333;
        line-height: 1;
    }

    .stat-total { color: #667eea; }
    .stat-pending { color: #6c757d; }
    .stat-processing { color: #17a2b8; }
    .stat-shipped { color: #ffc107; }
    .stat-delivered { color: #667eea; }
    .stat-received { color: #28a745; }

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
    }

    .filter-card .form-label i {
        color: #667eea;
    }

    .filter-card .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-card .form-select:focus {
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
        font-size: 0.85rem;
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
        transform: scale(1.01);
    }

    .custom-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        font-weight: 600;
        color: #333;
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

    .user-phone {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .product-info {
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-weight: 700;
        color: #333;
    }

    .product-location {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.3rem;
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
    }

    .badge-pending {
        background: linear-gradient(135deg, rgba(108, 117, 125, 0.15) 0%, rgba(108, 117, 125, 0.15) 100%);
        color: #6c757d;
        border-color: rgba(108, 117, 125, 0.2);
    }

    .badge-processing {
        background: linear-gradient(135deg, rgba(23, 162, 184, 0.15) 0%, rgba(23, 162, 184, 0.15) 100%);
        color: #17a2b8;
        border-color: rgba(23, 162, 184, 0.2);
    }

    .badge-shipped {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0.15) 100%);
        color: #ffc107;
        border-color: rgba(255, 193, 7, 0.2);
    }

    .badge-delivered {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        color: #667eea;
        border-color: rgba(102, 126, 234, 0.2);
    }

    .badge-received {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(40, 167, 69, 0.15) 100%);
        color: #28a745;
        border-color: rgba(40, 167, 69, 0.2);
    }

    .badge-locked {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        margin-top: 0.3rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-manage {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

    .btn-manage:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
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

    .order-tracking {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem 0;
        position: relative;
        margin-bottom: 2rem;
    }

    .order-tracking::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 10%;
        right: 10%;
        height: 4px;
        background: #e9ecef;
        z-index: 0;
        transform: translateY(-50%);
        border-radius: 10px;
    }

    .order-step {
        text-align: center;
        position: relative;
        z-index: 1;
        flex: 1;
    }

    .order-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #e9ecef;
        color: #adb5bd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
        font-size: 1.8rem;
        transition: all 0.4s ease;
        border: 4px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .order-step.done .order-icon {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        animation: checkmark 0.5s ease;
    }

    .order-step.active .order-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        animation: pulse 2s infinite;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .order-label {
        font-size: 0.9rem;
        font-weight: 700;
        margin: 0;
        color: #6c757d;
    }

    .order-step.done .order-label,
    .order-step.active .order-label {
        color: #333;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
    }

    @keyframes checkmark {
        0% { transform: scale(0.8); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
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
        min-width: 100px;
        display: inline-block;
    }

    .alert-custom {
        border-radius: 15px;
        border: none;
        padding: 1.5rem;
        font-weight: 600;
    }

    .alert-success-custom {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(32, 201, 151, 0.15) 100%);
        color: #28a745;
        border: 2px solid rgba(40, 167, 69, 0.2);
    }

    .form-update {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
    }

    .form-update .form-label {
        font-weight: 800;
        color: #333;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .form-update .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .form-update .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .btn-update {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
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

    .alert-gradient {
        border-radius: 15px;
        border: none;
        padding: 1.2rem 1.5rem;
        margin-bottom: 2rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .alert-success-gradient {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(32, 201, 151, 0.15) 100%);
        color: #28a745;
        border: 2px solid rgba(40, 167, 69, 0.2);
    }

    .alert-danger-gradient {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.15) 0%, rgba(200, 35, 51, 0.15) 100%);
        color: #dc3545;
        border: 2px solid rgba(220, 53, 69, 0.2);
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .order-tracking {
            flex-wrap: wrap;
        }

        .order-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
        }
    }
</style>

<div class="order-page">
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-content">
                <h1 class="page-title">
                    <i class="bi bi-box-seam"></i>
                    Manajemen Pesanan
                </h1>
                <p class="page-subtitle">Kelola dan update status pesanan yang sedang berlangsung</p>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success-gradient alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger-gradient alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">
                    <i class="bi bi-inbox"></i> Total Order
                </div>
                <div class="stat-value stat-total">{{ $totalOrders }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">
                    <i class="bi bi-clock"></i> Pending
                </div>
                <div class="stat-value stat-pending">{{ $pendingOrders }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">
                    <i class="bi bi-gear"></i> Processing
                </div>
                <div class="stat-value stat-processing">{{ $processingOrders }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">
                    <i class="bi bi-truck"></i> Shipped
                </div>
                <div class="stat-value stat-shipped">{{ $shippedOrders }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">
                    <i class="bi bi-box-seam"></i> Delivered
                </div>
                <div class="stat-value stat-delivered">{{ $deliveredOrders }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">
                    <i class="bi bi-check-circle"></i> Received
                </div>
                <div class="stat-value stat-received">{{ $receivedOrders }}</div>
            </div>
        </div>

        <!-- Filter -->
        <div class="filter-card">
            <form method="GET" class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <label for="order_status" class="form-label">
                        <i class="bi bi-funnel"></i>
                        Filter Status Order
                    </label>
                    <select class="form-select" id="order_status" name="order_status">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="received" {{ request('order_status') == 'received' ? 'selected' : '' }}>Received</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-filter w-100">
                        <i class="bi bi-search me-1"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="table-card">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="custom-table table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pembeli</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Status Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>
                                        <div class="user-info">
                                            @if($order->user->avatar)
                                                <img src="{{ asset('storage/' . $order->user->avatar) }}" alt="Avatar" class="user-avatar">
                                            @else
                                                <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="user-avatar">
                                            @endif
                                            <div class="user-details">
                                                <span class="user-name">{{ $order->user->name }}</span>
                                                <span class="user-phone">
                                                    <i class="bi bi-telephone"></i> {{ $order->user->phone }}
                                                </span>
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
                                    <td>{{ $order->quantity }} Ekor</td>
                                    <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                                    <td>
                                        <small>{{ $order->created_at->format('d M Y') }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $statusConfig = [
                                                'pending' => ['badge' => 'pending', 'icon' => 'clock', 'text' => 'Pending'],
                                                'processing' => ['badge' => 'processing', 'icon' => 'gear', 'text' => 'Processing'],
                                                'shipped' => ['badge' => 'shipped', 'icon' => 'truck', 'text' => 'Shipped'],
                                                'delivered' => ['badge' => 'delivered', 'icon' => 'box-seam', 'text' => 'Delivered'],
                                                'received' => ['badge' => 'received', 'icon' => 'check-circle', 'text' => 'Received'],
                                            ];
                                            $config = $statusConfig[$order->order_status] ?? ['badge' => 'pending', 'icon' => 'question', 'text' => ucfirst($order->order_status)];
                                        @endphp
                                        <span class="badge-status badge-{{ $config['badge'] }}">
                                            <i class="bi bi-{{ $config['icon'] }}"></i>{{ $config['text'] }}
                                        </span>
                                        @if($order->is_received)
                                            <br><span class="badge-locked"><i class="bi bi-lock"></i> Locked</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-manage" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                            <i class="bi bi-pencil-square"></i> Kelola
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal for Order Status -->
                                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-box-seam me-2"></i>
                                                    Detail Pesanan #{{ $order->id }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Order Tracking Visual -->
                                                <div class="order-tracking">
                                                    <div class="order-step {{ in_array($order->order_status, ['pending', 'processing', 'shipped', 'delivered', 'received']) ? 'done' : '' }}">
                                                        <div class="order-icon">
                                                            <i class="bi bi-clock-fill"></i>
                                                        </div>
                                                        <p class="order-label">Pending</p>
                                                    </div>

                                                    <div class="order-step {{ in_array($order->order_status, ['processing', 'shipped', 'delivered', 'received']) ? 'done' : ($order->order_status == 'pending' ? 'active' : '') }}">
                                                        <div class="order-icon">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </div>
                                                        <p class="order-label">Processing</p>
                                                    </div>

                                                    <div class="order-step {{ in_array($order->order_status, ['shipped', 'delivered', 'received']) ? 'done' : ($order->order_status == 'processing' ? 'active' : '') }}">
                                                        <div class="order-icon">
                                                            <i class="bi bi-truck"></i>
                                                        </div>
                                                        <p class="order-label">Shipped</p>
                                                    </div>

                                                    <div class="order-step {{ in_array($order->order_status, ['delivered', 'received']) ? 'done' : ($order->order_status == 'shipped' ? 'active' : '') }}">
                                                        <div class="order-icon">
                                                            <i class="bi bi-box-seam"></i>
                                                        </div>
                                                        <p class="order-label">Delivered</p>
                                                    </div>

                                                    <div class="order-step {{ $order->order_status == 'received' ? 'done' : ($order->order_status == 'delivered' ? 'active' : '') }}">
                                                        <div class="order-icon">
                                                            <i class="bi bi-check-circle-fill"></i>
                                                        </div>
                                                        <p class="order-label">Received</p>
                                                    </div>
                                                </div>

                                                <!-- Order Details -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="info-section">
                                                            <h6>
                                                                <i class="bi bi-person-circle"></i>
                                                                Informasi Pembeli
                                                            </h6>
                                                            <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                                                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                                            <p><strong>Telepon:</strong> {{ $order->user->phone }}</p>
                                                            <p class="mb-0"><strong>Alamat:</strong> {{ $order->user->address }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="info-section">
                                                            <h6>
                                                                <i class="bi bi-cart-check"></i>
                                                                Detail Produk
                                                            </h6>
                                                            <p><strong>Produk:</strong> {{ $order->product->name }}</p>
                                                            <p><strong>Lokasi:</strong> {{ $order->product->location }}</p>
                                                            <p><strong>Quantity:</strong> {{ $order->quantity }} Ekor</p>
                                                            <p><strong>Harga/Unit:</strong> Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                                                            <p class="mb-0"><strong>Total:</strong> <span style="color: #667eea; font-weight: 800;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($order->is_received)
                                                    <div class="alert-custom alert-success-custom">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-lock-fill me-3" style="font-size: 2rem;"></i>
                                                            <div>
                                                                <strong style="font-size: 1.1rem;">Order Telah Dikonfirmasi Diterima</strong><br>
                                                                Diterima pada: {{ $order->received_at->format('d M Y H:i') }}<br>
                                                                Status order tidak dapat diubah lagi.
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="form-update">
                                                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <label for="order_status{{ $order->id }}" class="form-label">
                                                                <i class="bi bi-arrow-repeat me-2"></i>
                                                                Update Status Order
                                                            </label>
                                                            <select class="form-select" id="order_status{{ $order->id }}" name="order_status" required>
                                                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending - Menunggu Diproses</option>
                                                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing - Sedang Diproses</option>
                                                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped - Dalam Perjalanan</option>
                                                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered - Pesanan Tiba</option>
                                                            </select>
                                                            <button type="submit" class="btn-update">
                                                                <i class="bi bi-save"></i>Update Status
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
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
                    <p class="empty-text">Tidak ada pesanan yang sedang berlangsung.</p>
                </div>
            @endif
        </div>
    </div>
</div>
</div>

@endsection