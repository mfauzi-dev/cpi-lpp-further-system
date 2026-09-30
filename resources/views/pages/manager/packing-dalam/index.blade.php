@extends('layouts.master')

@section('title', 'Packing Dalam')

@section('content')

    <style>
        :root {
            --pd-primary: #1B4B43;
            --pd-primary-light: #E8F0EE;
            --pd-accent: #D98C3D;
            --pd-border: #E3E7E1;
            --pd-text: #1F2A24;
            --pd-muted: #5B6A62;
            --pd-soft: #F7F9F7;
        }

        .pd-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pd-text);
        }

        .pd-page .section-lead {
            color: var(--pd-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pd-page .card {
            border: none;
            border-left: 4px solid var(--pd-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .pd-page .card.card-final {
            border-left-color: var(--pd-accent);
        }

        .pd-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pd-border);
            padding: 1rem 1.5rem;
        }

        .pd-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pd-text);
            display: flex;
            align-items: center;
        }

        .pd-page .card-header h4 i {
            color: var(--pd-primary);
        }

        .pd-page .card-body {
            padding: 1.5rem;
        }

        .pd-page .filter-label {
            color: var(--pd-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .pd-page .form-control {
            border-color: var(--pd-border);
            border-radius: 7px;
        }

        .pd-page .form-control:focus {
            border-color: var(--pd-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .pd-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pd-page .table {
            margin-bottom: 0;
        }

        .pd-page .table thead th {
            background: var(--pd-primary-light);
            color: var(--pd-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .pd-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--pd-text);
            padding: .8rem .9rem;
        }

        .pd-page .table-bordered td,
        .pd-page .table-bordered th {
            border-color: var(--pd-border);
        }

        .pd-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pd-page .table-wide {
            min-width: 1900px;
        }

        .pd-page .table-wide th,
        .pd-page .table-wide td {
            white-space: nowrap;
        }

        .pd-page .badge-soft {
            display: inline-block;
            background: var(--pd-primary-light);
            color: var(--pd-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pd-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pd-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pd-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pd-muted);
        }

        .pd-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .pd-page .btn-primary {
            background: var(--pd-primary);
            border-color: var(--pd-primary);
        }

        .pd-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pd-page .btn-ghost {
            color: var(--pd-muted);
            background: transparent;
            border: 1px solid var(--pd-border);
        }

        .pd-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pd-text);
        }

        .pd-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .pd-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .pd-page .card-body {
                padding: 1rem;
            }

            .pd-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="pd-page">

        <div class="section-header">
            <h1>Packing Dalam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">
                        Packing Dalam
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses packing dalam berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('manager.packing-dalam.index') }}">

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

                        <a href="{{ route('manager.packing-dalam.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-box mr-2"></i>
                    Data Packing Dalam
                </h4>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Kode Product</th>
                                <th>Tanggal Produksi</th>
                                <th>Product</th>
                                <th>Line</th>
                                <th>MHW Korin</th>
                                <th>Heating Level</th>
                                <th>Speed</th>
                                <th>Pressure</th>
                                <th>Packing Manual</th>
                                <th>Timbangan</th>
                                <th>Heating Level Packing Manual</th>
                                <th>Waktu Awal</th>
                                <th>Waktu Akhir</th>
                                <th>PIC Produksi</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($packingDalams as $index => $packingDalam)
                                <tr>

                                    <td class="text-center">
                                        {{ $packingDalams->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($packingDalam->productionBatch && $packingDalam->productionBatch->product)
                                            <span class="badge-soft">
                                                {{ $packingDalam->productionBatch->product->kode_product }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->productionBatch && $packingDalam->productionBatch->tanggal_produksi)
                                            {{ $packingDalam->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->productionBatch && $packingDalam->productionBatch->product)
                                            {{ $packingDalam->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->productionBatch && $packingDalam->productionBatch->line)
                                            <span class="badge-value">
                                                {{ $packingDalam->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->mhw_korin)
                                            {{ $packingDalam->mhw_korin }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->heating_level !== null)
                                            {{ $packingDalam->heating_level }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->speed !== null)
                                            {{ $packingDalam->speed }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->pressure !== null)
                                            {{ $packingDalam->pressure }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->packing_manual)
                                            {{ $packingDalam->packing_manual }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->timbangan)
                                            {{ $packingDalam->timbangan }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->heating_level_packing_manual !== null)
                                            {{ $packingDalam->heating_level_packing_manual }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->waktu_awal)
                                            {{ $packingDalam->waktu_awal }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->waktu_akhir)
                                            {{ $packingDalam->waktu_akhir }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($packingDalam->pic_produksi)
                                            {{ $packingDalam->pic_produksi }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.packing-dalam.detail', $packingDalam->id) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="16">

                                        <div class="empty-state">

                                            <i class="fas fa-box d-block"></i>

                                            <div>
                                                Belum ada data Packing Dalam.
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
                {{ $packingDalams->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
