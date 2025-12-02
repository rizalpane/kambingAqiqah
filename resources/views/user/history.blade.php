@extends('layouts.layoutUser')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="container card my-5 p-5">

    <p class="display-6">Riwayat Transaksi</p>

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

    @if ($orders->count() > 0)
        <div class="table-responsive">
            <table class="table mt-4 table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>Hewan</th>
                        <th>Jumlah</th>
                        <th>Harga/Unit</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->quantity }} Ekor</td>
                            <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                            <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                            <td>
                                @if ($order->status === 'success')
                                    <span class="badge bg-info">Midtrans</span>
                                @elseif ($order->status === 'pending')
                                    <span class="badge bg-secondary">Tertunda</span>
                                @else
                                    <span class="badge bg-light text-dark">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->status === 'success' && $order->payment_date)
                                    <span class="badge bg-success">Lunas</span>
                                @elseif ($order->status === 'failed')
                                    <span class="badge bg-danger">Gagal</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                                    Detail
                                </button>
                                @if ($order->status === 'failed' || $order->status === 'pending')
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $order->id }}">
                                        Hapus
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Detail Modals -->
        @foreach ($orders as $order)
            <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailLabel{{ $order->id }}">Detail Transaksi #{{ $order->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Produk:</strong>
                                    <p>{{ $order->product->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Jumlah:</strong>
                                    <p>{{ $order->quantity }} Ekor</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Harga/Unit:</strong>
                                    <p>Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Total Harga:</strong>
                                    <p><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Tanggal Beli:</strong>
                                    <p>{{ $order->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status Pembayaran:</strong>
                                    <p>
                                        @if ($order->status === 'success' && $order->payment_date)
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif ($order->status === 'failed')
                                            <span class="badge bg-danger">Gagal</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Lunas</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($order->payment_date)
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <strong>Tanggal Pembayaran:</strong>
                                        <p>{{ $order->payment_date->format('d-m-Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Lokasi Produk:</strong>
                                    <p>{{ $order->product->location }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Kategori:</strong>
                                    <p>{{ $order->product->category }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            @if ($order->status === 'pending')
                                <a href="{{ route('user.payment', $order->id) }}" class="btn btn-primary">
                                    <i class="bi bi-credit-card"></i> Lanjutkan Pembayaran
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteLabel{{ $order->id }}">Hapus Transaksi #{{ $order->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.</p>
                            <p><strong>Produk:</strong> {{ $order->product->name }} ({{ $order->quantity }} Ekor)</p>
                            <p><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('user.order.delete', $order->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info text-center mt-4" role="alert">
            <p class="mb-0">Anda belum memiliki riwayat transaksi. Mulai berbelanja sekarang!</p>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">Lihat Produk</a>
        </div>
    @endif

</div>

@endsection