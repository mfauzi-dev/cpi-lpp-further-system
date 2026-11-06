@extends('layouts.master')

@section('title', 'Edit Produk')

@section('content')
    <div class="page-section">
        <div class="section-header">
            <h1>Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.product.index') }}">
                        Produk
                    </a>
                </div>
                <div class="breadcrumb-item active">
                    Edit Produk
                </div>
            </div>
        </div>

        <div class="section-lead">
            Ubah data produk sesuai kebutuhan.
        </div>

        <div class="section-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Periksa kembali data yang diinput.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('operator.product.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">1</span>
                            Informasi Produk
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="filter-label">Kode Produk</label>
                            <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
                                placeholder="Masukkan kode produk (opsional)" value="{{ old('kode', $product->kode) }}">

                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="filter-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Masukkan nama produk" value="{{ old('nama', $product->nama) }}">

                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="filter-label">Gramasi</label>
                            <input type="number" step="0.01" name="gramasi"
                                class="form-control @error('gramasi') is-invalid @enderror"
                                placeholder="Masukkan gramasi (opsional)" value="{{ old('gramasi', $product->gramasi) }}">

                            @error('gramasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label class="filter-label">Pack per Box</label>
                            <input type="number" name="pack_per_box"
                                class="form-control @error('pack_per_box') is-invalid @enderror"
                                placeholder="Masukkan pack per box (opsional)"
                                value="{{ old('pack_per_box', $product->pack_per_box) }}">

                            @error('pack_per_box')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="section-info mb-2 mb-md-0">
                                <i class="fas fa-info-circle"></i>
                                Pastikan perubahan data Produk sudah sesuai.
                            </div>

                            <div class="action-buttons">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>
                                    Update
                                </button>

                                <a href="{{ route('operator.product.index') }}" class="btn btn-ghost">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
