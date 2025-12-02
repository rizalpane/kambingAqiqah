@extends('layouts.layoutAuth')

@section('title', 'Halaman Index')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100 ">

    <div class="card border shadow p-5 w-25">

        <div class="text-secondary h-3 display-6  ">Lupa Password ?</div>


        <form action="#" method="POST">

            <div class="mb-3 py-5">
                <label class="form-label text-secondary h-3">Email Terdaftar</label>
                <input type="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-5">Send Mail</button>

            <div class="text-center">
                <a class="text-decoration-none" href="/register">Buat Akun ?</a>
            </div>

        </form>
    </div>

</div>


@endsection