@extends('layouts.layoutAdmin')
@section('title', 'Halaman Index')
@section('content')
<div class="container p-5">
    <div class="mb-4">
        <h2 class="fw-bold">Riwayat</h2>
    </div>
    <div class="">
        <table class="table">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Status</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Kambing 1.5 Tahun</td>
                    <td>11/11/2025</td>
                    <td>Rp 3.200.000</td>
                     <td><span class="badge bg-success">Selesai</span></td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Kambing 2.5 Tahun</td>
                    <td>11/11/2025</td>
                    <td>Rp 3.800.000</td>
                     <td><span class="badge bg-warning">Dikirim</span></td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Kambing 2 Tahun</td>
                    <td>11/11/2025</td>
                    <td>Rp 3.500.000</td>
                     <td><span class="badge bg-danger">Batal</span></td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Kambing 2 Tahun</td>
                    <td>11/11/2025</td>
                    <td>Rp 3.500.000</td>
                     <td><span class="badge bg-primary">Menunggu Pembayaran</span></td>
                </tr>

        </table>
    </div>  
</div>
@endsection