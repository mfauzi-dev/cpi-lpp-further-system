@extends('layouts.master')

@section('title', 'Kemasan Rijek')

@section('content')

    <style>
        :root {
            --kr-primary: #1B4B43;
            --kr-primary-light: #E8F0EE;
            --kr-accent: #D98C3D;
            --kr-border: #E3E7E1;
            --kr-text: #1F2A24;
            --kr-muted: #5B6A62;
            --kr-soft: #F7F9F7;
        }

        .kr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--kr-text);
        }

        .kr-page .section-lead {
            color: var(--kr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .kr-page .card {
            border: none;
            border-left: 4px solid var(--kr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .kr-page .card.card-final {
            border-left-color: var(--kr-accent);
        }

        .kr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--kr-border);
            padding: 1rem 1.5rem;
        }

        .kr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--kr-text);
            display: flex;
            align-items: center;
        }

        .kr-page .card-header h4 i {
            color: var(--kr-primary);
        }

        .kr-page .card-body {
            padding: 1.5rem;
        }

        .kr-page .filter-label {
            color: var(--kr-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .kr-page .form-control {
            border-color: var(--kr-border);
            border-radius: 7px;
        }

        .kr-page .form-control:focus {
            border-color: var(--kr-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .kr-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .kr-page .table {
            margin-bottom: 0;
        }

        .kr-page .table thead th {
            background: var(--kr-primary-light);
            color: var(--kr-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .kr-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--kr-text);
            padding: .8rem .9rem;
        }

        .kr-page .table-bordered td,
        .kr-page .table-bordered th {
            border-color: var(--kr-border);
        }

        .kr-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .kr-page .table-wide {
            min-width: 1550px;
        }

        .kr-page .table-wide th,
        .kr-page .table-wide td {
            white-space: nowrap;
        }

        .kr-page .badge-soft {
            display: inline-block;
            background: var(--kr-primary-light);
            color: var(--kr-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .kr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .kr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .kr-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--kr-muted);
        }

        .kr-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .kr-page .btn-primary {
            background: var(--kr-primary);
            border-color: var(--kr-primary);
        }

        .kr-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .kr-page .btn-ghost {
            color: var(--kr-muted);
            background: transparent;
            border: 1px solid var(--kr-border);
        }

        .kr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--kr-text);
        }

        .kr-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .kr-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .kr-page .card-body {
                padding: 1rem;
            }

            .kr-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="kr-page">

        <div class="section-header">
            <h1>Kemasan Rijek</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Kemasan Rijek</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring kemasan rijek berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.kemasan-rijek.index') }}">

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

                        <a href="{{ route('manager.kemasan-rijek.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-recycle mr-2"></i>
                    Data Kemasan Rijek
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
                                <th>Line</th>
                                <th>Total Cooking KG</th>
                                <th>Total Rijek Cooking KG</th>
                                <th>Total Packing KG</th>
                                <th>Total Rijek Packing KG</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($kemasanRijeks as $index => $kemasanRijek)
                                <tr>

                                    <td class="text-center">
                                        {{ $kemasanRijeks->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->productionBatch)
                                            <span class="badge-soft">
                                                {{ $kemasanRijek->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->productionBatch && $kemasanRijek->productionBatch->tanggal_produksi)
                                            {{ $kemasanRijek->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->productionBatch && $kemasanRijek->productionBatch->product)
                                            {{ $kemasanRijek->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->productionBatch && $kemasanRijek->productionBatch->line)
                                            <span class="badge-value">
                                                {{ $kemasanRijek->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->total_cooking_kg !== null)
                                            {{ number_format((float) $kemasanRijek->total_cooking_kg, 2, ',', '.') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->total_rijek_cooking_kg !== null)
                                            <span class="badge-value">
                                                {{ number_format((float) $kemasanRijek->total_rijek_cooking_kg, 2, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->total_packing_kg !== null)
                                            {{ number_format((float) $kemasanRijek->total_packing_kg, 2, ',', '.') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($kemasanRijek->total_rijek_packing_kg !== null)
                                            <span class="badge-value">
                                                {{ number_format((float) $kemasanRijek->total_rijek_packing_kg, 2, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.kemasan-rijek.detail', $kemasanRijek->id) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="10">

                                        <div class="empty-state">
                                            <i class="fas fa-recycle d-block"></i>

                                            <div>
                                                Belum ada data Kemasan Rijek.
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
                {{ $kemasanRijeks->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
