@extends('layouts.master')

@section('title', 'Grinder')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Grinder</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.grinder.index') }}">
                        Grinder
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses produksi menggunakan Grinder.
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

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

        <div class="mb-4">
            <a href="{{ route('operator.grinder.create') }}" class="btn btn-add">
                <i class="fas fa-plus mr-1"></i>
                Tambah Grinder
            </a>
        </div>

        {{-- FILTER --}}
        <div class="card mb-4">

            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('operator.grinder.index') }}">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">

                                <label class="filter-label">
                                    No. Batch
                                </label>

                                <input type="text" name="no_batch" class="form-control" placeholder="Cari nomor batch..."
                                    value="{{ request('no_batch') }}">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label class="filter-label">
                                    Line
                                </label>

                                <input type="text" name="line" class="form-control" placeholder="Cari line..."
                                    value="{{ request('line') }}">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label class="filter-label">
                                    Tanggal Dari
                                </label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label class="filter-label">
                                    Tanggal Sampai
                                </label>

                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">

                            </div>
                        </div>

                    </div>

                    <div class="d-flex align-items-center" style="gap: .5rem;">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search mr-1"></i>
                            Tampilkan
                        </button>

                        <a href="{{ route('operator.grinder.index') }}" class="btn btn-ghost">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset
                        </a>

                    </div>

                </form>

            </div>
        </div>

        {{-- DATA GRINDER --}}
        <div class="card card-accent">

            <div class="card-header">
                <h4>
                    <i class="fas fa-cogs mr-2"></i>
                    Data Grinder
                </h4>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>
                            <tr>

                                <th class="text-center">
                                    No
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Production Batch
                                </th>

                                <th>
                                    Produk
                                </th>

                                <th>
                                    Waktu Kerja
                                </th>

                                <th>
                                    Ukuran Saringan
                                </th>

                                <th>
                                    Hasil
                                </th>

                                <th>
                                    Waktu Mulai
                                </th>

                                <th>
                                    Waktu Selesai
                                </th>

                                <th>
                                    Downtime
                                </th>

                                <th>
                                    Keterangan
                                </th>

                                <th>
                                    Petugas
                                </th>

                                <th>
                                    Line
                                </th>

                                <th>
                                    PIC Produksi
                                </th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($grinders as $index => $grinder)
                                <tr>

                                    {{-- NO --}}
                                    <td class="text-center">
                                        {{ $grinders->firstItem() + $index }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>

                                        @if ($grinder->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">
                                                {{ $grinder->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUCTION BATCH --}}
                                    <td>

                                        @if ($grinder->productionBatch?->no_batch)
                                            <span class="badge-soft">
                                                {{ $grinder->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUK --}}
                                    <td>

                                        @if ($grinder->productionBatch?->product?->nama)
                                            {{ $grinder->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU KERJA --}}
                                    <td>

                                        @if ($grinder->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">
                                                {{ $grinder->productionBatch->waktu_kerja }}
                                                menit
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- UKURAN SARINGAN --}}
                                    <td>

                                        @if ($grinder->ukuran_saringan !== null)
                                            <span class="badge-value">
                                                {{ $grinder->ukuran_saringan }} mm
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- HASIL --}}
                                    <td>

                                        @if ($grinder->hasil !== null)
                                            <span class="badge-value">
                                                {{ $grinder->hasil }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU MULAI --}}
                                    <td>

                                        @if ($grinder->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($grinder->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU SELESAI --}}
                                    <td>

                                        @if ($grinder->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($grinder->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DOWNTIME --}}
                                    <td>

                                        @if ($grinder->downtime !== null)
                                            <span class="badge-value">
                                                {{ $grinder->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- KETERANGAN --}}
                                    <td>

                                        @if ($grinder->keterangan)
                                            {{ $grinder->keterangan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PETUGAS --}}
                                    <td>

                                        @if ($grinder->petugas)
                                            {{ $grinder->petugas }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- LINE --}}
                                    <td>

                                        @if ($grinder->productionBatch?->line)
                                            <span class="badge-soft">
                                                {{ $grinder->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PIC PRODUKSI --}}
                                    <td>

                                        @if ($grinder->pic_produksi)
                                            {{ $grinder->pic_produksi }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTION --}}
                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.grinder.detail', $grinder->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('operator.grinder.edit', $grinder->id) }}"
                                                class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('operator.grinder.destroy', $grinder->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                    onclick="return confirm('Yakin hapus data Grinder ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="15">

                                        <div class="empty-state">

                                            <i class="fas fa-cogs d-block"></i>

                                            <div>
                                                Belum ada data Grinder.
                                            </div>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="card-footer bg-white border-top">
                {{ $grinders->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
