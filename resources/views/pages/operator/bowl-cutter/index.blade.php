@extends('layouts.master')

@section('title', 'Bowl Cutter')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Bowl Cutter</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.bowl-cutter.index') }}">
                        Bowl Cutter
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses produksi menggunakan Bowl Cutter.
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
            <a href="{{ route('operator.bowl-cutter.create') }}" class="btn btn-add">
                <i class="fas fa-plus mr-1"></i>
                Tambah Bowl Cutter
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

                <form method="GET" action="{{ route('operator.bowl-cutter.index') }}">

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

                        <a href="{{ route('operator.bowl-cutter.index') }}" class="btn btn-ghost">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset
                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- DATA BOWL CUTTER --}}
        <div class="card card-accent">

            <div class="card-header">
                <h4>
                    <i class="fas fa-blender mr-2"></i>
                    Data Bowl Cutter
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
                                    Speed
                                </th>

                                <th>
                                    Suhu Emulasi
                                </th>

                                <th>
                                    Homogenisasi Overlap
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

                            @forelse ($bowlCutters as $index => $bowlCutter)
                                <tr>

                                    {{-- NO --}}
                                    <td class="text-center">
                                        {{ $bowlCutters->firstItem() + $index }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>

                                        @if ($bowlCutter->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">
                                                {{ $bowlCutter->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUCTION BATCH --}}
                                    <td>

                                        @if ($bowlCutter->productionBatch?->no_batch)
                                            <span class="badge-soft">
                                                {{ $bowlCutter->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUK --}}
                                    <td>

                                        @if ($bowlCutter->productionBatch?->product?->nama)
                                            {{ $bowlCutter->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU KERJA --}}
                                    <td>

                                        @if ($bowlCutter->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">
                                                {{ $bowlCutter->productionBatch->waktu_kerja }}
                                                menit
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- SPEED --}}
                                    <td>

                                        @if ($bowlCutter->speed !== null)
                                            <span class="badge-value">
                                                {{ $bowlCutter->speed }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- SUHU EMULASI --}}
                                    <td>

                                        @if ($bowlCutter->suhu_emulasi !== null)
                                            <span class="badge-value">
                                                {{ $bowlCutter->suhu_emulasi }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- HOMOGENISASI --}}
                                    <td>

                                        @if ($bowlCutter->homeganisasi_orlap !== null)
                                            <span class="badge-value">
                                                {{ $bowlCutter->homeganisasi_orlap }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU MULAI --}}
                                    <td>

                                        @if ($bowlCutter->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($bowlCutter->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU SELESAI --}}
                                    <td>

                                        @if ($bowlCutter->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($bowlCutter->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DOWNTIME --}}
                                    <td>

                                        @if ($bowlCutter->downtime !== null)
                                            <span class="badge-value">
                                                {{ $bowlCutter->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- KETERANGAN --}}
                                    <td>

                                        @if ($bowlCutter->keterangan)
                                            {{ $bowlCutter->keterangan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PETUGAS --}}
                                    <td>

                                        @if ($bowlCutter->petugas)
                                            {{ $bowlCutter->petugas }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- LINE --}}
                                    <td>

                                        @if ($bowlCutter->productionBatch?->line)
                                            <span class="badge-soft">
                                                {{ $bowlCutter->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PIC PRODUKSI --}}
                                    <td>

                                        @if ($bowlCutter->pic_produksi)
                                            {{ $bowlCutter->pic_produksi }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTION --}}
                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.bowl-cutter.detail', $bowlCutter->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('operator.bowl-cutter.edit', $bowlCutter->id) }}"
                                                class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('operator.bowl-cutter.destroy', $bowlCutter->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                    onclick="return confirm('Yakin hapus data?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="16">

                                        <div class="empty-state">

                                            <i class="fas fa-blender d-block"></i>

                                            <div>
                                                Belum ada data Bowl Cutter.
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

                {{ $bowlCutters->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
