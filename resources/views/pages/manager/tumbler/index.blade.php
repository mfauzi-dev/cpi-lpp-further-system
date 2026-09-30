@extends('layouts.master')

@section('title', 'Tumbler')

@section('content')

    <style>
        :root {
            --tb-primary: #1B4B43;
            --tb-primary-light: #E8F0EE;
            --tb-accent: #D98C3D;
            --tb-border: #E3E7E1;
            --tb-text: #1F2A24;
            --tb-muted: #5B6A62;
            --tb-soft: #F7F9F7;
        }

        .tb-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--tb-text);
        }

        .tb-page .section-lead {
            color: var(--tb-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .tb-page .card {
            border: none;
            border-left: 4px solid var(--tb-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .tb-page .card.card-final {
            border-left-color: var(--tb-accent);
        }

        .tb-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--tb-border);
            padding: 1rem 1.5rem;
        }

        .tb-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--tb-text);
            display: flex;
            align-items: center;
        }

        .tb-page .card-header h4 i {
            color: var(--tb-primary);
        }

        .tb-page .card-body {
            padding: 1.5rem;
        }

        .tb-page .filter-label {
            color: var(--tb-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .tb-page .form-control {
            border-color: var(--tb-border);
            border-radius: 7px;
        }

        .tb-page .form-control:focus {
            border-color: var(--tb-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .tb-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .tb-page .table {
            margin-bottom: 0;
        }

        .tb-page .table thead th {
            background: var(--tb-primary-light);
            color: var(--tb-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .tb-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--tb-text);
            padding: .8rem .9rem;
        }

        .tb-page .table-bordered td,
        .tb-page .table-bordered th {
            border-color: var(--tb-border);
        }

        .tb-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .tb-page .table-wide {
            min-width: 1250px;
        }

        .tb-page .table-wide th,
        .tb-page .table-wide td {
            white-space: nowrap;
        }

        .tb-page .badge-soft {
            display: inline-block;
            background: var(--tb-primary-light);
            color: var(--tb-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .tb-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .tb-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .tb-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--tb-muted);
        }

        .tb-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .tb-page .btn-primary {
            background: var(--tb-primary);
            border-color: var(--tb-primary);
        }

        .tb-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .tb-page .btn-ghost {
            color: var(--tb-muted);
            background: transparent;
            border: 1px solid var(--tb-border);
        }

        .tb-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--tb-text);
        }

        .tb-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .tb-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .tb-page .card-body {
                padding: 1rem;
            }

            .tb-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="tb-page">

        <div class="section-header">

            <h1>Tumbler</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="#">Tumbler</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Monitoring proses tumbler berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.tumbler.index') }}">

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

                        <a href="{{ route('manager.tumbler.index') }}" class="btn btn-ghost">

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

                    <i class="fas fa-sync-alt mr-2"></i>
                    Data Tumbler

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
                                <th>Tumbler</th>
                                <th>Drum On</th>
                                <th>Drum Off</th>
                                <th>Vacuum A</th>
                                <th>Vacuum B</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($tumblers as $index => $tumbler)
                                <tr>

                                    <td class="text-center">
                                        {{ $tumblers->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($tumbler->productionBatch)
                                            <span class="badge-soft">
                                                {{ $tumbler->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->productionBatch && $tumbler->productionBatch->tanggal_produksi)
                                            {{ $tumbler->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->productionBatch && $tumbler->productionBatch->product)
                                            {{ $tumbler->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->line)
                                            <span class="badge-value">
                                                {{ $tumbler->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->tumbler)
                                            <span class="badge-soft">
                                                {{ $tumbler->tumbler }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->drum_on !== null)
                                            {{ $tumbler->drum_on }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->drum_off !== null)
                                            {{ $tumbler->drum_off }}
                                        @else
                                            <span class="value-empty">-</span>
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
                                            {{ $tumbler->waktu_mulai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->waktu_selesai)
                                            {{ $tumbler->waktu_selesai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($tumbler->downtime)
                                            <span class="badge-value">
                                                {{ $tumbler->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.tumbler.detail', $tumbler->id) }}"
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

                                            <i class="fas fa-sync-alt d-block"></i>

                                            <div>
                                                Belum ada data Tumbler.
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
