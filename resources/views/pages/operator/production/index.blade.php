@extends('layouts.master')

@section('title', 'Produksi Bahan Baku')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Produksi Bahan Baku</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Produksi Bahan Baku</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring produksi bahan baku berdasarkan proses produksi.
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
            <a href="{{ route('operator.production.create') }}" class="btn btn-add">
                <i class="fas fa-plus mr-1"></i>
                Tambah Produksi
            </a>
        </div>

        <div class="card mb-4">

            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('operator.production.index') }}">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">
                                    Jenis Tipe Proses
                                </label>

                                <select name="process_type_id" class="form-control select2">
                                    <option value="">
                                        Semua Jenis Proses
                                    </option>

                                    @foreach ($processTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ request('process_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
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

                        <a href="{{ route('operator.production.index') }}" class="btn btn-ghost">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset
                        </a>

                    </div>

                </form>

            </div>
        </div>

        <div class="card card-accent">

            <div class="card-header">
                <h4>
                    <i class="fas fa-boxes mr-2"></i>
                    Data Produksi Bahan Baku
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
                                    Waktu Kerja
                                </th>

                                <th>
                                    Jenis Proses
                                </th>

                                <th>
                                    Jumlah Produk
                                </th>

                                <th class="text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($productions as $index => $production)
                                <tr>

                                    <td class="text-center">
                                        {{ $productions->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($production->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">
                                                {{ $production->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($production->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">
                                                {{ $production->productionBatch->waktu_kerja }} menit
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($production->processType)
                                            <span class="badge-soft">
                                                {{ $production->processType->name }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($production->details->count() > 0)
                                            <span class="badge-value">
                                                {{ $production->details->count() }} Produk
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.production.detail', $production->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6">

                                        <div class="empty-state">
                                            <i class="fas fa-boxes d-block"></i>

                                            <div>
                                                Belum ada data Produksi Bahan Baku.
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
                {{ $productions->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
