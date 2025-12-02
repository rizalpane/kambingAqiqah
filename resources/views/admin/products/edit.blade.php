@extends('layouts.layoutAdmin')

@section('title', 'Edit Produk')

@section('content')

<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="display-6">Edit Produk</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Validasi Gagal!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" placeholder="Contoh: Kambing Etawa Umur 1.5 Tahun" 
                               value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" 
                               id="category" name="category" placeholder="Contoh: Hewan" 
                               value="{{ old('category', $product->category) }}" required>
                        @error('category')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" placeholder="Contoh: 3200000" 
                               value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="stock" class="form-label">Stok (Jumlah Ekor) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" placeholder="Contoh: 12" 
                               value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" placeholder="Contoh: Kec. Medan Tembung, Kota Medan" 
                           value="{{ old('location', $product->location) }}" required>
                    @error('location')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4" 
                              placeholder="Masukkan deskripsi produk (opsional)">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    @if ($product->image)
                        <div class="mt-3">
                            <p class="mb-2"><strong>Gambar Saat Ini:</strong></p>
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 150px; height: auto;">
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Perbarui Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
