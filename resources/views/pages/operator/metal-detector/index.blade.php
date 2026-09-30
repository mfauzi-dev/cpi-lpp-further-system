@extends('layouts.master')

@section('title', 'Metal Detector')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Metal Detector</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.metal-detector.index') }}">
                        Metal Detector
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

            <a href="{{ route('operator.metal-detector.create') }}" class="btn btn-add">

                <i class="fas fa-plus mr-1"></i>
                Tambah Metal Detector

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

                <form method="GET" action="{{ route('operator.metal-detector.index') }}">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="filter-label">
                                Kode Product
                            </label>

                            <input type="text" name="kode_product" class="form-control" placeholder="Cth: PRD-001"
                                value="{{ request('kode_product') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="filter-label">
                                Tanggal Dari
                            </label>

                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="filter-label">
                                Tanggal Sampai
                            </label>

                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">

                        </div>

                    </div>

                    <div class="d-flex align-items-center" style="gap: .5rem;">

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-search mr-1"></i>
                            Tampilkan

                        </button>

                        <a href="{{ route('operator.metal-detector.index') }}" class="btn btn-ghost">

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

                    <i class="fas fa-magnet mr-2"></i>
                    Data Metal Detector

                </h4>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Tanggal Produksi</th>
                                <th>No Batch</th>
                                <th>Product</th>
                                <th>Line</th>

                                <th width="150" class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($productionBatches as $index => $productionBatch)
                                <tr>

                                    <td>
                                        {{ $productionBatches->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($productionBatch->tanggal_produksi)
                                            <span class="badge-soft">

                                                {{ \Carbon\Carbon::parse($productionBatch->tanggal_produksi)->format('d/m/Y') }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($productionBatch->no_batch)
                                            <span class="badge-soft">

                                                {{ $productionBatch->no_batch }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $productionBatch->product->nama ?? '-' }}

                                    </td>

                                    <td>

                                        @if ($productionBatch->line)
                                            <span class="badge-soft">

                                                {{ $productionBatch->line }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.metal-detector.detail', $productionBatch->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('operator.metal-detector.edit', $productionBatch->id) }}"
                                                class="btn btn-outline-warning" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form
                                                action="{{ route('operator.metal-detector.destroy', $productionBatch->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Yakin ingin menghapus data Metal Detector untuk batch ini?');">

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

                                    <td colspan="6">

                                        <div class="empty-state">

                                            <i class="fas fa-magnet d-block"></i>

                                            <div>
                                                Belum ada data Metal Detector.
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

                {{ $productionBatches->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
