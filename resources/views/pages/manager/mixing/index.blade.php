@extends('layouts.master')

@section('title', 'Mixing')

@section('content')

    <style>
        :root {
            --mx-primary: #1B4B43;
            --mx-primary-light: #E8F0EE;
            --mx-accent: #D98C3D;
            --mx-border: #E3E7E1;
            --mx-text: #1F2A24;
            --mx-muted: #5B6A62;
            --mx-soft: #F7F9F7;
        }

        .mx-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--mx-text);
        }

        .mx-page .section-lead {
            color: var(--mx-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .mx-page .card {
            border: none;
            border-left: 4px solid var(--mx-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .mx-page .card.card-final {
            border-left-color: var(--mx-accent);
        }

        .mx-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--mx-border);
            padding: 1rem 1.5rem;
        }

        .mx-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--mx-text);
            display: flex;
            align-items: center;
        }

        .mx-page .card-header h4 i {
            color: var(--mx-primary);
        }

        .mx-page .card-body {
            padding: 1.5rem;
        }

        .mx-page .filter-label {
            color: var(--mx-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .mx-page .form-control {
            border-color: var(--mx-border);
            border-radius: 7px;
        }

        .mx-page .form-control:focus {
            border-color: var(--mx-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .mx-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .mx-page .table {
            margin-bottom: 0;
        }

        .mx-page .table thead th {
            background: var(--mx-primary-light);
            color: var(--mx-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .mx-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--mx-text);
            padding: .8rem .9rem;
        }

        .mx-page .table-bordered td,
        .mx-page .table-bordered th {
            border-color: var(--mx-border);
        }

        .mx-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .mx-page .table-wide {
            min-width: 1700px;
        }

        .mx-page .table-wide th,
        .mx-page .table-wide td {
            white-space: nowrap;
        }

        .mx-page .badge-soft {
            display: inline-block;
            background: var(--mx-primary-light);
            color: var(--mx-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .mx-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .mx-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .mx-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--mx-muted);
        }

        .mx-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .mx-page .btn-primary {
            background: var(--mx-primary);
            border-color: var(--mx-primary);
        }

        .mx-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .mx-page .btn-ghost {
            color: var(--mx-muted);
            background: transparent;
            border: 1px solid var(--mx-border);
        }

        .mx-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--mx-text);
        }

        .mx-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .mx-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .mx-page .card-body {
                padding: 1rem;
            }

            .mx-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="mx-page">

        <div class="section-header">

            <h1>Mixing</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">

                    <a href="#">
                        Mixing
                    </a>

                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Monitoring proses mixing berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>

                    <i class="fas fa-filter mr-2"></i>
                    Filter Data

                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.mixing.index') }}">

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

                        <a href="{{ route('manager.mixing.index') }}" class="btn btn-ghost">

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
                    Data Mixing

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
                                <th>Mixer Preparation</th>
                                <th>Suhu Air</th>
                                <th>Lama Pengadukan</th>
                                <th>Filter</th>
                                <th>Salinity</th>
                                <th>Brix</th>
                                <th>Mixer</th>
                                <th>Suhu Adonan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th class="text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($mixings as $index => $mixing)
                                <tr>

                                    <td class="text-center">

                                        {{ $mixings->firstItem() + $index }}

                                    </td>

                                    <td>

                                        @if ($mixing->productionBatch)
                                            <span class="badge-soft">

                                                {{ $mixing->productionBatch->no_batch }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->productionBatch && $mixing->productionBatch->tanggal_produksi)
                                            {{ $mixing->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->productionBatch && $mixing->productionBatch->product)
                                            {{ $mixing->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->line)
                                            <span class="badge-value">

                                                {{ $mixing->line }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->mixer_preparation)
                                            <span class="badge-soft">

                                                {{ $mixing->mixer_preparation }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->suhu_air !== null)
                                            {{ $mixing->suhu_air }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->lama_pengadukan !== null)
                                            {{ $mixing->lama_pengadukan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->filter)
                                            <span class="badge-soft">

                                                {{ $mixing->filter }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->salinity !== null)
                                            {{ $mixing->salinity }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->brix)
                                            {{ $mixing->brix }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->mixer)
                                            <span class="badge-soft">

                                                {{ $mixing->mixer }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->suhu_adonan !== null)
                                            {{ $mixing->suhu_adonan }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->waktu_mulai)
                                            {{ $mixing->waktu_mulai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->waktu_selesai)
                                            {{ $mixing->waktu_selesai }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($mixing->downtime)
                                            <span class="badge-value">

                                                {{ $mixing->downtime }}

                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.mixing.detail', $mixing->id) }}"
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

                                            <i class="fas fa-blender d-block"></i>

                                            <div>
                                                Belum ada data Mixing.
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

                {{ $mixings->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
