@extends('layouts.layoutUser')

@section('title', 'Profil Saya')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h3 class="mb-3">Profil Saya</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 text-center">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle" width="120" height="120">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="rounded-circle" width="120" height="120">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Profil (ubah)</label>
                        <input type="file" name="avatar" class="form-control">
                        <small class="text-muted">Tipe: jpg, jpeg, png — Max 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                    </div>

                    <hr>
                    <h5>Ubah Password (opsional)</h5>

                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection