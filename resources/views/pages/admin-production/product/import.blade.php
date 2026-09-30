@extends('layouts.master')

@section('title', 'Import Product')

@section('content')

    <div class="section-header">
        <h1>Import Product</h1>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="alert alert-info">
                Format Excel harus punya header (baris ketiga) berikut:
                <code>Kode Produk</code>, <code>Nama Produk</code>, <code>Nama Produk Grup</code>,
                <code>Nama Process Type</code>.
                <br>
                Kalau <code>Nama Produk Grup</code> / <code>Nama Process Type</code> tidak cocok dengan data yang
                sudah ada, kolom itu akan dikosongkan (tidak menggagalkan import).
            </div>

            <form action="{{ route('admin-production.product.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>File Excel</label>

                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="form-control @error('file') is-invalid @enderror">

                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Import
                </button>

                <a href="{{ route('admin-production.product.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>

@endsection
