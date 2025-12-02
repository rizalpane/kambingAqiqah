@extends('layouts.layoutAuth')

@section('title', 'Halaman Index')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100 ">

    <div class="card border shadow p-5 w-25">

        <div class="text-secondary h-3 ">Masukan Informasi Login</div>
        <h3 class="display-6 mb-5 "><strong>Selamat datang </strong></h3>

        <form action="{{ route('auth.login') }}" method="POST">
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
                <label class="form-label text-secondary h-3">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-5">
                <label class="form-label text-secondary h-3">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" placeholder="Masukkan password" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-5">Login</button>

            <div class="text-center">
                <a class="text-decoration-none" href="/forgot">Lupa password ?</a>
                <br> Atau <br>
                <a class="text-decoration-none" href="{{ route('auth.register') }}">Belum Punya akun ?</a>
            </div>

        </form>
    </div>

</div>


@endsection