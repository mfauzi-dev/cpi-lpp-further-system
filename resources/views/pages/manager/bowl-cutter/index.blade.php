@extends('layouts.master')

@section('title', 'Bowl Cutter')

@section('content')

    <style>
        :root {
            --bc-primary: #1B4B43;
            --bc-primary-light: #E8F0EE;
            --bc-accent: #D98C3D;
            --bc-border: #E3E7E1;
            --bc-text: #1F2A24;
            --bc-muted: #5B6A62;
            --bc-soft: #F7F9F7;
        }

        .bc-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--bc-text);
        }

        .bc-page .section-lead {
            color: var(--bc-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .bc-page .card {
            border: none;
            border-left: 4px solid var(--bc-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .bc-page .card.card-final {
            border-left-color: var(--bc-accent);
        }

        .bc-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--bc-border);
            padding: 1rem 1.5rem;
        }

        .bc-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--bc-text);
            display: flex;
            align-items: center;
        }

        .bc-page .card-header h4 i {
            color: var(--bc-primary);
        }

        .bc-page .card-body {
            padding: 1.5rem;
        }

        .bc-page .filter-label {
            color: var(--bc-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .bc-page .form-control {
            border-color: var(--bc-border);
            border-radius: 7px;
        }

        .bc-page .form-control:focus {
            border-color: var(--bc-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .bc-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .bc-page .table {
            margin-bottom: 0;
        }

        .bc-page .table thead th {
            background: var(--bc-primary-light);
            color: var(--bc-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .bc-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--bc-text);
            padding: .8rem .9rem;
        }

        .bc-page .table-bordered td,
        .bc-page .table-bordered th {
            border-color: var(--bc-border);
        }

        .bc-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .bc-page .table-wide {
            min-width: 1200px;
        }

        .bc-page .table-wide th,
        .bc-page .table-wide td {
            white-space: nowrap;
        }

        .bc-page .badge-soft {
            display: inline-block;
            background: var(--bc-primary-light);
            color: var(--bc-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .bc-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .bc-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .bc-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--bc-muted);
        }

        .bc-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .bc-page .btn-primary {
            background: var(--bc-primary);
            border-color: var(--bc-primary);
        }

        .bc-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .bc-page .btn-ghost {
            color: var(--bc-muted);
            background: transparent;
            border: 1px solid var(--bc-border);
        }

        .bc-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--bc-text);
        }

        .bc-page .btn-add {
            background: var(--bc-accent);
            border-color: var(--bc-accent);
            color: #fff;
        }

        .bc-page .btn-add:hover {
            background: #C77B30;
            border-color: #C77B30;
            color: #fff;
        }

        .bc-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .bc-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .bc-page .card-body {
                padding: 1rem;
            }

            .bc-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="bc-page">

        <div class="section-header">
            <h1>Bowl Cutter</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Bowl Cutter</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses bowl cutter berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.bowl-cutter.index') }}">

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

                        <a href="{{ route('manager.bowl-cutter.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-blender mr-2"></i>
                    Data Bowl Cutter
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
                                <th>Speed</th>
                                <th>Suhu Emulasi</th>
                                <th>Homeganisasi / Orlap</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($bowlCutters as $index => $bowlCutter)
                                <tr>

                                    <td class="text-center">
                                        {{ $bowlCutters->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($bowlCutter->productionBatch)
                                            <span class="badge-soft">
                                                {{ $bowlCutter->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->productionBatch && $bowlCutter->productionBatch->tanggal_produksi)
                                            {{ $bowlCutter->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->productionBatch && $bowlCutter->productionBatch->product)
                                            {{ $bowlCutter->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->line)
                                            <span class="badge-value">
                                                {{ $bowlCutter->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->speed !== null)
                                            {{ $bowlCutter->speed }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->suhu_emulasi !== null)
                                            {{ $bowlCutter->suhu_emulasi }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->homeganisasi_orlap)
                                            <span class="badge-soft">
                                                {{ $bowlCutter->homeganisasi_orlap }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->waktu_mulai)
                                            {{ $bowlCutter->waktu_mulai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->waktu_selesai)
                                            {{ $bowlCutter->waktu_selesai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($bowlCutter->downtime)
                                            <span class="badge-value">
                                                {{ $bowlCutter->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.bowl-cutter.detail', $bowlCutter->id) }}"
                                                class="btn btn-outline-info">

                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="12">

                                        <div class="empty-state">

                                            <i class="fas fa-blender d-block"></i>

                                            <div>
                                                Belum ada data Bowl Cutter.
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

                {{ $bowlCutters->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
