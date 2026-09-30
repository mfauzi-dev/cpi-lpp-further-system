@extends('layouts.master')

@section('title', 'Grinder')

@section('content')

    <style>
        :root {
            --gr-primary: #1B4B43;
            --gr-primary-light: #E8F0EE;
            --gr-accent: #D98C3D;
            --gr-border: #E3E7E1;
            --gr-text: #1F2A24;
            --gr-muted: #5B6A62;
            --gr-soft: #F7F9F7;
        }

        .gr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--gr-text);
        }

        .gr-page .section-lead {
            color: var(--gr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .gr-page .card {
            border: none;
            border-left: 4px solid var(--gr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .gr-page .card.card-final {
            border-left-color: var(--gr-accent);
        }

        .gr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--gr-border);
            padding: 1rem 1.5rem;
        }

        .gr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--gr-text);
            display: flex;
            align-items: center;
        }

        .gr-page .card-header h4 i {
            color: var(--gr-primary);
        }

        .gr-page .card-body {
            padding: 1.5rem;
        }

        .gr-page .filter-label {
            color: var(--gr-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .gr-page .form-control {
            border-color: var(--gr-border);
            border-radius: 7px;
        }

        .gr-page .form-control:focus {
            border-color: var(--gr-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .gr-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .gr-page .table {
            margin-bottom: 0;
        }

        .gr-page .table thead th {
            background: var(--gr-primary-light);
            color: var(--gr-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .gr-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--gr-text);
            padding: .8rem .9rem;
        }

        .gr-page .table-bordered td,
        .gr-page .table-bordered th {
            border-color: var(--gr-border);
        }

        .gr-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .gr-page .table-wide {
            min-width: 1200px;
        }

        .gr-page .table-wide th,
        .gr-page .table-wide td {
            white-space: nowrap;
        }

        .gr-page .badge-soft {
            display: inline-block;
            background: var(--gr-primary-light);
            color: var(--gr-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .gr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .gr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .gr-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--gr-muted);
        }

        .gr-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .gr-page .btn-primary {
            background: var(--gr-primary);
            border-color: var(--gr-primary);
        }

        .gr-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .gr-page .btn-ghost {
            color: var(--gr-muted);
            background: transparent;
            border: 1px solid var(--gr-border);
        }

        .gr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--gr-text);
        }

        .gr-page .btn-add {
            background: var(--gr-accent);
            border-color: var(--gr-accent);
            color: #fff;
        }

        .gr-page .btn-add:hover {
            background: #C77B30;
            border-color: #C77B30;
            color: #fff;
        }

        .gr-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .gr-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .gr-page .card-body {
                padding: 1rem;
            }

            .gr-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="gr-page">

        <div class="section-header">

            <h1>Grinder</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="#">
                        Grinder
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses grinder berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.grinder.index') }}">

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

                        <a href="{{ route('manager.grinder.index') }}" class="btn btn-ghost">

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
                    Data Grinder

                </h4>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>

                            <tr>

                                <th class="text-center">
                                    No
                                </th>

                                <th>
                                    Production Batch
                                </th>

                                <th>
                                    Tanggal Produksi
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Line
                                </th>

                                <th>
                                    Ukuran Saringan
                                </th>

                                <th>
                                    Hasil
                                </th>

                                <th>
                                    Waktu Mulai
                                </th>

                                <th>
                                    Waktu Selesai
                                </th>

                                <th>
                                    Downtime
                                </th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($grinders as $index => $grinder)
                                <tr>

                                    <td class="text-center">
                                        {{ $grinders->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($grinder->productionBatch)
                                            <span class="badge-soft">
                                                {{ $grinder->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->productionBatch && $grinder->productionBatch->tanggal_produksi)
                                            {{ $grinder->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->productionBatch && $grinder->productionBatch->product)
                                            {{ $grinder->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->line)
                                            <span class="badge-value">
                                                {{ $grinder->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->ukuran_saringan)
                                            <span class="badge-soft">
                                                {{ $grinder->ukuran_saringan }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->hasil)
                                            {{ $grinder->hasil }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->waktu_mulai)
                                            {{ $grinder->waktu_mulai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->waktu_selesai)
                                            {{ $grinder->waktu_selesai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($grinder->downtime)
                                            <span class="badge-value">
                                                {{ $grinder->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.grinder.detail', $grinder->id) }}"
                                                class="btn btn-outline-info">

                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="11">

                                        <div class="empty-state">

                                            <i class="fas fa-cogs d-block"></i>

                                            <div>
                                                Belum ada data Grinder.
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

                {{ $grinders->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
