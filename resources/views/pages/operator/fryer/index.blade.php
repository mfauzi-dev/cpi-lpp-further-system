@extends('layouts.master')

@section('title', 'Fryer')

@push('addon-style')
    <style>
        .badge-suhu-success {
            background: #d4edda !important;
            color: #155724 !important;
        }

        .badge-suhu-warning {
            background: #fff3cd !important;
            color: #856404 !important;
        }

        .badge-suhu-danger {
            background: #f8d7da !important;
            color: #721c24 !important;
        }
    </style>
@endpush

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Fryer</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('operator.fryer.index') }}">
                        Fryer
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

            <div class="mb-4">

                <a href="{{ route('operator.fryer.create') }}" class="btn btn-add">

                    <i class="fas fa-plus mr-1"></i>

                    Tambah Fryer

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

                    <form method="GET" action="{{ route('operator.fryer.index') }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>
                                    Kode Batch
                                </label>

                                <input type="text" name="no_batch" class="form-control" placeholder="Cth: BATCH001"
                                    value="{{ request('no_batch') }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Line
                                </label>

                                <input type="text" name="line" class="form-control" placeholder="Cth: Line 1"
                                    value="{{ request('line') }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Tanggal Dari
                                </label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Tanggal Sampai
                                </label>

                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">

                            </div>

                        </div>

                        <div>

                            <button type="submit" class="btn btn-primary">

                                <i class="fas fa-search mr-1"></i>

                                Filter

                            </button>

                            <a href="{{ route('operator.fryer.index') }}" class="btn btn-ghost">

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

                        <i class="fas fa-fire mr-2"></i>

                        Daftar Fryer

                    </h4>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered table-wide">

                            <thead>

                                <tr>

                                    <th>No</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Kode Batch</th>
                                    <th>Product</th>
                                    <th>Suhu Pusat</th>
                                    <th>Suhu Minimum</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($fryers as $fryer)
                                    <tr>

                                        <td class="number-cell">

                                            {{ $fryers->firstItem() + $loop->index }}

                                        </td>

                                        <td>

                                            @if ($fryer->productionBatch?->tanggal_produksi)
                                                <span class="badge-soft">

                                                    {{ \Carbon\Carbon::parse($fryer->productionBatch->tanggal_produksi)->format('d M Y') }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->productionBatch?->no_batch)
                                                <span class="badge-soft">

                                                    {{ $fryer->productionBatch->no_batch }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            {{ $fryer->productionBatch->product->nama ?? '-' }}

                                        </td>

                                        <td>

                                            @if ($fryer->suhu_pusat !== null)
                                                <span class="badge-value badge-suhu-{{ $fryer->suhu_pusat_status }}">

                                                    {{ $fryer->suhu_pusat }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->suhu_minimum !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->suhu_minimum }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            <div class="action-buttons">

                                                <a href="{{ route('operator.fryer.detail', $fryer->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('operator.fryer.edit', $fryer->id) }}"
                                                    class="btn btn-outline-warning" title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form action="{{ route('operator.fryer.destroy', $fryer->id) }}"
                                                    method="POST" style="display: inline;">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                        onclick="return confirm('Yakin hapus data Fryer ini?')">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="7">

                                            <div class="empty-state">

                                                <i class="fas fa-fire d-block"></i>

                                                <div>
                                                    Belum ada data Fryer.
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

                    {{ $fryers->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
