@extends('layouts.master')

@section('title', 'Forming')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Forming</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">

                    <a href="{{ route('operator.forming.index') }}">

                        Forming

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

            <a href="{{ route('operator.forming.create') }}" class="btn btn-add">

                <i class="fas fa-plus mr-1"></i>

                Tambah Forming

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

                <form method="GET" action="{{ route('operator.forming.index') }}">

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

                        <a href="{{ route('operator.forming.index') }}" class="btn btn-ghost">

                            <i class="fas fa-sync-alt mr-1"></i>

                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- DATA FORMING --}}

        <div class="card card-accent">

            <div class="card-header">

                <h4>

                    <i class="fas fa-shapes mr-2"></i>

                    Data Forming

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

                                    Alat

                                </th>

                                <th>

                                    Waktu Kerja

                                </th>

                                <th>

                                    Suhu Adonan

                                </th>

                                <th>

                                    Pressure

                                </th>

                                <th>

                                    Speed

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

                            @forelse ($formings as $index => $forming)
                                <tr>

                                    {{-- NO --}}

                                    <td class="text-center">

                                        {{ $formings->firstItem() + $index }}

                                    </td>

                                    {{-- TANGGAL --}}

                                    <td>

                                        @if ($forming->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">

                                                {{ $forming->productionBatch->tanggal_produksi->format('d/m/Y') }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUCTION BATCH --}}

                                    <td>

                                        @if ($forming->productionBatch?->no_batch)
                                            <span class="badge-soft">

                                                {{ $forming->productionBatch->no_batch }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUK --}}

                                    <td>

                                        @if ($forming->productionBatch?->product?->nama)
                                            {{ $forming->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- ALAT --}}

                                    <td>

                                        @if ($forming->alat)
                                            {{ $forming->alat }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU KERJA --}}

                                    <td>

                                        @if ($forming->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">

                                                {{ $forming->productionBatch->waktu_kerja }}

                                                menit

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- SUHU ADONAN --}}

                                    <td>

                                        @if ($forming->suhu_adonan !== null)
                                            <span class="badge-value">

                                                {{ $forming->suhu_adonan }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRESSURE --}}

                                    <td>

                                        @if ($forming->pressure !== null)
                                            <span class="badge-value">

                                                {{ $forming->pressure }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- SPEED --}}

                                    <td>

                                        @if ($forming->speed !== null)
                                            <span class="badge-value">

                                                {{ $forming->speed }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU MULAI --}}

                                    <td>

                                        @if ($forming->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($forming->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU SELESAI --}}

                                    <td>

                                        @if ($forming->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($forming->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- DOWNTIME --}}

                                    <td>

                                        @if ($forming->downtime !== null)
                                            <span class="badge-value">

                                                {{ $forming->downtime }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- KETERANGAN --}}

                                    <td>

                                        @if ($forming->keterangan)
                                            {{ $forming->keterangan }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- PETUGAS --}}

                                    <td>

                                        @if ($forming->petugas)
                                            {{ $forming->petugas }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- LINE --}}

                                    <td>

                                        @if ($forming->productionBatch?->line)
                                            <span class="badge-soft">

                                                {{ $forming->productionBatch->line }}

                                            </span>
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- PIC PRODUKSI --}}

                                    <td>

                                        @if ($forming->pic_produksi)
                                            {{ $forming->pic_produksi }}
                                        @else
                                            <span class="value-empty">

                                                -

                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTION --}}

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.forming.detail', $forming->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('operator.forming.edit', $forming->id) }}"
                                                class="btn btn-outline-warning" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('operator.forming.destroy', $forming->id) }}"
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

                                    <td colspan="17">

                                        <div class="empty-state">

                                            <i class="fas fa-shapes d-block"></i>

                                            <div>

                                                Belum ada data Forming.

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

                {{ $formings->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
