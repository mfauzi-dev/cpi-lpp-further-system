@extends('layouts.master')

@section('title', 'Mixing')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Mixing</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.mixing.index') }}">
                        Mixing
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

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

            <a href="{{ route('operator.mixing.create') }}" class="btn btn-add">

                <i class="fas fa-plus mr-1"></i>
                Tambah Mixing

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

                <form method="GET" action="{{ route('operator.mixing.index') }}">

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

                        <a href="{{ route('operator.mixing.index') }}" class="btn btn-ghost">

                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- DATA MIXING --}}
        <div class="card card-accent">

            <div class="card-header">

                <h4>

                    <i class="fas fa-blender mr-2"></i>
                    Data Mixing

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
                                    Mixer Preparation
                                </th>

                                <th>
                                    Suhu Air
                                </th>

                                <th>
                                    Lama Pengadukan
                                </th>

                                <th>
                                    Filter
                                </th>

                                <th>
                                    Salinity
                                </th>

                                <th>
                                    Brix
                                </th>

                                <th>
                                    Mixer
                                </th>

                                <th>
                                    Suhu Adonan
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

                            @forelse ($mixings as $index => $mixing)
                                <tr>

                                    {{-- NO --}}
                                    <td class="text-center">
                                        {{ $mixings->firstItem() + $index }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>

                                        @if ($mixing->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">
                                                {{ $mixing->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUCTION BATCH --}}
                                    <td>

                                        @if ($mixing->productionBatch?->no_batch)
                                            <span class="badge-soft">
                                                {{ $mixing->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUK --}}
                                    <td>

                                        @if ($mixing->productionBatch?->product?->nama)
                                            {{ $mixing->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU KERJA --}}
                                    <td>

                                        @if ($mixing->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">
                                                {{ $mixing->productionBatch->waktu_kerja }}
                                                menit
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- MIXER PREPARATION --}}
                                    <td>

                                        @if ($mixing->mixer_preparation !== null)
                                            <span class="badge-value">
                                                {{ $mixing->mixer_preparation }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- SUHU AIR --}}
                                    <td>

                                        @if ($mixing->suhu_air !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($mixing->suhu_air, 2, ',', '.'), '0'), ',') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- LAMA PENGADUKAN --}}
                                    <td>

                                        @if ($mixing->lama_pengadukan !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($mixing->lama_pengadukan, 2, ',', '.'), '0'), ',') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- FILTER --}}
                                    <td>

                                        @if ($mixing->filter !== null)
                                            <span class="badge-value">
                                                {{ $mixing->filter }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- SALINITY --}}
                                    <td>

                                        @if ($mixing->salinity !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($mixing->salinity, 2, ',', '.'), '0'), ',') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- BRIX --}}
                                    <td>

                                        @if ($mixing->brix !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($mixing->brix, 2, ',', '.'), '0'), ',') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- MIXER --}}
                                    <td>

                                        @if ($mixing->mixer !== null)
                                            <span class="badge-value">
                                                {{ $mixing->mixer }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- SUHU ADONAN --}}
                                    <td>

                                        @if ($mixing->suhu_adonan !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($mixing->suhu_adonan, 2, ',', '.'), '0'), ',') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU MULAI --}}
                                    <td>

                                        @if ($mixing->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($mixing->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU SELESAI --}}
                                    <td>

                                        @if ($mixing->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($mixing->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DOWNTIME --}}
                                    <td>

                                        @if ($mixing->downtime !== null)
                                            <span class="badge-value">
                                                {{ $mixing->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- KETERANGAN --}}
                                    <td>

                                        @if ($mixing->keterangan)
                                            {{ $mixing->keterangan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PETUGAS --}}
                                    <td>

                                        @if ($mixing->petugas)
                                            {{ $mixing->petugas }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- LINE --}}
                                    <td>

                                        @if ($mixing->productionBatch?->line)
                                            <span class="badge-soft">
                                                {{ $mixing->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PIC PRODUKSI --}}
                                    <td>

                                        @if ($mixing->pic_produksi)
                                            {{ $mixing->pic_produksi }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTION --}}
                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.mixing.detail', $mixing->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('operator.mixing.edit', $mixing->id) }}"
                                                class="btn btn-outline-warning" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('operator.mixing.destroy', $mixing->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                    onclick="return confirm('Yakin hapus data Mixing?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="21">

                                        <div class="empty-state">

                                            <i class="fas fa-blender d-block"></i>

                                            <div>
                                                Belum ada data Mixing.
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

                {{ $mixings->withQueryString()->links() }}

            </div>

        </div>

    </div>


@endsection
