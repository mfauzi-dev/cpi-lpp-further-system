@extends('layouts.master')

@section('title', 'Produksi Bahan Baku')

@section('content')

    <style>
        :root {
            --pr-primary: #1B4B43;
            --pr-primary-light: #E8F0EE;
            --pr-accent: #D98C3D;
            --pr-border: #E3E7E1;
            --pr-text: #1F2A24;
            --pr-muted: #5B6A62;
            --pr-soft: #F7F9F7;
        }

        .pr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pr-text);
        }

        .pr-page .section-lead {
            color: var(--pr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pr-page .card {
            border: none;
            border-left: 4px solid var(--pr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .pr-page .card.card-final {
            border-left-color: var(--pr-accent);
        }

        .pr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pr-border);
            padding: 1rem 1.5rem;
        }

        .pr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pr-text);
            display: flex;
            align-items: center;
        }

        .pr-page .card-header h4 i {
            color: var(--pr-primary);
        }

        .pr-page .card-body {
            padding: 1.5rem;
        }

        .pr-page .filter-label {
            color: var(--pr-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .pr-page .form-control {
            border-color: var(--pr-border);
            border-radius: 7px;
        }

        .pr-page .form-control:focus {
            border-color: var(--pr-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .pr-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pr-page .table {
            margin-bottom: 0;
        }

        .pr-page .table thead th {
            background: var(--pr-primary-light);
            color: var(--pr-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .pr-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--pr-text);
            padding: .8rem .9rem;
        }

        .pr-page .table-bordered td,
        .pr-page .table-bordered th {
            border-color: var(--pr-border);
        }

        .pr-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pr-page .table-wide {
            min-width: 1150px;
        }

        .pr-page .table-wide th,
        .pr-page .table-wide td {
            white-space: nowrap;
        }

        .pr-page .badge-soft {
            display: inline-block;
            background: var(--pr-primary-light);
            color: var(--pr-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pr-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pr-muted);
        }

        .pr-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .pr-page .btn-primary {
            background: var(--pr-primary);
            border-color: var(--pr-primary);
        }

        .pr-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pr-page .btn-ghost {
            color: var(--pr-muted);
            background: transparent;
            border: 1px solid var(--pr-border);
        }

        .pr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pr-text);
        }

        .pr-page .btn-add {
            background: var(--pr-accent);
            border-color: var(--pr-accent);
            color: #fff;
        }

        .pr-page .btn-add:hover {
            background: #C77B30;
            border-color: #C77B30;
            color: #fff;
        }

        .pr-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .pr-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .pr-page .card-body {
                padding: 1rem;
            }

            .pr-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="pr-page">

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
            Pencatatan dan monitoring penggunaan bahan baku berdasarkan production batch.
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
                                    No. Batch
                                </label>

                                <input type="text" name="no_batch" class="form-control" placeholder="Cari nomor batch..."
                                    value="{{ request('no_batch') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">
                                    Process Type
                                </label>

                                <select name="process_type_id" class="form-control">
                                    <option value="">Semua Process Type</option>

                                    @foreach ($processTypes as $processType)
                                        <option value="{{ $processType->id }}"
                                            {{ request('process_type_id') == $processType->id ? 'selected' : '' }}>
                                            {{ $processType->name }}
                                        </option>
                                    @endforeach
                                </select>
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

                        <a href="{{ route('operator.production.index') }}" class="btn btn-ghost">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset
                        </a>

                    </div>

                </form>

            </div>
        </div>

        <div class="card card-final">

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
                                <th class="text-center">No</th>
                                <th>Production Batch</th>
                                <th>Tanggal Produksi</th>
                                <th>Product</th>
                                <th>Process Type</th>
                                <th class="text-center">Jumlah Detail</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($productions as $index => $production)
                                <tr>

                                    <td class="text-center">
                                        {{ $productions->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($production->productionBatch)
                                            <span class="badge-soft">
                                                {{ $production->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($production->productionBatch && $production->productionBatch->tanggal_produksi)
                                            {{ $production->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($production->productionBatch && $production->productionBatch->product)
                                            {{ $production->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($production->processType)
                                            <span class="badge-value">
                                                {{ $production->processType->name }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <span class="badge-soft">
                                            {{ $production->details->count() }} Data
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.production.detail', $production->id) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7">

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
