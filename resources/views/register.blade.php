@extends('layouts.layoutAuth')

@section('title', 'Halaman Index')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100 ">

    <div class="card border shadow p-5 w-25">

        <div class="text-secondary h-3 ">Buat Akun Baru</div>
        <h3 class="display-6 mb-5 "><strong>Selamat datang </strong></h3>

        <form action="{{ route('auth.register') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <small>{{ $error }}</small><br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label text-secondary h-3">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" placeholder="Masukkan nama" value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary h-3">Alamat</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                       name="address" placeholder="Masukkan alamat" value="{{ old('address') }}" required>
                @error('address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class=" mb-3">
                <label class="form-label text-secondary h-3">Nomor</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                           name="phone" placeholder="Masukkan nomor" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary h-3">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary h-3">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" placeholder="Masukkan password" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-5">
                <label class="form-label text-secondary h-3">Verifikasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       name="password_confirmation" placeholder="Masukkan password" required>
                @error('password_confirmation')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-5">Register</button>

            <div class="text-center">
                <a class="text-decoration-none" href="{{ route('auth.login') }}">Sudah Punya akun ?</a>
            </div>

        </form>
    </div>

</div>

@endsection