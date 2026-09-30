@extends('layouts.master')

@section('title', 'HLT')

@section('content')

    <style>
        :root {
            --hlt-primary: #1B4B43;
            --hlt-primary-light: #E8F0EE;
            --hlt-accent: #D98C3D;
            --hlt-border: #E3E7E1;
            --hlt-text: #1F2A24;
            --hlt-muted: #5B6A62;
            --hlt-soft: #F7F9F7;
        }

        .hlt-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--hlt-text);
        }

        .hlt-page .section-lead {
            color: var(--hlt-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .hlt-page .card {
            border: none;
            border-left: 4px solid var(--hlt-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .hlt-page .card.card-final {
            border-left-color: var(--hlt-accent);
        }

        .hlt-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--hlt-border);
            padding: 1rem 1.5rem;
        }

        .hlt-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--hlt-text);
            display: flex;
            align-items: center;
        }

        .hlt-page .card-header h4 i {
            color: var(--hlt-primary);
        }

        .hlt-page .card-body {
            padding: 1.5rem;
        }

        .hlt-page .filter-label {
            color: var(--hlt-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .hlt-page .form-control {
            border-color: var(--hlt-border);
            border-radius: 7px;
        }

        .hlt-page .form-control:focus {
            border-color: var(--hlt-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .hlt-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .hlt-page .table {
            margin-bottom: 0;
        }

        .hlt-page .table thead th {
            background: var(--hlt-primary-light);
            color: var(--hlt-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .hlt-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--hlt-text);
            padding: .8rem .9rem;
        }

        .hlt-page .table-bordered td,
        .hlt-page .table-bordered th {
            border-color: var(--hlt-border);
        }

        .hlt-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .hlt-page .table-wide {
            min-width: 1750px;
        }

        .hlt-page .table-wide th,
        .hlt-page .table-wide td {
            white-space: nowrap;
        }

        .hlt-page .badge-soft {
            display: inline-block;
            background: var(--hlt-primary-light);
            color: var(--hlt-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .hlt-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .hlt-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .hlt-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--hlt-muted);
        }

        .hlt-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .hlt-page .btn-primary {
            background: var(--hlt-primary);
            border-color: var(--hlt-primary);
        }

        .hlt-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .hlt-page .btn-ghost {
            color: var(--hlt-muted);
            background: transparent;
            border: 1px solid var(--hlt-border);
        }

        .hlt-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--hlt-text);
        }

        .hlt-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .hlt-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .hlt-page .card-body {
                padding: 1rem;
            }

            .hlt-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="hlt-page">

        <div class="section-header">
            <h1>HLT</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">
                        HLT
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Monitoring proses HLT berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.hlt.index') }}">

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
                                    Kode Product
                                </label>

                                <input type="text" name="kode_product" class="form-control"
                                    placeholder="Cari kode product..." value="{{ request('kode_product') }}">
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

                        <a href="{{ route('manager.hlt.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-fire mr-2"></i>
                    Data HLT
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
                                <th>Suhu Awal Daging</th>
                                <th>Suhu Infeed</th>
                                <th>Suhu Outfeed</th>
                                <th>Steam Valve</th>
                                <th>Speed Ventilator</th>
                                <th>Lama Pemasakan</th>
                                <th>Suhu Pusat CT</th>
                                <th>Organoleptik</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($hlts as $index => $hlt)
                                <tr>

                                    <td class="text-center">
                                        {{ $hlts->firstItem() + $index }}
                                    </td>

                                    <td>
                                        @if ($hlt->productionBatch)
                                            <span class="badge-soft">
                                                {{ $hlt->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->productionBatch && $hlt->productionBatch->tanggal_produksi)
                                            {{ $hlt->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->productionBatch && $hlt->productionBatch->product)
                                            {{ $hlt->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->line)
                                            <span class="badge-value">
                                                {{ $hlt->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->suhu_awal_daging !== null)
                                            {{ $hlt->suhu_awal_daging }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->suhu_infeed !== null)
                                            {{ $hlt->suhu_infeed }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->suhu_outfeed !== null)
                                            {{ $hlt->suhu_outfeed }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->steam_valve !== null)
                                            {{ $hlt->steam_valve }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->speed_ventilator !== null)
                                            {{ $hlt->speed_ventilator }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->lama_pemasakan !== null)
                                            {{ $hlt->lama_pemasakan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->suhu_pusat_ct !== null)
                                            {{ $hlt->suhu_pusat_ct }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->organoleptik)
                                            <span class="badge-soft">
                                                {{ $hlt->organoleptik }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->waktu_mulai)
                                            {{ $hlt->waktu_mulai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->waktu_selesai)
                                            {{ $hlt->waktu_selesai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($hlt->downtime)
                                            <span class="badge-value">
                                                {{ $hlt->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.hlt.detail', $hlt->id) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="17">

                                        <div class="empty-state">

                                            <i class="fas fa-fire d-block"></i>

                                            <div>
                                                Belum ada data HLT.
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
                {{ $hlts->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
