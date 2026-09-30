@extends('layouts.master')

@section('title', 'Batter')

@section('content')

    <style>
        :root {
            --bt-primary: #1B4B43;
            --bt-primary-light: #E8F0EE;
            --bt-accent: #D98C3D;
            --bt-border: #E3E7E1;
            --bt-text: #1F2A24;
            --bt-muted: #5B6A62;
            --bt-soft: #F7F9F7;
        }

        .bt-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--bt-text);
        }

        .bt-page .section-lead {
            color: var(--bt-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .bt-page .card {
            border: none;
            border-left: 4px solid var(--bt-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .bt-page .card.card-final {
            border-left-color: var(--bt-accent);
        }

        .bt-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--bt-border);
            padding: 1rem 1.5rem;
        }

        .bt-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--bt-text);
            display: flex;
            align-items: center;
        }

        .bt-page .card-header h4 i {
            color: var(--bt-primary);
        }

        .bt-page .card-body {
            padding: 1.5rem;
        }

        .bt-page .filter-label {
            color: var(--bt-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .bt-page .form-control {
            border-color: var(--bt-border);
            border-radius: 7px;
        }

        .bt-page .form-control:focus {
            border-color: var(--bt-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .bt-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .bt-page .table {
            margin-bottom: 0;
        }

        .bt-page .table thead th {
            background: var(--bt-primary-light);
            color: var(--bt-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .bt-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--bt-text);
            padding: .8rem .9rem;
        }

        .bt-page .table-bordered td,
        .bt-page .table-bordered th {
            border-color: var(--bt-border);
        }

        .bt-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .bt-page .table-wide {
            min-width: 1400px;
        }

        .bt-page .table-wide th,
        .bt-page .table-wide td {
            white-space: nowrap;
        }

        .bt-page .badge-soft {
            display: inline-block;
            background: var(--bt-primary-light);
            color: var(--bt-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .bt-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .bt-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .bt-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--bt-muted);
        }

        .bt-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .bt-page .btn-primary {
            background: var(--bt-primary);
            border-color: var(--bt-primary);
        }

        .bt-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .bt-page .btn-ghost {
            color: var(--bt-muted);
            background: transparent;
            border: 1px solid var(--bt-border);
        }

        .bt-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--bt-text);
        }

        .bt-page .btn-add {
            background: var(--bt-accent);
            border-color: var(--bt-accent);
            color: #fff;
        }

        .bt-page .btn-add:hover {
            background: #C77B30;
            border-color: #C77B30;
            color: #fff;
        }

        .bt-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .bt-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .bt-page .card-body {
                padding: 1rem;
            }

            .bt-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="bt-page">
        <div class="section-header">
            <h1>Batter</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Batter</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses batter berdasarkan production batch.
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('manager.batter.index') }}">
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

                        <a href="{{ route('manager.batter.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-fill-drip mr-2"></i>
                    Data Batter
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
                                <th>Suhu Batter</th>
                                <th>Viskositas</th>
                                <th>Salinity</th>
                                <th>Batter</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($batters as $index => $batter)
                                <tr>
                                    <td class="text-center">
                                        {{ $batters->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($batter->productionBatch)
                                            <span class="badge-soft">
                                                {{ $batter->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->productionBatch && $batter->productionBatch->tanggal_produksi)
                                            {{ $batter->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->productionBatch && $batter->productionBatch->product)
                                            {{ $batter->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->line)
                                            <span class="badge-value">
                                                {{ $batter->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->suhu_batter !== null)
                                            {{ $batter->suhu_batter }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->viskositas !== null)
                                            {{ $batter->viskositas }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->salinity !== null)
                                            {{ $batter->salinity }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->batter !== null && $batter->batter !== '')
                                            <span class="badge-value">
                                                {{ $batter->batter }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->waktu_mulai)
                                            {{ $batter->waktu_mulai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->waktu_selesai)
                                            {{ $batter->waktu_selesai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($batter->downtime)
                                            <span class="badge-value">
                                                {{ $batter->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('manager.batter.detail', $batter->id) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13">
                                        <div class="empty-state">
                                            <i class="fas fa-fill-drip d-block"></i>

                                            <div>
                                                Belum ada data Batter.
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
                {{ $batters->withQueryString()->links() }}
            </div>
        </div>
    </div>

@endsection
