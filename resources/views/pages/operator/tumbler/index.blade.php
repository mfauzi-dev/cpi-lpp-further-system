@extends('layouts.master')

@section('title', 'Tumbler A/B')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Tumbler A/B</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">

                    <a href="{{ route('operator.tumbler.index') }}">
                        Tumbler A/B
                    </a>

                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses produksi menggunakan Tumbler A/B.
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

            <a href="{{ route('operator.tumbler.create') }}" class="btn btn-add">

                <i class="fas fa-plus mr-1"></i>

                Tambah Tumbler A/B

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

                <form method="GET" action="{{ route('operator.tumbler.index') }}">

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

                        <a href="{{ route('operator.tumbler.index') }}" class="btn btn-ghost">

                            <i class="fas fa-sync-alt mr-1"></i>

                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- DATA TUMBLER A/B --}}

        <div class="card card-accent">

            <div class="card-header">

                <h4>

                    <i class="fas fa-sync-alt mr-2"></i>

                    Data Tumbler A/B

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
                                    Tumbler
                                </th>

                                <th>
                                    Drum On
                                </th>

                                <th>
                                    Drum Off
                                </th>

                                <th>
                                    Vacuum A
                                </th>

                                <th>
                                    Vacuum B
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

                            @forelse ($tumblers as $index => $tumbler)
                                <tr>

                                    <td class="text-center">

                                        {{ $tumblers->firstItem() + $index }}

                                    </td>

                                    <td>

                                        @if ($tumbler->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">

                                                {{ $tumbler->productionBatch->tanggal_produksi->format('d/m/Y') }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUCTION BATCH --}}

                                    <td>

                                        @if ($tumbler->productionBatch?->no_batch)
                                            <span class="badge-soft">

                                                {{ $tumbler->productionBatch->no_batch }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PRODUK --}}

                                    <td>

                                        @if ($tumbler->productionBatch?->product?->nama)
                                            {{ $tumbler->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU KERJA --}}

                                    <td>

                                        @if ($tumbler->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">

                                                {{ $tumbler->productionBatch->waktu_kerja }}
                                                menit

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- TUMBLER --}}

                                    <td>

                                        @if ($tumbler->tumbler !== null)
                                            <span class="badge-value">

                                                {{ $tumbler->tumbler }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DRUM ON --}}

                                    <td>

                                        @if ($tumbler->drum_on !== null)
                                            <span class="badge-value">

                                                {{ rtrim(rtrim(number_format($tumbler->drum_on, 2, ',', '.'), '0'), ',') }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DRUM OFF --}}

                                    <td>

                                        @if ($tumbler->drum_off !== null)
                                            <span class="badge-value">

                                                {{ rtrim(rtrim(number_format($tumbler->drum_off, 2, ',', '.'), '0'), ',') }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        @if ($tumbler->vacuum_a !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($tumbler->vacuum_a, 2, ',', '.'), '0'), ',') }}
                                                %
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($tumbler->vacuum_b !== null)
                                            <span class="badge-value">
                                                {{ rtrim(rtrim(number_format($tumbler->vacuum_b, 2, ',', '.'), '0'), ',') }}
                                                %
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>

                                        @if ($tumbler->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($tumbler->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- WAKTU SELESAI --}}

                                    <td>

                                        @if ($tumbler->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($tumbler->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- DOWNTIME --}}

                                    <td>

                                        @if ($tumbler->downtime !== null)
                                            <span class="badge-value">

                                                {{ $tumbler->downtime }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- KETERANGAN --}}

                                    <td>

                                        @if ($tumbler->keterangan)
                                            {{ $tumbler->keterangan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PETUGAS --}}

                                    <td>

                                        @if ($tumbler->petugas)
                                            {{ $tumbler->petugas }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- LINE --}}

                                    <td>

                                        @if ($tumbler->productionBatch?->line)
                                            <span class="badge-soft">

                                                {{ $tumbler->productionBatch->line }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- PIC PRODUKSI --}}

                                    <td>

                                        @if ($tumbler->pic_produksi)
                                            {{ $tumbler->pic_produksi }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTION --}}

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.tumbler.detail', $tumbler->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('operator.tumbler.edit', $tumbler->id) }}"
                                                class="btn btn-outline-warning" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('operator.tumbler.destroy', $tumbler->id) }}"
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

                                            <i class="fas fa-sync-alt d-block"></i>

                                            <div>
                                                Belum ada data Tumbler A/B.
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

                {{ $tumblers->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
