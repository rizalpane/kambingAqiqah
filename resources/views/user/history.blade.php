@extends('layouts.layoutUser')

@section('title', 'Riwayat Transaksi')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .page-title {
        color: white;
        font-weight: 800;
        font-size: 2.5rem;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        margin: 0;
    }

    .history-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
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

    .custom-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #333;
        font-weight: 500;
        border-bottom: 1px solid #f0f0f0;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: scale(1.01);
        box-shadow: 0 3px 10px rgba(102, 126, 234, 0.1);
    }

    .badge-custom {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .badge-success-custom {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .badge-warning-custom {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #333;
    }

    .badge-danger-custom {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .badge-info-custom {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }

    .badge-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-secondary-custom {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
    }

    .btn-detail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.85rem;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.85rem;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        color: white;
    }

    .btn-confirm {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        color: white;
    }

    .price-text {
        color: #667eea;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state i {
        font-size: 5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state h3 {
        color: #333;
        font-weight: 700;
        margin: 1.5rem 0 1rem;
    }

    .empty-state p {
        color: #666;
        font-size: 1.1rem;
    }

    .btn-shop-now {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .btn-shop-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .modal-header-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .modal-header-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
</style>

<div class="container my-5">
    
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-clock-history me-3"></i>Riwayat Transaksi
        </h1>
        <p class="page-subtitle mt-2">Kelola dan pantau semua transaksi Anda</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($orders->count() > 0)
        <div class="history-card">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Hewan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status Pembayaran</th>
                            <th>Status Order</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td><strong>{{ $order->product->name }}</strong></td>
                                <td>{{ $order->quantity }} Ekor</td>
                                <td><span class="price-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></td>
                                <td>
                                    @if ($order->status === 'success' && $order->payment_date)
                                        <span class="badge-custom badge-success-custom">
                                            <i class="bi bi-check-circle-fill"></i> Lunas
                                        </span>
                                    @elseif ($order->status === 'failed')
                                        <span class="badge-custom badge-danger-custom">
                                            <i class="bi bi-x-circle-fill"></i> Gagal
                                        </span>
                                    @else
                                        <span class="badge-custom badge-warning-custom">
                                            <i class="bi bi-clock-fill"></i> Belum Lunas
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status === 'success')
                                        @php
                                            $statusConfig = [
                                                'pending' => ['badge' => 'secondary', 'icon' => 'clock-fill', 'text' => 'Pending'],
                                                'processing' => ['badge' => 'info', 'icon' => 'gear-fill', 'text' => 'Processing'],
                                                'shipped' => ['badge' => 'warning', 'icon' => 'truck', 'text' => 'Dikirim'],
                                                'delivered' => ['badge' => 'primary', 'icon' => 'box-seam-fill', 'text' => 'Pesanan Tiba'],
                                                'received' => ['badge' => 'success', 'icon' => 'check-circle-fill', 'text' => 'Diterima'],
                                            ];
                                            $config = $statusConfig[$order->order_status] ?? ['badge' => 'secondary', 'icon' => 'question-circle', 'text' => ucfirst($order->order_status)];
                                        @endphp
                                        <span class="badge-custom badge-{{ $config['badge'] }}-custom">
                                            <i class="bi bi-{{ $config['icon'] }}"></i> {{ $config['text'] }}
                                        </span>
                                    @else
                                        <span class="badge-custom badge-secondary-custom">-</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button type="button" class="btn btn-detail btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                        @if ($order->status === 'failed' || $order->status === 'pending')
                                            <button type="button" class="btn btn-delete btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $order->id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        @endif
                                        @if ($order->status === 'success' && $order->order_status === 'delivered' && !$order->is_received)
                                            <button type="button" class="btn btn-confirm btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $order->id }}">
                                                <i class="bi bi-check-circle"></i> Konfirmasi
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail Modals -->
        @foreach ($orders as $order)
            <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border: none; border-radius: 20px; overflow: hidden;">
                        <div class="modal-header modal-header-custom border-0">
                            <h5 class="modal-title" id="detailLabel{{ $order->id }}">
                                <i class="bi bi-receipt me-2"></i>Detail Transaksi #{{ $order->id }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Produk:</strong>
                                    <p class="mb-0">{{ $order->product->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Jumlah:</strong>
                                    <p class="mb-0">{{ $order->quantity }} Ekor</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Harga/Unit:</strong>
                                    <p class="mb-0">Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Total Harga:</strong>
                                    <p class="mb-0 price-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Tanggal Beli:</strong>
                                    <p class="mb-0">{{ $order->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Status Pembayaran:</strong>
                                    <p class="mb-0">
                                        @if ($order->status === 'success' && $order->payment_date)
                                            <span class="badge-custom badge-success-custom">
                                                <i class="bi bi-check-circle-fill"></i> Lunas
                                            </span>
                                        @elseif ($order->status === 'failed')
                                            <span class="badge-custom badge-danger-custom">
                                                <i class="bi bi-x-circle-fill"></i> Gagal
                                            </span>
                                        @else
                                            <span class="badge-custom badge-warning-custom">
                                                <i class="bi bi-clock-fill"></i> Belum Lunas
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($order->payment_date)
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <strong style="color: #667eea;">Tanggal Pembayaran:</strong>
                                        <p class="mb-0">{{ $order->payment_date->format('d-m-Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Lokasi Produk:</strong>
                                    <p class="mb-0">{{ $order->product->location }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong style="color: #667eea;">Kategori:</strong>
                                    <p class="mb-0">{{ $order->product->category }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Tutup</button>
                            @if ($order->status === 'pending')
                                <a href="{{ route('user.payment', $order->id) }}" class="btn btn-detail">
                                    <i class="bi bi-credit-card"></i> Lanjutkan Pembayaran
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border: none; border-radius: 20px; overflow: hidden;">
                        <div class="modal-header modal-header-danger border-0">
                            <h5 class="modal-title" id="deleteLabel{{ $order->id }}">
                                <i class="bi bi-trash me-2"></i>Hapus Transaksi #{{ $order->id }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="alert alert-warning" style="border-radius: 15px;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Perhatian!</strong> Tindakan ini tidak dapat dibatalkan.
                            </div>
                            <p><strong style="color: #667eea;">Produk:</strong> {{ $order->product->name }} ({{ $order->quantity }} Ekor)</p>
                            <p><strong style="color: #667eea;">Total:</strong> <span class="price-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                        </div>
                        <div class="modal-footer border-0 bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Batal</button>
                            <form action="{{ route('user.order.delete', $order->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation Modal for Received -->
            @if ($order->status === 'success' && $order->order_status === 'delivered' && !$order->is_received)
                <div class="modal fade" id="confirmModal{{ $order->id }}" tabindex="-1" aria-labelledby="confirmLabel{{ $order->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border: none; border-radius: 20px; overflow: hidden;">
                            <div class="modal-header modal-header-success border-0">
                                <h5 class="modal-title" id="confirmLabel{{ $order->id }}">
                                    <i class="bi bi-check-circle me-2"></i>Konfirmasi Penerimaan Pesanan
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <p><strong>Apakah Anda sudah menerima pesanan ini?</strong></p>
                                <hr>
                                <p class="mb-1"><strong style="color: #667eea;">Produk:</strong> {{ $order->product->name }}</p>
                                <p class="mb-1"><strong style="color: #667eea;">Quantity:</strong> {{ $order->quantity }} Ekor</p>
                                <p class="mb-3"><strong style="color: #667eea;">Total:</strong> <span class="price-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                                <div class="alert alert-warning" style="border-radius: 15px;">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <small><strong>Perhatian:</strong> Setelah Anda konfirmasi, status pesanan tidak dapat diubah lagi dan transaksi akan selesai.</small>
                                </div>
                            </div>
                            <div class="modal-footer border-0 bg-light">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Batal</button>
                                <form action="{{ route('user.order.confirm', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-confirm">
                                        <i class="bi bi-check-circle me-1"></i>Ya, Saya Sudah Terima
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="history-card">
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h3>Belum Ada Riwayat Transaksi</h3>
                <p>Anda belum memiliki riwayat transaksi. Mulai berbelanja sekarang!</p>
                <a href="{{ route('user.dashboard') }}" class="btn btn-shop-now">
                    <i class="bi bi-cart-plus me-2"></i>Mulai Belanja
                </a>
            </div>
        </div>
    @endif

</div>

@endsection