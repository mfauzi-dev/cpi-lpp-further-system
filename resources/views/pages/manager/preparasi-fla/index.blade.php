@extends('layouts.master')

@section('title', 'Preparasi FLA')

@section('content')

    <style>
        :root {
            --pf-primary: #1B4B43;
            --pf-primary-light: #E8F0EE;
            --pf-accent: #D98C3D;
            --pf-border: #E3E7E1;
            --pf-text: #1F2A24;
            --pf-muted: #5B6A62;
            --pf-soft: #F7F9F7;
        }

        .pf-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pf-text);
        }

        .pf-page .section-lead {
            color: var(--pf-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pf-page .card {
            border: none;
            border-left: 4px solid var(--pf-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .pf-page .card.card-final {
            border-left-color: var(--pf-accent);
        }

        .pf-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pf-border);
            padding: 1rem 1.5rem;
        }

        .pf-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pf-text);
            display: flex;
            align-items: center;
        }

        .pf-page .card-header h4 i {
            color: var(--pf-primary);
        }

        .pf-page .card-body {
            padding: 1.5rem;
        }

        .pf-page .filter-label {
            color: var(--pf-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .pf-page .form-control {
            border-color: var(--pf-border);
            border-radius: 7px;
        }

        .pf-page .form-control:focus {
            border-color: var(--pf-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .pf-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pf-page .table {
            margin-bottom: 0;
        }

        .pf-page .table thead th {
            background: var(--pf-primary-light);
            color: var(--pf-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .pf-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--pf-text);
            padding: .8rem .9rem;
        }

        .pf-page .table-bordered td,
        .pf-page .table-bordered th {
            border-color: var(--pf-border);
        }

        .pf-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pf-page .table-wide {
            min-width: 1300px;
        }

        .pf-page .table-wide th,
        .pf-page .table-wide td {
            white-space: nowrap;
        }

        .pf-page .badge-soft {
            display: inline-block;
            background: var(--pf-primary-light);
            color: var(--pf-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pf-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pf-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pf-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pf-muted);
        }

        .pf-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .pf-page .btn-primary {
            background: var(--pf-primary);
            border-color: var(--pf-primary);
        }

        .pf-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pf-page .btn-ghost {
            color: var(--pf-muted);
            background: transparent;
            border: 1px solid var(--pf-border);
        }

        .pf-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pf-text);
        }

        .pf-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .pf-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .pf-page .card-body {
                padding: 1rem;
            }

            .pf-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="pf-page">

        <div class="section-header">

            <h1>Preparasi FLA</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="#">Preparasi FLA</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Monitoring proses preparasi FLA berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.preparasi-fla.index') }}">

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

                        <a href="{{ route('manager.preparasi-fla.index') }}" class="btn btn-ghost">

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

                    <i class="fas fa-cogs mr-2"></i>
                    Data Preparasi FLA

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
                                <th>Homeganisasi / Orlap</th>
                                <th>Suhu FLA After Cooling Down</th>
                                <th>Setting Speed X</th>
                                <th>Setting Speed Y</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($preparasiFlas as $index => $preparasiFla)
                                <tr>

                                    <td class="text-center">
                                        {{ $preparasiFlas->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($preparasiFla->productionBatch)
                                            <span class="badge-soft">
                                                {{ $preparasiFla->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->productionBatch && $preparasiFla->productionBatch->tanggal_produksi)
                                            {{ $preparasiFla->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->productionBatch && $preparasiFla->productionBatch->product)
                                            {{ $preparasiFla->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->line)
                                            <span class="badge-value">
                                                {{ $preparasiFla->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->homeganisasi_orlap)
                                            <span class="badge-soft">
                                                {{ $preparasiFla->homeganisasi_orlap }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->suhu_fla_after_cooling_down)
                                            <span class="badge-soft">
                                                {{ $preparasiFla->suhu_fla_after_cooling_down }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->setting_speed_x !== null)
                                            {{ $preparasiFla->setting_speed_x }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->setting_speed_y !== null)
                                            {{ $preparasiFla->setting_speed_y }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->waktu_mulai)
                                            {{ $preparasiFla->waktu_mulai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->waktu_selesai)
                                            {{ $preparasiFla->waktu_selesai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($preparasiFla->downtime)
                                            <span class="badge-value">
                                                {{ $preparasiFla->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.preparasi-fla.detail', $preparasiFla->id) }}"
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

                                            <i class="fas fa-cogs d-block"></i>

                                            <div>
                                                Belum ada data Preparasi FLA.
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

                {{ $preparasiFlas->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
