@extends('layouts.master')

@section('title', 'Forming')

@section('content')

    <style>
        :root {
            --fm-primary: #1B4B43;
            --fm-primary-light: #E8F0EE;
            --fm-accent: #D98C3D;
            --fm-border: #E3E7E1;
            --fm-text: #1F2A24;
            --fm-muted: #5B6A62;
            --fm-soft: #F7F9F7;
        }

        .fm-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--fm-text);
        }

        .fm-page .section-lead {
            color: var(--fm-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .fm-page .card {
            border: none;
            border-left: 4px solid var(--fm-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .fm-page .card.card-final {
            border-left-color: var(--fm-accent);
        }

        .fm-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--fm-border);
            padding: 1rem 1.5rem;
        }

        .fm-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--fm-text);
            display: flex;
            align-items: center;
        }

        .fm-page .card-header h4 i {
            color: var(--fm-primary);
        }

        .fm-page .card-body {
            padding: 1.5rem;
        }

        .fm-page .filter-label {
            color: var(--fm-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .fm-page .form-control {
            border-color: var(--fm-border);
            border-radius: 7px;
        }

        .fm-page .form-control:focus {
            border-color: var(--fm-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .fm-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .fm-page .table {
            margin-bottom: 0;
        }

        .fm-page .table thead th {
            background: var(--fm-primary-light);
            color: var(--fm-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .fm-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--fm-text);
            padding: .8rem .9rem;
        }

        .fm-page .table-bordered td,
        .fm-page .table-bordered th {
            border-color: var(--fm-border);
        }

        .fm-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .fm-page .table-wide {
            min-width: 1450px;
        }

        .fm-page .table-wide th,
        .fm-page .table-wide td {
            white-space: nowrap;
        }

        .fm-page .badge-soft {
            display: inline-block;
            background: var(--fm-primary-light);
            color: var(--fm-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .fm-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .fm-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .fm-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--fm-muted);
        }

        .fm-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .fm-page .btn-primary {
            background: var(--fm-primary);
            border-color: var(--fm-primary);
        }

        .fm-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .fm-page .btn-ghost {
            color: var(--fm-muted);
            background: transparent;
            border: 1px solid var(--fm-border);
        }

        .fm-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--fm-text);
        }

        .fm-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .fm-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .fm-page .card-body {
                padding: 1rem;
            }

            .fm-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="fm-page">

        <div class="section-header">

            <h1>Forming</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="#">
                        Forming
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Monitoring proses forming berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.forming.index') }}">

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

                        <a href="{{ route('manager.forming.index') }}" class="btn btn-ghost">

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

                    <i class="fas fa-shapes mr-2"></i>
                    Data Forming

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
                                <th>Alat</th>
                                <th>Suhu Adonan</th>
                                <th>Pressure</th>
                                <th>Speed</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($formings as $index => $forming)
                                <tr>

                                    <td class="text-center">
                                        {{ $formings->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($forming->productionBatch)
                                            <span class="badge-soft">
                                                {{ $forming->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->productionBatch && $forming->productionBatch->tanggal_produksi)
                                            {{ $forming->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->productionBatch && $forming->productionBatch->product)
                                            {{ $forming->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->line)
                                            <span class="badge-value">
                                                {{ $forming->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->alat)
                                            <span class="badge-soft">
                                                {{ $forming->alat }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->suhu_adonan !== null)
                                            {{ $forming->suhu_adonan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->pressure !== null)
                                            {{ $forming->pressure }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->speed !== null)
                                            {{ $forming->speed }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->waktu_mulai)
                                            {{ $forming->waktu_mulai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->waktu_selesai)
                                            {{ $forming->waktu_selesai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($forming->downtime)
                                            <span class="badge-value">
                                                {{ $forming->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.forming.detail', $forming->id) }}"
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

                                            <i class="fas fa-shapes d-block"></i>

                                            <div>
                                                Belum ada data Forming.
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

                {{ $formings->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
