@extends('layouts.master')

@section('content')
    <div class="page-section">

        <div class="section-header">
            <h1>Production Batch</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Production Batch</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring production batch berdasarkan proses produksi.
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
            <a href="{{ route('operator.production-batch.create') }}" class="btn btn-add">
                <i class="fas fa-plus mr-1"></i>
                Tambah Production Batch
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
                <form method="GET" action="{{ route('operator.production-batch.index') }}">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">
                                    Product
                                </label>

                                <select name="product_id" class="form-control select2">
                                    <option value="">Semua Product</option>

                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->kode_product ? $product->kode_product . ' - ' : '' }}{{ $product->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

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
                                    Tanggal Mulai
                                </label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">
                                    Tanggal Akhir
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

                        <a href="{{ route('operator.production-batch.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-layer-group mr-2"></i>
                    Data Production Batch
                </h4>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Tanggal Produksi</th>
                                <th>Product</th>
                                <th>No. Batch</th>
                                <th>Line</th>
                                <th>Waktu Kerja</th>
                                <th>Yield</th>
                                <th>Persen Rijek</th>
                                <th>Produktifitas</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($productionBatches as $index => $productionBatch)
                                <tr>

                                    <td class="text-center">
                                        {{ $productionBatches->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($productionBatch->tanggal_produksi)
                                            {{ $productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->product)
                                            <span class="badge-soft">
                                                {{ $productionBatch->product->kode_product ? $productionBatch->product->kode_product . ' - ' : '' }}{{ $productionBatch->product->nama }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->no_batch)
                                            <span class="badge-soft">
                                                {{ $productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->line)
                                            <span class="badge-value">
                                                {{ $productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->waktu_kerja !== null)
                                            {{ $productionBatch->waktu_kerja }} menit
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->yield !== null)
                                            {{ $productionBatch->yield }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->persen_rijek !== null)
                                            <span class="badge-value">
                                                {{ $productionBatch->persen_rijek }}%
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($productionBatch->produktifitas !== null)
                                            {{ $productionBatch->produktifitas }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="action-buttons">

                                            <a href="{{ route('operator.production-batch.export-pdf', $productionBatch->id) }}"
                                                target="_blank" class="btn btn-outline-danger" title="Export PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>

                                            <a href="{{ route('production-batch.export', $productionBatch->id) }}"
                                                class="btn btn-outline-success" title="Export Excel">
                                                <i class="fas fa-file-excel"></i>
                                            </a>

                                            <a href="{{ route('operator.production-batch.detail', $productionBatch->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('operator.production-batch.edit', $productionBatch->id) }}"
                                                class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form
                                                action="{{ route('operator.production-batch.destroy', $productionBatch->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                    onclick="return confirm('Yakin hapus data production batch ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="10">

                                        <div class="empty-state">
                                            <i class="fas fa-layer-group d-block"></i>

                                            <div>
                                                Belum ada data Production Batch.
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

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                width: '100%'
            });

        });
    </script>
@endpush
