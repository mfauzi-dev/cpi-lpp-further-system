@extends('layouts.master')

@section('title', 'Packing Luar')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Packing Luar</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.packing-luar.index') }}">
                        Packing Luar
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Table
                </div>
            </div>
        </div>

        <div class="section-body">

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

            {{-- ACTION --}}
            <div class="mb-4">
                <a href="{{ route('operator.packing-luar.create') }}" class="btn btn-add">
                    <i class="fas fa-plus mr-1"></i>
                    Tambah Packing Luar
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

                    <form method="GET" action="{{ route('operator.packing-luar.index') }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Kode Product</label>

                                <input type="text" name="kode_product" class="form-control" placeholder="Cth: PRD001"
                                    value="{{ request('kode_product') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Line</label>

                                <input type="text" name="line" class="form-control" placeholder="Cth: Line 1"
                                    value="{{ request('line') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tanggal Dari</label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tanggal Sampai</label>

                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>

                        </div>

                        <div class="d-flex flex-wrap">

                            <button type="submit" class="btn btn-primary mr-2 mb-2">
                                <i class="fas fa-search mr-1"></i>
                                Filter
                            </button>

                            <a href="{{ route('operator.packing-luar.index') }}" class="btn btn-secondary mb-2">

                                <i class="fas fa-sync-alt mr-1"></i>
                                Reset

                            </a>

                        </div>

                    </form>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="card card-accent">

                <div class="card-header">
                    <h4>
                        <i class="fas fa-box-open mr-2"></i>
                        Daftar Packing Luar
                    </h4>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered table-wide">

                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Production Batch</th>
                                    <th>Kode Product</th>
                                    <th>Product</th>
                                    <th>Waktu Kerja</th>
                                    <th>Waktu</th>
                                    <th>Line</th>
                                    <th>PIC Produksi</th>
                                    <th width="150" class="text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($packingLuars as $packingLuar)
                                    <tr>

                                        <td>
                                            @if ($packingLuar->productionBatch?->tanggal_produksi)
                                                {{ $packingLuar->productionBatch->tanggal_produksi->format('d-m-Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            <span class="badge-soft">
                                                {{ $packingLuar->productionBatch->no_batch ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-value">
                                                {{ $packingLuar->productionBatch->product->kode_product ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $packingLuar->productionBatch->product->nama ?? '-' }}
                                        </td>

                                        <td>
                                            @if ($packingLuar->productionBatch->waktu_kerja !== null)
                                                {{ $packingLuar->productionBatch->waktu_kerja }} Jam
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($packingLuar->waktu_awal || $packingLuar->waktu_akhir)
                                                <span class="badge-value">
                                                    {{ $packingLuar->waktu_awal ? \Carbon\Carbon::parse($packingLuar->waktu_awal)->format('H:i') : '-' }}

                                                    &ndash;

                                                    {{ $packingLuar->waktu_akhir ? \Carbon\Carbon::parse($packingLuar->waktu_akhir)->format('H:i') : '-' }}
                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $packingLuar->line ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $packingLuar->pic_produksi ?? '-' }}
                                        </td>

                                        <td class="text-center">

                                            <div class="action-buttons justify-content-center">

                                                <a href="{{ route('operator.packing-luar.detail', $packingLuar->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('operator.packing-luar.edit', $packingLuar->id) }}"
                                                    class="btn btn-outline-warning" title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form
                                                    action="{{ route('operator.packing-luar.destroy', $packingLuar->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data Packing Luar ini?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="9">

                                            <div class="empty-state">
                                                <i class="fas fa-box-open"></i>

                                                <div>
                                                    Belum ada data Packing Luar.
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer">
                    {{ $packingLuars->withQueryString()->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection
