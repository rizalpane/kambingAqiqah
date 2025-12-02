@extends('layouts.layoutAdmin')
@section('title', 'Halaman Index')
@section('content')
<div  class="container p-5">
    <div class="mb-4">
        <h2 class="fw-bold">Pesanan</h2>
    </div>
    <div class="">
        <table class="table">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
                <tr>
                    <td class="align-middle">1</td>
                    <td class="align-middle">Kambing 1.5 Tahun</td>
                    <td class="align-middle" >11/11/2025</td>
                    <td class="align-middle" ><span class="badge bg-success">Konfirmasi Pembayaran</span></td>
                    <td>
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-box"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Status Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="order-tracking">
                            <!-- STEP 0 - selesai -->
                            <div class="order-step done">
                                <div class="order-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <p class="order-label">Konfirmasi Pembayaran</p>
                            </div>

                            <!-- STEP 1 - selesai -->
                            <div class="order-step done">
                                <div class="order-icon">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <p class="order-label">Menunggu Kurir</p>
                            </div>

                            <!-- STEP 2 - sedang aktif -->
                            <div class="order-step active">
                                <div class="order-icon">
                                    <i class="bi bi-truck order-truck-animate"></i>
                                </div>
                                <p class="order-label">Dalam Perjalanan</p>
                            </div>

                            <!-- STEP 3 - belum aktif -->
                            <div class="order-step">
                                <div class="order-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <p class="order-label">Pesanan Tiba</p>
                            </div>

                        </div>

                        <div class="p-5">
                        <select class="form-select " aria-label="Default select example">
                            <option value="1" selected>Konfirmasi Pembayaran</option>
                            <option value="2">Menunggu Kurir</option>
                            <option value="3">Dalam Perjalanan</option>
                            <option value="4">Pesanan Tiba</option>
                        </select>

                        <button type="button" class="btn btn-primary mt-3">Update</button>
                        </div>

                        </div>
                        </div>
                    </div>
                    </div>
                    </td>
                </tr>

            </td>
        </table>
</div>
@endsection