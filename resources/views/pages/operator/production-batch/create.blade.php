@extends('layouts.master')

@section('title', 'Tambah Production Batch')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Production Batch</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.production-batch.index') }}">
                        Production Batch
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Tambah
                </div>
            </div>
        </div>

        <p class="section-lead">
            Tambahkan production batch berdasarkan product, no batch, tanggal produksi, dan line produksi.
        </p>

        <div class="section-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan.</strong>

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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    {{ session('error') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>
            @endif

            <form action="{{ route('operator.production-batch.store') }}" method="POST" id="form-production-batch"
                enctype="multipart/form-data">

                @csrf

                {{-- STEP 1 --}}
                <div class="card mb-4">

                    <div class="card-header">
                        <h4>
                            <span class="step-badge">1</span>
                            Informasi Production Batch
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-8">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Product
                                    </label>

                                    <select name="product_id" id="product_id"
                                        class="form-control select2 @error('product_id') is-invalid @enderror">

                                        <option value="">
                                            Pilih Product
                                        </option>

                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                                {{ $product->kode_product ? $product->kode_product . ' - ' : '' }}{{ $product->nama }}

                                            </option>
                                        @endforeach

                                    </select>

                                    @error('product_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Tanggal Produksi
                                    </label>

                                    <input type="date" name="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi', date('Y-m-d')) }}">

                                    @error('tanggal_produksi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">
                                        No Batch
                                    </label>

                                    <input type="text" name="no_batch" id="no_batch"
                                        class="form-control @error('no_batch') is-invalid @enderror"
                                        value="{{ old('no_batch') }}" placeholder="Masukkan No Batch" required>

                                    @error('no_batch')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <small class="form-text text-muted">
                                        Masukkan nomor batch sesuai batch produksi.
                                    </small>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Line
                                    </label>

                                    <input type="text" name="line"
                                        class="form-control @error('line') is-invalid @enderror" placeholder="Cth: Line 1"
                                        value="{{ old('line') }}">

                                    @error('line')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Tipe Proses
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="tipe_proses" id="tipe_proses"
                                        class="form-control @error('tipe_proses') is-invalid @enderror" required>

                                        <option value="">Pilih Tipe Proses</option>

                                        <option value="forming" {{ old('tipe_proses') == 'forming' ? 'selected' : '' }}>
                                            Forming
                                        </option>

                                        <option value="non_forming"
                                            {{ old('tipe_proses') == 'non_forming' ? 'selected' : '' }}>
                                            Non Forming (Breader / Batter)
                                        </option>

                                        <option value="non_forming_roasted"
                                            {{ old('tipe_proses') == 'non_forming_roasted' ? 'selected' : '' }}>
                                            Non Forming Roasted
                                        </option>

                                    </select>

                                    @error('tipe_proses')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <small class="form-text text-muted">
                                        Menentukan proses awal untuk perhitungan waktu kerja.
                                    </small>

                                </div>

                            </div>

                        </div>

                        <div class="process-highlight mb-0">

                            <div class="process-label">
                                Informasi
                            </div>

                            <div class="process-value">
                                Production Batch
                            </div>

                            <div class="text-muted mt-1">
                                Masukkan No Batch sesuai dengan nomor batch produksi yang digunakan.
                            </div>

                        </div>

                    </div>

                </div>

                {{-- STIKER --}}
                <div class="card mb-4">

                    <div class="card-header">
                        <h4>
                            <span class="step-badge">+</span>
                            Stiker yang Ditempel
                        </h4>
                    </div>

                    <div class="card-body">

                        <p class="text-muted mb-3">
                            Upload foto/scan stiker jika ada. Semua boleh dikosongkan.
                        </p>

                        <div class="row">

                            <div class="col-md-3 col-6 mb-3">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Label Komposisi
                                    </label>

                                    <input type="file" name="stiker_komposisi" accept="image/*"
                                        class="form-control @error('stiker_komposisi') is-invalid @enderror">

                                    @error('stiker_komposisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-3 col-6 mb-3">

                                <div class="form-group">

                                    <label class="filter-label">
                                        CPPB / QI / BB
                                    </label>

                                    <input type="file" name="stiker_cppb_qi_bb" accept="image/*"
                                        class="form-control @error('stiker_cppb_qi_bb') is-invalid @enderror">

                                    @error('stiker_cppb_qi_bb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-3 col-6 mb-3">

                                <div class="form-group">

                                    <label class="filter-label">
                                        BPOM RI MD
                                    </label>

                                    <input type="file" name="stiker_bpom" accept="image/*"
                                        class="form-control @error('stiker_bpom') is-invalid @enderror">

                                    @error('stiker_bpom')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-3 col-6 mb-3">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Kode Cetak
                                    </label>

                                    <input type="file" name="stiker_kode_cetak" accept="image/*"
                                        class="form-control @error('stiker_kode_cetak') is-invalid @enderror">

                                    @error('stiker_kode_cetak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- STEP 2 --}}
                <div class="card mb-4">

                    <div class="card-header">
                        <h4>
                            <span class="step-badge">2</span>
                            Perhitungan Production Batch
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <div class="info-box">

                                    <div class="info-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="info-value">
                                        -
                                    </div>

                                    <small class="text-muted d-block mt-2">
                                        Otomatis dihitung dari proses awal (sesuai tipe proses) sampai Packing Luar.
                                    </small>

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <div class="info-box">

                                    <div class="info-label">
                                        Yield
                                    </div>

                                    <div class="info-value">
                                        -
                                    </div>

                                    <small class="text-muted d-block mt-2">
                                        Akan dihitung otomatis berdasarkan hasil produksi.
                                    </small>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    <div class="info-label">
                                        Persen Rijek
                                    </div>

                                    <div class="info-value">
                                        -
                                    </div>

                                    <small class="text-muted d-block mt-2">
                                        Akan dihitung otomatis berdasarkan data rijek.
                                    </small>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    <div class="info-label">
                                        Produktifitas
                                    </div>

                                    <div class="info-value">
                                        -
                                    </div>

                                    <small class="text-muted d-block mt-2">
                                        Akan dihitung otomatis dari data proses produksi.
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="card card-final mb-4">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div class="total-card mb-2 mb-md-0">

                                <div class="stat-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Production Batch
                                    </div>

                                    <div class="stat-value">
                                        Siap disimpan
                                    </div>

                                </div>

                            </div>

                            <div class="action-buttons">

                                <a href="{{ route('operator.production-batch.index') }}" class="btn btn-ghost">

                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Batal

                                </a>

                                <button type="submit" class="btn btn-add">

                                    <i class="fas fa-save mr-1"></i>
                                    Simpan Production Batch

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                width: '100%',
                placeholder: 'Pilih Product'
            });

        });
    </script>
@endpush
