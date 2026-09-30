@extends('layouts.master')

@section('title', 'Packing Luar')

@section('content')

    <style>
        :root {
            --pl-primary: #1B4B43;
            --pl-primary-light: #E8F0EE;
            --pl-accent: #D98C3D;
            --pl-border: #E3E7E1;
            --pl-text: #1F2A24;
            --pl-muted: #5B6A62;
            --pl-soft: #F7F9F7;
        }

        .pl-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pl-text);
        }

        .pl-page .section-lead {
            color: var(--pl-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pl-page .card {
            border: none;
            border-left: 4px solid var(--pl-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .pl-page .card.card-final {
            border-left-color: var(--pl-accent);
        }

        .pl-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pl-border);
            padding: 1rem 1.5rem;
        }

        .pl-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pl-text);
            display: flex;
            align-items: center;
        }

        .pl-page .card-header h4 i {
            color: var(--pl-primary);
        }

        .pl-page .card-body {
            padding: 1.5rem;
        }

        .pl-page .filter-label {
            color: var(--pl-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .pl-page .form-control {
            border-color: var(--pl-border);
            border-radius: 7px;
        }

        .pl-page .form-control:focus {
            border-color: var(--pl-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .pl-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pl-page .table {
            margin-bottom: 0;
        }

        .pl-page .table thead th {
            background: var(--pl-primary-light);
            color: var(--pl-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .pl-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--pl-text);
            padding: .8rem .9rem;
        }

        .pl-page .table-bordered td,
        .pl-page .table-bordered th {
            border-color: var(--pl-border);
        }

        .pl-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pl-page .table-wide {
            min-width: 1550px;
        }

        .pl-page .table-wide th,
        .pl-page .table-wide td {
            white-space: nowrap;
        }

        .pl-page .badge-soft {
            display: inline-block;
            background: var(--pl-primary-light);
            color: var(--pl-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pl-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pl-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pl-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pl-muted);
        }

        .pl-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .pl-page .btn-primary {
            background: var(--pl-primary);
            border-color: var(--pl-primary);
        }

        .pl-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pl-page .btn-ghost {
            color: var(--pl-muted);
            background: transparent;
            border: 1px solid var(--pl-border);
        }

        .pl-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pl-text);
        }

        .pl-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .pl-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .pl-page .card-body {
                padding: 1rem;
            }

            .pl-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="pl-page">

        <div class="section-header">

            <h1>Packing Luar</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="#">
                        Packing Luar
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses packing luar berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.packing-luar.index') }}">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label class="filter-label">
                                    Kode Product
                                </label>

                                <input type="text" name="kode_product" class="form-control"
                                    placeholder="Cari kode product..." value="{{ request('kode_product') }}">

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

                        <a href="{{ route('manager.packing-luar.index') }}" class="btn btn-ghost">

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
                    <i class="fas fa-box-open mr-2"></i>
                    Data Packing Luar
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
                                    Kode Product
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
                                    Pengisian ke Dalam Box
                                </th>

                                <th>
                                    Sealer Box
                                </th>

                                <th>
                                    Check Weigher Box
                                </th>

                                <th>
                                    Waktu Awal
                                </th>

                                <th>
                                    Waktu Akhir
                                </th>

                                <th>
                                    PIC Produksi
                                </th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($packingLuars as $index => $packingLuar)
                                <tr>

                                    <td class="text-center">
                                        {{ $packingLuars->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($packingLuar->productionBatch && $packingLuar->productionBatch->product)
                                            <span class="badge-soft">
                                                {{ $packingLuar->productionBatch->product->kode_product }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->productionBatch && $packingLuar->productionBatch->tanggal_produksi)
                                            {{ $packingLuar->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->productionBatch && $packingLuar->productionBatch->product)
                                            {{ $packingLuar->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->productionBatch && $packingLuar->productionBatch->line)
                                            <span class="badge-value">
                                                {{ $packingLuar->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->pengisian_ke_dalam_box)
                                            {{ $packingLuar->pengisian_ke_dalam_box }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->sealer_box)
                                            {{ $packingLuar->sealer_box }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->check_weigher_box)
                                            {{ $packingLuar->check_weigher_box }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->waktu_awal)
                                            {{ $packingLuar->waktu_awal }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->waktu_akhir)
                                            {{ $packingLuar->waktu_akhir }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($packingLuar->pic_produksi)
                                            {{ $packingLuar->pic_produksi }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.packing-luar.detail', $packingLuar->id) }}"
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

                                            <i class="fas fa-box-open d-block"></i>

                                            <div>
                                                Belum ada data Packing Luar.
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

                {{ $packingLuars->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
